<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\userOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class userOrderController extends Controller
{
    public function index(userOrderDataTable $datatable){
        return $datatable->render('frontend.dashboard.order.index');
    }

    public function show(string $id){
        $orders = order::findOrFail($id);
        return view('frontend.dashboard.order.show',compact('orders'));
    }
}
