@extends('seller.layouts.master')
@section('title')
COCOHub - Penarikan
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}
      <div class="row mb-3">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fa fa-money"></i> Saldo</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h2>Saldo anda Rp{{Auth::user()->vendor->balance}}</h2>
                <a href="{{ route('seller.payout.log') }}" class="btn btn-primary">Riwayat penarikan</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Tarik saldo menggunakan rekening</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area table-responsive">
                <div>
                    <a href="{{route('seller.payout.create')}}" class="btn btn-primary float-end">add</a>
                </div>
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

