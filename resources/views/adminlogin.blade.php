@extends('adminmaster')
@section('content')
    <div class="wrapper">
        <div class="row">

            <div class="login-box">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <a class="h3"><b>Admin</b></a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Sign in to start</p>

                        <form action="adminlogin" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .wrapper {
          display: flex;
          justify-content: center;
          align-items: center;
          height: 70vh;
        }
      
        .login-box {
          width: 400px;
        }
      </style>

@endsection
