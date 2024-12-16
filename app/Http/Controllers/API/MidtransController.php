<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request){

        
        // Log the entire request for debugging
        \Log::info('Midtrans Callback', $request->all());

        // Get server key securely
        $serverKey = config('services.midtrans.serverKey');
        
        // Ensure all required parameters are present
        if (!$request->order_id || !$request->status_code || 
            !$request->gross_amount || !$request->signature_key) {
            return response()->json([
                'meta' => [
                    'code' => 400,
                    'message' => 'Missing required parameters'
                ]
            ], 400);
        }

        // Create signature hash exactly as Midtrans expects
        $signatureInput = $request->order_id . $request->status_code . $request->gross_amount . $serverKey;
        $hashed = hash("sha512", $signatureInput);
        
        // Debugging output
        \Log::info('Signature Verification', [
            'received_signature' => $request->signature_key,
            'calculated_signature' => $hashed,
            'signature_input' => $signatureInput
        ]);

        // Strict signature comparison
        if ($hashed !== $request->signature_key) {
            return response()->json([
                'meta' => [
                    'code' => 400,
                    'message' => 'Invalid signature'
                ]
            ], 400);
        }

        // Extract transaction ID
        $trxID = explode('-', $request->order_id);
        
        // Find the transaction
        $transaction = Transaction::find($trxID[1]);
        
        if (!$transaction) {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'message' => 'Transaction not found'
                ]
            ], 404);
        }

        // Handle different transaction statuses
        $transactionStatus = $request->transaction_status;
        
        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $transaction->update(['payment_status' => 'paid']);
                break;
            case 'pending':
                $transaction->update(['payment_status' => 'pending']);
                break;
            case 'deny':
            case 'cancel':
                $transaction->update(['payment_status' => 'failed']);
                break;
        }

        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => $transaction->payment_status
            ]
        ]);

    }
}
