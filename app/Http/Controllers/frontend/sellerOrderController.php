<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\sellerOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\resi;
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

    public function resi(String $id){
        $order = order::findOrFail($id);
        if ($order->vendor_id != auth()->user()->vendor->id) {
            abort(404);
        }
        return view('seller.order.tambahresi', compact('order'));
    }

    public function resiStore(Request $request){
        $request->validate([
            'resi' => 'required',
            'orderId' => 'required',
        ]);

        $resi = new resi();
        $resi->order_id = $request->orderId;
        $resi->resi = $request->resi;
        $resi->save();

        $order = order::findOrFail($request->orderId);
        $order->order_status = 3;
        $order->save();
        toastr('resi berhasil ditambah', 'success');
        return redirect()->route('seller.orders.index');
    }

    public function changeStatus(Request $request){
        $order = orderProduct::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        toastr('success', 'Order Status Changed Successfully');
        return redirect()->back();
    }
}
