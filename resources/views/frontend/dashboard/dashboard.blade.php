@extends('frontend.dashboard.layouts.master')
@section('title')
COCOHub - User Dashboard
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <h3>Dashboard User</h3>
          <br>
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{ route('user.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Pesanan</p>
                    <h4 class="text-white">{{$totalOrder}}</h4>
                  </a>
                </div>
                {{-- <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                    <i class="fal fa-cloud-download"></i>
                    <p>download</p>
                  </a>
                </div> --}}
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{ route('user.productReview.index') }}">
                    <i class="fas fa-star"></i>
                    <p>Ulasan</p>
                    <h4 class="text-white">{{$review}}</h4>
                  </a>
                </div>
                {{-- <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                    <i class="far fa-heart"></i>
                    <p>wishlist</p>
                  </a>
                </div> --}}
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{ route('user.profile') }}">
                    <i class="fas fa-user-shield"></i>
                    <p>profile</p>
                    <h4 class="text-white">-</h4>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="{{ route('user.address.index') }}">
                    <i class="fal fa-map-marker-alt"></i>
                    <p>Alamat</p>
                    <h4 class="text-white">-</h4>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
