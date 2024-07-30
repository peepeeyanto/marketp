<?php

use App\Http\Controllers\backend\sellerController;
use App\Http\Controllers\backend\sellerProductController;
use App\Http\Controllers\backend\sellerShopProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [sellerController::class, 'dashboard'])->name('dashboard');

Route::resource('shop-profile', sellerShopProfileController::class);

Route::get('products/get-subcategories', [sellerProductController::class, 'getSubcategories'])->name('products.getSubcategories');
Route::resource('products', sellerProductController::class);
