@extends('master')
@section('content')
    <div class="bg-image">
        <div class="container custom-content mt-5">
            <a class="btn btn-success" href="{{ url()->previous() }}">Go back</a>
            <div class="block-product mt-2">

                <div class="row">
                    <div class="col-sm-6">
                        <img src="{{ asset($product['image']) }}" width="300" height="300">
                    </div>
                    <div class="col-sm-6">
                        <h1>{{ $product['name'] }}</h1>
                        <h4>Details : {{ $product['description'] }}</h4>
                        <h4>Category : {{ $product['categories']->name }}</h4>
                        <h3>Price : ฿ {{ $product['price'] }}</h3>
                        <br><br>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value={{ $product['id'] }}>
                            <input type="hidden" name="quantity" value="1">

                            @if (session('user'))
                                <button type="submit"  class="btn btn-primary js-btn-add" id="liveToastBtn">Add to Cart</button>
                            @else
                                <a href="/login" class="btn btn-primary">Add to Cart</a>
                            @endif
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
@endsection
