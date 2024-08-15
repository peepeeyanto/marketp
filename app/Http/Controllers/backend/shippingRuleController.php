<?php

namespace App\Http\Controllers\backend;

use App\DataTables\shippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\shippingRule;
use Illuminate\Http\Request;
class shippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(shippingRuleDataTable $datatable)
    {
        return $datatable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $shipping = new shippingRule();
        $shipping->name = $request->name;
        $shipping->type = $request->type;
        $shipping->min_cost = $request->min_cost;
        $shipping->cost = $request->cost;
        $shipping->status = $request->status;
        $shipping->save();
        toastr('berhasil dibuat', 'success');
        return redirect()->route('admin.shipping-rule.index');
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
        $shipping = shippingRule::findOrFail($id);
        return view('admin.shipping-rule.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shipping = shippingRule::findOrFail($id);
        $request->validate([
            'name' => ['required','max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required'],
        ]);

        $shipping = shippingRule::findOrFail($id);
        $shipping->name = $request->name;
        $shipping->type = $request->type;
        $shipping->min_cost = $request->min_cost;
        $shipping->cost = $request->cost;
        $shipping->status = $request->status;
        $shipping->save();
        toastr('berhasil diupdate', 'success');
        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipping = shippingRule::findOrFail($id);
        $shipping->delete();

        return response(['status' => 'success', 'message' => 'data berhasil dihapus']);
    }

    public function changeStatus(Request $request)
    {
        $shipping = shippingRule::findOrFail($request->id);
        $shipping->status = $request->status == 'true'? 1 : 0;
        $shipping->save();
        return response(['status' => 'succcess', 'message' => 'status berhasil diupdate']);
    }
}
