

@extends('seller.layouts.master')
@section('title')
COCOHub - Pesanan
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Detil Pesanan</h3>
            <div class="wsus__dashboard_profile">
                <div class="wsus__invoice_area invoice-print">
                    <div class="container d-lg-flex flex-column align-items-lg-center">
                        <div class="row" style="margin-bottom: 11px;">
                            <div class="col"><img class="img-fluid" src="{{asset('backend/assets/img/tag1.png')}}" width="200px" /></div>
                        </div>
                        <div class="row" style="margin-bottom: 12px;">
                            <div class="col"><img src="{{$qr}}" width="200px" /></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Scan Qr ini di: CocoHub.com/label</p>
                                <p>Production date: {{ $jsn['prod_date'] }}</p>
                                <p>Toko: {{ Auth::user()->vendor->shop_name }}</p>
                                <p>Produk: {{ $productName->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 d-flex flex-column align-items-end">
                    <button class="btn btn-warning print_invoice">Print</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('script')
<script>
    $('.print_invoice').on('click', function () {
    let contentBody = $('.invoice-print');
    let originalContent = $('body').html();
    $('body').html(contentBody.html());
    window.print();
    $('body').html(originalContent);
    })
</script>
@endpush
