@extends('seller.layouts.master')
@section('title')
COCOHub - Item Varian
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <a href="{{ route('seller.products-variant-item.index', ['productID' => $product->id, 'variantID' => $variant->id]) }}" class="btn btn-warning mb-3">Kembali</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Produk</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Tambah produk item varian</h4>
                <form action="{{ route('seller.products-variant-item.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group wsus__sinput">
                        <label>Nama varian</label>
                        <input type="text" name="variant_name" class="form-control" value="{{ $variant->name }}" readonly>
                    </div>

                    <div class="form-group wsus__sinput">
                        <input type="hidden" name="variant_id" class="form-control" value="{{ $variant->id }}">
                    </div>

                    <div class="form-group wsus__sinput">
                        <input type="hidden" name="product_id" class="form-control" value="{{ $product->id }}">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Nama item varian</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Harga</label>
                        <input type="text" name="price" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Stok</label>
                        <input type="text" name="stock" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Berat</label>
                        <input type="text" name="weight" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Default</label>
                        <select class="form-control" name="is_default">
                            <option value="">select</option>
                            <option value="1">yes</option>
                            <option value="0">no</option>
                        </select>
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
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

