<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\product;
use App\Models\transaction as ModelsTransaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Midtrans\Transaction;

class paymentController extends Controller
{
    public function index($payId){
        if(!Session::has('shipping_address')){
            return redirect()->route('user.checkout');
        }

        $order = order::findOrFail($payId);

        return view('frontend.pages.payment', compact('order'));
    }

    public function clearSession(){
        Cart::destroy();
        Session::forget('shipping_address');
        Session::forget('shipping_method');
    }

    public function paySuccess($transactionID){
        $transaction = ModelsTransaction::where('transaction_id', $transactionID)->firstOrFail();
        $order = order::findOrFail($transaction->order_id);
        $order->payment_status = 1;
        $order->save();
        $this->clearSession();
        return view('frontend.pages.paySuccess');
    }

}
