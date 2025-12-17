    @extends('master')
    @section('content')
        <div class="bg-image">
            <div class="container custom-content mt-5">
                <div class="row">
                    <div class="col">
                        <h2>My order</h2>
                        <h5>Order Detail</h5>
                    </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        @foreach ($order_details as $detail)
                            {{-- {{ dd($order_details) }} --}}
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
                                    ฿ {{ $detail->price }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- {{ dd($order) }} --}}
                    <div class="col-6">
                        <h3>รวม {{ $order->total }}</h3>
                        <h5>สถานะคำสั่งซื้อ :
                            @if ($order->status == 1)
                                Pending
                            @elseif ($order->status == 2)
                                Packing
                            @elseif ($order->status == 3)
                                Sending
                            @endif
                        </h5>
                        <h5> ที่อยู่จัดส่ง : {{ $order->address_list->addressname }} </h5>

                        @if ($order->slip)
                            <img src="{{ asset($order->slip) }}" alt="Slip" width="200">
                        @endif
                        @if (!$order->slip)
                            <form action="{{ route('uploadSlip') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="image">Upload Image:</label>
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="file" class="form-control" id="image" name="image" required />
                                <button type="submit" class="btn btn-success">Upload</button>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        {{-- @endsection --}}
