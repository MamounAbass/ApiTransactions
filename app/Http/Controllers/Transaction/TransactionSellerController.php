<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($transaction_id)
    {
         $transaction = Transaction::findOrfail($transaction_id);
         $seller = $transaction->product->Seller;
        
        return $this->showOne($seller);
    }
}
