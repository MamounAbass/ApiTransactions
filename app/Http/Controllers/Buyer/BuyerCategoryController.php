<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($buyer_id)
    {
        $buyer = Buyer::findOrfail($buyer_id);
        //We can access to the Product through many transactions with egr loading and with the Product we can access to the  
        // to the Sellers and with pluck method we can select only that instense of seller throght prodcuts and transactions 
        $categories = $buyer->transactions()->with('product.categories')->get()->pluck('product.categories')->collapse()->unique('id')->values();
        return $this->showAll($categories);
    }

  
}
