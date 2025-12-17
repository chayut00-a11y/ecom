@extends('master')
@section('content')
    <div class="bg-image">
        <div class="container custom-content d-flex justify-content-center mt-5">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Login</h1>

                    <div class="block-login">
                        @if (isset($error))
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        <form action="login" method="POST">
                            <div class="col mb-3">
                                @csrf
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
