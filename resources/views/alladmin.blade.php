@extends('adminmaster')
@section('content')
    <div class="wrapper">
        <div class="row">
            <div class="col-auto">
                <aside class="main-sidebar sidebar-dark-primary elevation-4 vh-100">
                    <!-- Sidebar -->
                    <div class="sidebar h-auto">
                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class
                                       with font-awesome or any other icon font library -->
                               
                                <li class="nav-item">
                                    <a href="/alladmin" class="nav-link active">
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
                                    <a href="/allorder" class="nav-link">
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
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-10">
                                <h1>Admin</h1>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add</button>
                            </div>
                        </div>
        
        
                        {{-- <div class="row">
                            <div class="col">
                                <table id="datatable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Username</th>
                                        </tr>
                                    </thead>
                                    <div class="">
                                        @foreach ($admins as $admin)
                                            <tbody>
                                                <tr>
                                                    <td>{{ $admin->id }}</td>
                                                    <td>{{ $admin->username }}</td>
                                                    <td class="col">
                                                        <button type="button" class="btn btn-warning editbtn"
                                                            data-bs-target="#edit" value="{{ $admin->id }}">Edit</button>
                                                    </td>
                                                    <td class="col">
                                                        <form action="{{ route('deleteAdmin', $admin->id) }}" method="post"
                                                            id="delete-form-{{ $admin->id }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-xs btn-flat show_confirm"
                                                                data-toggle="tooltip" title='Delete'>Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </div>
                                </table>
                            </div>
                            <div class="col-paginate">
                                {{ $admins->render('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div> --}}
        
                        <div class="row">
                            <div class="col-9">
                                <div class="card">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Username</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            @foreach ($admins as $admin)
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $admin->id }}</td>
                                                        <td>{{ $admin->username }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning editbtn"
                                                                data-bs-target="#edit" value="{{ $admin->id }}">Edit</button>
                                                        </td>
                                                        <td class="col-2">
                                                            <form action="{{ route('deleteAdmin', $admin->id) }}" method="post"
                                                                id="delete-form-{{ $admin->id }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-block btn-danger show_confirm"
                                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-paginate">
                                        {{ $admins->render('vendor.pagination.bootstrap-5') }}
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
                        <h1 class="modal-title fs-5" id="add">Add Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addAdmin') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="Userame" class="col-form-label">Userame:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="Password" class="col-form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
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
    
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit">Edit Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateAdmin') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="admin_id" id="admin_id" />
                            <div class="mb-3">
                                <label for="Name" class="col-form-label">Username:</label>
                                <input type="text" class="form-control" id="eusername" name="username">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="Password" class="col-form-label">Password:</label>
                                <input type="text" class="form-control" id="epassword" name="password">
                            </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="edit"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            event.preventDefault();
            var form = $(this).closest("form");
            var id = form.attr("id").split("-").pop();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $(".editbtn").on('click', function() {
                var admin_id = $(this).val();
                $('#edit').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edit-admin/" + admin_id,
                    success: function(response) {
                        console.log(response);
                        $('#eusername').val(response.admin.username);
                        // $('#epassword').val(response.admin.password);
                        $('#admin_id').val(response.admin.id);
                    }
                });
            });

        });
    </script>
@endsection
