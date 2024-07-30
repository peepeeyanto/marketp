<?php

namespace App\Http\Controllers\backend;

use App\DataTables\sellerProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\subCategory;
use App\Traits\imageUploadsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
class sellerProductController extends Controller
{
    use imageUploadsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(sellerProductDataTable $datatable)
    {
        return $datatable->render('seller.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all();
        return view('seller.products.create', compact('categories'));
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

    public function getSubcategories(Request $request){
        $subcategories = subCategory::where('category_id', $request->id)->get();
        return $subcategories;
    }
}
