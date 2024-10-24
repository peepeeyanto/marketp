@php
    $address = json_decode($orders->order_address);
@endphp

@extends('seller.layouts.master')
@section('title')
COCOHub - Pesanan
@endsection
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
      {{-- @include('frontend.dashboard.layouts.sidebar') --}}

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Detil Pesanan</h3>
            <div class="wsus__dashboard_profile">
                <div class="wsus__invoice_area invoice-print">
                    <div class="wsus__invoice_header">
                        <div class="wsus__invoice_content ">
                            <div class="row">
                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                    <div class="wsus__invoice_single">
                                        <h5>Invoice To</h5>
                                        <h6>{{ $orders->user->name}}</h6>
                                        <p>{{ $address->phone }}</p>
                                        <p>{{ $address->address }}</p>
                                        <p>{{ $address->zip }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                    <div class="wsus__invoice_single text-md-center">
                                        <h5>shipping information</h5>
                                        <h6>{{ $orders->user->name}}</h6>
                                        <p>{{ $address->phone }}</p>
                                        <p>{{ $address->address }}</p>
                                        <p>{{ $address->zip }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-4">
                                    <div class="wsus__invoice_single text-md-end">
                                        <h5>Order id: #{{ $orders->invoice_id }}</h5>
                                        <h6>Order Status: {{ config('order_status.order_status_admin')[$orders->order_status]['status'] }}</h6>
                                        <p>Payment Method: {{ $orders->payment_method }}</p>
                                        <p>Payment Status: {{ $orders->payment_status }}</p>
                                        <p>Transaction Id: {{ $orders->transaction->transaction_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_description">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="name">
                                            product
                                        </th>

                                        <th class="amount">
                                            penjual
                                        </th>

                                        <th class="amount">
                                            harga unit
                                        </th>

                                        <th class="quentity">
                                            qty
                                        </th>

                                        <th class="total">
                                            total
                                        </th>
                                    </tr>

                                    @foreach ($orders->orderProduct as $product)
                                            @php
                                                $variants = json_decode($product->variants);
                                                $total = 0;
                                                $total += ($product->unit_price + $product->variant_total) * $product->qty;
                                            @endphp
                                            <tr>
                                                <td class="name">
                                                    <p>{{ $product->product_name }}</p>

                                                    @foreach ($variants as $key => $item)
                                                        <span>{{ $key }} : {{ $item->name }} (Rp{{ $item->price }})</span>
                                                    @endforeach
                                                </td>

                                                <td class="amount">
                                                    {{ $product->product->vendor->shop_name }}
                                                </td>

                                                <td class="amount">
                                                    Rp{{ $product->unit_price }}
                                                </td>

                                                <td class="quentity">
                                                    {{ $product->qty }}
                                                </td>
                                                <td class="total">
                                                    Rp{{ ($product->unit_price + $product->variant_total) * $product->qty }}
                                                </td>
                                            </tr>

                                    @endforeach

                                    {{-- <tr>
                                        <td class="name">
                                            <p>men's fashion sholder bag</p>
                                            <span>color : yellow</span>
                                            <span>size : XL</span>
                                        </td>
                                        <td class="amount">
                                            $55
                                        </td>

                                        <td class="quentity">
                                            2
                                        </td>
                                        <td class="total">
                                            $110
                                        </td>
                                    </tr> --}}
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="wsus__invoice_footer">
                        <p><span>Subtotal:</span> Rp{{ $orders->subtotal }} </p>
                        <p><span>Ongkos Kirim:</span> Rp{{ $orders->total_shipping }} </p>
                        <p><span>Total:</span> Rp{{ $orders->ammount }}</p>
                    </div>
                </div>

                {{-- <div class="row mt-4">
                    <div class="col-xl-6">
                        <form action="{{ route('seller.orders.changeStatus', $orders->id) }}">
                            <div class="form-group">
                                <label for="" class="mb-1">Order Status</label>
                                <select name="status" class="form-control">
                                    @foreach (config('order_status.order_status_vendor') as $key => $status)
                                        <option {{ $key == $orders->order_status? 'selected' : '' }} value="{{ $key }}">{{ $status['status'] }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary mt-2" type="submit">submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-xl-6 d-flex flex-column align-items-end">
                        <button class="btn btn-warning print_invoice">Print</button>
                    </div>
                </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

{{-- @push('script')
<script>
    $('.print_invoice').on('click', function () {
    let contentBody = $('.invoice-print');
    let originalContent = $('body').html();
    $('body').html(contentBody.html());
    window.print();
    $('body').html(originalContent);
    })
</script>
@endpush --}}
