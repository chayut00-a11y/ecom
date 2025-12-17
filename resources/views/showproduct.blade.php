@extends('master')
@section('content')
    <div class="bg-image">
        <div class="custom-content d-flex mt-3">
            <div class="flex-fill"> 
            <div class="row h-100">
                <div class="col-12 col-md-3">
                    <div class="block-sidebar top-0 h-100">
                        <h4>Product Categories</h4>
                        <ul class="list-unstyled list-menu">
                            <a href="/showproduct">Show all</a>
                            @foreach ($categories as $category)
                                <a href="{{ url()->current() }}?category_id={{ $category->id }}">{{ $category->name }}</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <h1 class="text-center">Products</h1>
                    <div id="product-list" class="row">
                        @foreach ($products as $product)
                            <div class="col-12 col-md-4 mb-3 js-product-card">
                                <div class="card h-100 fade-in">
                                    <img src="{{ $product->image }}" class="card-img-top" height="300px"
                                        alt="{{ $product->name }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <p class="card-text text-start">฿ {{ $product->price }} </p>
                                            </div>
                                            <div class="col text-end">
                                                <a href="/detail/{{ $product->id }}" class="btn btn-primary">View
                                                    Product</a>
                                            </div>
                                        </div>
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

    <script>
        $(document).ready(function() {
            $(".js-btn-close").click(function() {
                $(".js-trigger").addClass("d-none");
                $(".js-trigger").removeClass("d-block");
            });
        });
    </script>
@endsection

