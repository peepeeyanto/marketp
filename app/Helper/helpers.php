<?php


// set sidebar active

use Gloudemans\Shoppingcart\Facades\Cart;

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
        $subtotal = "Rp".($product->price + $product->options->variants_total)* $product->qty;
    }
    return $subtotal;
} 