@extends('seller.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Shop Profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Edit Profil Toko</h4>
                <form action="{{route('seller.shop-profile.update', Auth::user()->vendor->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__sinput">
                        <label>Preview</label>
                        <br>
                        <img width="200px" src="{{ empty($profile->banner) ? asset('frontend/images/ts-2.jpg') : asset($profile->banner) }}" alt="">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Gambar Banner</label>
                        <input type="file" name="banner" class="form-control">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Nama Toko</label>
                        <input type="text" name="shop_name" class="form-control" value="{{ empty($profile->shop_name) ? '' : $profile->shop_name }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>No. Handphone toko</label>
                        <input type="text" name="phone" class="form-control" value="{{ empty($profile->phone) ? '' : $profile->phone }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ empty($profile->email) ? '' : $profile->email }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Deskripsi</label>
                        <textarea class="summernote" name="description">{{ empty($profile->description) ? '' : $profile->description }}</textarea>
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Kota</label>
                        <input type="text" name="address" class="form-control" value="{{ empty($profile->address) ? '' : $profile->address}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
