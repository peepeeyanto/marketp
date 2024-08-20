<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\shippingRule;
use App\Models\userAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class checkOutController extends Controller
{
    public function index(){
        $addresses = userAddress::where('user_id', Auth::user()->id)->get();
        $shippingMethod = shippingRule::where('status', '1')->get();
        return view('frontend.pages.checkout', compact('addresses', 'shippingMethod'));
    }

    public function storeAddress(Request $request){
        $request->validate([
            'name' => ['required', 'max:200'],
            'phone' => ['required', 'max:200'],
            'state' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $address = new userAddress();
        $address->name=$request->name;
        $address->user_id = Auth::user()->id;
        $address->phone=$request->phone;
        $address->state=$request->state;
        $address->city=$request->city;
        $address->zip=$request->zip;
        $address->address=$request->address;
        $address->save();
        toastr('alamat berhasil ditambahkan', 'success');
        return redirect()->back();

    }

    public function checkoutSubmit(Request $request){
        $request->validate([
            'shipping_method_id' => ['required', 'integer'],
           'shipping_address_id' => ['required', 'integer']
        ]);

        $shippingMethod = shippingRule::findOrFail($request->shipping_method_id);

        if($shippingMethod){
            Session::put('shipping_method', [
                'id' => $shippingMethod->id,
                'name' => $shippingMethod->name,
                'type' => $shippingMethod->type,
                'cost' => $shippingMethod->cost
            ]);
        }


        $address = userAddress::findOrFail($request->shipping_address_id)->toArray();

        if($address){
            Session::put('shipping_address', $address);
        }


        return response(['status' => 'success', 'redirect_url' => route('user.pay')]);
    }
}
