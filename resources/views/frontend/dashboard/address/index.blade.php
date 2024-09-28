@extends('frontend.dashboard.layouts.master')
@section('title')
COCOHub - Alamat
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <h3><i class="fal fa-gift-card"></i> address</h3>
            <div class="wsus__dashboard_add">
              <div class="row">
                @foreach ($addresses as $address)
                    <div class="col-xl-6">
                        <div class="wsus__dash_add_single">
                        <h4>Billing Address <span>{{ $address->id }}</span></h4>
                        <ul>
                            <li><span>name :</span> {{ $address->name }}</li>
                            <li><span>Phone :</span> {{ $address->phone }}</li>
                            <li><span>city :</span> {{ $address->city }}</li>
                            <li><span>State :</span> {{ $address->state }}</li>
                            <li><span>zip code :</span> {{ $address->zip }}</li>
                            <li><span>address :</span> {{ $address->address }}</li>
                        </ul>
                        <div class="wsus__address_btn">
                            <a href="{{ route('user.address.edit', $address->id) }}" class="edit"><i class="fal fa-edit"></i> edit</a>
                            <a href="{{ route('user.address.destroy', $address->id) }}" class="del delete-item"><i class="fal fa-trash-alt"></i> delete</a>
                        </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-xl-6">
                  <div class="wsus__dash_add_single">
                    <h4>Billing Address <span>home</span></h4>
                    <ul>
                      <li><span>name :</span> anik roy</li>
                      <li><span>Phone :</span> +66954581322222</li>
                      <li><span>email :</span> example@gmail.com</li>
                      <li><span>country :</span> bangladesh</li>
                      <li><span>city :</span> dhaka</li>
                      <li><span>zip code :</span> 8320</li>
                      <li><span>company :</span> N/A</li>
                      <li><span>address :</span> bashindhara P/A, dhaka</li>
                    </ul>
                    <div class="wsus__address_btn">
                      <a href="dsahboard_address_add.html" class="edit"><i class="fal fa-edit"></i> edit</a>
                      <a href="dsahboard_address_add.html" class="del"><i class="fal fa-trash-alt"></i> delete</a>
                    </div>
                  </div>
                </div> --}}
                <div class="col-12">
                  <a href="{{ route('user.address.create') }}" class="add_address_btn common_btn"><i class="far fa-plus"></i>
                    add new address</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
