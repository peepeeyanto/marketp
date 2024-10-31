@extends('seller.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('seller.dashboard.layouts.sidebar') --}}
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
                @if (empty(Auth::user()->vendor->id))
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Buat toko-mu sekarang!</h4>
                            <a class="btn btn-primary" href="{{ route('seller.shop-profile.index')}}" type="button">Buat Toko</a>
                        </div>
                    </div>
                @endif
              @if (!empty(Auth::user()->vendor->id))
                    <div class="row">
                        <div class="col-xl-2 col-6 col-md-4">
                        <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                            <i class="far fa-address-book"></i>
                            <p>Order Hari ini</p>
                            <h4 class="text-white">{{$todayorder}}</h4>
                        </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                        <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                            <i class="fal fa-cloud-download"></i>
                            <p>Order Pending</p>
                            <h4 class="text-white">{{ $todayPendingOrder }}</h4>
                        </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                        <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                            <i class="fas fa-star"></i>
                            <p>Total Orderan</p>
                            <h4 class="text-white">{{$totalOrder}}</h4>
                        </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                        <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                            <i class="far fa-heart"></i>
                            <p>Total Pending</p>
                            <h4 class="text-white">{{$totalPendingOrder}}</h4>
                        </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                        <a class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                            <i class="fas fa-user-shield"></i>
                            <p>Order Selesai</p>
                            <h4 class="text-white">{{$totalCompleteOrder}}</h4>
                        </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                        <a class="wsus__dashboard_item purple" href="dsahboard_address.html">
                            <i class="fal fa-map-marker-alt"></i>
                            <p>Jumlah Produk</p>
                            <h4 class="text-white">{{$totalProduct}}</h4>
                        </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                            <i class="fas fa-user-shield"></i>
                            <p>Penghasilan</p>
                            <h4 class="text-white">Rp{{$todayEarning}}</h4>
                            </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                                <a class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                                    <i class="fas fa-user-shield"></i>
                                    <p>Penghasilan total</p>
                                    <h4 class="text-white">Rp{{$totalEarning}}</h4>
                                </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                            <i class="fas fa-user-shield"></i>
                            <p>Penghasilan bulan ini</p>
                            <h4 class="text-white">Rp{{$monthEarning}}</h4>
                            </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                            <i class="fas fa-star"></i>
                            <p>Total Ulasan</p>
                            <h4 class="text-white">{{$totalReview}}</h4>
                            </a>
                        </div>
                    </div>
              @endif

              <div class="row">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
