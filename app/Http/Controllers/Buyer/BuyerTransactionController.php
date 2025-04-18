<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($Buyer_id)
    {
        $buyer = Buyer::findOrfail($Buyer_id);
        $transactions =$buyer->transactions;
        return $this->showAll($transactions);
    }

    
}
