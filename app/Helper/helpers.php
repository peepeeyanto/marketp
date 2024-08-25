<?php


// set sidebar active

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

function setActive(array $route){
    if(is_array($route)){
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

function getSubTotal(){
    $subtotal = 0;
    foreach(Cart::content() as $product){
        $subtotal += ($product->price + $product->options->variants_total)* $product->qty;
    }

    return $subtotal;
}

function getShippingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else{
        return 0;
    }
}

function getTotal(){
    return getSubTotal() + getShippingFee();
}
