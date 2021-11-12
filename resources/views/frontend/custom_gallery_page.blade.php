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
<section class=" ">
    <div class="text-white bg-cover bg-no-repeat bg-center py-9" style="background-image: url({{uploaded_asset(get_page_setting('banner',$page->id)) }});">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <div class="text-uppercase mb-1">{{ get_page_setting('subtitle',$page->id,null,App::getLocale()) }}</div>
                    <h1 class="h2 mb-3">{{ $page->getTranslation('title') }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="border-bottom brder-bottom pb-5 pt-10px">
    @if (get_page_setting('gallery_title',$page->id,null,App::getLocale()) != null)
        @foreach (json_decode(get_page_setting('gallery_title',$page->id,null,App::getLocale()), true) as $key => $value)
        <div class="py-7 bg-light text-center mb-5">
            <h4>{{ $value }}</h4>
        </div>
        <div class="container mb-5">
            <div class="card-columns">
                @if(!is_int(json_decode(get_page_setting('gallery_all_images',$page->id))))
                    @foreach(explode(',',json_decode(get_page_setting('gallery_all_images',$page->id),true)[$key]) as $key => $value)
                    <div class="card mb-3">
                        <img src="{{ uploaded_asset($value) }}" class="img-fluid">
                    </div>
                    @endforeach
                @else
                    <div class="card mb-3">
                        <img src="{{ uploaded_asset(get_page_setting('gallery_all_images',$page->id)) }}" class="img-fluid">
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    @endif
</section>
@endsection
