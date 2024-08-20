<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class gradingController extends Controller
{
    public function index(){
        return view('frontend.pages.grading');
    }
}
