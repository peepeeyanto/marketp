<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\sellerReportDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class sellerReportController extends Controller
{
    public function index(sellerReportDataTable $dataTable) {
        return $dataTable->render('seller.report.index');
    }
}
