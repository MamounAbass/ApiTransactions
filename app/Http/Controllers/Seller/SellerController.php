<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index( )
    {
        $sellers = Seller::has('products')->get();
        return response()->json(['data'=>$sellers],200);
    }

    public function show(string $id)
    {
        //
        $sellers = Seller::has('products')->findOrfail($id);
        
        return response()->json(['data'=>$sellers],200);
    }

   
}
