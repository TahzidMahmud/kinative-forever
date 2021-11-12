@extends('frontend.layouts.app')

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($page->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($page->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($page->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ URL($page->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($page->meta_img) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($page->unit_price) }}" />
@endsection

@section('content')
<section class="mb-4 ">
    <div class="text-white bg-cover bg-no-repeat bg-center py-9" style="background-image: url({{uploaded_asset(get_page_setting('banner',$page->id)) }});">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <div class="text-uppercase mb-1">{{ $page->getTranslation('subtitle')  }}</div>
                    <h1 class="h2 mb-3">{{ $page->getTranslation('title') }}</h1>
                    {{-- <a href="{{ get_page_setting('shop_link',$page->id) }}" class="btn btn-primary text-uppercase btn-circle px-4 fs-12">{{ translate('Visit Shop') }}</a> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="brder-bottom pb-5">
	<div class="container">
        <div class="row py-9 bg-no-repeat bg-center bg-center" style="background-image: url({{ static_asset('assets/img/logo-watermark.png') }});">
            <div class="col-xl-9 mx-auto lh-1-9 text-center ">
    		    {!! get_page_setting('description',$page->id,null,App::getLocale()) !!}
            </div>
        </div>
        <div class="row">
           <div class="col d-flex justify-content-center align-items-center py-5 my-3">
            <img src="{{uploaded_asset(get_page_setting('diagram',$page->id)) }}" alt="">
           </div>
        </div>
        {{-- stages text --}}
        <h2 class="text-center text-primary py-2">{{ get_page_setting('stage_text',$page->id,null,App::getLocale()) }}</h2>

        @if (get_page_setting('banner_text_images',$page->id) != null)
            @foreach (json_decode(get_page_setting('banner_text_images',$page->id), true) as $key => $value)
            {{-- {{ dd(count(json_decode(get_page_setting('banner_text_images',$page->id), true))) }} --}}
            @if($key>2)
               @break
                {{-- <div class="row">
                    <img src="{{uploaded_asset(get_page_setting('banner2',$page->id)) }}" style="width: 100vh;" alt="">
                </div> --}}
            @endif
            <div class="row align-items-center py-4">
                <div class="col-lg-6 @if(($key % 2) != 0) order-1 @endif">
                    <a href="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}" class="d-block text-reset">
                        <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-lg-6 my-4">
                    <h3 class="fs-20 text-uppercase text-primary fw-600">
                        <a href="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}"  class="d-inline-block text-reset">{{ json_decode(get_page_setting('banner_text_titles',$page->id,null,App::getLocale()),true)[$key] }}</a>
                    </h3>
                    <div class="lh-1-8 mb-4">{{ json_decode(get_page_setting('banner_text_details',$page->id,null,App::getLocale()),true)[$key] }}</div>
                    {{-- <a href="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}"  class="btn btn-primary">{{ translate('Shop Now') }}</a> --}}
                </div>
            </div>
            @endforeach
        @endif

	</div>
</section>
@if(get_page_setting('banner2',$page->id))

<div class="my-3" style="width:100vw;padding-left:0px;padding-right:0px;margin-left:0px;margin-right:0px;">
    <div class="text-white bg-cover bg-no-repeat bg-center py-9" style="background-image: url({{uploaded_asset(get_page_setting('banner2',$page->id)) }});">
    </div>
</div>
@endif
<section class="brder-bottom pb-5">
	<div class="container">

        @if (get_page_setting('banner_text_images',$page->id) != null)
            @foreach (json_decode(get_page_setting('banner_text_images',$page->id), true) as $key => $value)
            {{-- {{ dd(count(json_decode(get_page_setting('banner_text_images',$page->id), true))) }} --}}
            @if($key >2)
            <div class="row align-items-center py-4">
                <div class="col-lg-6 @if(($key % 2) != 0) order-1 @endif">
                    <a href="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}" class="d-block text-reset">
                        <img src="{{ uploaded_asset($value) }}" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-lg-6 my-4">
                    <h3 class="fs-20 text-uppercase text-primary fw-600">
                        <a href="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}"  class="d-inline-block text-reset">{{ json_decode(get_page_setting('banner_text_titles',$page->id,null,App::getLocale()),true)[$key] }}</a>
                    </h3>
                    <div class="lh-1-8 mb-4">{{ json_decode(get_page_setting('banner_text_details',$page->id,null,App::getLocale()),true)[$key] }}</div>
                    {{-- <a href="{{ json_decode(get_page_setting('banner_text_links',$page->id),true)[$key] }}"  class="btn btn-primary">{{ translate('Shop Now') }}</a> --}}
                </div>
            </div>
            @endif

            @endforeach
        @endif

	</div>
</section>

@endsection
