@extends('frontend.home.layouts.master')

@section('title')
COCOHub - Product
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3" style="padding-top: 12px;padding-bottom: 12px;">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Harga</h5>
                        </div>
                        <div class="card-body"><span>Range</span><input class="form-range" type="range"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-top: 12px;padding-bottom: 12px;">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Tipe</h5>
                        </div>
                        <div class="card-body"><select>
                                <option value="Standar">Standar</option>
                                <option value="NonStandar">Non-Standar</option>
                            </select></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col" style="padding-top: 12px;padding-bottom: 12px;">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Lokasi</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Item 1</li>
                                <li>Item 2</li>
                                <li>Item 3</li>
                                <li>Item 4</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="row" style="margin-top: 12px;">
                @foreach ($products as $product)
                <div class="col-6 col-sm-5 col-md-3 col-lg-4 col-xl-3 col-xxl-3">
                    <div class="card" style="height: 286.5px;">
                        <div class="card-body">
                            <div style="height: 119px;margin-bottom: 19px;"><img src="{{ asset($product->thumb_image) }}" width="100" height="80" style="width: 100%;height: 100%;margin-bottom: 50px;"></div><a href="{{ route('product-detail', $product->slug) }}" style="color: var(--bs-black);font-size: 17px;">{{$product->name}}</a>
                            <p style="font-size: 18px;font-weight: bold;margin-bottom: 2px;margin-top: 6px;">Rp{{ $product->price }}</p>
                            <p style="margin-bottom: 3px;">{{$product->vendor->shop_name}}</p>
                            <p>{{$product->vendor->address}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>



    </div>
</div>
@endsection
