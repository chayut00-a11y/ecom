@extends('master')
@section('content')
    <div class="container custom-content">

        <div class="row">
            <div class="col">
                <h1>Category</h1>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $item)
                <div class="col-3">
                    <div class="card mt-3 ms-3">
                        <img src="{{ $item->image }}" alt="{{ $item->image }}" height="200" width="200">
                        <div>
                            {{ $item->name }}
                        </div>
                        <div>
                            {{ $item->price }}
                        </div>
                        <a href="detail/{{ $item['id'] }}">?</a>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection
