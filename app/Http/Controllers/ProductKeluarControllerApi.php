<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Helpers\Helper;
use App\Product_Keluar;
use App\Product;
use App\Category;
use App\Customer;
use Barryvdh\DomPDF\PDF;
use Yajra\DataTables\DataTables;
use App\Exports\ExportProdukKeluar;

class ProductKeluarControllerApi extends Controller
{
    // ...
    public function addProductKeluar(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'qty' => 'required',
        ]);
    
        DB::beginTransaction();
    
        try {
            $ProductKeluar = new Product_Keluar();
            $ProductKeluar->product_id = $request->product_id;
            $ProductKeluar->customer_id = $request->customer_id;
            $ProductKeluar->qty = $request->qty;
            $ProductKeluar->tanggal = now()->toDateTimeString(); // Tambahkan tanggal saat ini menggunakan now()
    
            $ProductKeluar->save();
    
            $product = Product::findOrFail($request->product_id);
            $product->qty -= $request->qty;
            $product->save();
    
            DB::commit();
    
            return Helper::toJson([
                'message' => 'Product Keluar added successfully',
                'ProductKeluar' => $ProductKeluar
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
    
            return response()->json([
                'error' => 'Failed to add Product Keluar'
            ], 500);
        }
    }
    
    public function getProductKeluar(){
        $ProductKeluar = Product_Keluar::orderBy("id", "desc")->get();
        return Helper::toJson($ProductKeluar);
    }
}