<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>

    <a href="{{ url('/') }}" class="dash_logo text-center mt-5"><h4 class="text-white">MarketP</h4></a>
    <h5 class="text-center text-white">Dashboard Toko</h5>

    <ul class="dashboard_link">
      <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Halaman Utama</a></li>
      <li><a class="{{setActive(['seller.dashboard'])}}" href="{{ route('seller.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      {{-- <li><a href="dsahboard_profile.html"><i class="far fa-user"></i> My Profile</a></li> --}}
      @if (!empty(Auth::user()->vendor->id))
      <li><a class="{{setActive(['seller.shop-profile.*'])}}" href="{{ route('seller.shop-profile.edit', Auth::user()->vendor->id) }}"><i class="far fa-user"></i> Shop Profile</a></li>
      <li><a class="{{setActive(['seller.products.*'])}}" href="{{ route('seller.products.index') }}"><i class="fas fa-box"></i> Produk</a></li>
      <li><a class="{{setActive(['seller.reviews.*'])}}" href="{{ route('seller.reviews.index') }}"><i class="fas fa-star"></i> Ulasan</a></li>
      <li><a class="{{setActive(['seller.chat-list'])}}" href="{{ route('seller.chat-list') }}"><i class="fas fa-comment"></i> Chat</a></li>
      <li><a class="{{setActive(['seller.orders.*'])}}" href="{{ route('seller.orders.index') }}"><i class="fas fa-shopping-cart"></i> Order</a></li>
      <li><a class="{{setActive(['seller.payout.*'])}}" href="{{ route('seller.payout.index') }}"><i class="fa fa-money"></i> Penarikan Saldo</a></li>
      <li><a class="{{setActive(['seller.report.*'])}}" href="{{ route('seller.report.index') }}"><i class="fa fa-money"></i> Laporan penjualan</a></li>
      @endif

      <li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                <i class="far fa-sign-out-alt"></i> Log out
            </a>
        </form>
      </li>
    </ul>
  </div>
