<?php

namespace App\Http\Controllers\backend;

use App\DataTables\sellerProductReviewsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sellerProductReviewController extends Controller
{
    public function index(sellerProductReviewsDataTable $datatable){
        return $datatable->render('seller.reviews.index');
    }
}
