<?php

use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\CustomerAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Customer authentication
Route::post('/customer/register', [CustomerAuthenticationController::class, 'customer_register']);
Route::post('/customer/login', [CustomerAuthenticationController::class, 'customer_login']);
Route::post('/customer/logout', [CustomerAuthenticationController::class, 'customer_logout']);
// Category
Route::get('/get/category',[CategoryApiController::class, 'get_category']);
// Product
Route::get('/get/product', [CategoryApiController::class, 'get_product']);
