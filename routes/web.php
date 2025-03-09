<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FronendController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PassresetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/',[FronendController::class,'welcome'])->name('index');
Route::get('product/details/{slug}',[FronendController::class,'product_details'])->name('product.details');
Route::post('/getSize',[FronendController::class,'getSize']);
// Route::post('/getQuantity',[FronendController::class,'getQuantity']);
Route::get('/shop',[FronendController::class,'shop'])->name('shop');
Route::get('/recent/view',[FronendController::class,'recent_view'])->name('recent.view');
Route::get('/faqs',[FronendController::class,'faqs'])->name('faqs');

Route::get('/dashboard', [HomeController::class,'dashboard'])->middleware(['auth','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__.'/auth.php';
// require __DIR__.'/api.php';
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

    //  Tags
    Route::get('/tag', [TagController::class, 'tag'])->name('tag');
    Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');
    Route::get('/tag/delte/{id}', [TagController::class, 'tag_delete'])->name('tag.delete');

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

    // Cupon
    Route::get('/cupon/list',[CuponController::class,'cupon_list'])->name('cupon.list');
    Route::get('/cupon/create',[CuponController::class,'cupon_create'])->name('cupon.create');
    Route::post('/cupon/store',[CuponController::class,'cupon_store'])->name('cupon.store');
    Route::get('/cupon/status/{id}',[CuponController::class,'cupon_status'])->name('cupon.status');
    Route::get('/cupon/edit/{id}',[CuponController::class,'cupon_edit'])->name('cupon.edit');
    Route::post('/cupon/update/{id}',[CuponController::class,'cupon_update'])->name('cupon.update');
    Route::get('/cupon/delete/{id}',[CuponController::class,'cupon_delete'])->name('cupon.delete');

});

 // Customer
 Route::get('/customer/githubredirect',[CustomerAuthController::class,'githubredirect_login'])->name('githubredirect.login');
 Route::get('/customer/githubcallback',[CustomerAuthController::class,'githubcallback_login'])->name('githubcallback.login');

 Route::get('/customer/googleredirect',[CustomerAuthController::class,'googleredirect_login'])->name('googleredirect.login');
 Route::get('/customer/googlecallback',[CustomerAuthController::class,'googlecallback_login'])->name('googlecallback.login');
 Route::get('/customer/login',[CustomerAuthController::class,'customer_login'])->name('customer.login');
 Route::get('/customer/register',[CustomerAuthController::class,'customer_register'])->name('customer.register');
 Route::post('/customer/store',[CustomerAuthController::class,'customer_store'])->name('customer.store');
 Route::post('/customer/logged',[CustomerAuthController::class,'customer_logged'])->name('customer.logged');
 Route::get('/customer/profile',[CustomerController::class,'customer_profile'])->name('customer.profile');
 Route::get('/customer/logout',[CustomerController::class,'customer_logout'])->name('customer.logout');
 Route::post('/customer/update',[CustomerController::class,'customer_update'])->name('customer.update');
 Route::get('/customer/my/order',[CustomerController::class,'customer_order'])->name('customer.order');
 Route::get('/download/invoice/{id}',[CustomerController::class,'download_invoice'])->name('download.invoice');
//  email verify route
 Route::get('/customer/email/verify/{token}',[CustomerController::class,'customer_email_verify'])->name('customer.email.verify');
 Route::get('/resend/email/verify',[CustomerController::class,'resend_email_verify'])->name('resend.email.verify');
 Route::post('/resend/email/verification/link',[CustomerController::class,'resend_email_verification_link'])->name('resend.email.verification.link');

//  Cart
Route::post('/add/cart',[CartController::class,'add_cart'])->name('add.cart');
Route::get('/cart/remove/{id}',[CartController::class,'cart_remove'])->name('cart.remove');
Route::get('/cart',[CartController::class,'cart'])->name('cart')->middleware('customer');
Route::post('/cart/update',[CartController::class,'cart_update'])->name('cart.update');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/order/store', [CheckoutController::class,'order_store'])->name('order.store');
Route::get('/order/success', [CheckoutController::class,'order_success'])->name('order.success');

// Orders
Route::get('/orders',[OrderController::class,'orders'])->name('orders');
Route::post('/orders/status/update/{id}',[OrderController::class,'orders_status_update'])->name('orders.status.update');
Route::get('/order/cancel/customer/{id}', [OrderController::class, 'order_cancel'])->name('order.cancel');
Route::post('/order/cancel/request/{id}', [OrderController::class, 'order_cancel_request'])->name('order.cancel.request');
Route::get('/order/cancel/list', [OrderController::class,'order_cancel_list'])->name('order.cancel.list');
Route::get('/order/cancel/details/{id}', [OrderController::class, 'order_cancel_details'])->name('order.cancel.details');
Route::get('/order/cancel/accept/{id}', [OrderController::class, 'order_cancel_accept'])->name('order.cancel.accept');

// SSLCOMMERZ Start
Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('sslpay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// Reviews
Route::post('/review/store/{id}', [FronendController::class, 'review_store'])->name('review.store');

// Roll Manage
Route::get('/roll/manage', [RollController::class,'role_manage'])->name('roll.manage');
Route::post('/permission/store', [RollController::class,'permission_store'])->name('permission.store');
Route::post('/roll/store', [RollController::class,'role_store'])->name('role.store');
Route::get('/roll/delete/{id}', [RollController::class,'role_delete'])->name('role.delete');
Route::get('/roll/edit/{id}', [RollController::class,'role_edit'])->name('role.edit');
Route::post('/roll/update/{id}', [RollController::class,'role_update'])->name('role.update');
Route::post('/assign/role', [RollController::class,'assign_role'])->name('assign.role');
Route::get('/remove/role/{id}', [RollController::class,'remove_role'])->name('remove.role');

// Password Reset
Route::get('/forget/password', [PassresetController::class,'forget_password'])->name('forget.password');
Route::post('/password/reset/request', [PassresetController::class,'password_reset_request'])->name('password.reset.request');
Route::get('/password/reset/form/{token}', [PassresetController::class,'password_reset_form'])->name('password.reset.form');
Route::post('/password/reset/confirm/{token}', [PassresetController::class,'password_reset_confirm'])->name('password.reset.confirm');

// Faq
Route::resource('faq', FaqController::class);

// Product Api
Route::get('/product/api',[FronendController::class, 'product_api']);
Route::get('/category/api',[FronendController::class, 'category_api']);

// General Setting
Route::get('/general/setting', [GeneralSettingController::class, 'general_setting'])->name('general.logo');
Route::post('/general/store', [GeneralSettingController::class, 'general_store'])->name('general.logo.store');
Route::get('/general/edit/{id}', [GeneralSettingController::class, 'general_edit'])->name('general.logo.edit');
Route::post('/general/update/{id}', [GeneralSettingController::class, 'general_update'])->name('general.logo.update');
Route::post('/general/delete/{id}', [GeneralSettingController::class, 'general_delete'])->name('general.logo.delete');
