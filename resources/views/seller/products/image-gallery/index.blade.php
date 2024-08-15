@extends('seller.layouts.master')
@section('title')
COCOHub - Image Gallery
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row mb-5">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <a href="{{ route('seller.products.index') }}" class="btn btn-info mb-2">Kembali</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Produk: {{ $product->name }}</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Tambah gambar</h4>
                <form action="{{ route('seller.products-image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group wsus__sinput">
                        <label for="">Image</label>
                        <input type="file" name="image[]" class="form-control" multiple>
                        <input type="hidden" name="product" value="{{ $product->id }}" >
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Gambar</h4>
                <div class="card-body table-responsive">
                    {{ $dataTable->table() }}
                </div>
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
