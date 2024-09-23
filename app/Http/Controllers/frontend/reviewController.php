<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\userProductReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\productReview;
use App\Models\productReviewGallery;
use App\Traits\imageUploadsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reviewController extends Controller
{
    use imageUploadsTrait;
    public function create(Request $request){

        $request->validate([
            'rating' => ['required'],
            'review' => ['required', 'max:200'],
            'image.*' => ['required', 'image']
        ]);

        $checkExistingReview = productReview::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->first();

        if($checkExistingReview){
            toastr('Ulasan produk sudah pernah dibuat', 'error');
            return redirect()->back();
        }
        $imagePaths = $this->imageUploadMultiple($request, 'image', 'uploads');
        $productReview = new productReview();
        $productReview->product_id = $request->product_id;
        $productReview->user_id = Auth::user()->id;
        $productReview->vendor_id = $request->vendor_id;
        $productReview->rating = $request->rating;
        $productReview->review = $request->review;
        $productReview->status = true;
        $productReview->save();

        if(!empty($imagePaths)){
            foreach($imagePaths as $imagePath){
                $reviewGallery = new productReviewGallery();
                $reviewGallery->product_review_id = $productReview->id;
                $reviewGallery->image = $imagePath;
                $reviewGallery->save();
            }
        }

        toastr('Ulasan berhasil dibuat', 'success');
        return redirect()->back();
    }

    public function index(userProductReviewsDataTable $datatable){
        // dd(Auth::user()->id);
        return $datatable->render('frontend.dashboard.reviews.index');
    }
}
