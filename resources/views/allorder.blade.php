@extends('adminmaster')
@section('content')

    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-primary elevation-4 vh-100">
            <div class="sidebar h-auto">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                       
                        <li class="nav-item">
                            <a href="/alladmin" class="nav-link">
                                <i class="nav-icon far fa-image"></i>
                                <p>
                                    Admin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/alluser" class="nav-link">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/allproduct" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Product
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/allorder" class="nav-link active">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Order
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/category" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/banners" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Banner
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="row">

            <div class="col-lg-3 col-md-4">
            </div>

            <div class="col-lg-9 col-md-8">

                <div class="row">
                    <div class="col">
                        <h1>Order</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-10">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">หมายเลขคำสั่งซื้อ</th>
                                    <th scope="col">วันที่สั่งซื้อ</th>
                                    <th scope="col">ชื่อผู้สั่งซื้อ</th>
                                    <th scope="col">ที่อยู่จัดส่ง</th>
                                    <th scope="col">ยอดชำระ</th>
                                    <th scope="col">สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    {{-- {{ dd($order) }} --}}
                                    @if ($order->status != 0)
                                        @if (!empty($order->user->name))
                                            <tr>
                                                <td><a href="/adminorderdetail/{{ $order->id }}">{{ $order->id }}</a>
                                                </td>
                                                <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                                <td>{{ $order->address_list->username }}</td>
                                                <td>{{ $order->address_list->addressname }}</td>
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
                                                <td>
                                                    <button class="btn btn-warning updatebtn"
                                                        value="{{ $order->id }}">Update
                                                        Status</button>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center bg-light">ไม่มีข้อมูล</td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center bg-light">ผู้ใช้ยังไม่สั่งซื้อ</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-paginate">
                        {{ $orders->render('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>

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
