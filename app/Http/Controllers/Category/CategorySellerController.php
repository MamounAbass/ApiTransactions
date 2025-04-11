<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index($category_id)
    {
        $category = Category::findOrfail($category_id);
        $sellers = $category->products()->with('seller')->get()->pluck('seller')->unique()->values();
       
        return $this->showAll($sellers);
    }

}
