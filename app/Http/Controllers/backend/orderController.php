<?php

namespace App\Http\Controllers\backend;

use App\DataTables\orderDataTable;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(orderDataTable $datatable)
    {
        return $datatable->render('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = order::findOrFail($id);
        $order->orderProduct()->delete();
        $order->transaction()->delete();
        $order->delete();
        return response(['status' =>'success','message' => 'Order Berhasil Dihapus']);
    }

    public function changeStatus(Request $request){
        $order = order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();
        return response(['status' => 'success', 'message' =>'status berhasil diubah']);
    }

    public function changePaymentStatus (Request $request){
        $order = order::findOrFail($request->id);
        $order->payment_status  = $request->payment_status;
        $order->save();
        return response(['status' =>'success','message' => 'payment status berhasil diubah']);
    }
}
