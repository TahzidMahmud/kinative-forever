@extends('frontend.layouts.app')

@section('content')

<section class="mb-4 position-relative text-white">
    <div class="">
        <div class="aiz-carousel mobile-img-auto-height dot-small-white dots-inside-bottom " data-dots="true" data-autoplay="true">
            @foreach(explode(",",get_setting('offers_banner')) as $value)
            <div class="carousel-box">
                <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="mb-4">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 gutters-10">                           
            @foreach($all_flash_deals as $single)
            <div class="col">
                <div class="bg-white rounded shadow-sm mb-3">
                    <a href="{{ route('flash-deal-details', $single->slug) }}" class="d-block text-reset">
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($single->banner) }}"
                            alt="{{ $single->title }}"
                            class="img-fluid lazyload rounded">
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection
