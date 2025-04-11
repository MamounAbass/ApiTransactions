<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return $this->showAll($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules =[
            'name'=>'required',
            'description'=>'required'
        ];

        $this->validate($request,$rules);
        $category = Category::create($request->all());
        return $this->showone($category,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category ,$id)
    {
        $category = Category::findOrfail($id);
        return $this->showOne($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $rules =[
            'name'=>'required',
            'description'=>'required'
        ];

        $this->validate($request,$rules);

        $category = Category::findOrfail($id);

        $category->name = $request->name;
        $category->description= $request->description;
      
        if($category->isClean())
        {
            return $this->errorResponse('You need to Specfiy any differencet value to update',422);
            //return response()->json(['error'=> 'you need to specifiy diffirent value to updata','code'=>422],422);

        }

        $category->save();
        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return $this->showOne($category);
    }
}
