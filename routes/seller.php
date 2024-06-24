<?php

use App\Http\Controllers\backend\sellerController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [sellerController::class, 'dashboard'])->name('dashboard');
