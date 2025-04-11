<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();

        return response()->json(['data'=>$products],200);
    }

   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrfail($id);

        return response()->json(['data'=>$product],200);
    }

}
