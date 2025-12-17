@extends('master')
@section('content')
    <div class="bg-image">
        <div class="container custom-content mt-5">
            @if ($order)
                <h1>สินค้าในตะกร้า</h1>
                <div class="row">
                    <div class="col-8">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>ชื่อ</th>
                                    <th>ราคา</th>
                                    <th>จำนวน</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($order->order_details as $detail)
                                    <tr>
                                        <td>
                                            <img src="{{ $detail->product->image }}" alt="{{ $detail->product->name }} "
                                                width="200">
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column align-items-center" style="line-height: 40px">
                                                {{ $detail->product->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column align-items-center" style="line-height: 40px">
                                                ฿ {{ $detail->price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-4">
                                                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" value="decrease" name="value">
                                                        <input type="hidden" value="{{ $detail->product_id }}"
                                                            name="product_id">
                                                        <button class="btn btn-outline-danger" type="submit">-</button>
                                                    </form>
                                                </div>
                                                <div class="col-4">
                                                    {{ $detail->amount }}
                                                </div>
                                                <div class="col-4">
                                                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" value="increase" name="value">
                                                        <input type="hidden" value="{{ $detail->product_id }}"
                                                            name="product_id">
                                                        <button class="btn btn-outline-success" type="submit">+</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <td></td>
                                    <td></td>
                                    <td>รวม ฿{{ $order->total }}</td>
                                    <td>
                                        <form action="{{ route('orders.update', $order->id) }}" method="post"
                                            id="checkout-form">
                                            <div class="text-end">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="value" value="checkout">
                                                <input type="hidden" name="address_id" value="" id="" class="address_id">
                                                <button class="btn btn-outline-primary" type="submit" id="checkout-btn"
                                                    disabled>Checkout</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-4">
                        <form action="{{ route('orders.update', $order->id) }}" method="post" id="checkout-form">
                            <div class="row">
                                <div class="col">
                                    <h2>ข้อมูลสำหรับจัดส่ง</h2>
                                    <div class="row">
                                        @foreach ($useraddress as $item)
                                            <div class="col-12">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <input type="radio" name="address_id" value="{{ $item->id }}"
                                                            id="address-{{ $item->id }}" class="address_radio">
                                                    </div>
                                                    <div class="card-body">
                                                        <p>ชื่อ : {{ $item->username }}</p>
                                                        <p>Address: {{ $item->addressname }}</p>
                                                        <p>เบอร์ : {{ $item->tel }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col text-center">
                                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add">Add</button>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="row">
                    <div class="col text-center">
                        <h3>ไม่มีสินค้าในตะกร้า</h3>
                    </div>
                </div>
            @endif
        </div>
    </div>



    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add">เพิ่มที่อยู่</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addresses.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" value="{{ $user->id }}" class="form-control" id="user_id"
                                name="user_id">
                        </div>
                        <div class="mb-3">
                            <label for="Name" class="col-form-label">ชื่อ:</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="col-form-label">ที่อยู่:</label>
                            <input type="text" class="form-control" id="addressname" name="addressname">
                        </div>
                        <div class="mb-3">
                            <label for="Tel" class="col-form-label">เบอร์โทรศํพท์:</label>
                            <input type="tel" class="form-control" id="tel" name="tel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="add"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        const addressInputs = document.querySelectorAll('input[type="radio"][name="address_id"]');
        const checkoutButton = document.getElementById('checkout-btn');

        addressInputs.forEach((addressInput) => {
            addressInput.addEventListener('change', () => {
                checkoutButton.disabled = false;
            });
        });
    </script>
    <script type="text/javascript">
        $('#checkout-btn').click(function(event) {
            event.preventDefault();

            swal({
                title: "Are you sure you want to checkout?",
                text: "Once you checkout, the order cannot be modified.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willCheckout) => {
                if (willCheckout) {
                    $('#checkout-form').submit();
                }
            });
        });

        $(function(){
            $(".address_radio").on("click",function(){
                var _x = $(this).val();
                //console.log($(this).val());
                $(".address_id").val(_x);
                console.log($(".address_id").val());
            });
            
            
        });
    </script>


@endsection
