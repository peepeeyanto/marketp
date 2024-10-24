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
            <h3><i class="fal fa-gift-card"></i>Edit address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{ route('user.address.update', $address->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">

                    <input type="hidden" name="lat"  value="{{$address->lat}}" class='lat'>
                    <input type="hidden" name="lon" value="{{ $address->lon }}" class='long'>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Nama <b>*</b></label>
                      <input type="text" placeholder="Name" name="name" value="{{$address->name}}" required>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>No.HP <b>*</b></label>
                      <input type="text" placeholder="Phone" name="phone" value="{{$address->phone}}" required>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>Provinsi <b>*</b></label>
                        <input type="text" placeholder="State" name="state" value="{{$address->state}}" required>
                      </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                        <label>Kota <b>*</b></label>
                        <input type="text" placeholder="City" name="city" value="{{$address->city}}" required>
                      </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Kode Pos <b>*</b></label>
                      <input type="text" placeholder="Zip Code" name="zip" value="{{$address->zip}}" required>
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Alamat<b>*</b></label>
                      <input type="text" placeholder="Address" name="address" value="{{$address->address}}" required>
                    </div>
                  </div>

                  <div class="col-xl-12">
                    <label>Lokasi (klik peta untuk tambahkan lokasi) *</label>
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
            var map = L.map('map').setView([{{$address->lat}}, {{$address->lon}}], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            var marker;

            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position){
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;

                    map.setView([lat,lon], 13);
                })
            }
            else {
                alert('geolocation is not supported')
            }


            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(function(position) {
            //     // Get the user's coordinates
            //     var lat = position.coords.latitude;
            //     var lon = position.coords.longitude;

            //     // Set the map view to the user's location
            //     map.setView([lat, lon], 13);

            //     // Add a marker at the user's location
            //     L.marker([lat, lon]).addTo(map)
            //      .bindPopup("You are here!")
            //      .openPopup();
            //     },

            //     function() {
            //         alert("Unable to retrieve your location");
            //     });

            // } else {
            //     alert("Geolocation is not supported by your browser");
            // }

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
