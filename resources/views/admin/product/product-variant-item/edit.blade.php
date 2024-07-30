@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Varian Produk</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Components</a></div>
          <div class="breadcrumb-item">Table</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Edit Item varian produk</h4>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.products-variant-item.update', $variantItem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama varian</label>
                        <input type="text" name="variant_name" class="form-control" value="{{ $variantItem->productVariant->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama item varian</label>
                        <input type="text" name="name" class="form-control" value="{{ $variantItem->name }}">
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="price" class="form-control" value="{{ $variantItem->price }}">
                    </div>

                    <div class="form-group">
                        <label>Default</label>
                        <select class="form-control" name="is_default">
                            <option value="">select</option>
                            <option {{ $variantItem->is_default == 1 ? 'selected' : '' }} value="1">yes</option>
                            <option {{ $variantItem->is_default == 0 ? 'selected' : '' }} value="0">no</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option {{ $variantItem->status == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $variantItem->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
