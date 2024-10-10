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
            <h3><i class="far fa-user"></i> Tarik saldo</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Saldo anda saat ini : Rp{{Auth::user()->vendor->balance}}</h4>
                <form action="{{route('seller.withdraw-store')}}" method="POST" >
                    @csrf

                    <div class="form-group wsus__sinput">
                        <input type="hidden" name="beneficiary_id" class="form-control" value="{{ Request::route('id') }}">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Jumlah yang ingin ditarik (dalam rupiah)</label>
                        <input type="text" name="amount" class="form-control">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Berita acara</label>
                        <input type="text" name="notes" class="form-control">
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

