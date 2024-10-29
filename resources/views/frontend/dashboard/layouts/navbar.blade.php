<div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      {{-- <img src="images/dashboard_user.jpg" alt="img" class="img-fluid"> --}}
      <p class="me-4">{{ Auth::user()->name }}</p>
      <i class="fas fa-cart-plus me-2"></i>
      <a href="{{route('cart-detail')}}">{{Cart::content()->count() }} </a>
    </div>
  </div>
