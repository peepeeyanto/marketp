<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\product;
use App\Models\transaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class paymentController extends Controller
{
    public function index($payId){
        // if(!Session::has('shipping_address')){
        //     return redirect()->route('user.checkout');
        // }
        // dd($payId)->all();
        $order = transaction::findOrFail($payId);

        // if($order->user_id != Auth::user()->id){
        //     abort(404);
        // }

        $is_cod = 1;

        foreach ($order->order as $items){
            $shipping = json_decode($items->shipping_method);
            if ($shipping->service != 'lokal' && $items->vendor->shipping_courier->is_COD_enabled != 1){
                $is_cod = 0;
                break;
            }
        }

        return view('frontend.pages.payment', compact('order', 'is_cod'));
    }

    public function clearSession(){
        Cart::destroy();
        Session::forget('shipping_address');
        Session::forget('shipping_method');
    }

    public function cod($transactionID){
        $transaction = transaction::findOrFail($transactionID);
        $order = order::where('transaction_id', $transaction->id)->get();
        // dd($order)->all();
        foreach ($order as $item) {
            $pay = order::findOrFail($item->id);
            $pay->payment_status = 2;
            $pay->save();
        }
        $this->clearSession();
        return view('frontend.pages.paySuccess');
    }

    public function paySuccess($transactionID){
        $transaction = transaction::where('transaction_id', $transactionID)->firstOrFail();
        $order = order::where('transaction_id', $transaction->id)->get();
        // dd($order)->all();
        foreach ($order as $item) {
            $pay = order::findOrFail($item->id);
            $pay->payment_status = 1;
            $pay->save();
        }
        $this->clearSession();
        return view('frontend.pages.paySuccess');
    }

}
