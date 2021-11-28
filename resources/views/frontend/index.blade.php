@extends('frontend.layouts.app')

@section('content')
    {{-- Sliders  --}}
    @if (get_setting('home_slider_images') != null)
    <div class="home-banner-area text-white">
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height dot-small-white" data-dots="true" data-autoplay='true'>
            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
            @foreach ($slider_images as $key => $value)
                <div class="carousel-box">
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}" class="d-block">
                        <img src="{{ uploaded_asset($value) }}" class="mw-100 w-100">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
    @php
        $featured_categories = \App\Category::where('featured', 1)->get();
    @endphp

    @if (count($featured_categories) > 0)
    <div class="py-5">
        <div class="container">
            <div class="px-md-3 px-xl-5">
                <div class="aiz-carousel gutters-10 full-outside-arrow ihw-arrow" data-items="7" data-xl-items="6" data-lg-items="5"  data-md-items="4" data-sm-items="3" data-xs-items="2" data-arrows='true'>
                    @foreach ($featured_categories as $key => $category)
                        <div class="carousel-box py-2">
                            <a href="{{ route('products.category', $category->slug) }}" class="d-block p-2 text-reset text-center hov-shadow-md rounded">
                                <span class="h-50px d-block mb-3">
                                    <img
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($category->banner) }}"
                                        alt="{{ $category->getTranslation('name') }}"
                                        class="lazyload img-fluid mh-100 mx-auto"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                                    >
                                </span>
                                <div class="text-truncate fs-11 text-uppercase fw-700 opacity-70">{{ $category->getTranslation('name') }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif


    {{-- Flash Deal --}}
    @php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
    <section class="mb-4">
        <div class="container">
            <div class="d-flex flex-wrap mb-3 align-items-center justify-content-between">
                <div class="d-flex">
                    <img src="{{ static_asset('assets/img/flash.png')}}" class="h-70px mr-4">
                    <span class="">
                        <h3 class="h5 fw-500 text-uppercase">{{ translate('Flash Sale') }}</h3>
                        <div class="aiz-count-down align-items-center" data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                    </span>
                </div>
                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="d-inline-block">
                    <span class="text-alter text-uppercase fs-13">{{ translate('View All') }}</span>
                    <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 shadow-ihw justify-content-center align-items-center rounded-circle text-white"></i>
                </a>
            </div>

            <div class="aiz-carousel gutters-5 dot-small-black" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-dots='true' data-autoplay='true'>
                @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                    @php
                        $product = \App\Product::find($flash_deal_product->product_id);
                    @endphp
                    @if ($product != null && $product->published != 0)
                        <div class="carousel-box">
                            @include('frontend.partials.product_box_1',['product' => $product])
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif


    {{-- Banner section 1 --}}
    @if (get_setting('home_banner1_images') != null)
    <div class="mb-4">
        <div class="container-fluid px-10px">
            <div class="row gutters-5">
                @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
                @foreach ($banner_1_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset position-relative">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                <div class="absolute-bottom-left align-items-center d-flex justify-content-between mb-3 px-5 text-white w-100">
                                    <span class="broadcast display-4">{{ json_decode(get_setting('home_banner1_labels'), true)[$key] }}</span>
                                    <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 justify-content-center align-items-center rounded-circle text-white"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if(get_setting('home_about_details') != null)
    <div class="py-4 mb-5 d-none">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <img src="{{ uploaded_asset(get_setting('home_about_image')) }}" class="img-fluid w-100">
                </div>
                <div class="col-xl-6">
                    <div class="pl-xl-4">
                        <h2 class="broadcast brush-bg display-2 pt-3 mb-0">
                            <span class="opacity-80">{{ translate('About Us') }}</span>
                        </h2>
                        <div class="lh-1-8 mb-4">{!! get_setting('home_about_details') !!}</div>
                        <a href="{{ get_setting('home_about_link') }}" class="d-inline-block">
                            <span class="text-alter text-uppercase fs-13">{{ translate('Learn More') }}</span>
                            <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 justify-content-center align-items-center rounded-circle text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>



    @if (get_setting('home_specials_images') != null)
    <div class="py-5 d-none d-lg-block">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="broadcast brush-bg bg-center display-2 pt-3 mb-0">
                    <span class="opacity-80">{{ get_setting('home_specials_title') }}</span>
                </h2>
                <div>{!! get_setting('home_specials_subtitle') !!}</div>
            </div>
            <div class="">
                <ul class="d-flex flex-column flex-lg-row pl-0 mb-0 special-carousel align-items-center justify-content-center">
                    @foreach (json_decode(get_setting('home_specials_images'), true) as $key => $value)
                        <li class="list-inline-item mb-3">
                            <a href="{{ json_decode(get_setting('home_specials_links'), true)[$key] }}" class="text-reset d-block text-center">
                                <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
                                <div class="mt-2 text-uppercase fs-12">{{ json_decode(get_setting('home_specials_labels'), true)[$key] }}</div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    {{-- Category wise Products --}}
    <div id="section_home_categories_2">

    </div>

    {{-- Banner Section 2 --}}
    @if (get_setting('home_banner2_images') != null)
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-5">
                @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                @foreach ($banner_2_imags as $key => $value)
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset position-relative">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload w-100">
                                <div class="absolute-bottom-left align-items-center d-flex justify-content-center flex-column mb-3 px-5 text-white w-100">
                                    <span class="broadcast display-4">{{ json_decode(get_setting('home_banner2_titles'), true)[$key] }}</span>
                                    <span class="mb-3">{{ json_decode(get_setting('home_banner2_sub_titles'), true)[$key] }}</span>
                                    <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 justify-content-center align-items-center rounded-circle text-white"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif



    <div class="py-5 border-top">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="h5 text-uppercase fw-600">{{ translate('BRANDS') }}</h3>
            </div>
            <div>
                <div class="aiz-carousel gutters-10 dot-small-black" data-items="3" data-xl-items="3" data-lg-items="2"  data-md-items="2" data-sm-items="1" data-xs-items="1" data-dots='true' data-infinite='true'>
                    @if (get_setting('customer_reviews_image') != null)
                        @foreach (json_decode(get_setting('customer_reviews_image'), true) as $key => $value)
                            <div class="carousel-box">
                                <div class="mb-4">
                                    <img src="{{ uploaded_asset($value) }}" class="h-60px mb-3">
                                    <!--<div class="rating rating-sm mb-2">-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--</div>-->
                                    <div class="mb-3">
                                        <span class="fw-600">{{ json_decode(get_setting('customer_reviews_name'), true)[$key] }}</span>
                                        <span class="ml-2 text-alter">{{ json_decode(get_setting('customer_reviews_title'), true)[$key] }}</span>
                                    </div>
                                    <div class="lh-1-8 font-italic">{{ json_decode(get_setting('customer_reviews_details'), true)[$key] }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories_2').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
