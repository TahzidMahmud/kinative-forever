@extends('frontend.layouts.app')

@section('content')
<section class="mb-4 px-10px ">
    <div class="text-white bg-cover bg-no-repeat bg-center position-relative">
        <div class="aiz-carousel dot-small-white dots-inside-bottom" data-dots="true" data-autoplay="true">
            @foreach(explode(',',get_setting('blog_banners')) as $value)
            <div class="carousel-box">
                <img src="{{ uploaded_asset($value) }}" class="mw-100 w-100 h-300px img-fit">
            </div>
            @endforeach
        </div>
        <div class="absolute-full overflow-hidden d-flex align-items-center">
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-left">
                        <!--<h1 class="h2 mb-3">{{ translate('Blog') }}</h1>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pb-4">
    <div class="container">
        <div class="card-columns">
            @foreach($blogs as $blog)
                <div class="card mb-3 overflow-hidden shadow-sm">
                    <a href="{{ route('blog.details',$blog->slug) }}" class="text-reset d-block">
                        <img
                            src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset($blog->banner) }}"
                            alt="{{ $blog->title }}"
                            class="img-fluid lazyload "
                        >
                    </a>
                    <div class="p-4">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="{{ route('blog.details',$blog->slug) }}" class="text-reset">
                                {{ $blog->getTranslation('title') }}
                            </a>
                        </h2>
                        @if($blog->category != null)
                        <div class="mb-2 opacity-50">
                            <i>{{ $blog->category->category_name }}</i>
                        </div>
                        @endif
                        <p class="opacity-70 mb-4">
                            {{ $blog->getTranslation('short_description') }}
                        </p>
                        <a href="{{ route('blog.details',$blog->slug) }}" class="btn btn-primary">
                            {{ translate('View More') }}
                        </a>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="aiz-pagination aiz-pagination-center mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
@endsection
