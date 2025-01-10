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
                    <div class="col"><img /></div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Cek label dan keaslian pada produk-mu disini</h5>
                    </div>
                </div>

                <form action="{{route('label.decrypt.show')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col"><input type="file" accept="image/*" name="qrs" /></div>
                        <button type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
