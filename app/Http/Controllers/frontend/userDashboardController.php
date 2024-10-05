<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\product;
use App\Models\productReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userDashboardController extends Controller
{
    public function index(){
        $totalOrder = order::where('user_id', Auth::user()->id)->count();
        $review = productReview::where('user_id', Auth::user()->id)->count();
        return view('frontend.dashboard.dashboard', compact('totalOrder', 'review'));
    }
}
