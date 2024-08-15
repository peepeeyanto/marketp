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
          <a href="{{route('seller.products-variant.index', ['product' => $product->id])}}" class="btn btn-primary mb-3">Kembali</a>
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Produk</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Item untuk varian: {{ $variant->name }}</h4>
                <div>
                    <a href="{{ route('seller.products-variant-item.create', ['productID' => $product->id, 'variantID' => $variant->id]) }}" class="btn btn-primary float-end">add</a>
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
    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('seller.products-variant-item.changeStatus') }}",
                    method: "PUT",
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    success: function(data){
                        console.log(data);
                    },
                    error: function(lhr, status, error){
                        console.log(error);
                    },
                })
            });
        });
    </script>
@endpush

