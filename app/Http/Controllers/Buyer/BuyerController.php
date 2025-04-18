<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Buyer;


class BuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers =Buyer::has('transactions')->get();
       
        return response()->json(['data'=>$buyers],200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buyer =Buyer::has('transactions')->findOrfail($id);
        return response()->json(['data'=>$buyer],200);
    }

}
