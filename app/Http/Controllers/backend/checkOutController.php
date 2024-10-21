<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\product;
use App\Models\shipping_couriers;
use App\Models\shippingRule;
use App\Models\transaction;
use App\Models\userAddress;
use App\Models\vendor;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use stdClass;
use Yrehan32\PhpHaversine\Haversine;

class checkOutController extends Controller
{
    public function index(){
        $addresses = userAddress::where('user_id', Auth::user()->id)->first();

        $groupedCart = Cart::content()->groupBy(function ($item) {
            return $item->options->vendor_id;
        });

        $vendorInfo = [];
        foreach ($groupedCart as $key => $value) {
            $vendorInfo[$key] = vendor::where('id',$key)->get()->toarray();
        }

        $url = '';
        $data = [];
        $items = [];

        foreach($groupedCart as $key1=>$vend){
            foreach($vend as $key2=> $item){
                $items[$key1][$key2] = [
                    "name"=>$item->name,
                    'weight'=>$item->weight,
                    'quantity'=>$item->qty
                ];
            }
        }


        foreach($vendorInfo as $key=>$value){
            $shippingc = shipping_couriers::where('vendor_id',$key)->first();
            $courier = json_decode($shippingc->couriers,true);
            $data[$key] = [
                "origin_postal_code" => $value[0]['zipcode'],
                "destination_postal_code" => $addresses->zip,
                "couriers" => implode(",", $courier),
                "items" => $items[$key]
            ];
        }
        // dd(json_encode($data))->all();

        // $shippingMethod = shippingRule::where('status', '1')->get();

        $shippingMethod = [];
        $url = 'https://api.biteship.com/v1/rates/couriers';
        $header = ['authorization' => getenv('BITESHIP_API_KEY'), 'content-type' => 'application/json'];
        foreach($data as $key => $value){
            $shippingMethod[$key] = Http::withHeaders($header)->post($url, $value);
        }

        $responses = [];
        foreach($shippingMethod as $key=>$value){
            $responses[$key] = json_decode($value->body());
        }



        foreach($responses as $key => $value){
            $vendor = shipping_couriers::where('vendor_id', $key)->first();
            if ($vendor->is_local_deliveries == 1){
                $price = $vendor->base_cost + (Haversine::calculate($vendor->lat, $vendor->lon, $addresses->lat, $addresses->lon) * $vendor->cost_per_km);
                $obj = new stdClass();
                $obj->price = $price;
                $obj->courier_name = 'pengantaran lokal';
                $obj->courier_service_name = 'lokal';
                $responses[$key]->pricing[] = $obj;
            }
        }

        // dd($responses);

        return view('frontend.pages.checkout', compact('addresses', 'groupedCart', 'vendorInfo', 'responses'));
    }


    public function checkoutSpecific(string $addressId){
        $addresses = userAddress::where('user_id', Auth::user()->id)->where('')->get();

        $groupedCart = Cart::content()->groupBy(function ($item) {
            return $item->options->vendor_id;
        });

        $vendorInfo = [];
        foreach ($groupedCart as $key => $value) {
            $vendorInfo[$key] = vendor::where('id',$key)->select('shop_name', 'address')->get()->toarray();
        }

        // dd($groupedCart)->all();
        // $shippingMethod = shippingRule::where('status', '1')->get();

        $shippingMethod = [];
        return view('frontend.pages.checkout', compact('addresses', 'groupedCart', 'vendorInfo'));
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

    public function checkoutsubmit2(Request $request){

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(1, 999999),
                'gross_amount' => getTotal(),
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order = new order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->subtotal = getSubTotal();
        $order->ammount =  getSubTotal() + $request->shipping_fee;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = 'midtrans';
        $order->payment_status = 0;
        $order->order_address = json_encode(Session::get('shipping_address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->order_status = 0;
        $order->snap_id = $snapToken;
        $order->save();
    }

    public function checkoutSubmit(Request $request){
        dd($request)->all();
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

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(1, 999999),
                'gross_amount' => getTotal(),
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order = new order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->subtotal = getSubTotal();
        $order->ammount =  getTotal();
        $order->product_qty = Cart::content()->count();
        $order->payment_method = 'midtrans';
        $order->payment_status = 0;
        $order->order_address = json_encode(Session::get('shipping_address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->order_status = 0;
        $order->snap_id = $snapToken;
        $order->save();

        foreach(Cart::content() as $item){
            $product = product::find($item->id);
            $orderProduct = new orderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->vendor_id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($item->options->variants);
            $orderProduct->variant_total = $item->options->variants_total;
            $orderProduct->unit_price = $item->price;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();
        }

        $transaction = new transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $params['transaction_details']['order_id'];
        $transaction->payment_method = 'midtrans';
        $transaction->amount = getTotal();
        $transaction->save();


        return response(['status' => 'success', 'redirect_url' => route('user.pay', $order->id)]);
    }
}
