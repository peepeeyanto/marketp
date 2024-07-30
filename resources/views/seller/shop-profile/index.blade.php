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
                <form action="{{route('seller.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group wsus__sinput">
                        <label>Preview</label>
                        <br>
                        <img width="200px" src="{{asset($profile->banner)}}" alt="">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Banner Image</label>
                        <input type="file" name="banner" class="form-control">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" value="{{ $profile->shop_name }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $profile->phone }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $profile->email }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Description</label>
                        <textarea class="summernote" name="description">{{ $profile->description }}</textarea>
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $profile->address}}">
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
