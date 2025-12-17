@extends('master')
@section('content')
<div class="bg-image">
    <div class="container custom-content mt-5">
        <div class="row">

            <div class="col">
                <h4>Result fo Products</h4>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-3">
                            <div class="card">
                                <img src="{{ $product->image }}" class="card-img-top " width="350" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text">฿ {{ $product->price }}</p>
                                    <a href="/detail/{{ $product->id }}" class="btn btn-primary">View Product</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
