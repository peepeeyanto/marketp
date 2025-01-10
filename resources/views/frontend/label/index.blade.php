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
                        <div id="reader" width="100%"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Cek label dan keaslian pada produk-mu disini</h5>
                    </div>
                </div>

                {{-- <form enctype="multipart/form-data" id="qrimg">
                    <div class="row">
                        <div class="col"><input type="file" accept="image/*" name="qrs" id="image"/></div>
                        <button type="submit">Submit</button>
                    </div>
                </form> --}}

                <div class="row">
                    <div class="col">
                            <p id="shopName"><span>Nama toko:</span></p>
                            <p id="productName"><span>Produk:</span> </p>
                            <p id="prodDate"><span>Tanggal produksi:</span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
        });

        function onScanSuccess(decodedText, decodedResult) {
            html5QrcodeScanner.clear();

            $.ajax({
                url: "{{ route('label.decrypt.show') }}",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({ ciphertext: decodedText }),
                success: function(response){
                    $('#shopName').after(response.shop_name)
                    $('#productName').after(response.product_name)
                    $('#prodDate').after(response.date)
                },
                error: function(xhr, status, error) {
                    alert(error);
                }
            })
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure
        );

        // Handle form submission
        // $('#qrimg').on('submit', function(event) {
        //     event.preventDefault(); // Prevent default form submission

        //     const html5QrCode = new Html5Qrcode('qrimg')

        //     const imageFile = document.getElementById('image').files[0];
        //     html5QrCode.scanFile(imageFile, true)
        //         .then(decodedText =>{
        //             // console.log(decodedText)
        //             $.ajax({
        //                 url: "{{ route('label.decrypt.show') }}",
        //                 type: "POST",
        //                 contentType: "application/json",
        //                 data: JSON.stringify({ ciphertext: decodedText }),
        //                 success: function(response){
        //                     $('#shopName').after(response.shop_name)
        //                     $('#productName').after(response.product_name)
        //                     $('#prodDate').after(response.date)
        //                 },
        //                 error: function(xhr, status, error) {
        //                     alert(error);
        //                 }
        //             })
        //     });
        // });
    });
</script>
@endpush
