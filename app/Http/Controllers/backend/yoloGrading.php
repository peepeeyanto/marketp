<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class yoloGrading extends Controller
{
    public function index(){
        return view('frontend.pages.yoloGrading');
    }

    public function predict(Request $request){
        $request->validate([
            'image' => ['required', 'image', 'max:2048']
        ]);

        $image = $request->file('image');

        $response = Http::attach(
            'file', file_get_contents($image->getRealPath()), $image->getClientOriginalName()
        )->post('http://localhost:8000/predictwithclasses/');

        // Handle the response
        if ($response->successful()) {
            return $response->json();
        } else {
            // Handle the case where the request failed
            abort(200);
        }
    }
}
