<?php

use App\Http\Controllers\backend\sellerChatListController;
use App\Http\Controllers\backend\sellerController;
use App\Http\Controllers\backend\sellerProductController;
use App\Http\Controllers\backend\sellerProductImageGalleryController;
use App\Http\Controllers\backend\sellerProductReviewController;
use App\Http\Controllers\backend\sellerProductsVariantItemController;
use App\Http\Controllers\backend\sellerProductVariantController;
use App\Http\Controllers\backend\sellerShopProfileController;
use App\Http\Controllers\frontend\sellerOrderController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [sellerController::class, 'dashboard'])->name('dashboard');

Route::resource('shop-profile', sellerShopProfileController::class);

Route::get('products/get-subcategories', [sellerProductController::class, 'getSubcategories'])->name('products.getSubcategories');
Route::resource('products', sellerProductController::class);

Route::resource('products-image-gallery', sellerProductImageGalleryController::class);

Route::put('products-variant/change-status', [sellerProductVariantController::class, 'changeStatus'])->name('products-variant.changeStatus');
Route::resource('products-variant', sellerProductVariantController::class);

Route::get('products-variant-item/create/{productID}/{variantID}', [sellerProductsVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [sellerProductsVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemID}', [sellerProductsVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemID}', [sellerProductsVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemID}', [sellerProductsVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [sellerProductsVariantItemController::class, 'changeStatus'])->name('products-variant-item.changeStatus');
Route::get('products-variant-item/{productID}/{variantID}', [sellerProductsVariantItemController::class, 'index'])->name('products-variant-item.index');

Route::get('orders', [sellerOrderController::class, 'index'])->name('orders.index');
Route::get('orders/show/{id}', [sellerOrderController::class,'show'])->name('orders.show');
Route::get('orders/changeStatus/{id}', [sellerOrderController::class, 'changeStatus'])->name('orders.changeStatus');

Route::get('reviews', [sellerProductReviewController::class, 'index'])->name('reviews.index');

Route::get('chat-list', [sellerChatListController::class, 'index'])->name('chat-list');
