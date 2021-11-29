@extends('frontend.layouts.app')

@section('content')
    {{-- Sliders  --}}
    @if (get_setting('home_slider_images') != null)
    <div class="home-banner-area text-white">
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height dot-small-white" data-dots="false" data-autoplay='true'>
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

    <div class="container-fluid mx-1 my-4">

      <div class="row m y-3">
        @if (get_setting('home_categories_2') != null)
        @foreach (json_decode(get_setting('home_categories_2'), true) as $key => $value)
            @php
                $category=App\Category::findOrFAil($value)
            @endphp
            <div class="col " >
                <div>
                    <div style="position: relative;">
                        <img src="{{ uploaded_Asset($category->banner) }}" alt="">
                    </div>

                    <div class="mx-2 py-3" style="margin-top:-1.5rem;background-color:#ffff;position:relative;">
                       <div  style="background-color:#ffff;">
                        <h6 class="text-center py-2"><b>{{ $category->cat_min_desc }}</b></h6>
                        <p class="opacity-70 text-center text-truncate-2 lh-3-4 h-35px px-4">{{ $category->cat_long_desc }}</p>
                       <a href="{{ route('products.category',$category->slug)}}"> <p class="text-center fw-500 text-uppercase text-alter-2"><span class=" border-bottom border-primary py-1">view products</span></p></a>
                       </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endif
      </div>
    </div>



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
   {{-- Best Selling Sectrion--}}
   <div id="section_home_categories_2">

    </div>

    {{-- Banner section 1 --}}
    @if (get_setting('home_banner1_images') != null)
    <div class="mb-4">
        <div class="container px-10px">
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

    <div class="container my-2">
        <div class="row d-flex align-items-center">
            <div class="col-md-3 col">
                <h1 class="text-uppercase ">{{ get_setting('midbanner_text_title')  }}</h1>
                <p class="text-left">{{ get_setting('midbanner_text_subtitle') }}</p>
                <div class="">
                    @if (get_setting('mid_banner_icons') != null)
                        @foreach (json_decode(get_setting('mid_banner_icons'), true) as $key => $value)
                            <img src="{{ uploaded_asset($value) }}" class="mr-2" alt="">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-9 d-flex flex-row ">
                @if(get_setting('mid_banner_images') != null)
                @forelse (json_decode(get_setting('mid_banner_images'), true)  as $key => $value)
                <div class="ml-2">
                    <a href="{{  json_decode(get_setting('mid_banner_links'), true)[$key] }}" class="mx-0 px-0">
                        <img src="{{ uploaded_asset($value) }}" class="img-fit" alt=""></a>
                </div>

                @empty

                @endforelse
            @endif
            </div>


        </div>
    </div>
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


{{-- {{ dd(uploaded_asset(get_setting('bottom_image'))) }} --}}
<div style="background-image: url({{uploaded_asset(get_setting('bottom_image'))}});">
    <div class="container">
        <div class="row" style="height: 333px;">
            <div class="col-md-6"></div>
            <div class="col-md-4 d-flex align-items-center">
              <div>
                <h1 class="text-uppercase text-left">{{ get_setting('bottom_title')  }}</h1>
                <p class="text-left text-white pr-5">{{ get_setting('bottom_sub_title') }}</p>
                <span class="text-uppercase border-bottom border-primary p-1 text-alter">view all</span>
              </div>
            </div>
            <div class="col-md-2"></div>
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

            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories_2').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
