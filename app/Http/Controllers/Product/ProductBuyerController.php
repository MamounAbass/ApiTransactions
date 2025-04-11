<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $Product)
    {
        $buyer = $Product->transactions()->with('buyer')->get()->pluck('buyer')->unique('id')->values();

        return response()->json(['data'=>$buyer],200);
    }

   
}
