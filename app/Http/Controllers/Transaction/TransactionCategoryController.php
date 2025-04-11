<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($transaction_id)
    {
        $transaction = Transaction::findOrfail($transaction_id);
        $categories = $transaction->product->categories;
        
        return $this->showAll($categories);
    }

}
