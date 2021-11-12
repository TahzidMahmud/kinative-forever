@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')

<section class="py-0">
    <div class="mb-4">
        <img
            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
            data-src="{{ uploaded_asset($blog->banner) }}"
            alt="{{ $blog->title }}"
            class="img-fit lazyload w-100 h-500px"
        >
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4">
                    <div class="border-bottom">
                        <h1 class="h4">
                            {{ $blog->getTranslation('title') }}
                        </h1>

                        @if($blog->category != null)
                        <div class="mb-2 opacity-50">
                            <i>{{ $blog->category->category_name }}</i>
                        </div>
                        @endif
                    </div>
                    <div class="mb-4 overflow-hidden fs-16">
                        {!! $blog->getTranslation('description') !!}
                    </div>

                    @if (get_setting('facebook_comment') == 1)
                    <div>
                        <div class="fb-comments" data-href="{{ route("blog",$blog->slug) }}" data-width="" data-numposts="5"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {{-- watermark --}}

        <div class="row py-5 bg-no-repeat bg-center bg-center mt-5 mt-2" style="background-image: url({{ static_asset('assets/img/logo-watermark.png') }});background-position: center center; background-repeat: no-repeat;background-size:contain;">
            <div class="col-xl-8 mx-auto lh-1-9 text-center ">
                <h3 class="h4 fw-700 text-uppercase text-primary fs-20 ">{{ translate('Shop').' '.$blog->getTranslation('title').' '.translate('Items') }}</h3>
            </div>
        </div>
        <div class="row pt-2 mt-2">


       {{-- products list --}}
        @if ($blog->products != null)
        <div class="aiz-carousel gutters-5 half-outside-arrow mb-4" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2">
            @foreach (json_decode($blog->products) as $key => $product_id)
                @php $product = \App\Product::find($product_id); @endphp
                @if($product != null)
                <div class="carousel-box">
                    @include('frontend.partials.product_box_1',['product' => $product])
                </div
                >@endif
            @endforeach
        </div>

        @endif
        </div>
        <div class="text-center d-flex align-items-center justify-content-center">
            <a href="{{route('home.shop') }}" class="btn btn-primary text-uppercase btn-circle px-4 fs-12">{{ translate('Visit Shop') }}</a>
        </div>
    </div>
</section>

@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection
