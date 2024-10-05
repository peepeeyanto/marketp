<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>

    <a href="{{ url('/') }}" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>

    <ul class="dashboard_link">
      <li><a href="{{ url('/') }}"><i class="fas fa-home"></i>Halaman Utama</a></li>
      <li><a class="{{setActive(['user.dashboard'])}}" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a class="{{setActive(['user.orders.*'])}}" href="{{ route('user.orders.index') }}"><i class="fas fa-shopping-cart"></i> Pesanan</a></li>
      {{-- <li><a href="dsahboard_download.html"><i class="far fa-cloud-download-alt"></i> Downloads</a></li> --}}
      <li><a class="{{setActive(['user.productReview.*'])}}" href="{{ route('user.productReview.index') }}"><i class="far fa-star"></i> Ulasan</a></li>
      {{-- <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li> --}}
      <li><a class="{{setActive(['user.profile'])}}" href="{{ route('user.profile') }}"><i class="far fa-user"></i> Profil</a></li>
      <li><a class="{{setActive(['user.chat-list'])}}" href="{{ route('user.chat-list') }}"><i class="fas fa-comment"></i> Chat</a></li>
      <li><a class="{{setActive(['user.address.*'])}}" href="{{ route('user.address.index') }}"><i class="fal fa-address-card"></i> Alamat</a></li>
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
