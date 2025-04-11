<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions =Transaction::all();

        return $this->showAll($transactions);
    }

    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transactions =Transaction::findOrfail($id);

        return $this->showOne($transactions);
    }

}
