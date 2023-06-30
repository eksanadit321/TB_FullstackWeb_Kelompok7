<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Helpers\Helper;
use App\Product_Masuk;
use App\Product;
use App\Category;
use App\Customer;
use Barryvdh\DomPDF\PDF;
use Yajra\DataTables\DataTables;
use App\Exports\ExportProdukMasuk;

class ProductMasukControllerApi extends Controller
{
    // ...

   
public function addProductMasuk(Request $request)
{
    $request->validate([
        'product_id' => 'required',
        'supplier_id' => 'required',
        'qty' => 'required',
    ]);

    DB::beginTransaction();

    try {
        $ProductMasuk = new Product_Masuk();
        $ProductMasuk->product_id = $request->product_id;
        $ProductMasuk->supplier_id = $request->supplier_id;
        $ProductMasuk->qty = $request->qty;
        $ProductMasuk->tanggal = now()->toDateTimeString(); // Tambahkan tanggal saat ini menggunakan now()

        $ProductMasuk->save();

        $product = Product::findOrFail($request->product_id);
        $product->qty -= $request->qty;
        $product->save();

        DB::commit();

        return Helper::toJson([
            'message' => 'Product Masuk added successfully',
            'ProductMasuk' => $ProductMasuk
        ], 201);
    } catch (\Exception $e) {
        DB::rollback();

        return response()->json([
            'error' => 'Failed to add Product Masuk'
        ], 500);
    }
}
    public function getProductMasuk(){
        $ProductMasuk = Product_Masuk::orderBy("id", "desc")->get();
        return Helper::toJson($ProductMasuk);
    }
}