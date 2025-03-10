@php
    $categories = App\Models\category::where('status', 1)
    ->with(['subCategories' => function($query){
        $query->where('status', 1);
    }])
    ->get();
@endphp


<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        {{-- <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li> --}}
                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->subCategories) > 0 ? 'wsus__droap_arrow' : '' }}" href="{{ route('products.index', ['category' => $category->slug]) }}"><i class="{{ $category->icon }}"></i> {{ $category->name }} </a>
                                @if (count($category->subCategories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">
                                        @foreach ($category->subCategories as $subCategory)
                                            <li><a href="#">{{ $subCategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        {{-- <li><a href="#"><i class="fal fa-gem"></i> Semua kategori</a></li> --}}

                        @if (Auth::check())
                        <li><a class="wsus__droap_arrow" href="{{route('user.dashboard')}}"> Akun</a>
                            <ul class="wsus_menu_cat_droapdown">
                                <li><a href="">Profil saya</a></li>
                                <li><a href="">Pesanan</a></li>
                                <li><a href="">Alamat</a></li>
                                <li><a href="">Chat</a></li>
                            </ul>
                        </li>
                    @endif
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="active" href="{{ url('/') }}">Beranda</a></li>
                        {{-- <li><a href="product_grid_view.html">shop <i class="fas fa-caret-down"></i></a>
                            <div class="wsus__mega_menu">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>women</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>men</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>category</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#"> Healthy & Beauty</a></li>
                                                <li><a href="#">Gift Ideas</a></li>
                                                <li><a href="#">Toy & Games</a></li>
                                                <li><a href="#">Cooking</a></li>
                                                <li><a href="#">Smart Phones</a></li>
                                                <li><a href="#">Cameras & Photo</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">View All Categories</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3">
                                        <div class="wsus__mega_menu_colum">
                                            <h4>women</h4>
                                            <ul class="wsis__mega_menu_item">
                                                <li><a href="#">New Arrivals</a></li>
                                                <li><a href="#">Best Sellers</a></li>
                                                <li><a href="#">Trending</a></li>
                                                <li><a href="#">Clothing</a></li>
                                                <li><a href="#">Shoes</a></li>
                                                <li><a href="#">Bags</a></li>
                                                <li><a href="#">Accessories</a></li>
                                                <li><a href="#">Jewlery & Watches</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> --}}
                        <li><a href="{{ route('sellers') }}">Toko</a></li>
                        <li><a href="{{ route('products.index') }}">Produk</a></li>
                        <li><a href="{{ route('grading') }}">Cek Kualitas Kelapa</a></li>
                        <li><a href="{{ route('label.decrypt.index') }}">Cek Label</a></li>
                        <li><a href="{{ route('yolov5-grading') }}">Cek Kualitas Kelapa YOLOv5</a></li>
                        {{-- <li class="wsus__relative_li"><a href="#">pages <i class="fas fa-caret-down"></i></a>
                            <ul class="wsus__menu_droapdown">
                                <li><a href="404.html">404</a></li>
                                <li><a href="faqs.html">faq</a></li>
                                <li><a href="invoice.html">invoice</a></li>
                                <li><a href="about_us.html">about</a></li>
                                <li><a href="product_grid_view.html">product</a></li>
                                <li><a href="check_out.html">check out</a></li>
                                <li><a href="team.html">team</a></li>
                                <li><a href="change_password.html">change password</a></li>
                                <li><a href="custom_page.html">custom page</a></li>
                                <li><a href="forget_password.html">forget password</a></li>
                                <li><a href="privacy_policy.html">privacy policy</a></li>
                                <li><a href="product_category.html">product category</a></li>
                                <li><a href="brands.html">brands</a></li>
                            </ul>
                        </li> --}}
                        <li><a href="{{ route('user.assistant') }}">Bantuan</a></li>
                        {{-- <li><a href="daily_deals.html">daily deals</a></li> --}}
                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        {{-- <li><a href="contact.html">contact</a></li> --}}

                        @if (Auth::check())
                            @if (Auth::user()->role == 'admin')
                                <li><a href={{route('admin.dashboard')}}>Dashboard</a></li>
                            @elseif (Auth::user()->role == 'seller')
                                <li><a href={{route('seller.dashboard')}}>Jualan sekarang!</a></li>
                            @else
                                <li><a href={{route('user.orders.index')}}>Daftar transaksi</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                        Log out
                                    </a>
                                </form>
                            </li>
                        @else
                            <li><a href="{{route('login')}}">Login/Daftar</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        {{-- <li><a href="wishlist.html"><i class="far fa-heart"></i> <span>2</span></a></li>

        <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li> --}}
    </ul>
    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" placeholder="Search" name="search">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Belanja</button>
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
                        {{-- <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li> --}}

                        @foreach ($categories as $categoryItem)
                            <li>
                                {{-- <a href="{{ route('products.index', ['category' => $categoryItem->slug]) }}" class="{{ count($categoryItem->subCategories) > 0 ? "accordion-button collapsed" : " " }}" data-bs-toggle="collapse" data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false" aria-controls="flush-collapseThreew-{{ $loop->index }}"><i class="{{ $categoryItem->icon }}"></i>{{ $categoryItem->name }}</a>
                                @if (count($categoryItem->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($categoryItem->subCategories as $subcategoryItem)
                                                    <li><a href="#">{{ $subcategoryItem->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif --}}
                                <a href="{{ route('products.index', ["category" => $categoryItem->slug]) }}"><i class="{{$categoryItem->icon}}"></i> {{$categoryItem->name}}</a>

                            </li>
                        @endforeach
                        {{-- <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        <li><a href="{{ url('/')}}">home</a></li>
                        {{-- <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
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
                        </li> --}}
                        <li><a href="{{route('sellers')}}">Penjual Kami</a></li>
                        <li><a href="{{route('products.index')}}">Belanja</a></li>
                        {{-- <li><a href="daily_deals.html">campain</a></li> --}}
                        <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                aria-controls="flush-collapseThree101">Fitur Cerdas</a>
                            <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="{{route('grading')}}">Cek kualitas kelapa</a></li>
                                        <li><a href="{{route('user.assistant')}}">Bantuan</a></li>
                                        <li><a href="{{route('label.decrypt.index')}}">Cek label produk</a></li>
                                        {{-- <li><a href="invoice.html">invoice</a></li>
                                        <li><a href="about_us.html">about</a></li>
                                        <li><a href="team.html">team</a></li>
                                        <li><a href="product_grid_view.html">product grid view</a></li>
                                        <li><a href="product_grid_view.html">product list view</a></li>
                                        <li><a href="team_details.html">team details</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @if (Auth::check())
                            @if(Auth::user()->role == 'user')
                                <li><a href="{{route('user.orders.index')}}">Daftar transaksi</a></li>
                            @endif
                            <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree102" aria-expanded="false"
                                aria-controls="flush-collapseThree102">Akun saya</a>
                            <div id="flush-collapseThree102" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample2">
                                <div class="accordion-body">
                                    <ul>
                                        @if (Auth::user()->role == 'admin')
                                            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                        @elseif (Auth::user()->role == 'seller')
                                            <li><a href="{{route('seller.dashboard')}}">Jualan sekarang!</a></li>
                                        @else
                                            <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                                            <li><a href="{{route('user.orders.index')}}">Pesanan</a></li>
                                            <li><a href="{{route('user.address.index')}}">Alamat</a></li>
                                            <li><a href="{{route('user.chat-list')}}">Chat</a></li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                        Log out
                                    </a>
                                </form>
                            </li>
                        @else
                            <li><a href="{{route('login')}}">Login/Daftar</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
