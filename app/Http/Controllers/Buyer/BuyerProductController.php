<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($buyer_id)
    {
        $buyer = Buyer::findOrfail($buyer_id);
        //We can access to the product through many transactions with egr loading 
        // and with pluck method we can select only that instense content produt
        $produts = $buyer->transactions()->with('product')->get()->pluck('product');
        return $this->showAll($produts);
    }

}
