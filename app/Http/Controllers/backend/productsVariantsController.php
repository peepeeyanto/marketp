<?php

namespace App\Http\Controllers\backend;

use App\DataTables\productVariantDataTable;
use App\DataTables\productVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\productVariant;
use App\Models\productVariantItem;
use Illuminate\Http\Request;

class productsVariantsController extends Controller
{
    public function index(productVariantItemDataTable $datatable, $productID, $variantID){
        $product = product::findOrFail($productID);
        $variant = productVariant::findOrFail($variantID);
        return $datatable->render('admin.product.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productID, string $variantID){
        $variant = productVariant::findOrFail($variantID);
        $product = product::findOrFail($productID);
        return view('admin.product.product-variant-item.create', compact('variant' , 'product'));
    }

    public function store(Request $request){
        $request->validate([
            'variant_id' => ['required', 'integer'],
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantitem = new productVariantItem();
        $variantitem->product_variant_id = $request->variant_id;
        $variantitem->name = $request->name;
        $variantitem->price = $request->price;
        $variantitem->is_default = $request->is_default;
        $variantitem->status = $request->status;
        $variantitem->save();
        toastr('item varian berhasil dibuat', 'success');
        return redirect()->route('admin.products-variant-item.index', ['productID' => $request->product_id, 'variantID' => $request->variant_id]);
    }

    public function edit(string $variantItemID){
        $variantItem = productVariantItem::findOrFail($variantItemID);
        return view('admin.product.product-variant-item.edit', compact('variantItem'));
    }

    public function update(Request $request, string $variantItemID){
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['required', 'integer'],
            'is_default' => ['required'],
            'status' => ['required'],
        ]);

        $variantitem = productVariantItem::findOrFail($variantItemID);
        $variantitem->name = $request->name;
        $variantitem->price = $request->price;
        $variantitem->is_default = $request->is_default;
        $variantitem->status = $request->status;
        $variantitem->save();
        toastr('item varian berhasil diupdate', 'success');
        return redirect()->route('admin.products-variant-item.index', ['productID' => $variantitem->productVariant->product_id, 'variantID' => $variantitem->product_variant_id]);

    }

    public function destroy(string $variantItemID){
        $variantItem = productVariantItem::findOrFail($variantItemID);
        $variantItem->delete();
        toastr('item varian berhasil dihapus', 'success');
        return response(['status' => 'success', 'message' => 'item varian berhasil dihapus']);
    }

    public function changeStatus(Request $request){
        $variantItem = productVariantItem::findOrFail($request->id);
        $variantItem->status = $variantItem->status == 1 ? 0 : 1;
        $variantItem->save();
        toastr('status item varian berhasil diubah', 'success');
        return response(['status' => 'success', 'message' => 'status item varian berhasil diubah']);
    }
}
