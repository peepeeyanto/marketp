<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use App\Models\slider;
use App\Models\vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function index(){
        $sliders = slider::where('status', '1')->orderBy('serial','asc')->get();
        return view('frontend.home.home', compact('sliders'));
    }

    public function sellers(){
        $vendors = vendor::paginate(20);
        return view('frontend.pages.sellers', compact('vendors'));
    }

    public function sellerProductsPage(string $id){
        if(!Session::has('product_list_style')){
            Session::put('product_list_style', 'grid');
        }
        $products = product::where('vendor_id', $id)->paginate(12);
        $vendor = vendor::findOrFail($id);
        // dd($request)->all();
        $categories = category::where('status', 1)->get();
        return view('frontend.pages.sellersProducts', compact('products', 'categories', 'vendor'));
    }
}
