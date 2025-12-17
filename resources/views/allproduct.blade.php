@extends('adminmaster')
@section('content')
    <div class="wrapper">
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
                            <a href="/allproduct" class="nav-link active">
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
        <div class="row">
            <div class="col-3">
            </div>

            <div class="col-9">

                <div class="row">
                    <div class="col-10">
                        <h1>Product</h1>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduct">Add</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <div class="">
                                @foreach ($products as $product)
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->categories->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td><img src="{{ $product->image }}" class="img" height="300px"></td>
                                            <td>
                                                <button class="btn btn-warning editbtn"
                                                    value="{{ $product->id }}">Edit</button>
                                            </td>
                                            <td class="col">
                                                <form action="{{ route('deleteProduct', $product->id) }}" method="post"
                                                    class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </div>
                        </table>
                    </div>
                    <div class="col-paginate">
                        {{ $products->render('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="Name" class="form-label">Product name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="name"
                                    placeholder="Productname" required>
                            </div>
                            <div class="mb-3">
                                <label for="Description" class="form-label">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ProductCategory" class="col-form-label">Product Category</label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Price" class="form-label">Product price</label>
                                <input type="number" class="form-control" name="price" id="exampleFormControlInput1"
                                    placeholder="Productprice" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">ภาพสินค้า</label>
                                <img id="image">
                                <input type="file" class="form-control" id="image" name="image" required />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade" id="editproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateProduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="hidden" name="product_id" id="product_id">
                                <label for="Name" class="form-label">Product name</label>
                                <input type="text" class="form-control" id="name" placeholder="Productname"
                                    name="name">
                            </div>
                            <div class="mb-3">
                                <label for="Description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="ProductCategory" class="col-form-label">Product Category</label>
                                <select class="form-select" name="ecategory_id" id="ecategory_id" required>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Price" class="form-label">Product price</label>
                                <input type="number" class="form-control" id="price" placeholder="Productprice"
                                    name="price">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" id="image" for="image">ภาพสินค้า</label>
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
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
                    text: "Once deleted, you will not be able to recover this product!",
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

            $(document).on('click', '.editbtn', function() {
                var product_id = $(this).val();
                $('#editproduct').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edit-product/" + product_id,
                    success: function(response) {
                        console.log(response);
                        $('#name').val(response.product.name);
                        $('#description').val(response.product.description);
                        $('#ecategory_id').val(response.product.category_id);
                        $('#price').val(response.product.price);
                        $('#image').val(response.product.image);
                        $('#product_id').val(response.product.id);


                    }
                });
            });
        });
    </script>
@endsection
