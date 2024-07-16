<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>Sazao || e-Commerce HTML Template</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.nice-number.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.calendar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/add_row_custon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/mobile_menu.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.exzoom.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/multiple-image-video.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/ranger_style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.classycountdown.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/venobox.min.css')}}">

    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

    <!--============================
        HEADER START
    ==============================-->
        @include('frontend.home.layouts.header')
    <!--============================
        HEADER END
    ==============================-->


        @yield('content')


    <!--============================
        MOBILE MENU START
    ==============================-->
    <section id="wsus__mobile_menu">
        <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
        <ul class="wsus__mobile_menu_header_icon d-inline-flex">

            <li><a href="wishlist.html"><i class="far fa-heart"></i> <span>2</span></a></li>

            <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li>
        </ul>
        <form>
            <input type="text" placeholder="Search">
            <button type="submit"><i class="far fa-search"></i></button>
        </form>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="wsus__mobile_menu_main_menu">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <ul class="wsus_mobile_menu_category">
                            <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li>
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew" aria-expanded="false"
                                    aria-controls="flush-collapseThreew"><i class="fal fa-tshirt"></i> fashion</a>
                                <div id="flush-collapseThreew" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="#">men's</a></li>
                                            <li><a href="#">wemen's</a></li>
                                            <li><a href="#">kid's</a></li>
                                            <li><a href="#">others</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreer" aria-expanded="false"
                                    aria-controls="flush-collapseThreer"><i class="fas fa-tv"></i> electronics</a>
                                <div id="flush-collapseThreer" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="#">Consumer Electronic</a></li>
                                            <li><a href="#">Accessories & Parts</a></li>
                                            <li><a href="#">other brands</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreerrp" aria-expanded="false"
                                    aria-controls="flush-collapseThreerrp"><i class="fas fa-chair-office"></i>
                                    furnicture</a>
                                <div id="flush-collapseThreerrp" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="#">home</a></li>
                                            <li><a href="#">office</a></li>
                                            <li><a href="#">restaurent</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreerrw" aria-expanded="false"
                                    aria-controls="flush-collapseThreerrw"><i class="fal fa-mobile"></i> Smart
                                    Phones</a>
                                <div id="flush-collapseThreerrw" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="#">apple</a></li>
                                            <li><a href="#">xiaomi</a></li>
                                            <li><a href="#">oppo</a></li>
                                            <li><a href="#">samsung</a></li>
                                            <li><a href="#">vivo</a></li>
                                            <li><a href="#">others</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="#"><i class="fas fa-home-lg-alt"></i> Home & Garden</a></li>
                            <li><a href="#"><i class="far fa-camera"></i> Accessories</a></li>
                            <li><a href="#"><i class="fas fa-heartbeat"></i> healthy & Beauty</a></li>
                            <li><a href="#"><i class="fal fa-gift-card"></i> Gift Ideas</a></li>
                            <li><a href="#"><i class="fal fa-gamepad-alt"></i> Toy & Games</a></li>
                            <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="wsus__mobile_menu_main_menu">
                    <div class="accordion accordion-flush" id="accordionFlushExample2">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">shop</a>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="#">men's</a></li>
                                            <li><a href="#">wemen's</a></li>
                                            <li><a href="#">kid's</a></li>
                                            <li><a href="#">others</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="vendor.html">vendor</a></li>
                            <li><a href="blog.html">blog</a></li>
                            <li><a href="daily_deals.html">campain</a></li>
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                    aria-controls="flush-collapseThree101">pages</a>
                                <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body">
                                        <ul>
                                            <li><a href="404.html">404</a></li>
                                            <li><a href="faqs.html">faq</a></li>
                                            <li><a href="invoice.html">invoice</a></li>
                                            <li><a href="about_us.html">about</a></li>
                                            <li><a href="team.html">team</a></li>
                                            <li><a href="product_grid_view.html">product grid view</a></li>
                                            <li><a href="product_grid_view.html">product list view</a></li>
                                            <li><a href="team_details.html">team details</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><a href="track_order.html">track order</a></li>
                            <li><a href="daily_deals.html">daily deals</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        MOBILE MENU END
    ==============================-->


    <!--==========================
        POP UP START
    ===========================-->
    <!-- <section id="wsus__pop_up">
        <div class="wsus__pop_up_center">
            <div class="wsus__pop_up_text">
                <span id="cross"><i class="fas fa-times"></i></span>
                <h5>get up to <span>75% off</span></h5>
                <h2>Sign up to E-SHOP</h2>
                <p>Subscribe to the <b>E-SHOP</b> market newsletter to receive updates on special offers.</p>
                <form>
                    <input type="email" placeholder="Your Email" class="news_input">
                    <button type="submit" class="common_btn">go</button>
                    <div class="wsus__pop_up_check_box">
                    </div>
                </form>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault11">
                    <label class="form-check-label" for="flexCheckDefault11">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div>
    </section> -->
    <!--==========================
        POP UP END
    ===========================-->



    <!--============================
        FOOTER PART START
    ==============================-->
        @include('frontend.home.layouts.footer')
    <!--============================
        FOOTER PART END
    ==============================-->


    <!--============================
        SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
        SCROLL BUTTON  END
    ==============================-->


    <!--jquery library js-->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <!--bootstrap js-->
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <!--font-awesome js-->
    <script src="{{asset('frontend/js/Font-Awesome.js')}}"></script>
    <!--select2 js-->
    <script src="{{asset('frontend/js/select2.min.js')}}"></script>
    <!--slick slider js-->
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <!--simplyCountdown js-->
    <script src="{{asset('frontend/js/simplyCountdown.js')}}"></script>
    <!--product zoomer js-->
    <script src="{{asset('frontend/js/jquery.exzoom.js')}}"></script>
    <!--nice-number js-->
    <script src="{{asset('frontend/js/jquery.nice-number.min.js')}}"></script>
    <!--counter js-->
    <script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.countup.min.js')}}"></script>
    <!--add row js-->
    <script src="{{asset('frontend/js/add_row_custon.js')}}"></script>
    <!--multiple-image-video js-->
    <script src="{{asset('frontend/js/multiple-image-video.js')}}"></script>
    <!--sticky sidebar js-->
    <script src="{{asset('frontend/js/sticky_sidebar.js')}}"></script>
    <!--price ranger js-->
    <script src="{{asset('frontend/js/ranger_jquery-ui.min.js')}}"></script>
    <script src="{{asset('frontend/js/ranger_slider.js')}}"></script>
    <!--isotope js-->
    <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
    <!--venobox js-->
    <script src="{{asset('frontend/js/venobox.min.js')}}"></script>
    <!--classycountdown js-->
    <script src="{{asset('frontend/js/jquery.classycountdown.js')}}"></script>

    <!--main/custom js-->
    <script src="{{asset("frontend/js/main.js")}}"></script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @php
                    toastr()->error($error);
                @endphp
            @endforeach
        @endif
      </script>
</body>

</html>
