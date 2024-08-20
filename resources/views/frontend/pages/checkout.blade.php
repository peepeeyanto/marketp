@extends('frontend.home.layouts.master')
@section('title')
    COCOHub - Checkout
@endsection
@section('content')
<section id="wsus__cart_view">
    <div class="container">
        {{-- <form class="wsus__checkout_form"> --}}
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5>Billing Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add new address</a></h5>
                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input ship_address" type="radio" data-id="{{$address->id}}" name="flexRadioDefault" id="flexRadioDefault1" >
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span> {{ $address->name }}</li>
                                            <li><span>Phone :</span> {{ $address->phone }}</li>
                                            <li><span>State :</span> {{ $address->state }}</li>
                                            <li><span>City :</span> {{ $address->city }}</li>
                                            <li><span>Zip Code :</span> {{ $address->zip }}</li>
                                            <li><span>Address :</span> {{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">shipping Methods</p>

                        @foreach ($shippingMethod as $method)

                            @if ($method->type == 'min_cost' && getCartTotal() >= $method->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping-method" type="radio" name="exampleRadios" id="exampleRadios1" value="{{ $method->id }}" data-id="{{ $method->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $method->name }}
                                        <span>{{ $method->cost == 0 ? "Gratis" : "Rp".$method->cost }}</span>
                                    </label>
                                </div>
                            @elseif ($method->type == 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping-method" type="radio" name="exampleRadios" id="exampleRadios" value="{{ $method->id }}" data-id="{{ $method->cost }}" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $method->name }}
                                        <span>{{ $method->cost == 0 ? "Gratis" : "Rp".$method->cost }}</span>
                                    </label>
                                </div>
                            @endif

                        @endforeach

                        <div class="wsus__order_details_summery">
                            <p>subtotal: <span>Rp{{ getSubTotal() }}</span></p>
                            <p>shipping fee: <span id="spanShipping">-</span></p>
                            {{-- <p>tax: <span>$00.00</span></p> --}}
                            <p><b>total:</b> <span><b id="tAmmount" data-id="{{ getSubTotal() }}">Rp{{ getSubTotal() }}</b></span></p>
                        </div>

                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree-tos" type="checkbox" value="" id="flexCheckChecked3"
                                    checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    I have read and agree to the website <a href="#">terms and conditions *</a>
                                </label>
                            </div>
                        </div>

                        <form action="" id="checkout-form">
                            <input type="hidden" name="shipping_method_id" id="ship_id" value="">
                            <input type="hidden" name="shipping_address_id" id="add_id" value="">
                        </form>

                        <a href="" id="submitCheckoutForm" class="common_btn">Place Order</a>
                    </div>
                </div>
            </div>
        {{-- </form> --}}
    </div>
</section>

<div class="wsus__popup_address">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="wsus__check_form p-3">
                        <form action="{{ route('user.checkout.address.create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Nama" name="name" value="{{ old('name')  }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Alamat" name="address" value="{{ old('address') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Provinsi" name="state" value="{{ old('state')  }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Kota" name="city" value="{{ old('city')   }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="Kode Pos" name="zip" value="{{ old('zip')    }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wsus__check_single_form">
                                        <input type="text" placeholder="No. Handphone" name="phone" value="{{ old('phone')   }}">
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="wsus__check_single_form">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

            $('input[type="radio"]').prop('checked', false);
            $('.shipping-method').on('click', function () {
                let shipCost = $(this).data('id');
                $('#ship_id').val($(this).val());
                $('#spanShipping').text('Rp' + shipCost);
                let pastTotal = $('#tAmmount').data('id');
                let total = pastTotal + shipCost;
                $('#tAmmount').text('Rp' + total);
            })

            $('.ship_address').on('click', function () {
                $('#add_id').val($(this).data('id'));
            })

            $('#submitCheckoutForm').on('click', function (e) {
                e.preventDefault();
                if($('#ship_id').val() == ''){
                    toastr.error('Metode Pengiriman perlu diisi');
                }else if($('#add_id').val() == ''){
                    toastr.error('Alamat pengiriman perlu diisi');
                }else if(!$('.agree-tos').prop('checked')){
                    toastr.error('Anda harus menyetujui syarat dan ketentuan');
                }else{
                    $.ajax({
                    url: '{{ route('user.checkout.submit') }}',
                    method: 'post',
                    data: $('#checkout-form').serialize(),
                    beforeSend: function(){
                        $('#submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>');
                    },
                    success: function (data) {
                        if(data.status == "success"){
                            $('#submitCheckoutForm').text('Pesan Sekarang');
                            window.location.href = data.redirect_url;
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })
                }
            })
        })
    </script>
@endpush
