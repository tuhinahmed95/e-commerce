<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FronendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
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
    Route::get('/category/soft/delete/{id}',[CategoryController::class,'category_soft_delete'])->name('category.soft.delete');
    Route::get('/category/trash',[CategoryController::class,'category_trash'])->name('category.trash');
    Route::get('/category/restore/{id}',[CategoryController::class,'category_restore'])->name('category.restore');
    Route::get('/category/permanent/delete/{id}',[CategoryController::class,'category_permanent_delete'])->name('category.permanent.delete');
    Route::get('/category/edit/{id}',[CategoryController::class,'category_edit'])->name('category.edit');
    Route::post('/category/update/{id}',[CategoryController::class,'category_update'])->name('category.update');
    Route::post('/checked/delete',[CategoryController::class,'checked_delete'])->name('checked.delete');
    Route::post('/checked/restore',[CategoryController::class,'checked_restore'])->name('checked.restore');

    //subcategory
    Route::get('/subcategory/create',[SubcategoryController::class,'sub_create'])->name('sub.category.create');
    Route::get('/subcategory/list',[SubcategoryController::class,'subcategory_list'])->name('sub.category.list');
    Route::post('/subcategory/store',[SubcategoryController::class,'subcategory_store'])->name('sub.category.store');
    Route::get('/subcategory/edit/{id}',[SubcategoryController::class,'subcategory_edit'])->name('sub.category.edit');
    Route::post('/subcategory/update/{id}',[SubcategoryController::class,'subcategory_update'])->name('sub.category.update');
    Route::get('/subcategory/delete/{id}',[SubcategoryController::class,'subcategory_delete'])->name('sub.category.delete');

    // Product
    Route::get('/product/list',[ProductController::class,'product_list'])->name('product.list');
    Route::get('/product/create',[ProductController::class,'product_create'])->name('prduct.create');
    Route::post('/product/store',[ProductController::class,'product_store'])->name('prduct.store');
});


