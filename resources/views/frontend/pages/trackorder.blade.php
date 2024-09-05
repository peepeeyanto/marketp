@extends('frontend.home.layouts.master')

@section('title')
COCOHub - Tracking
@endsection

@section('content')
<section id="wsus__login_register">
    <div class="container">
        <div class="wsus__track_area">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                    <form class="tack_form">
                        <h4 class="text-center">order tracking</h4>
                        <p class="text-center">tracking your order status</p>
                        <div class="wsus__track_input">
                            <label class="d-block mb-2">No resi</label>
                            <input type="text" name="waybill_id" placeholder="#H25-21578455">
                        </div>
                        <div class="wsus__track_input">
                            <label class="d-block mb-2">Kurir</label>
                            <select name="courier" class="form-control mb-4">
                                <option value="jne">JNE</option>
                                <option value="deliveree">Deliveree</option>
                                <option value="sicepat">Sicepat</option>
                                <option value="grab">Grab</option>
                                <option value="tiki">Tiki</option>
                                <option value="gojek">Gojek</option>
                            </select>
                        </div>
                        <button type="submit" class="common_btn">track</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__track_header">
                        <div class="wsus__track_header_text">
                            <div class="row">
                                {{-- <div class="col-xl-3 col-sm-6 col-lg-3">
                                    <div class="wsus__track_header_single">
                                        <h5>estimated delivery time:</h5>
                                        <p>20 nov 2021</p>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-xl-3 col-sm-6 col-lg-3">
                                    <div class="wsus__track_header_single">
                                        <h5>shopping by:</h5>
                                        <p>one shop</p>
                                    </div>
                                </div> --}}
                                <div class="col-xl-6 col-sm-6 col-lg-3">
                                    <div class="wsus__track_header_single">
                                        <h5>status:</h5>
                                        <p id="trackstatus">-</p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-6 col-lg-3">
                                    <div class="wsus__track_header_single border_none">
                                        <h5>tracking:</h5>
                                        <p id="waybill">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-12">
                    <ul class="progtrckr" data-progtrckr-steps="4">
                        <li class="progtrckr_done icon_one check_mark">Order pending</li>
                        <li class="progtrckr_done icon_two ">order Processing</li>
                        <li class="icon_three">on the way</li>
                        <li class="icon_four red_mark">ready for delivery</li>
                    </ul>
                </div> --}}
                {{-- <div class="col-xl-12">
                    <a href="#" class="common_btn"><i class="fas fa-chevron-left"></i> back to order</a>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
            });
            $('.tack_form').on('submit', function(e){
                e.preventDefault();
                // alert('hello')

                $.ajax({
                    url: "{{ route('trackstatus') }}",
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                            if (response.success) {
                                // Display tracking information
                                let trackingData = response.data;
                                $('#trackstatus').text(`<p>Status: ${trackingData.status}</p>`);
                            } else {
                                 // Display error message
                                $('#trackstatus').text(response.message);
                            }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            toastr.error(xhr.responseJSON.error, 'Error');
                        } else {
                            toastr.error('Terjadi kesalahan.', 'Error');
                        }
                    }
                });
            })
        })
    </script>
@endpush
