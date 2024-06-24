<?php

use App\Http\Controllers\backend\adminController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
