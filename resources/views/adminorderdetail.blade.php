@extends('adminmaster')
@section('content')
    <div class="container custom-content">
        <div class="row">
            <div class="col mt-3">
                <h5>Order Detail</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                @foreach ($order_details as $detail)
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset($detail->product['image']) }}" width="200">
                        </div>
                        <div class="col">
                            {{ $detail->product->name }}
                        </div>
                        <div class="col">
                            {{ $detail->amount }} ชิ้น
                        </div>
                        <div class="col">
                            {{ $detail->price }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-6">
                <div class="block-login">
                    <h3>รวม {{ $order->total }}</h3>
                    <h5>Order Status :
                        @if ($order->status == 1)
                            Pending
                        @elseif ($order->status == 2)
                            Packing
                        @elseif ($order->status == 3)
                            Sending
                        @endif
                    </h5>
                    <h5>ที่อยู่จัดส่ง : {{ $order->address_list->addressname }} </h5>
                    @if ($order->slip)
                        <img src="{{ asset($order->slip) }}" alt="Slip" width="200">
                    @endif


                </div>
            </div>

        </div>
    </div>
@endsection
