<?php

namespace App\Http\Controllers\backend;

use App\DataTables\sellerProductDataTable;
use App\DataTables\sellerProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\productVariant;
use App\Models\productVariantItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sellerProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(sellerProductVariantDataTable $dataTable, Request $request)
    {
        $product = product::findOrFail($request->product);
        if($product->vendor_id!= auth()->user()->vendor->id){
            abort(404);
        }
        return $dataTable->render('seller.products.products-variant.index', compact('product'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seller.products.products-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $variant = new productVariant();
        $variant->product_id = $request->product;
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr('kategori varian berhasil ditambahkan', 'success');
        return redirect()->route('seller.products-variant.index', ['product' => $request->product]);
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
        $variant = productVariant::findOrFail($id);
        if($variant->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        return view('seller.products.products-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'status' => ['required']
        ]);

        $variant = productVariant::findOrFail($id);
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        toastr('kategori varian berhasil diubah', 'success');
        return redirect()->route('seller.products-variant.index', ['product' => $variant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = productVariant::findOrFail($id);
        if($variant->product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }
        $variantItemCheck = productVariantItem::where('product_variant_id', $id)->count();
        if($variantItemCheck > 0){
            return response(['status'=>'error', 'message'=>'kategori varian tidak bisa dihapus karena memiliki item varian']);
        }
        $variant->delete();
        return response(['status'=>'success', 'message'=>'kategori varian berhasil dihapus']);
    }

    public function changeStatus(Request $request){
        $variant = productVariant::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();
        return response(['status' => 'success', 'message' => 'status berhasil diubah']);
    }
}
