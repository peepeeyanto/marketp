@extends('frontend.home.layouts.master')
@section('title')
COCOHub - Payment
@endsection

@section('content')
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <h1>Transaksi Berhasil</h1>
                    <p>Terimakasih telah berbelanja di COCOHub</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">Lanjutkan Belanja</a>
                </div>
            </div>
        </div>
    </section>
@endsection
