<?php

namespace App\Http\Controllers\backend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\coupon;
use Illuminate\Http\Request;

class couponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $datatable)
    {
        return $datatable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'code' => ['required', 'max:200'],
            'qty' => ['required', 'integer'],
            'max_use' => ['required','integer'],
            'start' => ['required'],
            'end'   => ['required'],
            'type' => ['required', 'integer'],
            'value' => ['required', 'integer', 'max: 100'],
        ]);

        $coupon = new coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->qty = $request->qty;
        $coupon->max_use = $request->max_use;
        $coupon->start = $request->start;
        $coupon->end   = $request->end;
        $coupon->type = $request->type;
        $coupon->value  = $request->value;
        $coupon->status = 1;
        $coupon->total_used = 0;
        $coupon->save();
        toastr('Kupon berhasil ditambahkan');
        return redirect()->route('admin.coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
