<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Seller $Seller)
    {
        
        $products = $Seller->products;

        return response()->json(['data'=>$products],200);
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Seller $Seller , Product $Product)
    { 
         
        $rules =[
            'name'=>'required',
            'description'=>'required',
            'quantity'=>'required|integer|min:1',
           // 'image'=>'required|image'
        ];

        $this->validate($request,$rules);
       
        $data = $request->all();

        $data['status']= Product::UNAVILABLE_PRODUCT;
        $data['image']='1.jpg';
        $data['seller_id'] =$Seller->id;
      
        $Product = Product::create($data);
        
        return response()->json(['data'=>$Product],201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Seller $Seller , Product $Product)
    {
        $rules =[
        'quantity'=>'integer|min:1',
        'status'=>'in:'.Product::UNAVILABLE_PRODUCT.','.Product::AVILABLE_PRODUCT,
        //'image'=>'image',
        ];

        $this->validate($request,$rules);

        $this->checkSeller($Seller,$Product);


        if ($request->has('status')) {

               $Product->status = $request->status;
               if ($Product->isAvilable && $Product->categories()->count()==0) {
                   
                   return $this->errorResponse('An active product must have at least one category',409);
               }
               if ($Product->isClean) {
                   return $this->errorResponse('you need to specifiy a different vaule to update ' ,422);
               }
        }

        $Product->image = '2.jpg';
        $Product->seller_id= $Seller->id;
      
        if($request->has('name'))
        {
            $Product->name = $request->name;
        }
        if($request->has('description'))
        {
            $Product->description = $request->description;
        }
        if($request->has('quantity'))
        {
            $Product->quantity = $request->quantity;
        }
       
        
           $Product->save();

           return $this->showOne($Product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $Seller , Product $Product)
    {
       $this->checkSeller($Seller,$Product);

        $Seller->delete();

        return $this->showOne($Seller);
    }

    protected function checkSeller(Seller $Seller, Product $Product)
    {
        
        if ($Seller->id != $Product->seller_id) {
            
            return response()->json(['error'=>' the specified seller is not the actual seller of the products','code'=>422],422);
        }
    }
}