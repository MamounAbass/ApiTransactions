<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($seller_id)
    {
        $seller = Seller::findOrfail($seller_id);
        $buyers = $seller->products()->wherehas('transactions')->with('transactions.buyer')->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id')->values();
       
        return $this->showAll($buyers);
    }

   
}
