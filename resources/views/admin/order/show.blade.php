@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
@endphp

@extends('admin.layouts.master')

@section('content')
    <section class="section">
      <div class="section-header">
        <h1>Order</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Components</a></div>
          <div class="breadcrumb-item">Table</div>
        </div>
      </div>

      <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
              <div class="row">
                <div class="col-lg-12">
                  <div class="invoice-title">
                    <h2>Invoice</h2>
                    <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <address>
                        <strong>Kepada:</strong><br>
                          {{ $address->name }}<br>
                          {{ $address->phone }}<br>
                          {{ $address->address }}<br>
                          {{ $address->state }}, Indonesia
                      </address>
                    </div>

                    <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Tanggal:</strong><br>
                          {{ date('d M, Y', strtotime($order->created_at)) }}<br>
                        </address>
                    </div>
                    {{-- <div class="col-md-6 text-md-right">
                      <address>
                        <strong>Shipped To:</strong><br>
                        Muhamad Nauval Azhar<br>
                        1234 Main<br>
                        Apt. 4B<br>
                        Bogor Barat, Indonesia
                      </address>
                    </div> --}}
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <address>
                        <strong>Info Pembayaran:</strong><br>
                        Metode: {{ $order->payment_method }}<br>
                        ID Transaksi: {{ $order->transaction->transaction_id }}<br>
                        Status: {{ $order->payment_status == 1 ? 'Lunas' : 'Belum Lunas'}}
                      </address>
                    </div>

                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-md-12">
                  <div class="section-title">Order Summary</div>
                  <p class="section-lead">All items here cannot be deleted.</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                      <tr>
                        <th data-width="40">#</th>
                        <th>Toko</th>
                        <th>Item</th>
                        <th>Varian</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Total</th>
                      </tr>
                      @foreach ($order->orderProduct as $product)
                        @php
                            $variants = json_decode($product->variants);
                        @endphp

                        <tr>
                            <td>{{++$loop->index}}</td>
                            <td>{{$product->vendor->shop_name}}</td>
                            <td>
                                @if ($product->product->slug)
                                    <a href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!empty($variants))
                                    @foreach ($variants as $key=>$variant)
                                        <b>{{ $key }}: {{$variant->name}} (Rp{{ $variant->price }})</b>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">Rp{{ $product->unit_price }}</td>
                            <td class="text-center">{{ $product->qty }}</td>
                            <td class="text-right">Rp{{ ($product->variant_total + $product->unit_price) * $product->qty}}</td>
                        </tr>
                      @endforeach

                      {{-- <tr>
                        <td>1</td>
                        <td>Mouse Wireless</td>
                        <td class="text-center">$10.99</td>
                        <td class="text-center">1</td>
                        <td class="text-right">$10.99</td>
                      </tr> --}}

                    </table>
                  </div>
                  <div class="row mt-4">
                    <div class="col-lg-8">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Status order</label>
                          <select name="order_status" id="order_status" data-id="{{ $order->id }}" class="form-control">
                            @foreach (config('order_status.order_status_admin') as $key=>$orderStatus)
                                <option {{$order->order_status == $key? 'selected' : ''}} value="{{ $key }}">{{ $orderStatus['status'] }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      {{-- <div class="section-title">Payment Method</div>
                      <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                      <div class="images">
                        <img src="assets/img/visa.png" alt="visa">
                        <img src="assets/img/jcb.png" alt="jcb">
                        <img src="assets/img/mastercard.png" alt="mastercard">
                        <img src="assets/img/paypal.png" alt="paypal">
                      </div> --}}
                    </div>
                    <div class="col-lg-4 text-right">
                      <div class="invoice-detail-item">
                        <div class="invoice-detail-name">Subtotal</div>
                        <div class="invoice-detail-value">Rp{{ $order->subtotal }}</div>
                      </div>
                      <div class="invoice-detail-item">
                        <div class="invoice-detail-name">Shipping</div>
                        <div class="invoice-detail-value">Rp{{ $shipping->cost }}</div>
                      </div>
                      <hr class="mt-2 mb-2">
                      <div class="invoice-detail-item">
                        <div class="invoice-detail-name">Total</div>
                        <div class="invoice-detail-value invoice-detail-value-lg">Rp{{ $order->ammount }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="text-md-right">
              <div class="float-lg-left mb-lg-0 mb-3">
                <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
              </div>
              <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            </div>
          </div>
      </div>
    </section>
@endsection

@push('script')
    <script>
    $(document).ready(function (){
        $.ajaxSetup({
          "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')}
        });

        $('#order_status').on('change', function () {
            let status = $(this).val();
            let id = $(this).data('id');
            $.ajax({
                method: 'GET',
                url: '{{ route('admin.order.status') }}',
                data: {
                    status : status,
                    id: id
                },
                success: function (data) {
                    if(data.status == 'success'){
                        toastr.success(data.message);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            })
        })
    })
    </script>
@endpush

