<?php

use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\profileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [profileController::class, 'index'])->name('profile');
Route::post('profile/update', [profileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [profileController::class, 'updatePassword'])->name('password.update');
