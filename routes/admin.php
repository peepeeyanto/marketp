<?php

use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\profileController;
use App\Http\Controllers\backend\sliderController;
use App\Http\Controllers\backend\subCategoryController;
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
