@extends('seller.layouts.master')
@section('title')
COCOHub - Rekening
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Rekening</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Tambah Rekening</h4>
                <form action="{{route('seller.payout.store')}}" method="POST" >
                    @csrf

                    <div class="form-group wsus__sinput">
                        <input type="hidden" name="vendor_id" class="form-control" value="{{ Auth::user()->vendor->id }}">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Bank</label>
                        <select class="form-control" name="bank">
                            <option value="">select</option>
                            <option value="bca">Bank BCA</option>
                            <option value="mandiri">Bank Mandiri</option>
                            <option value="permata">Bank Permata</option>
                            <option value="danamon">Bank Danamon</option>
                            <option value="bni">Bank BNI</option>
                            <option value="bri">Bank BRI</option>
                            <option value="cimb">Bank CIMB</option>
                            <option value="gopay">GO-PAY</option>
                        </select>
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>No. rekening</label>
                        <input type="text" name="acc_number" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Nama pada rekening</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>E-mail</label>
                        <input type="text" name="email" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Alias</label>
                        <input type="text" name="alias" class="form-control">
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

