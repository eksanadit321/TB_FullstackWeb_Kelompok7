<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Supplier;

class SupplierControllerApi extends Controller
{
    // ...

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            
        ]);

        $Supplier = new Supplier();
        $Supplier->nama = $request->input('nama');
        $Supplier->harga= $request->input('harga');
        $Supplier->save();

        return response()->json(['message' => 'Supplier created successfully'], 201);
    }

    public function index()
    {
        $Suppliers = Supplier::all();

        return response()->json($Suppliers);
    }

    public function getSupplier(){
        $Supplier = Supplier::orderBy("id", "desc")->get();
        return Helper::toJson($Supplier);
    }
}