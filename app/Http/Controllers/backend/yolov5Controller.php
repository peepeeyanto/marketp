<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class yolov5Controller extends Controller
{
    public function index(){
        return view('frontend.grading.index');
    }

    public function filegrade(){
        return view('frontend.grading.filegrade');
    }


    public function cameragrade(){
        return view('frontend.grading.cameratest');
    }

    public function detect(Request $request){
        $request->validate([
            'image' => ['required', 'image', 'max:2048']
        ]);

        $image = $request->file('image');

        $response = Http::attach(
            'file', file_get_contents($image->getRealPath()), $image->getClientOriginalName()
        )->post('http://43.216.253.86:8000/object-to-img/');


        // Handle the response
        if ($response->successful()) {
            return $response->json();
        } else {
            // Handle the case where the request failed
            abort(200);
        }
    }

    public function cameratest(){
        return view('frontend.grading.cameratest');
    }
}
