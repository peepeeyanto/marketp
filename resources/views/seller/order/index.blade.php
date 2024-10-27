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
            <h3><i class="far fa-user"></i> Pesanan</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area table-responsive">
                <h4>Lihat Semua Pesanan</h4>
                {{ $dataTable->table() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
