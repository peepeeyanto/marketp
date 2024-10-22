<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\userOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userOrderController extends Controller
{
    public function index(userOrderDataTable $datatable){
        return $datatable->render('frontend.dashboard.order.index');
    }

    public function show(string $id){
        $orders = order::findOrFail($id);
        return view('frontend.dashboard.order.show',compact('orders'));
    }

    public function complete(string $id){
        $orders = orderProduct::findorFail($id);
        if(Auth::user()->id == $orders->user_id){
            $orders->order_status = 4;
            $orders->save();
            toastr('Pesanan berhasil diselesaikan', 'success');
            return redirect()->back();
        }
        else{
            abort('404');
        }
    }
}
