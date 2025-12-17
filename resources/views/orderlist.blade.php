@extends('master')
@section('content')
<div class="bg-image">

    <div class="container custom-content mt-5">

        <div class="row">
            <div class="col text-center">
                <h1>Order</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-8 mx-auto">
            <table id="datatable" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">หมายเลขคำสั่งซื้อ</th>
                        <th scope="col">วันที่สั่งซื้อ</th>
                        <th scope="col">ชื่อผู้สั่งซื้อ</th>
                        <th scope="col">ที่อยู่จัดส่ง</th>
                        <th scope="col">ยอดชำระ</th>
                        <th scope="col">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            @if ($order->status != 0)
                                <td><a class="text-black text-decoration-none" href="/orderdetail/{{ $order->id }}">{{ $order->id }}</a></td>
                                <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                <td>{{ $order['address_list']->username }}</td>
                                <td>{{ $order['address_list']->addressname}}</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    @if ($order->status == 1)
                                        Pending
                                    @elseif ($order->status == 2)
                                        Packing
                                    @elseif ($order->status == 3)
                                        Sending
                                    @endif
                                </td>
                                <td><button type="button" class="btn btn-info"><a class="text-decoration-none text-black" href="/orderdetail/{{ $order->id }}">รายละเอียด</a></button></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        </div>
    </div>

    <div class="modal fade" id="update" tabindex="-1" aria-labelledby="update" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="update">Update Status Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateStatus') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_id" id="order_id" />
                        <select class="form-select" name="status" id="status">
                            <option selected>Select Status</option>
                            <option value="1" @if ($status = 1)  @endif>Pending</option>
                            <option value="2">Packing</option>
                            <option value="3">Sending</option>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="update" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.updatebtn', function() {
                var orders_id = $(this).val();
                $('#update').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-status/" + orders_id,
                    success: function(response) {
                        $('#order_id').val(orders_id);
                        $('#status').val(response.orders.status);
                    }
                });
            });
        });
    </script>
@endsection
