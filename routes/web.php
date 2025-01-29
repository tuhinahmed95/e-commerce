<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FronendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FronendController::class,'welcome'])->name('index');
Route::get('product/details/{id}',[FronendController::class,'product_details'])->name('product.details');

Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';

// banner
Route::get('/banner',[BannerController::class,'banner'])->name('banner');
Route::post('/banner/store',[BannerController::class,'banner_store'])->name('banner.store');
Route::get('/banner/delete/{id}',[BannerController::class,'banner_delete'])->name('banner.delete');



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
    Route::get('/product/edit/{id}',[ProductController::class,'product_edit'])->name('product.eidt');
    Route::post('/product/update/{id}',[ProductController::class,'product_update'])->name('product.update');
    Route::get('/product/delete/{id}',[ProductController::class,'product_delete'])->name('product.delete');
    Route::post('/getSubcategory',[ProductController::class,'getsubcategory']);
    Route::post('/getStatus',[ProductController::class,'getStatus']);

    // Brand
    Route::get('/brand/create',[BrandController::class,'brand_create'])->name('brand.create');
    Route::get('/brand/list',[BrandController::class,'brand_list'])->name('brand.list');
    Route::post('/brand/store',[BrandController::class,'brand_store'])->name('brand.store');
    Route::get('/brand/edit/{id}',[BrandController::class,'brand_edit'])->name('brand.edit');
    Route::post('/brand/update/{id}',[BrandController::class,'brand_update'])->name('brand.update');
    Route::get('/brand/delete/{id}',[BrandController::class,'brand_delete'])->name('brand.delete');

    // Variation
    Route::get('/variation',[VariationController::class,'variation'])->name('variation');
    Route::post('/variation/store',[VariationController::class,'variation_store'])->name('variation.store');
    Route::get('/variation/delete/{id}',[VariationController::class,'variation_delete'])->name('variation.delete');

    Route::post('/size/stor',[VariationController::class,'size_store'])->name('size.store');
    Route::get('/size/delete/{id}',[VariationController::class,'size_delete'])->name('size.delete');

    // Inventory
   Route::get('/inventory/{id}',[InventoryController::class,'add_inventory'])->name('add.inventory');
   Route::post('/inventory/store/{id}',[InventoryController::class,'inventory_store'])->name('inventory.store');
   Route::get('/inventory/delete/{id}',[InventoryController::class,'inventory_delete'])->name('inventory.delete');

//    Offers
    Route::get('/offer',[OfferController::class,'offer'])->name('offer');
    Route::post('/offer/update/{id}',[OfferController::class,'offer1_update'])->name('offer1.update');
    Route::post('/offer2/update/{id}',[OfferController::class,'offer2_update'])->name('offer2.update');

    // Subscribe
    Route::get('/subscribe',[FronendController::class,'subscribe'])->name('subscribe');
    Route::post('/subscribe/store',[FronendController::class,'subscribe_store'])->name('subscribe.store');


});


