<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Product;


class ProductControllerApi extends Controller
{
    // ...

    public function addProduct(Request $request)
    {
        $Product = new Product();
        $Product->nama = $request->nama;
        $Product->harga = $request->harga;
        $Product->qty = $request->qty;
        $Product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = str_slug($request->nama, '-') . '.' . $image->getClientOriginalExtension();
            $imagePath = '/upload/products/' . $imageName;
            $image->move(public_path('/upload/products/'), $imageName);
            $Product->image = $imagePath;
        }

        $Product->save();

        return Helper::toJson([
            'message' => 'Product added successfully',
            'Product' => $Product
        ], 201);
    }
    public function getProduct(){
        $Product = Product::orderBy("id", "desc")->get();
        return Helper::toJson($Product);
    }
}