<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class paymentController extends Controller
{
    public function index(){
        if(!Session::has('shipping_address')){
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }
}
