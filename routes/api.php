<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('role:admin')->get('/admin', function () {
    return "You have admin access.";
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    
    Route::post('logout', 'AuthControllerApi@logout');
    Route::post('refresh', 'AuthControllerApi@refresh');
    Route::post('me', 'AuthControllerApi@me');
});
Route::post('login', 'AuthControllerApi@login');
Route::post('usersjwt', 'UserControllerApi@store');
Route::get('usersjwt', 'UserControllerApi@index');

Route::group([
    'middleware' => ['api', 'jwt.verify'],
], function ($router) {
    Route::post('logout', 'AuthControllerApi@logout');
    Route::post('refresh', 'AuthControllerApi@refresh');
    Route::post('me', 'AuthControllerApi@me');
});

Route::resource('products', 'ProductControllerApi');

// Route::middleware('auth:api')->group(function () {
//     Route::resource('products', ProductControllerApi::class);
// });


Route::group([
    'middleware' => ['api', 'jwt.verify'],
], function ($router) {

    Route::get('category', 'CategoryControllerApi@getCategory');
    Route::post('addCategory', 'CategoryControllerApi@addCategory');

    Route::get('products', 'ProductControllerApi@getProduct');
    Route::post('addProducts', 'ProductControllerApi@addProduct');

    Route::get('supplier', 'SupplierControllerApi@getSupplier');

    Route::get('customer', 'CustomerControllerApi@getCustomer');
   
    
});