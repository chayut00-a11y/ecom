@extends('master')
@section('content')
    <div class="bg-image">
        <div class="container custom-content mt-5">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="text-center">
                        <h1>Register</h1>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="block-register">
                                    @csrf
                                    <div class="row">
                                        <div class="col md-6">
                                            <div class="form-group">
                                                <label for="name">Name:</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Enter email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password:</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Enter password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 text-center w-100">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
