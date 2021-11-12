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
<section class="mb-4 px-10px ">
    <div class="text-white bg-cover bg-no-repeat bg-center position-relative">
        <div class="aiz-carousel dot-small-white dots-inside-bottom" data-dots="true" data-autoplay="true">
            @foreach(explode(',',get_page_setting('banner',$page->id)) as $value)
            <div class="carousel-box">
                <img src="{{ uploaded_asset($value) }}" class="mw-100 w-100">
            </div>
            @endforeach
        </div>
        <div class="absolute-full overflow-hidden d-flex align-items-center">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-left">
                        <div class="text-uppercase mb-1">{{ get_page_setting('subtitle',$page->id,null,App::getLocale()) }}</div>
                        <h1 class="h2 mb-3">{{ $page->getTranslation('title') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="border-bottom brder-bottom pb-5 pt-8">
	<div class="container mb-5 pb-4">
        <div class="row mb-5 pb-4">
            <div class="col-lg-5 col-md-6">
                <img src="{{ uploaded_asset(get_page_setting('chairman_image',$page->id)) }}" class="img-fluid mb-5 mb-md-0">
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="h-100 d-flex align-items-center bg-no-repeat pl-md-5" style="background-image: url({{ static_asset('assets/img/logo-watermark.png') }});background-position: left center;">
                    <div class="lh-1-8 text-justify">{!! get_page_setting('description',$page->id,null,App::getLocale()) !!}</div>
                </div>
            </div>
        </div>
        <div class="row gutters-5">
            <div class="col-lg-4">
                <div class="bg-light p-3 p-lg-5 rounded text-center mt-2">
                    <div class="display-4 fw-900 text-primary">{{ get_page_setting('operating_since',$page->id,null,App::getLocale()) }}</div>
                    <div class="georgia text-uppercase fw-700 opacity-70 fs-14">{{ translate('Operating Since') }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-light p-3 p-lg-5 rounded text-center mt-2">
                    <div class="display-4 fw-900 text-primary">{{ get_page_setting('subdiary_companies',$page->id,null,App::getLocale()) }}</div>
                    <div class="georgia text-uppercase fw-700 opacity-70 fs-14">{{ translate('Subdiary Companies') }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-light p-3 p-lg-5 rounded text-center mt-2">
                    <div class="display-4 fw-900 text-primary">{{ get_page_setting('employees_staff',$page->id,null,App::getLocale()) }}</div>
                    <div class="georgia text-uppercase fw-700 opacity-70 fs-14">{{ translate('Employees and staff') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light mb-5 py-5 my-4">
        <div class="container">
            <div class="row gutters-5">
                <div class="col-lg-6">
                    <div class="py-5 px-3 text-center">
                        <img src="{{ static_asset('assets/img/mission.png') }}" class="mb-3">
                        <h4 class="text-primary fs-18 fw-700">{{ translate('OUR MISSION') }}</h4>
                        <div class="lh-1-8">{!! get_page_setting('our_mission',$page->id,null,App::getLocale()) !!}</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="py-5 px-3 text-center">
                        <img src="{{ static_asset('assets/img/vission.png') }}" class="mb-3">
                        <h4 class="text-primary fs-18 fw-700">{{ translate('OUR VISION') }}</h4>
                        <div class="lh-1-8">{!! get_page_setting('our_vision',$page->id,null,App::getLocale()) !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mb-5">
            <div class="af-sec-title  text-center ">
                <h3 class="text-uppercase text-primary fw-700 fs-18">{{ translate('Our Management') }}</h3>
            </div>
            <div class="row text-center justify-content-center">
                @if (get_page_setting('management_team_images',$page->id) != null)
                    @foreach (json_decode(get_page_setting('management_team_images',$page->id), true) as $key => $value)
                        <div class="col-xl-8 col-lg-10">
                            <div class="mb-5 d-md-flex align-items-center">
                                <img src="{{ uploaded_asset($value) }}" class="rounded-circle mb-4 mb-md-0 size-150px flex-shrik-0">
                                <div class="flex-grow-1 lh-1-8 text-left ml-4">
                                    <div class="d-flex mb-3">
                                        <span class="fw-700 georgia op text-uppercase">{{ json_decode(get_page_setting('management_team_names',$page->id,null,App::getLocale()),true)[$key] }}</span>
                                        <span class="border-left pl-3 ml-3 fw-600 opacity-70">{{ json_decode(get_page_setting('management_team_designations',$page->id,null,App::getLocale()),true)[$key] }}</span>
                                    </div>
                                    <div class="lh-1-8 text-justify">{!! json_decode(get_page_setting('management_team_details',$page->id,null,App::getLocale()),true)[$key] !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="text-center">
            <div class="af-sec-title">
                <h3 class="text-uppercase text-primary fw-700 fs-18 mb-5">{{ translate('Subsidiaries') }}</h3>
            </div>
            <div class="row text-center row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gutters-5">
                @if (get_page_setting('subsidiaries_images',$page->id) != null)
                    @foreach (json_decode(get_page_setting('subsidiaries_images',$page->id), true) as $key => $value)
                        <div class="col">
                            <div class="mb-2">
                                <img src="{{ uploaded_asset($value) }}" class="mw-100 mx-auto w-100">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        
	</div>
</section>
@endsection
