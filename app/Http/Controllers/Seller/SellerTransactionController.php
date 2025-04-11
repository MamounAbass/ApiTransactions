<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Seller $Seller)
    {
        $transations = $Seller->products()->with('transactions')->get()->pluck('transactions')->collapse();
        return $this->showall($transations);
    }

    
}
