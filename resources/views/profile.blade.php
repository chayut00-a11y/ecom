@extends('master')
@section('content')
    <div class="bg-image">
        <div class="custom-content d-flex">
            <div class="flex-fill">
                <div class="row h-100">
                    <div class="col-12 col-md-3">
                        <div class="block-sidebar h-100">
                            <ul class="list-unstyled list-menu">
                                <li><a class="text-decoration-none" href="/profile">ชื่อผู้ใช้ : {{ $user->name }}</a></li>
                                <li><a href="/address">ข้อมูลที่อยู่</a></li>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 mt-5">
                        <h1 class="text-center">Profile</h1>
                        <div class="row">
                            <div class="col">
                                <div class="block-profile">
                                    <div>
                                        ชื่อผู้ใช้ : {{ $user->name }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <h1 class="text-center">Order</h1>
                            <div class="col-12 block-order">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ชื่อผู้สั่งซื้อ</th>
                                            <th scope="col">วันที่สั่งซื้อ</th>
                                            <th scope="col">ยอดรวม</th>
                                            <th scope="col">สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            {{-- {{ dd($order) }} --}}
                                            @if ($order->status != 0)
                                                <tr>
                                                    <th scope="row">{{ $order->id }}</th>
                                                    <td>{{ $order->address_list->username }}</td>
                                                    <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                                    <td>฿ {{ $order->total }}</td>
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
                                                    <td><a class="text-decoration-none text-black"
                                                            href="/orderdetail/{{ $order->id }}">. . .</a></td>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
