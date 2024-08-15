@extends('frontend.home.layouts.master')
@section('title')
COCOHub - Cart
@endsection

@section('content')
<section id="wsus__cart_view">
    <div class="container">
        <div class="row">
            <div class="col-xl-9">
                <div class="wsus__cart_list">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                                <tr class="d-flex">
                                    <th class="wsus__pro_img">
                                        product item
                                    </th>

                                    <th class="wsus__pro_name">
                                        product details
                                    </th>

                                    <th class="wsus__pro_tk">
                                        price
                                    </th>

                                    <th class="wsus__pro_status">
                                        Total Price
                                    </th>

                                    <th class="wsus__pro_select">
                                        quantity
                                    </th>


                                    <th class="wsus__pro_icon">
                                        <a href="#" class="common_btn clearcart">clear cart</a>
                                    </th>
                                </tr>

                                @foreach ($cartItem as $item)
                                <tr class="d-flex">
                                    <td class="wsus__pro_img"><img src="{{ asset($item->options->image)  }}" alt="product"
                                            class="img-fluid w-100 ms-3">
                                    </td>

                                    <td class="wsus__pro_name">
                                        <p>{!! $item->name !!}</p>
                                        @foreach ($item->options->variants as $key => $variant)
                                            <span>{{ $key }}: {{ $variant['name'] }}</span>
                                        @endforeach

                                        {{-- <span>size: XL</span> --}}
                                    </td>

                                    <td class="wsus__pro_tk">
                                        <h6>Rp{{ $item->price }}</h6>
                                    </td>

                                    <td class="wsus__pro_status">
                                        <h6 id="{{ $item->rowId }}">Rp{{ ($item->price + $item->options->variants_total) * $item->qty }}</h6>
                                    </td>

                                    <td class="wsus__pro_select">
                                        <div class="product_qtywr">
                                            <button class="btn btn-danger prmin">-</button>
                                            <input class="qtyprod" data-rowid="{{ $item->rowId }}" data-price="{{ $item->price }}" type="text" min="1" max="100" value="{{ $item->qty }}" readonly />
                                            <button class="btn btn-primary pradd">+</button>
                                        </div>
                                    </td>



                                    <td class="wsus__pro_icon">
                                        <a href="{{ route('cart-removeProduct', $item->rowId) }}"><i class="far fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                                @if (count($cartItem) == 0)
                                    <tr class="d-flex">
                                        <td class="wsus__pro_icon" style="width: 100%">
                                            Keranjang kosong
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                    <h6>total cart</h6>
                    <p>subtotal: <span id="subtotalSide">{{ getSubTotal() }}</span></p>
                    <p>delivery: <span>$00.00</span></p>
                    <p>discount: <span>$10.00</span></p>
                    <p class="total"><span>total:</span> <span>$134.00</span></p>

                    <form>
                        <input type="text" placeholder="Coupon Code">
                        <button type="submit" class="common_btn">apply</button>
                    </form>
                    <a class="common_btn mt-4 w-100 text-center" href="check_out.html">checkout</a>
                    <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                            class="fab fa-shopify"></i> go shop</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
            });

            $('.pradd').on('click', function () {
                let input = $(this).siblings(".qtyprod");
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);
                // console.log(quantity);

                $.ajax({
                    url: '{{ route('cart.update-qty') }}',
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            let productId = '#'+rowId;
                            let totalAmount = "Rp" + data.product_total;
                            $(productId).text(totalAmount);
                            showSubTotal();
                        }else if(data.status == 'error'){
                            toastr.error(data.message);
                        }
                    },
                    error: function(data){

                    }
                })
            });

            $('.prmin').on('click', function () {
                let input = $(this).siblings(".qtyprod");
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                if(quantity < 1) {
                    quantity = 1;
                }

                input.val(quantity);
                // console.log(quantity);

                $.ajax({
                    url: '{{ route('cart.update-qty') }}',
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            let productId = '#'+rowId;
                            let totalAmount = "Rp" + data.product_total;
                            $(productId).text(totalAmount);
                            showSubTotal();
                        } else if(data.status == 'error'){
                            toastr.error(data.message);
                        }
                    },
                    error: function(data){

                    }
                })
            });

            $('.clearcart').on('click', function (e) {
                e.preventDefault();
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success me-7",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: true
                })

                swalWithBootstrapButtons.fire({
                    title: "Konfirmasi",
                    text: "Apakah anda ingin mengosongkan keranjang",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ok",
                    cancelButtonText: "Batalkan",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed){
                        $.ajax({
                            type: 'get',
                            url: '{{ route('cart-clear') }}',

                            success: function(data){
                                if(data.status == 'success'){
                                    window.location.reload();
                                }
                            },

                            error: function(xhr, status, error){
                                console.log(error);
                            }
                        })

                    } else if(result.dismiss === Swal.DismissReason.cancel){
                        swalWithBootstrapButtons.fire({
                            title: "Operasi hapus dibatalkan",
                            text: "Data anda tidak dihapus",
                            icon: "error"
                        });
                    }
                });
            })

            function showSubTotal(){
                $.ajax({
                    url : "{{ route('cart-subtotal') }}",
                    method:"get",
                    success  :function (data){
                        $("#subtotalSide").text("Rp"+ data);
                    },
                    error : function (data){
                        console.log(data)
                    }
                });
            }
        });
    </script>
@endpush
