<?php

namespace App\Http\Controllers\backend;

use App\DataTables\adminProductReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\productReview;
use Illuminate\Http\Request;

class adminProductReviewController extends Controller
{
    public function index(adminProductReviewDataTable $datatable){
        return $datatable->render('admin.product.reviews.index');
    }

    public function changeStatus(Request $request){
        $review = productReview::findOrFail($request->id);
        $review->status = $request->status == 'true' ? 1 : 0;
        $review->save();
        return response(['status' => 'succcess', 'message' => 'status berhasil diupdate']);
    }
}
