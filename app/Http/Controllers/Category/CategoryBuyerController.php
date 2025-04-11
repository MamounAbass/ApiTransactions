<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryBuyerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($category_id)
    {
        $category = Category::findOrfail($category_id);
        $buyers = $category->products()->wherehas('transactions')->with('transactions.buyer')->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id')->values();
       
        return $this->showAll($buyers);
    }

  
}
