<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\shipping_couriers;
use App\Models\vendor;
use App\Traits\imageUploadsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sellerShopProfileController extends Controller
{
    use imageUploadsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('seller.shop-profile.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request)->all();
        $request->validate([
            'banner' => ['required', 'image', 'max:3000'],
            'shop_name' => ['required','max:200'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'zipcode' => ['required'],
            'description' => ['required',],
            'couriers' => ['required']
        ]);

        $vendor = new vendor();
        $bannerPath = $this->imageUpload($request, 'banner', 'uploads');
        $vendor->user_id = Auth::user()->id;
        $vendor->banner = $bannerPath;
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->city = $request->city;
        $vendor->province = $request->province;
        $vendor->zipcode = $request->zipcode;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->save();

        $shipcourier = new shipping_couriers();
        $shipcourier->vendor_id = $vendor->id;
        $shipcourier->couriers = json_encode($request->couriers);
        $shipcourier->lat = $request->lat;
        $shipcourier->lon = $request->lon;
        $shipcourier->is_local_deliveries = $request->is_localdelivery == 'on'? '1': '0';
        $shipcourier->is_COD_enabled = $request->is_cod == 'on'? '1': '0';
        $shipcourier->base_cost = $request->base;
        $shipcourier->cost_per_km = $request->perkm;
        $shipcourier->save();


        toastr('Pembuatan Toko Berhasil', 'success');
        return redirect()->route('seller.dashboard');
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
    public function edit()
    {
        $profile = vendor::where('user_id', Auth::user()->id)->first();
        return view('seller.shop-profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'max:3000'],
            'shop_name' => ['required','max:200'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'zipcode' => ['required'],
            'description' => ['required',],
        ]);

        $vendor = vendor::where('user_id', Auth::user()->id)->first();
        $bannerPath = $this->imageUpdate($request, 'banner', 'uploads', $vendor->banner);
        $vendor->banner = empty(!$bannerPath) ? $bannerPath : $vendor->banner;
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->city = $request->city;
        $vendor->province = $request->province;
        $vendor->zipcode = $request->zipcode;
        $vendor->save();

        toastr('Berhasil Diupdate', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
