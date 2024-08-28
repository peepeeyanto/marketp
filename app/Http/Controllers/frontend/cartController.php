<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\productVariantItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function cartDetail(){
        $cartItem = Cart::content();
        if(count($cartItem) == 0 ){
            toastr('Keranjang belanja kosong', 'warning', 'warning');
            return redirect('/');
        }
        return view('frontend.pages.cart-detail', compact('cartItem'));
    }

    public function add(Request $request){
        $product = product::findOrFail($request->product_id);
        if($product->qty == 0){
            return response(['status' => 'stock_out', 'message' => 'stok barang sudah habis']);
        }
        elseif ($request->qty > $product->qty){
            return response(['status' => 'stock_out', 'message' =>'stok barang tidak mencukupi']);
        }
        $variants = [];
        $variantTotalAmount = 0;
        if($request->has('variant_items')){
            foreach ($request->variant_items as $variant){
                $variantItem = productVariantItem::findOrFail($variant);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        $productPrice = 0;
        $productPrice = $product->price;

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;
        $cartData['options']['vendor_id'] = $product->vendor_id;

        // dd($cartData);
        Cart::add($cartData);
        return response(['status' => 'success', 'message' => 'berhasil ditambah ke keranjang']);
    }

    public function updateQty(Request $request){
        $cartProduct = Cart::get($request->rowId)->id;
        $product = product::findOrFail($cartProduct);
        if($product->qty == 0){
            return response(['status' => 'error','message' => 'Stok habis']);
        }elseif($product->qty < $request->quantity){
            return response(['status' => 'error','message' =>'stock tidak mencukupi']);
        }
        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' =>'success','message' => 'berhasil diupdate', 'product_total' => $productTotal]);
    }

    public function getProductTotal($rowId){
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total)* $product->qty;
        return $total;
    }

    public function clearCart(){
        Cart::destroy();
        return response(['status' =>'success','message' => 'berhasil dikosongkan']);
    }

    public function removeProduct($rowId){
        Cart::remove($rowId);
        toastr('berhasil dihapus', 'success', 'success');
        return redirect()->back();
    }

    public function cartCount(){
        return Cart::content()->count();
    }

    public function getCartProduct(){
        return Cart::content();
    }

    public function removeSideProduct(Request $request){
        Cart::remove($request->rowId);
        return response(['status' =>'success','message' => 'berhasil dikeluarkan']);
    }

    public function getSubTotal(){
        $subtotal = 0;
        foreach(Cart::content() as $product){
            $subtotal += $this->getProductTotal($product->rowId);
        }
        return $subtotal;
    }
}
