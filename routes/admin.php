<?php

use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\adminProductReviewController;
use App\Http\Controllers\backend\adminVendorProfile;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\customerListController;
use App\Http\Controllers\backend\orderController;
use App\Http\Controllers\backend\productController;
use App\Http\Controllers\backend\productImageGalleryController;
use App\Http\Controllers\backend\productsVariantsController;
use App\Http\Controllers\backend\productVariantController;
use App\Http\Controllers\backend\profileController;
use App\Http\Controllers\backend\sellerListController;
use App\Http\Controllers\backend\shippingRuleController;
use App\Http\Controllers\backend\sliderController;
use App\Http\Controllers\backend\subCategoryController;
use App\Http\Controllers\backend\vendorProductController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [profileController::class, 'index'])->name('profile');
Route::post('profile/update', [profileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [profileController::class, 'updatePassword'])->name('password.update');

Route::resource('slider', sliderController::class);

Route::put('change-status', [categoryController::class, 'changeStatus'])->name('category.changeStatus');

Route::resource('category', categoryController::class);

Route::put('subcategory/change-status', [subCategoryController::class, 'changeStatus'])->name('subcategory.changeStatus');
Route::resource('subcategory', subCategoryController::class);

Route::resource('vendor-profile', adminVendorProfile::class);

Route::get('product/get-subcategories', [productController::class, 'getSubcategories'])->name('product.getsubcategories');

Route::resource('products', productController::class);
Route::resource('products-image-gallery', productImageGalleryController::class);

Route::put('products-variant/change-status', [productVariantController::class, 'changeStatus'])->name('products-variant.changeStatus');
Route::resource('products-variant', productVariantController::class);

Route::get('products-variant-item/create/{productID}/{variantID}', [productsVariantsController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [productsVariantsController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{variantItemID}', [productsVariantsController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemID}', [productsVariantsController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemID}', [productsVariantsController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [productsVariantsController::class, 'changeStatus'])->name('products-variant-item.changeStatus');
Route::get('products-variant-item/{productID}/{variantID}', [productsVariantsController::class, 'index'])->name('products-variant-item.index');

Route::get('vendor-product', [vendorProductController::class, 'index'])->name('vendor-product.index');

Route::put('shipping-rule/change-status', [shippingRuleController::class, 'changeStatus'])->name('shipping-rule.changeStatus');
Route::resource('shipping-rule', shippingRuleController::class);

Route::get('order-status', [orderController::class,'changeStatus'])->name('order.status');
Route::get('payment-status', [orderController::class, 'changePaymentStatus'])->name('order.payment_status');
Route::resource('order', orderController::class);

Route::put('reviews/change-status', [adminProductReviewController::class, 'changeStatus'])->name('review.change_status');
Route::get('reviews', [adminProductReviewController::class,'index'])->name('review.index');

Route::put('customers/change-status', [customerListController::class, 'changeStatus'])->name('customers.change-status');
Route::get('customers', [customerListController::class, 'index'])->name('customers.index');

Route::put('sellers/change-status', [sellerListController::class, 'changeStatus'])->name('sellers.change-status');
Route::get('sellers', [sellerListController::class, 'index'])->name('sellers.index');
