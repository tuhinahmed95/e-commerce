<?php

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

//user
Route::get('/user/update',[UserController::class,'user_update'])->name('user.update');
Route::post('/user/info/update',[UserController::class,'user_info_update'])->name('user.info.update');

require __DIR__.'/auth.php';
