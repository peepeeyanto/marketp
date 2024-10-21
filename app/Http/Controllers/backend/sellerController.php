<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\product;
use App\Models\productReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class sellerController extends Controller
{
    public function dashboard() {

        if(empty(Auth::user()->vendor->id)) {
            return view('seller.dashboard.dashboard');
        }

        $todayorder = order::whereDate('created_at', Carbon::today())
        ->whereHas('orderProduct', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })
        ->count();

        $todayPendingOrder = orderProduct::whereDate('created_at', Carbon::today())
        ->where('order_status', 0)
        ->where('vendor_id',Auth::user()->vendor->id)
        ->count();

        $totalOrder = order::whereHas('orderProduct', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })
        ->count();

        $totalPendingOrder = orderProduct::where('vendor_id', Auth::user()->vendor->id)
        ->where('order_status', 0)
        ->count();

        $totalCompleteOrder = orderProduct::where('vendor_id', Auth::user()->vendor->id)
        ->where('order_status', 4)
        ->count();

        // $todayEarning = order::whereDate('created_at', Carbon::today())
        // ->whereHas('orderProduct', function($query){
        //     $query->where('vendor_id', Auth::user()->vendor->id)->where('order_status', 4);
        // })
        // ->sum('subtotal');

        // $monthEarning = order::whereMonth('created_at', Carbon::now()->month)
        // ->whereHas('orderProduct', function($query){
        //     $query->where('vendor_id', Auth::user()->vendor->id)->where('order_status', 4);
        // })
        // ->sum('subtotal');

        // $totalEarning = orderProduct::where('vendor_id', Auth::user()->vendor->id)->where('order_status', 4)
        // ->sum('subtotal');

        $totalProduct = product::where('vendor_id', Auth::user()->vendor->id)->count();

        $totalReview = productReview::whereHas('product', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })
        ->count();

        return view('seller.dashboard.dashboard', compact(
            'todayorder',
            'todayPendingOrder',
            'totalOrder',
            'totalPendingOrder',
            'totalCompleteOrder',
            'totalProduct',
            // 'todayEarning',
            // 'totalEarning',
            // 'monthEarning',
            'totalReview'
        ));
    }
}
