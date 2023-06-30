<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Customer;

class CustomerControllerApi extends Controller
{
    // ...

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            
        ]);

        $Customer = new Customer();
        $Customer->nama = $request->input('nama');
        $Customer->harga= $request->input('harga');
        $Customer->save();

        return response()->json(['message' => 'Customer created successfully'], 201);
    }

    public function index()
    {
        $Customers = Customer::all();

        return response()->json($Customers);
    }

    public function getCustomer(){
        $Customer = Customer::orderBy("id", "desc")->get();
        return Helper::toJson($Customer);
    }
}