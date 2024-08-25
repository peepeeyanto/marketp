<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class demoProduct extends Controller
{
    public function index(){
        $products = product::all();
        return view('frontend.pages.demo-product', compact('products'));
    }
}
