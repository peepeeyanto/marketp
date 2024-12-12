<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\userOrderDatatable;
use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\userAddress;
use App\Models\vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userOrderController extends Controller
{
    public function index(userOrderDataTable $datatable){
        return $datatable->render('frontend.dashboard.order.index');
    }

    public function show(string $id){
        $orders = order::findOrFail($id);
        // $address = userAddress::findOrFail($orders->order_address);
        return view('frontend.dashboard.order.show',compact('orders'));
    }

    public function complete(string $id){
        $orders = order::findorFail($id);
        $vendor = vendor::findOrFail($orders->vendor_id);
        if(Auth::user()->id == $orders->user_id){
            $orders->order_status = 4;
            $orders->save();

            $vendor->balance = $vendor->balance + $orders->ammount;
            $vendor->save();

            toastr('Pesanan berhasil diselesaikan', 'success');
            return redirect()->back();
        }
        else{
            abort('404');
        }
    }
}
