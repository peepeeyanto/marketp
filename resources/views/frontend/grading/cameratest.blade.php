@extends('frontend.home.layouts.master')

@section('title')
COCOHub - Camera
@endsection

@section('content')
<section>
    <div class="row d-lg-flex justify-content-lg-center align-items-lg-center" style="margin-top: 15px;">
        <div class="col-lg-10 offset-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h6>Preview</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <video id="video-webcam" width="560" height="315" autoplay="true" style="width: 100%;height: 100%;">
                                        Browsermu tidak mendukung bro, upgrade donk!
                                    </video>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <h6>Result</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" id="resContainer">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 22px;">
                        <div class="col-lg-12 d-lg-flex justify-content-lg-center"><button class="btn btn-primary" type="button" id="snapbutton">Button</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-lg-flex justify-content-lg-center" style="margin-top: 20px;">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h3>Hasil Klasifikasi</h3>
                    <ul id="classifier">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    // seleksi elemen video
    var video = document.querySelector("#video-webcam");

    // minta izin user
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    // jika user memberikan izin
    if (navigator.getUserMedia) {
        // jalankan fungsi handleVideo, dan videoError jika izin ditolak
        navigator.getUserMedia({ video: true }, handleVideo, videoError);
    }

    // fungsi ini akan dieksekusi jika  izin telah diberikan
    function handleVideo(stream) {
        video.srcObject = stream;
    }

    // fungsi ini akan dieksekusi kalau user menolak izin
    function videoError(e) {
        // do something
        alert("Izinkan menggunakan webcam untuk demo!")
    }

    function dataURLtoBlob(dataURL) {
        var binary = atob(dataURL.split(',')[1]);
        var array = [];
        for (var i = 0; i < binary.length; i++) {
            array.push(binary.charCodeAt(i));
        }
        return new Blob([new Uint8Array(array)], { type: 'image/png' });
    }

    function displayImage(base64Image) {
        // Create a new img element
        var img = document.createElement('img');

        // Set the src attribute to the base64 image data
        img.src = 'data:image/png;base64,' + base64Image;  // Add base64 prefix
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        // Get the resContainer element
        var resContainer = document.getElementById('resContainer');

        // Clear any existing content in the resContainer
        resContainer.innerHTML = '';

        // Append the new image to resContainer
        resContainer.appendChild(img);
    }

    $(document).ready(function () {
        $.ajaxSetup({
        "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
        });

        $('#snapbutton').on('click', function(){
            // Create img element
            const resContainer = document.getElementById('resContainer');

            var img = document.createElement('img');
            var context;

            // Get video dimensions
            var width = video.offsetWidth,
                height = video.offsetHeight;

            // Create canvas element
            var canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;

            // Draw video frame onto the canvas
            context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, width, height);

            // Convert canvas to data URL and set to img element
            img.src = canvas.toDataURL('image/png');


            // Convert the data URL to blob for sending
            var dataURL = canvas.toDataURL('image/png');
            var blob = dataURLtoBlob(dataURL);

            // Create a form data object
            var formData = new FormData();
            formData.append('file', blob, 'snapshot.png');

            // Send image via AJAX
            $.ajax({
                type: 'POST',
                url: 'http://43.216.253.86:8000/object-to-img', // Change this to your server URL
                data: formData,
                processData: false, // Important: don't process the form data
                contentType: false, // Important: let jQuery set the content type
                success: function(response) {
                    $('#classifier').empty();
                    displayImage(response.image);
                    let detects = JSON.parse(response.result);
                    detects.forEach(function(detection) {
                        $('#classifier').append('<li>Class: ' + detection.name + ', Confidence: ' + detection.confidence + '</li>');
                    });
                },
                error: function(error) {
                    console.error(error); // Handle error
                }
            });
        })
    });
</script>
@endpush
