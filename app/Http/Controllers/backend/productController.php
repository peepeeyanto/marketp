<?php

namespace App\Http\Controllers\backend;

use App\DataTables\productDataTable;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\productImageGallery;
use App\Models\productVariant;
use App\Models\subCategory;
use App\Traits\imageUploadsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class productController extends Controller
{
    use imageUploadsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(productDataTable $datatable)
    {
        return $datatable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required']
        ]);

        $imagepath = $this->imageUpload($request, 'image', 'uploads');

        $product = new product();
        $product->thumb_image = $imagepath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->sku = $request->sku;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->save();

        toastr('produk berhasil dibuat', 'success');
        return redirect()->back();
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
        $categories = category::all();
        $product = product::findOrFail($id);
        $subcategories = subCategory::where('category_id', $product->category_id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required']
        ]);

        $product = product::findOrFail($id);

        $imagepath = $this->imageUpdate($request, 'image', 'uploads', $product->thumb_image);


        $product->thumb_image = empty(!$imagepath) ? $imagepath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->sku = $request->sku;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->save();

        toastr('produk berhasil diupdate', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::findOrFail($id);
        $this->imageDelete($product->thumb_image);
        $galleryImages = productImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImages as $image) {
            $this->imageDelete($image->image);
            $image->delete();
        }
        $variants = productVariant::where('product_id', $product->id)->get();
        foreach ($variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }
        $product->delete();
        return response(['status' => 'success', 'message' => 'produk berhasil dihapus']);
    }

    public function getSubcategories(Request $request){
        $subcategories = subCategory::where('category_id', $request->id)->get();
        return $subcategories;
    }
}
