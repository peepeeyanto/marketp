@extends('frontend.home.layouts.master')

@section('title')
COCOHub - Produk
@endsection

@section('content')
    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_page_bammer vendor_det_banner">
                        <img src="{{ asset("frontend/images/vendor_details_banner.jpg") }}" alt="banner" class="img-fluid w-100">
                        <div class="wsus__pro_page_bammer_text wsus__vendor_det_banner_text">
                            <div class="wsus__vendor_text_center">
                                <h4>{{ $vendor->shop_name }}</h4>

                                <a href="#"><i class="far fa-phone-alt"></i> {{ $vendor->phone }}</a>
                                <a href="#"><i class="far fa-envelope"></i> {{ $vendor->email }}</a>
                                <p class="wsus__vendor_location"><i class="fal fa-map-marker-alt"></i> {{ $vendor->address }} </p>
                                <p class="wsus__open_store"><i class="fab fa-shopify"></i> store open</p>
                                {{-- <ul class="d-flex">
                                    <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul> --}}
                                {{-- <a class="common_btn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="fas fa-star"></i>add review</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="wsus__product_topbar">
                                <div class="wsus__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'active' : '' }} list-view" data-id='grid' id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>

                                        <button class="nav-link {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'active' : '' }} list-view" data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>

                                    <div class="wsus__topbar_select">
                                        <select class="select_2" name="state">
                                            <option>default shorting</option>
                                            <option>short by rating</option>
                                            <option>short by latest</option>
                                            <option>low to high </option>
                                            <option>high to low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>show 12</option>
                                        <option>show 15</option>
                                        <option>show 18</option>
                                        <option>show 21</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'show active' : '' }} {{ !session()->has('product_list_style') ? 'active' : '' }}" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-3  col-sm-6">
                                            <div class="wsus__product_item">
                                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />

                                                    <img src="
                                                    @if (isset($product->productImageGallery[0]->image))
                                                        {{ asset($product->productImageGallery[0]->image) }}
                                                    @else
                                                        {{asset($product->thumb_image)}}
                                                    @endif
                                                    "
                                                    alt="product"
                                                    class="img-fluid w-100 img_2" />
                                                </a>

                                                {{-- <ul class="wsus__single_pro_icon">
                                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                                class="far fa-eye"></i></a></li>
                                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="far fa-random"></i></a>
                                                </ul> --}}

                                                <div class="wsus__product_details">
                                                    <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                                                    <p class="wsus__pro_rating">
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
                                                    <a class="wsus__pro_name" href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                                    <p class="wsus__price">Rp{{ $product->price }}</p>
                                                    {{-- <a class="add_cart" href="#">add to cart</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    {{-- <div class="col-xl-4  col-sm-6">
                                        <div class="wsus__product_item">
                                            <span class="wsus__new">New</span>
                                            <span class="wsus__minus">-20%</span>
                                            <a class="wsus__pro_link" href="product_details.html">
                                                <img src="images/pro4.jpg" alt="product"
                                                    class="img-fluid w-100 img_1" />
                                                <img src="images/pro4_4.jpg" alt="product"
                                                    class="img-fluid w-100 img_2" />
                                            </a>
                                            <ul class="wsus__single_pro_icon">
                                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                            class="far fa-eye"></i></a></li>
                                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                <li><a href="#"><i class="far fa-random"></i></a>
                                            </ul>
                                            <div class="wsus__product_details">
                                                <a class="wsus__category" href="#">fashion </a>
                                                <p class="wsus__pro_rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span>(17 review)</span>
                                                </p>
                                                <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                                                <p class="wsus__price">$159 <del>$200</del></p>
                                                <a class="add_cart" href="#">add to cart</a>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'show active' : '' }}" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="wsus__product_item wsus__list_view">
                                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />

                                                    <img src="
                                                    @if (isset($product->productImageGallery[0]->image))
                                                        {{ asset($product->productImageGallery[0]->image) }}
                                                    @else
                                                        {{asset($product->thumb_image)}}
                                                    @endif
                                                    " alt="product"
                                                        class="img-fluid w-100 img_2" />
                                                </a>

                                                <div class="wsus__product_details">
                                                    <a class="wsus__category" href="#">{{ $product->category->name }} </a>
                                                    <p class="wsus__pro_rating">
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
                                                    <a class="wsus__pro_name" href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                                    <p class="wsus__price">Rp{{ $product->price }}</p>
                                                    <p class="list_description">{{ $product->short_description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class="col-xl-12">
                                        <div class="wsus__product_item wsus__list_view">
                                            <span class="wsus__new">New</span>
                                            <span class="wsus__minus">-20%</span>
                                            <a class="wsus__pro_link" href="product_details.html">
                                                <img src="images/pro4.jpg" alt="product"
                                                    class="img-fluid w-100 img_1" />
                                                <img src="images/pro4_4.jpg" alt="product"
                                                    class="img-fluid w-100 img_2" />
                                            </a>
                                            <div class="wsus__product_details">
                                                <a class="wsus__category" href="#">fashion </a>
                                                <p class="wsus__pro_rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <span>(17 review)</span>
                                                </p>
                                                <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                                                <p class="wsus__price">$159 <del>$200</del></p>
                                                <p class="list_description">Ultrices eros in cursus turpis massa cursus
                                                    mattis. Volutpat ac tincidunt vitae semper quis lectus. Aliquam id
                                                    diam maecenas ultricies… </p>
                                                <ul class="wsus__single_pro_icon">
                                                    <li><a class="add_cart" href="#">add to cart</a></li>
                                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="far fa-random"></i></a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <section id="pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.list-view').on('click', function(){
                let style = $(this).data('id');

                $.ajax({
                    url: "{{ route('products.change') }}",
                    method:"GET",
                    data: {style: style},
                    success: function(data){

                    },
                    error: function(){

                    }
                })
            })

            @php
                if (request()->has('price_range')) {
                    $price = explode(';', request()->price_range);
                    $from = $price[0];
                    $to   = $price[1];
                }else{
                    $from = 0;
                    $to   = 50000;
                }
            @endphp

            jQuery(function () {
                jQuery("#slider_range").flatslider({
                    min: 0, max: 1000000,
                    step: 10000,
                    values: [{{ $from }}, {{ $to }}],
                    range: true,
                    einheit: 'Rp'
                });
            });
        })
    </script>
@endpush
