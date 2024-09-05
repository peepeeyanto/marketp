<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class trackOrderController extends Controller
{
    public function index(){
        return view('frontend.pages.trackorder');
    }

    public function trackstatus(Request $request){
        $request->validate([
            'waybill_id' => ['required', 'string'],
            'courier' => ['required', 'string'],
        ]);

        // Get waybill ID and courier code from request
        $waybillId = $request->waybill_id;
        $courier = $request->courier;

        $option = [
            'version' => 2,
        ];
        $header = [
            'authorization' => config('biteship.apikey'),
            'content-type' => 'application/json'
        ];
        // Make API call to the external tracking service

        $response = Http::withOptions($option)->withHeaders($header)->get("https://api.biteship.com/v1/trackings/{$waybillId}/couriers/{$courier}")->json();

        // dd($response);
        // Check if the response is successful
        if ($response['success'] == true) {
            return $response;
        }

        // Return an error response
        return response()->json(['error' => $response['error']], 400);
    }
}
