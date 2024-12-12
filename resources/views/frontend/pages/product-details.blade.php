@extends('frontend.home.layouts.master')
@section('title')
    {{ $product->name }} - COCOhub
@endsection
@section('content')
<section id="wsus__product_details">
    <div class="container">
        <div class="wsus__details_bg">
            <div class="row">
                <div class="col-xl-4 col-md-5 col-lg-5" style="z-index: 1000">
                    <div id="sticky_pro_zoom">
                        <div class="exzoom hidden" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}" alt="product"></li>
                                    @foreach ($product->productImageGallery as $image)
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($image->image) }}" alt="product"></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                        class="far fa-chevron-left"></i> </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                        class="far fa-chevron-right"></i> </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-md-7 col-lg-7">
                    <div class="wsus__pro_details_text">
                        <a class="title" href="#">{{ $product->name }}</a>
                        @if ($product->qty > 0)
                            <p class="wsus__stock_area"><span class="in_stock">Tersedia</span> (Stok: {{ $product->qty }})</p>
                        @elseif ($product->qty == 0)
                            <p class="wsus__stock_area"><span class="in_stock">Habis</span></p>
                        @endif

                        <h4>Rp{{ $product->price }}</h4>
                        <p class="review">
                            @php
                                $avgRating = $product->reviews()->avg('rating');
                                $roundedRating = round($avgRating);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $roundedRating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor

                            <span>{{ count($product->reviews) }} review</span>
                        </p>
                        <p class="description">
                            {!! $product->short_description !!}
                        </p>

                        <form class="shopping-cart-form">
                            <div class="wsus__selectbox">
                                <div class="row">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    @foreach ($product->variants as $variant)
                                        @if ($variant->status != 0)
                                            <div class="col-xl-6 col-sm-6">
                                                <h5 class="mb-2" style="width: 6rem">{{ $variant->name }}</h5>
                                                <select class="select_2" name="variant_items[]">
                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                        @if ($variantItem->status != 0)
                                                        <option {{ $variantItem->is_default == 1 ? "selected" : "" }} value="{{ $variantItem->id }}">{{ $variantItem->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="wsus__quentity">
                                <h5>Jumlah :</h5>
                                <div class="select_number">
                                    <input class="number_area" type="text" name="qty" min="1" max="100" value="1" />
                                </div>

                            </div>

                            <ul class="wsus__button_area">
                                <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                {{-- <li><a class="buy_now" href="#">buy now</a></li> --}}
                                <li><a class="buy_now" href="{{ route('user.chat', $product->vendor->user->id) }}">Chat Dengan Penjual</a></li>
                                {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                            </ul>
                        </form>
                        {{-- <p class="brand_model"><span>model :</span> 12345670</p>
                        <p class="brand_model"><span>brand :</span> The Northland</p> --}}
                        {{-- <div class="wsus__pro_det_share">
                            <h5>share :</h5>
                            <ul class="d-flex">
                                <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <a class="wsus__pro_report" href="#" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="fal fa-comment-alt-smile"></i> Report incorrect
                            product information.</a> --}}
                    </div>
                </div>
                {{-- <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                    <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                        <ul>
                            <li>
                                <span><i class="fal fa-truck"></i></span>
                                <div class="text">
                                    <h4>Return Available</h4>
                                    <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                </div>
                            </li>
                            <li>
                                <span><i class="far fa-shield-check"></i></span>
                                <div class="text">
                                    <h4>Secure Payment</h4>
                                    <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                </div>
                            </li>
                            <li>
                                <span><i class="fal fa-envelope-open-dollar"></i></span>
                                <div class="text">
                                    <h4>Warranty Available</h4>
                                    <!-- <p>Lorem Ipsum is simply dummy text of the printing</p> -->
                                </div>
                            </li>
                        </ul>
                        <div class="wsus__det_sidebar_banner">
                            <img src="images/blog_1.jpg" alt="banner" class="img-fluid w-100">
                            <div class="wsus__det_sidebar_banner_text_overlay">
                                <div class="wsus__det_sidebar_banner_text">
                                    <p>Black Friday Sale</p>
                                    <h4>Up To 70% Off</h4>
                                    <a href="#" class="common_btn">shope now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__pro_det_description">
                    <div class="wsus__details_bg">
                        <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                    data-bs-target="#pills-home22" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true">Description</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact2" type="button" role="tab"
                                    aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                            </li>

                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab23" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact23" type="button" role="tab"
                                    aria-controls="pills-contact23" aria-selected="false">comment</button>
                            </li> --}}

                        </ul>
                        <div class="tab-content" id="pills-tabContent4">
                            <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                aria-labelledby="pills-home-tab7">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__description_area">
                                            {!! $product->long_description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <div class="wsus__pro_det_vendor">
                                    <div class="row">
                                        <div class="col-xl-6 col-xxl-5 col-md-6">
                                            <div class="wsus__vebdor_img">
                                                <img src="{{ asset($product->vendor->banner) }}" style="max-height: 50vh" alt="vensor" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                            <div class="wsus__pro_det_vendor_text">
                                                <h4>{{ $product->vendor->shop_name }}</h4>
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(41 review)</span>
                                                </p>
                                                <p><span>Address:</span> {!! $product->vendor->address !!}</p>
                                                <p><span>Phone:</span> {!! $product->vendor->phone !!}</p>
                                                <p><span>Email:</span> {!! $product->vendor->email !!}</p>
                                                <a href="vendor_details.html" class="see_btn">visit store</a>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="wsus__vendor_details">
                                                {!! $product->vendor->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                aria-labelledby="pills-contact-tab2">
                                <div class="wsus__pro_det_review">
                                    <div class="wsus__pro_det_review_single">
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-7">
                                                <div class="wsus__comment_area">
                                                    <h4>Reviews <span>{{ count($reviews) }}</span></h4>

                                                    @foreach ($reviews as $review)
                                                        <div class="wsus__main_comment">
                                                            <div class="wsus__comment_img">
                                                                <img src="{{ asset($review->user->image) }}" alt="user"
                                                                    class="img-fluid w-100">
                                                            </div>
                                                            <div class="wsus__comment_text reply">
                                                                <h6>{{ $review->user->name }} <span>{{ $review->rating }} <i
                                                                            class="fas fa-star"></i></span></h6>
                                                                <span>{{ $review->created_at }}</span>
                                                                <p>
                                                                    {{ $review->review }}
                                                                </p>
                                                                <ul class="">
                                                                    @if (count($review->productReviewGallery) > 0 )
                                                                        @foreach ($review->productReviewGallery as $image)
                                                                            <li><img src="{{ asset($image->image) }}" alt="product"
                                                                                class="img-fluid w-100"></li>
                                                                        @endforeach
                                                                    @endif

                                                                </ul>
                                                                <a href="#" data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapsetwo">reply</a>
                                                                <div class="accordion accordion-flush"
                                                                    id="accordionFlushExample2">
                                                                    <div class="accordion-item">
                                                                        <div id="flush-collapsetwo"
                                                                            class="accordion-collapse collapse"
                                                                            aria-labelledby="flush-collapsetwo"
                                                                            data-bs-parent="#accordionFlushExample">
                                                                            <div class="accordion-body">
                                                                                <form>
                                                                                    <div
                                                                                        class="wsus__riv_edit_single text_area">
                                                                                        <i class="far fa-edit"></i>
                                                                                        <textarea cols="3" rows="1"
                                                                                            placeholder="Your Text"></textarea>
                                                                                    </div>
                                                                                    <button type="submit"
                                                                                        class="common_btn">submit</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                    {{-- <div class="wsus__main_comment">
                                                        <div class="wsus__comment_img">
                                                            <img src="images/client_img_1.jpg" alt="user"
                                                                class="img-fluid w-100">
                                                        </div>
                                                        <div class="wsus__comment_text reply">
                                                            <h6>Smith jhon <span>5 <i
                                                                        class="fas fa-star"></i></span>
                                                            </h6>
                                                            <span>09 Jul 2021</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                elit.
                                                                Cupiditate sint molestiae eos? Officia, fuga eaque.
                                                            </p>
                                                            <a href="#" data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapsetwo2">reply</a>
                                                            <div class="accordion accordion-flush"
                                                                id="accordionFlushExample2">
                                                                <div class="accordion-item">
                                                                    <div id="flush-collapsetwo2"
                                                                        class="accordion-collapse collapse"
                                                                        aria-labelledby="flush-collapsetwo"
                                                                        data-bs-parent="#accordionFlushExample">
                                                                        <div class="accordion-body">
                                                                            <form>
                                                                                <div
                                                                                    class="wsus__riv_edit_single text_area">
                                                                                    <i class="far fa-edit"></i>
                                                                                    <textarea cols="3" rows="1"
                                                                                        placeholder="Your Text"></textarea>
                                                                                </div>
                                                                                <button type="submit"
                                                                                    class="common_btn">submit</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div id="pagination">
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination">
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#"
                                                                        aria-label="Previous">
                                                                        <i class="fas fa-chevron-left"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="page-item"><a
                                                                        class="page-link page_active" href="#">1</a>
                                                                </li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">2</a></li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">3</a></li>
                                                                <li class="page-item"><a class="page-link"
                                                                        href="#">4</a></li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#" aria-label="Next">
                                                                        <i class="fas fa-chevron-right"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div> --}}

                                                    <div class="mt-5">
                                                        @if ($reviews->hasPages())
                                                            {{ $reviews->links() }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                @php
                                                $isBought = false;
                                                if(Auth::check()){
                                                    $orders = \App\Models\order::where(['user_id' => auth()->user()->id, 'order_status' => 4])->get();
                                                    foreach ($orders as $key => $order) {
                                                    $existItem = $order->orderProduct()->where('product_id', $product->id)->first();
                                                    if($existItem){
                                                        $isBought = true;
                                                    }
                                                    }
                                                }
                                                @endphp

                                                @if ($isBought)
                                                    <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                        <h4>write a Review</h4>
                                                        <form action="{{ route('user.review.create') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <p class="rating">
                                                                <span>select your rating : </span>
                                                            </p>

                                                            <div class="row">
                                                                <div class="col-xl-12 mb-4">
                                                                    <div class="wsus__single_com">
                                                                        <select name="rating" class="form-control">
                                                                            <option value="">Select</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="col-xl-12">
                                                                    <div class="wsus__single_com">
                                                                        <input type="text" placeholder="Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <div class="wsus__single_com">
                                                                        <input type="email" placeholder="Email">
                                                                    </div>
                                                                </div> --}}

                                                                <div class="col-xl-12">
                                                                    <div class="col-xl-12">
                                                                        <div class="wsus__single_com">
                                                                            <textarea cols="3" rows="3" name="review"
                                                                                placeholder="Write your review"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="img_upload">
                                                                <div class="">
                                                                    <input type="file" name="image[]" multiple>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                                                            <input type="hidden" name="vendor_id" value="{{ $product->vendor_id }}">
                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </form>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-contact23" role="tabpanel"
                                aria-labelledby="pills-contact-tab23">
                                <div class="wsus__pro_det_comment">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-6">
                                            <div class="wsus__comment_area">
                                                <h4>comment <span>03</span></h4>
                                                <div class="wsus__main_comment">
                                                    <div class="wsus__comment_img">
                                                        <img src="images/dashboard_user.jpg" alt="user"
                                                            class="img-fluid w-100">
                                                    </div>
                                                    <div class="wsus__comment_text reply">
                                                        <h6>Shopnil mahadi <span>09 Jul 2021</span></h6>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                            Cupiditate sint molestiae eos? Officia, fuga eaque.</p>
                                                        <a href="#" data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapsetwo2">reply</a>
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlushExample2">
                                                            <div class="accordion-item">
                                                                <div id="flush-collapsetwo2"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-collapsetwo"
                                                                    data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        <form>
                                                                            <div
                                                                                class="wsus__riv_edit_single text_area">
                                                                                <i class="far fa-edit"></i>
                                                                                <textarea cols="3" rows="1"
                                                                                    placeholder="Your Text"></textarea>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="common_btn">submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wsus__main_comment wsus__com_reply">
                                                    <div class="wsus__comment_img">
                                                        <img src="images/ts-3.jpg" alt="user"
                                                            class="img-fluid w-100">
                                                    </div>
                                                    <div class="wsus__comment_text reply">
                                                        <h6>Smith jhon <span>09 Jul 2021</span></h6>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                            Cupiditate sint molestiae eos? Officia, fuga eaque.</p>
                                                        <a href="#" data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapsetwo">reply</a>
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <div id="flush-collapsetwo"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-collapsetwo"
                                                                    data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        <form>
                                                                            <div
                                                                                class="wsus__riv_edit_single text_area">
                                                                                <i class="far fa-edit"></i>
                                                                                <textarea cols="3" rows="1"
                                                                                    placeholder="Your Text"></textarea>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="common_btn">submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wsus__main_comment">
                                                    <div class="wsus__comment_img">
                                                        <img src="images/team_1.jpg" alt="user"
                                                            class="img-fluid w-100">
                                                    </div>
                                                    <div class="wsus__comment_text reply">
                                                        <h6>Smith jhon <span>09 Jul 2021</span></h6>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                            Cupiditate sint molestiae eos? Officia, fuga eaque.</p>
                                                        <a href="#" data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapsetwo3">reply</a>
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlushExample3">
                                                            <div class="accordion-item">
                                                                <div id="flush-collapsetwo3"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-collapsetwo"
                                                                    data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        <form>
                                                                            <div
                                                                                class="wsus__riv_edit_single text_area">
                                                                                <i class="far fa-edit"></i>
                                                                                <textarea cols="3" rows="1"
                                                                                    placeholder="Your Text"></textarea>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="common_btn">submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="pagination">
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination">
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" aria-label="Previous">
                                                                    <i class="fas fa-chevron-left"></i>
                                                                </a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link page_active"
                                                                    href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link"
                                                                    href="#">2</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link"
                                                                    href="#">3</a>
                                                            </li>
                                                            <li class="page-item"><a class="page-link"
                                                                    href="#">4</a>
                                                            </li>
                                                            <li class="page-item">
                                                                <a class="page-link" href="#" aria-label="Next">
                                                                    <i class="fas fa-chevron-right"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-5 col-lg-6 mt-4 mt-lg-0">
                                            <div class="wsus__post_comment" id="sticky_sidebar2">
                                                <h4>post a comment</h4>
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="wsus__single_com">
                                                                <input type="text" placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="wsus__single_com">
                                                                <input type="email" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="wsus__single_com">
                                                                <textarea cols="3" rows="3"
                                                                    placeholder="Your Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="common_btn" type="submit">post comment</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection


