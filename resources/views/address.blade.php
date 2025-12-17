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
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 mt-5">
                        <h1 class="text-center">ข้อมูลที่อยู่</h1>
                        <div class="row">
                            <div class="col">
                                <div class="block-profile">
                                    <div class="row">
                                        <div class="col text-end">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#add">Add</button>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center">
                                        @foreach ($userdata as $item)
                                            <div class="col-8 mb-3">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Address Information
                                                    </div>
                                                    <div class="card-body">
                                                        <p>ชื่อ: {{ $item->username }}</p>
                                                        <p>Address: {{ $item->addressname }}</p>
                                                        <p>เบอร์โทรศัพท์: {{ $item->tel }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <label for="Tel" class="col-form-label">เบอร์โทรศัพท์:</label>
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
@endsection
