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
                            <a href="/alluser" class="nav-link active">
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
            </div>
        </aside>
        <div class="row">
            <div class="col-3">
            </div>

            <div class="col-9">
                <div class="row">
                    <div class="col-10">
                        <h1>User</h1>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th></th>
                                    <th></th>
                                    {{-- <th scope="col">Password</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <button class="btn btn-warning editbtn"
                                                value="{{ $user->id }}">Edit</button>
                                        </td>
                                        <td class="col-2">
                                            <form action="{{ route('deleteUser', $user->id) }}" method="post"
                                                id="{{ 'delete-form_' . $user->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-block btn-danger show_confirm"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-paginate">
                        {{ $users->render('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addUser') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="add"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary swalDefaultSuccess">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateUser') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" id="euser_id" />
                        <div class="mb-3">
                            <label for="Name" class="col-form-label">Name:</label>
                            <input value="text" type="text" class="form-control" id="ename" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="eemail" name="email">
                        </div>
                        <div class="mb-3">
                            {{-- <label for="Password" class="col-form-label">Password:</label> --}}
                            <input type="hidden" class="form-control" id="epassword" name="password">
                        </div>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        // Edit button functionality can be added here
    </script>



    <script>
        $(document).ready(function() {

            $(document).on('click', '.editbtn', function() {
                var user_id = $(this).val();
                $('#edituser').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edit-user/" + user_id,
                    success: function(response) {
                        console.log(response);
                        $('#ename').val(response.user.name);
                        $('#epassword').val(response.user.password);
                        $('#eemail').val(response.user.email);
                        $('#euser_id').val(response.user.id);
                    }
                });
            });

        });
    </script>

<script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
  
      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });

    });
  </script>
@endsection
