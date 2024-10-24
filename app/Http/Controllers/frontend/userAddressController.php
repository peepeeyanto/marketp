<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\userAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = userAddress::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'phone' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'lat'=>['required'],
            'lon'=>['required'],
            'address' => ['required'],
        ]);

        $address = new userAddress();
        $address->name=$request->name;
        $address->user_id = Auth::user()->id;
        $address->phone=$request->phone;
        $address->state=$request->state;
        $address->city=$request->city;
        $address->zip=$request->zip;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->address=$request->address;
        $address->save();
        toastr('alamat berhasil ditambahkan', 'success');
        return redirect()->route('user.address.index');
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
        $address = userAddress::findOrFail($id);
        return view('frontend.dashboard.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'phone' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'lat'=>['required'],
            'lon'=>['required'],
            'address' => ['required'],
        ]);

        $address = userAddress::findOrFail($id);
        $address->name=$request->name;
        $address->user_id = Auth::user()->id;
        $address->phone=$request->phone;
        $address->state=$request->state;
        $address->city=$request->city;
        $address->zip=$request->zip;
        $address->lat = $request->lat;
        $address->lon = $request->lon;
        $address->address=$request->address;
        $address->save();
        toastr('alamat berhasil diubah', 'success');
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = userAddress::findOrFail($id);
        $address->delete();
        return response(['status' => 'success', 'message' => 'alamat berhasil dihapus']);
    }
}
