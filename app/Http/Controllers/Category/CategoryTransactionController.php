<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($category_id)
    {
        //
        $category = Category::findOrfail($category_id);
        $transactions = $category->products()->wherehas('transactions')->with('transactions')->get()->pluck('transactions')->collapse();
       
        return $this->showAll($transactions);
    }

   
}
