@extends('master')
@section('content')
    <div class="bg-image">
        <div class="carousel-container w-100">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    @foreach ($banners as $key => $item)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner text-center">
                    @foreach ($banners as $key => $item)
                        <div class="carousel-item{{ $key == 0 ? ' active' : '' }}  banner">
                            <img class="mw-100" src="{{ $item['image'] }}" width="" alt="{{ $item['id'] }}"></a>
                        </div>
                    @endforeach
                    <button class="carousel-control-prev corousel-color" type="button"
                        data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next corousel-color" type="button"
                        data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>



        <div class="container custom-content mt-3">

                <div class="text-center">
                    <h3>สินค้าขายดี</h3>
                </div>
                <div class="d-flex justify-content-center">
                    @foreach ($products as $key => $item)
                        @if ($key >= 4)
                        @break
                    @endif
                    <div class="col image-container me-3">
                        <a class="text-decoration-none text-white" href="detail/{{ $item['id'] }}">
                            <div class="image-overlay hover-show-product me-3">
                                <div class="text-product">
                                    <div class="row justify-content-center">
                                        <div class="col-8 text-center">
                                            <span style="font-size: 24px">{{ $item->name }}</span>
                                        </div>
                                        <div class="col-8 text-center">
                                            <span style="font-size: 20px">฿ {{ $item->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img class="img fade-in image" src="{{ $item['image'] }}" alt="{{ $item['id'] }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


</div>
{{-- <script>

    $(document).ready(function() {
        $(".js-btn-close").click(function() {
            $(".js-trigger").addClass("d-none");
            $(".js-trigger").removeClass("d-block");
        });
    });
</script> --}}
@endsection
