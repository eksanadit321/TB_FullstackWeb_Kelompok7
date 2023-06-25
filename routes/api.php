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
    
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
Route::post('login', 'AuthController@login');
Route::post('usersjwt', 'UserControllerApi@store');
Route::get('usersjwt', 'UserControllerApi@index');

Route::group([
    'middleware' => ['api', 'jwt.verify'],
], function ($router) {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
