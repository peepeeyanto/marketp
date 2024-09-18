<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reviewController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'rating' => ['required'],
            'review' => ['required', 'max:200'],
            'image.*' => ['required', 'image']
        ]);
    }
}
