<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class frontendProductController extends Controller
{
    public function showProduct(String $slug){
        $product = product::with('vendor', 'variants', 'productImageGallery')->where('slug',$slug)->first();
        if (!$product) {
            abort(404);
        }
        return view('frontend.pages.product-details', compact('product'));
    }

    public function productsIndex(Request $request){
        if($request->has('category')){
            $category = category::where('slug', $request->category)->first();
            $products = product::where('category_id', $category->id)->when($request->has('price_range'), function($query) use($request){
                $price = explode(';', $request->price_range);
                $from = $price[0];
                $to   = $price[1];

                return $query->where('price', '>=', $from)->where('price', '<=', $to);
            })
            ->paginate(12);
        }

        $categories = category::where('status', 1)->get();
        return view('frontend.pages.product', compact('products', 'categories'));
    }

    public function changeProductList(Request $request){
        Session::put('product_list_style', $request->style);
    }
}
