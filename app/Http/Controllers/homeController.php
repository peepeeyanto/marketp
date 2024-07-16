<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        $sliders = slider::where('status', '1')->orderBy('serial','asc')->get();
        return view('frontend.home.home', compact('sliders'));
    }
}
