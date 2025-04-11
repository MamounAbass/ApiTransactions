<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $Product)
    {
        $categories = $Product->categories()->get();

        return $this->showAll($categories);
    }

    public function update(Request $Request , Product $Product , Category $Category)
    {
        // we can updata many to many realtion with method
        // attach , syn , synwith..........
        $Product->categories()->attach([$Category->id]);

        return $this->showAll($Product->categories);
    }

    public function destroy(Product $Product , Category $Category)
    {
        if (!$Product->categories()->find($Category->id)) {
            
            return $this->errorResponse('The specified category is not category of this product',404);
        }
        $Product->categories()->detach($Category->id);

        return $this->showAll($Product->categories);
    }

}
