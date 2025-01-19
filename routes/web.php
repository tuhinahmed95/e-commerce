<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FronendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FronendController::class,'welcome']);

Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';

 //user
 Route::get('/user/update',[UserController::class,'user_update'])->name('user.update');
 Route::post('/user/info/update',[UserController::class,'user_info_update'])->name('user.info.update');
 Route::post('password/update', [UserController::class,'password_update'])->name('password_update');
 Route::post('/photo/update',[UserController::class,'photo_update'])->name('photo.update');

//user-profile
 Route::post('user/add',[HomeController::class,'user_ad'])->name('user.add');
 Route::get('/user/list',[HomeController::class,'user_list'])->name('userlist');
 Route::get('/user/delete/{id}',[HomeController::class,'user_delete'])->name('user.delete');

Route::middleware('auth')->group(function () {

    //  category
    Route::get('/category/create',[CategoryController::class,'category_create'])->name('category.create');
    Route::post('category/store',[CategoryController::class,'category_store'])->name('category.store');
    Route::get('/category/list',[CategoryController::class,'category_list'])->name('category.list');
    Route::get('/category/update',[CategoryController::class,'category_update'])->name('category.edit');



});
