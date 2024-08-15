@extends('seller.layouts.master')
@section('title')
COCOHub - Edit Varian Produk
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <a href="{{ route('seller.products-variant.index', ['product' => $variant->product_id]) }}" class="btn btn-primary mb-3">Kembali</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Produk</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Edit Varian Produk</h4>
                <form action="{{ route('seller.products-variant.update', $variant->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control wsus__sinput" value="{{$variant->name}}">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control wsus__sinput" name="status">
                            <option {{ $variant->status = 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $variant->status = 0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


