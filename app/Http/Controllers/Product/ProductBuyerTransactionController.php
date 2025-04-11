<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductBuyerTransactionController extends ApiController
{
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Product $Product , User $Buyer)
    {
        $rules = [
            'quantity'=>'required|integer|min:1'
        ];

        $this->validate($request,$rules);

        //dd($Buyer->isAdmin());

        if ($Buyer->id == $Product->seller_id) {
            # code...
            return $this->errorResponse('The Buer must be different from the seller ',409);
        }
        if (!$Buyer->verified == 1) {
            # code...
            return $this->errorResponse('The Buyer must be verified User ...',409);
        }
        if (!$Product->seller->verified ==1) {
            # code...
            return $this->errorResponse('The Seller must be verified User ...',409);
        }
        if (!$Product->status == 'avilable') {
            # code...
            return $this->errorResponse('The product is not Available ...',409);
        }
        if ($Product->quantity < $request->quantity) {
            # code...
            return $this->errorResponse('The product does not have enough units for this transaction ...',409);
        }

        DB::transaction(function () use ($request ,$Product ,$Buyer) {
            $Product->quantity -= $request->quantity;
            $Product->save();
            
            $transaction = Transaction::create([
                'quantity'=>$request->quantity,
                'buyer_id'=>$Buyer->id,
                'product_id'=>$Product->id,
            ]);

             return $this->showone($transaction,201);
        });

      

    }

}
