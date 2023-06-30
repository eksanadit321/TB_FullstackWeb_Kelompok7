<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Category;

class CategoryControllerApi extends Controller
{


    public function getCategory(){
        $Category = Category::orderBy("id", "desc")->get();
        return Helper::toJson($Category);
    }

    public function addCategory(Request $request)
    {
        

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return Helper::toJson([
            'message' => 'Category added successfully',
            'category' => $category
        ], 201);
    }
}