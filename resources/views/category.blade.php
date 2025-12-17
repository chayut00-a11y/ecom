@extends('adminmaster')
@section('content')
    <div class="wrapper">
        <aside class="main-sidebar sidebar-dark-primary elevation-4 vh-100">
            <!-- Sidebar -->
            <div class="sidebar h-auto">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                       
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
                            <a href="/allorder" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Order
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/category" class="nav-link active">
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
            <div class="col-3">
            </div>
            <div class="col-8">
                <div class="row">
                    <div class="col-10">
                        <h1>Category</h1>
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
                                    <th scope="col">Category</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach ($categories as $category)
                                <tbody>
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <button class="btn btn-warning edit" value="{{ $category->id }}">Edit</button>
                                        </td>
                                        <td>
                                            <form action="{{ route('deleteCat', $category->id) }}" class="delete-form"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <div class="col-paginate">
                            {{ $categories->render('vendor.pagination.bootstrap-5') }}
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
                    <h1 class="modal-title fs-5" id="add">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('addCat') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
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

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateCat') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="category_id" id="category_id" />
                        <div class="mb-3">
                            <label for="Name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="ename" name="name">
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
        $('.delete-btn').click(function(event) {
            event.preventDefault();
            var form = $(this).closest('.delete-form');
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this category!",
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
    </script>


    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit', function() {
                var category_id = $(this).val();
                $('#edit').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-cat/" + category_id,
                    success: function(response) {
                        $('#ename').val(response.category.name);
                        $('#category_id').val(response.category.id);

                    }
                });
            });
        });
    </script>
@endsection
