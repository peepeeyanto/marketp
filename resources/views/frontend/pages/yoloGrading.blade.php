@extends('frontend.home.layouts.master')

@section('title')
Grading - COCOHub
@endsection

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h5 class="mb-0">Cek Kualitas Kelapa</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-lg-flex justify-content-lg-center">
                    <img id="annotatedImage" src="" style="width: 495px;height: 292px;margin-bottom: 12px;display:none;">
                </div>
            </div>
            <div class="row" style="border: 2px solid var(--bs-gray) ;">
                <div class="col d-lg-flex align-items-lg-center" style="height: 140px;border-right-style: solid;border-right-color: var(--bs-gray);">
                    <form id="imageForm" enctype="multipart/form-data">
                        <input id="image" name="image" type="file" accept="image/*" />
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <div class="col d-lg-flex align-items-lg-center">
                    <div id="label-container">
                        <ul id='detections'>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
         $(document).ready(function() {

            $.ajaxSetup({
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
            });

            // Handle form submission
            $('#imageForm').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Prepare the form data
                let formData = new FormData();
                formData.append('image', $('#image')[0].files[0]);

                // AJAX request to Laravel controller
                $.ajax({
                    url: "{{ route('grading.yolo.predict') }}", // Route to your controller method
                    type: "POST",
                    data: formData,
                    processData: false,  // Don't process the files
                    contentType: false,  // Set content type to false as jQuery will tell the server its a query string request
                    success: function(response) {
                        $('#detections').empty();
                        $('#annotatedImage').hide();

                        response.detections.forEach(function(detection) {
                            $('#detections').append('<li>Class: ' + detection.class.class_name + ', Confidence: ' + detection.confidence + '</li>');
                        });

                        $('#annotatedImage').attr('src', 'data:image/png;base64,' + response.annotated_image).show();
                    },
                    error: function(xhr, status, error) {
                        alert('Failed to get prediction: ' + error);
                    }
                });
            });
        });
    </script>
@endpush
