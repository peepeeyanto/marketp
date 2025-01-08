@extends('seller.layouts.master')
@section('title')
COCOHub - Tambah Produk
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
                <h4>Tambah produk toko</h4>
                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group wsus__sinput">
                        <label>Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group wsus__sinput">
                                <label>Category</label>
                                <select class="form-control main-category" name="category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group wsus__sinput">
                                <label>Subcategory</label>
                                <select class="form-control sub-category" name="subcategory">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group wsus__sinput">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control">
                    </div> --}}

                    <div class="form-group wsus__sinput">
                        <label>Berat</label>
                        <input type="text" name="weight" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Stok qty</label>
                        <input type="number" min="0" name="qty" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Long Description</label>
                        <textarea name="long_description" class="form-control summernote"></textarea>
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

@push('script')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                console.log('reached');
                $.ajax({
                    method: 'GET',
                    url: "{{ route('seller.products.getSubcategories') }}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">select</option>')
                        $.each(data,function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    },
                })
            })
        })
    </script>
@endpush
