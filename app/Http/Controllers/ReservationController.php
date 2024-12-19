<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\Reservation;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;
class ReservationController extends Controller
{
    public function book(Request $request){
        //dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|numeric',
            'customer_email' => 'required|email|max:255',
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $selectedService = Service::findOrFail($request->input('service_id'));
        $totalAmount = $selectedService->price;
        $discount = $request->input('discount', 0);
        $finalAmount = $totalAmount - ($totalAmount * ($discount / 100));

        // Create a new reservation
        $reservation = Reservation::create([
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_email' => $request->input('customer_email'),
            'service_id' => $request->input('service_id'),
            'reservation_date' => $request->input('reservation_date'),
            'notes' => $request->input('notes') ?? '',
            'status' => 'pending',
        ]);

        // Create a new transaction
        $transaction = Transaction::create([
            'reservation_id' => $reservation->id,
            'service_id'=> $reservation->service_id,
            'total_amount' => $totalAmount,
            'discount' => $discount,
            'final_amount' => $finalAmount,
            'payment_status' => 'pending',
            'payment_method' => 'MIDTRANS',
        ]);

        // Midtrans configuration
        \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is3ds');

        $midtransParams = [
            'transaction_details' => [
                'order_id' => 'snail_reservation-'. $transaction->id,
                'gross_amount' => $finalAmount,
            ],
            'customer_details' => [
                'first_name' => $request->input('customer_name'),
                'email' => $request->input('customer_email'),
                'phone' => $request->input('customer_phone'),
            ],
            'enabled_payments' => [
                'gopay', 'bank_transfer', 'alfamart', 'indomaret', 'shopeepay',
            ],
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s O'),
                'unit' => 'minute',
                'duration' => 15, // 90 menit = 1.5 jam
            ],
            'vtweb' => [],
        ];

        // dd($midtransParams); // Debugging point 1

        try {
            // Create Midtrans transaction
            $snapResponse = \Midtrans\Snap::createTransaction($midtransParams)->redirect_url;
            
            // dd($snapResponse); // Debugging point 2
            // Check the Midtrans response
            return redirect($snapResponse);
        } catch (\Exception $e) {
            // Handle any unexpected errors
            // dd($e); // Debugging point 3
            return redirect()->back()
                ->with('error', 'Failed to book appointment. Please try again.' . $e->getMessage());
        }put();
        }
        public function index(){
            $reservation = Reservation::with('service')->get();
            return view('reservation.index', compact('reservation'));
        }
        public function finish(Request $request)
        {
            $orderId = $request->input('order_id');
            $transactionId = str_replace('snail_reservation-', '', $orderId);
            
            try {
                $transaction = Transaction::findOrFail($transactionId);
                
                // Check payment status from database
                switch($transaction->payment_status) {
                    case 'paid':
                        return view('reservation.success', [
                            'transactionId' => $transactionId,
                            'orderId' => $orderId,
                            'totalAmount' => $transaction->final_amount,
                            'transactionStatus' => 'success',
                            'message' => 'Thank you for your payment. Please save this page as your payment proof. You can take a screenshot or download it for your records.'
                        ]);
                        
                    case 'pending':
                        return view('reservation.success', [
                            'transactionId' => $transactionId,
                            'orderId' => $orderId,
                            'totalAmount' => $transaction->final_amount,
                            'transactionStatus' => 'pending',
                            'message' => 'Your transaction is being processed. Please complete your payment within the time limit.'
                        ]);
                        
                    default:
                        return view('reservation.success', [
                            'transactionId' => $transactionId,
                            'orderId' => $orderId,
                            'totalAmount' => $transaction->final_amount,
                            'transactionStatus' => 'failed',
                            'message' => 'Payment failed. Please try again or contact our support.'
                        ]);
                }
                
            } catch (\Exception $e) {
                return view('reservation.success', [
                    'transactionId' => $transactionId,
                    'orderId' => $orderId,
                    'totalAmount' => 0,
                    'transactionStatus' => 'failed',
                    'message' => 'Transaction not found'
                ]);
            }
        }
    }

