@extends('frontend.layouts.app')

@section('content')
    {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area text-white pt-0px">
        <div class="container-fluid" style="padding-left:0px!important;padding-right:0px!important; ">
            <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height dot-small-black" data-dots="true" data-autoplay="false" data-arrows="true" data-infinite='true' >
                @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                @foreach ($slider_images as $key => $value)
                    <div class="carousel-box">
                        <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}" class="text-reset d-block">
                            <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <section class="py-lg-5 py-4  position-relative">
        <div class="container">
            <div class="row py-lg-5 d-flex align-items-center">
                <div class="col-lg-6">
                    <img src="{{ uploaded_asset(get_setting('home_about_image')) }}" class="img-fluid w-100" alt="">
                </div>
                <div class="col-lg-6">
                    <h2 class="text-uppercase text-alter-6 fs-18 fw-700">{{ get_setting('home_about_title', null, App::getLocale()) }}</h2>
                    <div class="lh-1-9 my-4 mr-1 text-justify ">{{ get_setting('home_about', null, App::getLocale()) }}</div>
                    <a href="{{ json_decode(get_setting('home_about_link'), true) }}" class="btn btn-md btn-primary text-white text-uppercase" style="border-radius: 0px!important;"> learn more </a>
                </div>
            </div>
        </div>
    </section>


    {{-- featured --}}

<div class="container">
    <div class="d-flex mb-3 align-items-baseline ">
        <h2 class="h5 fw-700 mb-0">
            <span class="ml-2 d-inline-block text-alter-6 text-uppercase fs-18">{{ translate('Featured Products') }}</span>
        </h2>
        <a href="#" class="ml-auto mr-0 mt-2 mt-md-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto text-uppercase fw-500" style="border-radius: 0px;">{{ translate('View All') }}</a>
    </div>
    <div class="aiz-carousel gutters-5  dot-small-white" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-infinite='true' data-dots="true" data-autoplay="true">

        @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
        <div class="carousel-box ">
            @include('frontend.partials.product_box_1',['product' => $product])
        </div>
        @endforeach
    </div>
</div>



{{-- main left right content --}}
<div class="container py-5">
    @if (get_setting('banner_text_images') != null)
            @foreach (json_decode(get_setting('banner_text_images'), true) as $key => $value)
            <div class="row align-items-center py-4">
                <div class="col-lg-6 @if(($key % 2) != 0) order-1 @endif">
                    <a href="{{ json_decode(get_setting('banner_text_links'),true)[$key] }}" class="d-block text-reset">
                        <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-lg-6 my-4">
                    <h2 class="text-uppercase text-alter-6 fs-18 fw-700">
                        <a href="{{ json_decode(get_setting('banner_text_links'),true)[$key] }}"  class="d-inline-block text-reset">{{ json_decode(get_setting('banner_text_titles',null,App::getLocale()),true)[$key] }}</a>
                    </h2>
                    <div class="lh-1-9 my-4 mr-1 text-justify">{{ json_decode(get_setting('banner_text_details',null,App::getLocale()),true)[$key] }}</div>
                    <a href="{{ json_decode(get_setting('banner_text_links'),true)[$key] }}"  class="btn btn-primary text-uppercase btn-md fs-12 fw-600 " style="border-radius: 0px;">{{ translate('view products') }}</a>
                </div>
            </div>
            @endforeach
        @endif
</div>

    {{-- @if(get_setting('filter_categories') != null)
    <div id="section_home_categories">

    </div>
    @endif --}}
    {{-- brands --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="border rounded border-gray-200 p-2 p-lg-4">
                <div class="aiz-carousel gutters-10" data-items="7" data-xl-items="6" data-lg-items="6" data-autoplay="true" data-md-items="6" data-sm-items="2" data-xs-items="2" data-infinite='true' >
                    @foreach(explode(',',get_setting('corporate_clients')) as $id)
                        <div class="carousel-box">
                            <img src="{{ uploaded_asset($id) }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    {{-- blog --}}
    <section class="py-5">
        <div class="container">
            <div class="d-flex my-5 justify-content-center align-items-center">
                <h3 class="h5 fw-700 mb-0 text-center text-alter-6">

                   {{ translate('From our blog') }}
                </h3>

            </div>
            @php
            $latest_blogs= \App\Blog::where('status', 1)->latest()->limit(3)->get();
            @endphp
            @if (!empty($latest_blogs))
                <div class="row ">
                    @foreach($latest_blogs as $blog)
                        <div class="col mb-3 overflow-hidden shadow-sm">
                            <a href="{{ route('blog.details', $blog->slug) }}" class="">
                                <img
                                    src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($blog->banner) }}"
                                    alt="{{ $blog->title }}"
                                    class="img-fluid lazyload"
                                >
                            </a>
                            <div class="p-4">
                                <h2 class="fs-18 fw-600 mb-1">
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="text-reset">
                                        {{ $blog->title }}
                                    </a>
                                </h2>
                                <p class="opacity-100 my-2">
                                    {{ $blog->short_description }}
                                </p>
                                <a href="{{ route('blog.details', $blog->slug) }}" class="btn btn-primary btn-sm text-uppercase fs-12 fw-600" style="border-radius: 0px;">
                                    {{ translate('Read more') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            @if (get_setting('vendor_system_activation') == 1)
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            @endif
        });
    </script>
@endsection