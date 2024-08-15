<?php

namespace App\Http\Controllers\backend;

use App\DataTables\vendorProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class vendorProductController extends Controller
{
    public function index(vendorProductDataTable $datatable){
        return $datatable->render('admin.product.vendor-product.index');
    }
}
