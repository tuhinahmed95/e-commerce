<?php

use App\Http\Controllers\API\CategoryApiController;
    use Illuminate\Support\Facades\Route;


    Route::get('get/category',[CategoryApiController::class,'get_category']);
