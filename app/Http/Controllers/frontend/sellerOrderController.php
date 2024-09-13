<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\sellerOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class sellerOrderController extends Controller
{
    public function index(sellerOrderDataTable $datatable){
        return $datatable->render('seller.order.index');
    }

    public function show($id){
        $orders = order::with(['orderProduct'])->findOrFail($id);
        return view('seller.order.show', compact('orders'));
    }

    public function changeStatus(Request $request, string $id){
        $order = order::findOrFail($id);
        $order->order_status = $request->status;
        $order->save();

        toastr('success', 'Order Status Changed Successfully');
        return redirect()->back();
    }
}
