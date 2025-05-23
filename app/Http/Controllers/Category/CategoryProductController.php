<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($category_id)
    {   
        $category = Category::findOrfail($category_id);
        $products = $category->products;
       
        return $this->showAll($products);
    }

   
}
