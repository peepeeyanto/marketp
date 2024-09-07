@extends('frontend.dashboard.layouts.master')
@section('title')
COCOHub - Alamat
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>create address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{ route('user.address.store') }}" method="POST">
                @csrf
                <div class="row">

                    <input type="hidden" name="latitude"  value="" class='lat'>
                    <input type="hidden" name="longitude" value="" class='long'>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>name <b>*</b></label>
                      <input type="text" placeholder="Name" name="name">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>phone <b>*</b></label>
                      <input type="text" placeholder="Phone" name="phone">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>State <b>*</b></label>
                        <input type="text" placeholder="State" name="state">
                      </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>City <b>*</b></label>
                        <input type="text" placeholder="City" name="city">
                      </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>zip code <b>*</b></label>
                      <input type="text" placeholder="Zip Code" name="zip">
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Address<b>*</b></label>
                      <input type="text" placeholder="Address" name="address">
                    </div>
                  </div>

                  <div class="col-xl-12">
                    <div class="wsus__add_address_single">
                        <div id="map" style="height:500px; width:100%">
                        </div>
                    </div>
                  </div>

                  <div>
                    <button type="submit" class="common_btn">Submit</button>
                  </div>
                </div>
              </form>
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
            var map = L.map('map').setView([-6.174475073397235, 106.8274102920588], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            var marker;

            function onMapClick(e) {
                var latitude = e.latlng.lat;
                var longitude = e.latlng.lng;

                $('.lat').val(latitude);
                $('.long').val(longitude);
                console.log('Latitude:', latitude, 'Longitude:', longitude);
                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([latitude, longitude]).addTo(map);
            }

            map.on('click', onMapClick);
        })
    </script>
@endpush
