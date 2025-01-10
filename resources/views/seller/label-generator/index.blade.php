@extends('seller.layouts.master')
@section('title')
COCOHub - Print Label
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Label</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Print Label</h4>
                <form action="{{ route('seller.label.encrypt') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="shop" value="{{ Auth::user()->vendor->id }}">

                    <div class="form-group wsus__sinput">
                        <label>Produk</label>
                        <select class="form-control main-category" name="prod">
                            <option value="">Select</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Tanggal produksi</label>
                        <input type="text" id="singleDateInput" name="prod_date" value="1/1/2025" />
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
    $(function () {
        $('#singleDateInput').daterangepicker({
            singleDatePicker: true, // Enable single date selection
            showDropdowns: true,   // Optional: show year and month dropdowns
            minYear: 2020,
            maxYear: parseInt(moment().format('YYYY'),10)
        });

        // Update the input field when the Apply button is clicked
        $('#singleDateInput').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY')); // Format and set the date
        });

        // Optional: Clear the input field when Cancel is clicked
        $('#singleDateInput').on('cancel.daterangepicker', function () {
            $(this).val('');
        });
    });
    </script>
@endpush

