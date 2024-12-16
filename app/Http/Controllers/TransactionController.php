<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('service','reservations')->get();
        return view('transaction.index', compact('transaction'));
    }
}
