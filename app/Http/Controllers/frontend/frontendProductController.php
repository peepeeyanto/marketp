<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class frontendProductController extends Controller
{
    public function showProduct(String $slug){
        $product = product::with('vendor', 'variants', 'productImageGallery')->where('slug',$slug)->first();
        if (!$product) {
            abort(404);
        }
        return view('frontend.pages.product-details', compact('product'));
    }
}
