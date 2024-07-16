<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\slider;
use App\Traits\imageUploadsTrait;
use Illuminate\Http\Request;

class sliderController extends Controller
{
    use imageUploadsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required', 'max:200'],
            'price' => ['max:200'],
            'buttonurl' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $slider = new slider();

        $imagepath = $this->imageUpload($request, 'banner', 'uploads');
        $slider->banner = $imagepath;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->startPrice = $request->price;
        $slider->buttonURL = $request->buttonurl;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();
        toastr('Berhasil ditambahkan', 'success');
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
        $slider = slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required', 'max:200'],
            'price' => ['max:200'],
            'buttonurl' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $slider = slider::findOrFail($id);

        $imagepath = $this->imageUpdate($request, 'banner', 'uploads', $slider->banner);
        $slider->banner = empty(!$imagepath) ? $imagepath : $slider->banner;
        $slider->type = $request->type;
        $slider->title = $request->title;
        $slider->startPrice = $request->price;
        $slider->buttonURL = $request->buttonurl;
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();
        toastr('Berhasil diubah', 'success');
        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = slider::findOrFail($id);
        $this->imageDelete($slider->banner);
        $slider->delete();

        return response(['stats' => 'success', 'message' => 'berhasil dihapus']);
    }
}
