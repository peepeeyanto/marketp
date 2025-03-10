<?php

use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\checkOutController;
use App\Http\Controllers\backend\labelGeneratorController;
use App\Http\Controllers\backend\paymentController;
use App\Http\Controllers\backend\sellerController;
use App\Http\Controllers\backend\yolov5Controller;
use App\Http\Controllers\frontend\cartController;
use App\Http\Controllers\frontend\chatListController;
use App\Http\Controllers\frontend\demoProduct;
use App\Http\Controllers\frontend\frontendProductController;
use App\Http\Controllers\frontend\gradingController;
use App\Http\Controllers\frontend\reviewController;
use App\Http\Controllers\frontend\userAddressController;
use App\Http\Controllers\frontend\userDashboardController;
use App\Http\Controllers\frontend\userOrderController;
use App\Http\Controllers\frontend\userProductReviewController;
use App\Http\Controllers\frontend\userProfileController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Assistant;
use App\Livewire\Chat;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [homeController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('frontend.dashboard.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

Route::get('/admin/login', [adminController::class, 'login'])->name('admin.login');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('/dashboard', [userDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [userProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [userProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile', [userProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::resource('/address', userAddressController::class);
    Route::get('/userReviews', [reviewController::class, 'index'])->name('productReview.index');

    Route::get('checkout', [checkOutController::class, 'index'])->name('checkout');
    Route::post('checkout/address', [checkOutController::class,'storeAddress'])->name('checkout.address.create');
    Route::post('checkout/form-submit', [checkOutController::class,'checkoutSubmit3'])->name('checkout.submit');

    Route::get('orders', [userOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [userOrderController::class,'show'])->name('orders.show');
    Route::get('orders/complete/{id}', [userOrderController::class, 'complete'])->name('orders.complete');

    Route::get('payment-success/cod/{transactionID}', [paymentController::class, 'cod'])->name('pay.success.cod');
    Route::get('payment-success/{transactionID}', [paymentController::class, 'paySuccess'])->name('pay.success');

    Route::get('payment/{payId}', [paymentController::class, 'index'])->name('pay');


    Route::post('review', [reviewController::class, 'create'])->name('review.create');

    Route::get('chat/{id}', Chat::class)->name('chat');

    Route::get('chat-list', [chatListController::class, 'index'])->name('chat-list');

    Route::get('assistant', Assistant::class)->name('assistant');

    Route::get('orders/complete/{id}', [userOrderController::class,'complete'])->name('orders.complete');
});

Route::get('change-product-list', [frontendProductController::class,'changeProductList'])->name('products.change');
Route::get('products', [frontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('product-detail/{slug}', [frontendProductController::class, 'showProduct'])->name('product-detail');
Route::post('add2cart', [cartController::class, 'add'])->name('add2cart');
Route::get('cart-detail', [cartController::class,'cartDetail'])->name('cart-detail');
Route::post('cart/updateqty', [cartController::class, 'updateQty'])->name('cart.update-qty');
Route::get('cart-clear', [cartController::class, 'clearCart'])->name('cart-clear');
Route::get('cart/remove-product/{rowId}', [cartController::class,'removeProduct'])->name('cart-removeProduct');
Route::get('cart-count', [cartController::class, 'cartCount'])->name('cart-count');
Route::get('cart-product', [cartController::class, 'getCartProduct'])->name('cart-product');
Route::post('cart/remove-sideProduct', [cartController::class,'removeSideProduct'])->name('cart-removeSideProduct');
Route::get('cart/get-subtotal', [cartController::class,'getSubTotal'])->name('cart-subtotal');
Route::get('grading', [gradingController::class, 'index'])->name('grading');
Route::get('demoproduct', [demoProduct::class, 'index'])->name('demo.product');
Route::get('sellers-product/{id}', [homeController::class,'sellerProductsPage'])->name('sellers-products');
Route::get('sellers', [homeController::class, 'sellers'])->name('sellers');

Route::post('yolov5/apirequest', [yolov5Controller::class, 'detect'])->name('yolov5-request');
route::get('yolov5/filegrade', [yolov5Controller::class, 'filegrade'])->name('yolov5-filegrade');
Route::get('yolov5/cameragrade', [yolov5Controller::class, 'cameragrade'])->name('yolov5-cameragrade');
Route::get('yolov5', [yolov5Controller::class,'index'])->name('yolov5-grading');

route::get('label/', [labelGeneratorController::class, 'decryptIndex'])->name('label.decrypt.index');
route::post('label/decrypt', [labelGeneratorController::class,'decryptData'])->name('label.decrypt.show');
