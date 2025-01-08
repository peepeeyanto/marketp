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
                <h4>Buat Toko</h4>
                <form action="{{route('seller.shop-profile.update', Auth::user()->vendor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="lat"  value="" class='lat'>
                    <input type="hidden" name="lon" value="" class='long'>
                    <div class="form-group wsus__sinput">
                        <label>Preview</label>
                        <br>
                        <img width="200px" src="{{ empty($profile->banner) ? asset('frontend/images/ts-2.jpg') : asset($profile->banner) }}" alt="">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Gambar Banner</label>
                        <input type="file" name="banner" accept="image/*" class="form-control">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Nama Toko</label>
                        <input type="text" name="shop_name" class="form-control" value="{{ empty($profile->shop_name) ? '' : $profile->shop_name  }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>No. Handphone toko</label>
                        <input type="text" name="phone" class="form-control" value=" {{ empty($profile->phone) ? '' : $profile->phone  }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value=" {{ empty($profile->email) ? '' : $profile->email  }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Deskripsi toko</label>
                        <textarea class="summernote" name="description">{{ empty($profile->description) ? '' : $profile->description }}</textarea>
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Kota</label>
                        <input type="text" name="city" class="form-control" value="{{ empty($profile->city) ? '' : $profile->city   }}">
                    </div>
                    <div class="form-group wsus__sinput">
                        <label>Provinsi</label>
                        <input type="text" name="province" class="form-control" value="{{empty($profile->province) ? '' : $profile->province}}">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Kode Pos</label>
                        <input type="text" name="zipcode" class="form-control" value="{{ empty($profile->zipcode) ? '' : $profile->zipcode  }}">
                    </div>

                    <div class="form-group wsus__sinput">
                        <label>Alamat</label>
                        <input type="text" name="address" class="form-control" value="{{ empty($profile->address) ? '' : $profile->address  }}">
                    </div>

                    <h4 class="mt-4">Pengiriman</h4>

                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name='is_localdelivery' id="islocaldelivery" {{ $profile->is_local_deliveries ? 'checked' : '' }}>
                        <label class="form-check-label" for="localdelivert">Nyalakan pengiriman independen</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" name='is_cod' type="checkbox" id="iscod" {{$profile->is_COD_enabled ? 'checked' : 'disabled'}}>
                        <label class="form-check-label" for="iscod">Nyalakan pembayaran COD pada pengiriman independen</label>
                    </div>

                    <div class="form-group wsus__sinput " >
                        <label>Lokasi (klik peta untuk tambahkan lokasi) *</label>
                            <div id="map" style="height:500px; width:100%" hidden>
                            </div>
                    </div>

                    <div class="form-group wsus__sinput">
                        <input class="form-control" name='base'  id="base" type="text" placeholder="Tarif dasar pengiriman independen" value="{{empty($profile->base_cost) ? '' : $profile->base_cost}}" disabled >
                        <input class="form-control" name='perkm' id="perkm" type="text" placeholder="Tarif per/KM pengiriman independen" value="{{empty($profile->cost_per_km) ? '' : $profile->cost_per_km}}" disabled >
                    </div>


                    <h4 class="mt-4">Kurir</h4>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="sicepat" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            SiCepat
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="paxel" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Paxel
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="jne" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            JNE
                        </label>
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="tiki" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            TIKI
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="deliveree" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            DELIVEREE
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="sicepat" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            SICEPAT
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="lalamove" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            LALAmove
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="ninja" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Ninja
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="couriers[]" value="lion" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Lion
                        </label>
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
        var map = L.map('map').setView([-6.174475073397235, 106.8274102920588], 13);
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

        $('#islocaldelivery').change(function() {
        if ($(this).is(':checked')) {
            $('#iscod').prop('disabled', false);
            $('#base').prop('disabled', false);
            $('#perkm').prop('disabled', false);
            $('#base').prop('required', true);
            $('#perkm').prop('required', true);
            $('#map').prop('hidden', false);
            map.invalidateSize();
        } else {
            $('#iscod').prop('disabled', true);
            $('#base').prop('disabled', true);
            $('#perkm').prop('disabled', true);
            $('#base').prop('required', false);
            $('#perkm').prop('required', false);
            $('#map').prop('hidden', true);
            $('.lat').val('');
            $('.long').val('');
        }
        });


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
