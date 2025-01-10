@extends('seller.layouts.master')
@section('title')
COCOHub - Tambah Resi
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Produk</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Tambah resi</h4>
                <form action="{{ route('seller.orders.resi.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="orderId" value="{{ $order->id }}">
                    <div class="form-group wsus__sinput">
                        <label>No.resi</label>
                        <input type="text" name="resi" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


