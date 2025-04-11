<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Seller $Seller)
    {
        //$seller = Seller::findOrfail($seller_id);
        $Categories = $Seller->products()->with('categories')->get()->pluck('categories')->collapse()->unique()->values();
        return $this->showall($Categories);
    }

}
