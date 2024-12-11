@extends('frontend.home.layouts.master')

@section('title')
COCOHub - Grading Yolov5
@endsection

@section('content')
<section>
    <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="height: 100vh;">
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <div class="row">
                    <div class="col d-lg-flex justify-content-lg-center align-items-lg-center">
                        <img class="w-75" src="{{asset('backend/assets/img/classes.png')}}">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col d-lg-flex justify-content-lg-center align-items-lg-center">
                        <a href="{{route('yolov5-filegrade')}}" class="btn btn-primary" type="button" style="margin-right: 21px;">Klasifikasi dengan file</a>
                        <a href="{{ route('yolov5-cameragrade') }}" class="btn btn-primary" type="button">Klasifikasi dengan kamera</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
