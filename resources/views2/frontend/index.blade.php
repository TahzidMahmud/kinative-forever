@extends('frontend.layouts.app')

@section('content')
    {{-- Categories , Sliders . Today's deal --}}
    <div class="home-banner-area text-white pt-0px">
        <div class="container-fluid px-5px">
            <div class="aiz-carousel mobile-img-auto-height dot-small-black" data-dots="true" data-autoplay="true">
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

    <section class="py-lg-5 py-4 home-about position-relative">
        <div class="container">
            <div class="row py-lg-7">
                <div class="col-xxl-6 offset-xxl-4 col-xl-8 offset-xl-2">
                    <h3 class="text-uppercase text-primary fs-18 fw-700">{{ translate('Get to know about us') }}</h3>
                    <div class="lh-1-9 mb-3 text-justify">{!! get_setting('home_about', null, App::getLocale()) !!}</div>
                    <ul class="list-inline">
                        @if (get_setting('home_about_icons') != null)
                            @foreach (json_decode(get_setting('home_about_icons'), true) as $key => $value)
                                <li class="list-inline-item rounded-pill border d-inline-flex align-items-center mb-3" style="padding: 2px">
                                    <img src="{{ uploaded_asset($value) }}">
                                    <div class="mx-2 fs-15">{{ json_decode(get_setting('home_about_titles', null, App::getLocale()), true)[$key] }}</div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Banner section 1 --}}
    @if (get_setting('home_banner1_images') != null)
    <div class="mb-4">
        <div class="container-fluid px-10px">
            <div class="row gutters-5 justify-content-center">
                @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                @foreach ($banner_1_imags as $key => $value)
                    <div class="col-xl-4 col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset text-center mb-3">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                <div class="py-4 px-4 px-xxl-6">
                                    <h3 class="text-uppercase mb-2 text-primary fs-18 fw-700">{{ json_decode(get_setting('home_banner1_titles'), true)[$key] }}</h3>
                                    <div class="lh-1-8">{{ json_decode(get_setting('home_banner1_subtitle'), true)[$key] }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if (get_setting('home_steps_images') != null)
    <section class="bg-primary py-5 text-white">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="af-sec-title light-bg text-center">
                    <h3 class="h4 fw-700 text-uppercase fs-20 ">{{ translate('farm to plate') }}</h3>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach (json_decode(get_setting('home_steps_images'), true) as $key => $value)
                <div class="col-xl col-4">
                    <div class="text-center">
                        <img src="{{ uploaded_asset($value) }}" class="img-fluid">
                        <div>{{ json_decode(get_setting('home_steps_titles', null, App::getLocale()), true)[$key] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(get_setting('filter_categories') != null)
    <div id="section_home_categories">

    </div>
    @endif

    {{-- Banner Section 2 --}}
    @if (get_setting('home_banner2_images') != null)
    <div class="mb-4">
        <div class="container-fluid px-10px">
            <div class="row gutters-5">
                @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                @foreach ($banner_2_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="af-sec-title left">
                        <h3 class="h4 fw-700 text-uppercase text-primary fs-20 mb-3">{{ get_setting('corporate_client_title', null, App::getLocale()) }}</h3>
                        <div class="opacity-70">{{ get_setting('corporate_client_subtitle', null, App::getLocale()) }}</div>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right mb-3 mb-lg-0">
                    <a href="{{ route('custom-pages.show_custom_page', 'contact-us') }}" class="btn btn-primary btn-circle text-uppercase px-4 fs-12">{{ translate('Contact us') }}</a>
                </div>
            </div>
            <div class="border rounded border-gray-200 p-2 p-lg-4">
                <div class="aiz-carousel gutters-10" data-items="7" data-xl-items="6" data-lg-items="5"  data-md-items="4" data-sm-items="3" data-xs-items="2">
                    @foreach(explode(',',get_setting('corporate_clients')) as $id)
                        <div class="carousel-box">
                            <img src="{{ uploaded_asset($id) }}">
                        </div>
                    @endforeach
                </div>
            </div>
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
