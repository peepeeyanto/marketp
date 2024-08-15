<?php

namespace App\Http\Controllers\backend;

use App\DataTables\sellerProductImageGalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\productImageGallery;
use App\Traits\imageUploadsTrait;
use Illuminate\Http\Request;

class sellerProductImageGalleryController extends Controller
{
    use imageUploadsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ,sellerProductImageGalleryDataTable $datatable)
    {
        $product = product::findOrFail($request->product);
        if($product->vendor_id != auth()->user()->vendor->id){
            abort(404);
        }
        return $datatable->render('seller.products.image-gallery.index', compact('product'));
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
        $request->validate([
            'image.*' => ['required', 'image', 'max:2048'],
        ]);

        $imagepaths = $this->imageUploadMultiple($request, 'image', 'uploads');

        foreach($imagepaths as $path){
            $productimagegallery = new productImageGallery();
            $productimagegallery->image = $path;
            $productimagegallery->product_id = $request->product;
            $productimagegallery->save();
        }

        toastr('berhasil diupload', 'success');
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
        $productimage = productImageGallery::findOrFail($id);
        if($productimage ->product->vendor_id != auth()->user()->vendor->id){
            abort(404);
        }
        $this->imageDelete($productimage->image);
        $productimage->delete();
        return response(['message' => 'berhasil dihapus', 'status' => 'success']);
    }
}
