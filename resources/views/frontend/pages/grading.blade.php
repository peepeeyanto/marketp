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
                <div class="col d-lg-flex justify-content-lg-center"><img id="imagePreview" style="width: 495px;height: 292px;margin-bottom: 12px;"></div>
            </div>
            <div class="row" style="border: 2px solid var(--bs-gray) ;">
                <div class="col d-lg-flex align-items-lg-center" style="height: 140px;border-right-style: solid;border-right-color: var(--bs-gray);">
                    <h5>Upload gambar kelapa disini!</h5>
                    <input id="imageUpload" type="file" />
                </div>
                <div class="col d-lg-flex align-items-lg-center">
                    <div id="label-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    // const URL = '{{ asset('my_model') }}';

    let model, labelContainer, maxPredictions;

    // Load the image model
    async function init() {
        const modelURL = "{{ asset('my_model/model.json') }}";
        const metadataURL = "{{ asset('my_model/metadata.json') }}";

        // load the model and metadata
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        labelContainer = document.getElementById('label-container');
        $('#label-container').empty();
        for (let i = 0; i < maxPredictions; i++) {
            // and class labels
            labelContainer.appendChild(document.createElement('div'));
        }
    }

    async function predict() {
        // predict can take in an image, video or canvas html element
        var image = document.getElementById('imagePreview');
        const prediction = await model.predict(image, false);
        for (let i = 0; i < maxPredictions; i++) {
            const classPrediction =
                prediction[i].className + ': ' + 'Kemungkinan ' + (prediction[i].probability.toFixed(2) * 100) + '%';
            labelContainer.childNodes[i].innerHTML = classPrediction;
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
                // $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#label-container').html('sedang diproses');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
            init().then(() => {
                predict();
            });
        }
    }
    $('#imageUpload').change(function () {
        readURL(this);
    });
</script>
@endpush
