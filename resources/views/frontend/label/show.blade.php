@extends('frontend.home.layouts.master')

@section('title')
COCOHub - Cek Label
@endsection

@section('content')
<section>
    <div class="container">
        <div class="card" style="margin-top:53px">
            <div class="card-body d-lg-flex flex-column justify-content-lg-center align-items-lg-center">
                <div class="row">
                    <div class="col">
                        <h5>Cek label dan keaslian pada produk-mu disini</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{route('sellers-products', $shop->id)}}">Dari toko: {{ $shop->shop_name }}</a>
                        <br>
                        <a href="{{route('product-detail', $product->id)}}">Produk: {{ $product->name }}</a>
                        <br>
                        <p>Tanggal Produksi: {{ $date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
