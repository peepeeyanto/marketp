<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sellerController extends Controller
{
    public function dashboard() {
        return view('seller.dashboard');
    }
}
