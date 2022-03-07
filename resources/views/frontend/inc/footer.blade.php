
<div class="container py-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <h5 class="px-5 text-center mx-2">Subscribe to newsletter to get exciting offers!</h5>
            <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                @csrf
                <div class="input-group flex-grow-1">
                    <input type="email" class="form-control w-lg-250px" placeholder="{{ translate('Provide your email') }}" name="email" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary px-4 text-uppercase fs-13 bg-alter-2 border-gray-100">{{ translate('Submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<section class="bg-blue py-3 text-light footer-widget "  style="background-color: rgba(70, 12, 90, 0.733)!important;background-image: url({{static_asset('assets/img/footer_bg.png')}});">
    <div class="container">
        <div class="row py-1">
            <div class="col-lg-5 col-xl-5 text-center text-md-left ">
                <div class="mt-4 mr-4 px-1 text-turncate">
                    <a href="{{ route('home') }}" class="d-block mb-4">
                        @if(get_setting('footer_logo') != null)
                            <img  src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" class="lazyload mw-100 h-32px " height="32" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="44">
                        @else
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"  data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                        @endif
                    </a>
                    <div class="my-2 text-md-left">
                        <div class="opacity-100 fs-13">
                            {!! get_setting('about_us_description',null,App::getLocale()) !!}
                        </div>

                    </div>
                    <br>

                    <div class="w-300px mw-100 mx-auto mx-md-0">
                        @if(get_setting('play_store_link') != null)
                            <a href="{{ get_setting('play_store_link') }}" target="_blank" class="d-inline-block mr-3 ml-0">
                                <img src="{{ static_asset('assets/img/play.png') }}" class="mx-100 h-40px">
                            </a>
                        @endif
                        @if(get_setting('app_store_link') != null)
                            <a href="{{ get_setting('app_store_link') }}" target="_blank" class="d-inline-block">
                                <img src="{{ static_asset('assets/img/app.png') }}" class="mx-100 h-40px">
                            </a>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-lg-2 ml-xl-auto col-md-2 mr-0 d-flex justify-content-center">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-12 text-white text-uppercase fw-600 mb-2">
                        {{ get_setting('widget_two') }}
                    </h4>
                    <ul class="list-unstyled">
                        @if ( get_setting('widget_two_labels',null,App::getLocale()) !=  null )
                            @foreach (json_decode( get_setting('widget_two_labels',null,App::getLocale()), true) as $key => $value)
                            <li class="mb-2 fs-13">
                                <a href="{{ json_decode( get_setting('widget_two_links'), true)[$key] }}" class="opacity-100 hov-opacity-100 text-reset">
                                   - {{ $value }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>

                </div>
            </div>
            <div class="col-lg-2 ml-xl-auto col-md-2 mr-0  d-flex justify-content-center">
                <div class="text-center text-md-left mt-4">
                    <h4 class="fs-12 text-white text-uppercase fw-600 mb-2">
                        {{ get_setting('widget_ten') }}
                    </h4>
                    <ul class="list-unstyled">
                        @if ( get_setting('widget_ten_labels',null,App::getLocale()) !=  null )
                            @foreach (json_decode( get_setting('widget_ten_labels',null,App::getLocale()), true) as $key => $value)
                            <li class="mb-2 fs-13">
                                <a href="{{ json_decode( get_setting('widget_ten_links'), true)[$key] }}" class="opacity-100 hov-opacity-100 text-reset">
                                   - {{ $value }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>

                </div>
            </div>

            <div class="col-md-3 col-lg-3  d-flex justify-content-center">
                <div class="text-center text-md-left mt-4 pr-2">
                    <h4 class="fs-12 text-white text-uppercase fw-600 mb-3">
                        {{ translate('Contacts') }}
                    </h4>
                    <ul class="list-unstyled fs-13">
                        <li class="mb-2 fs-13">
                            <span class="d-block opacity-100 mb-2">{{ get_setting('contact_address',null,App::getLocale()) }}</span>
                         </li>
                            <li class="mt-3 fs-13">
                                {{translate('Contact: +88')}}{{ get_setting('contact_phone') }}
                            </li>
                            {{-- <li class="">
                                {{translate('Email')}}:
                                {{ get_setting('contact_email') }}
                            </li> --}}
                    </ul>
                    <div class="">
                        <ul class="list-inline my-2 my-md-0 social colored">
                            @if ( get_setting('facebook_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('twitter_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('twitter_link') }}" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('instagram_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('instagram_link') }}" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('youtube_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('youtube_link') }}" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                            </li>
                            @endif
                            @if ( get_setting('linkedin_link') !=  null )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>







                </div>
                @if (get_setting('vendor_system_activation') == 1)
                    {{-- <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            {{ translate('Be a Seller') }}
                        </h4>
                        <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                            {{ translate('Apply Now') }}
                        </a>
                    </div> --}}
                @endif
            </div>
        </div>
        {{-- <hr style="border-width: 1px;opacity:60%;"> --}}

        {{-- footer menue and paymnet imgs --}}
        {{-- <div class="row my-1">

            <div class="col-md-6 col-xl-6 col-lg-6 col">
                @if ( get_setting('footer_menue_labes') !=  null )
                    <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex justify-content-between align-items-center mt-1 pt-1">
                        @foreach (json_decode( get_setting('footer_menue_labes'), true) as $key => $value)
                                <li class="list-inline-item mr-0 text-white pb-2 mb-2 mt-2">
                                    <a href="{{ json_decode( get_setting('footer_menue_links'), true)[$key] }}" class="text-uppercase fs-11 px-1 py-1  d-inline-block  hov-opacity-100 text-reset " >
                                       <span class="menue-top"> {{ translate($value) }}</span>
                                    </a>
                                </li>
                    @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12">
                @if ( get_setting('payment_method_images') !=  null )
                @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                <div class="text-center text-md-right mt-1 pt-1">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <img src="{{ uploaded_asset($value) }}" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                    </ul>
                </div>
                @endforeach
            @endif
            </div>
        </div> --}}


    </div>
</section>





{{-- copy right text  --}}
<footer class="bg-alter-4 text-white">
    <div class="container position-relative">
        <div class="text-center fs-13 pt-3 pb-7 py-xl-4 ">
            @php
                echo get_setting('frontend_copyright_text');
            @endphp
        </div>
    </div>
</footer>




{{-- like aftab --}}

<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important;width:100vw!important;" >
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 fw-600')}}">{{ translate('Home') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3"  data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                <i class="las la-list-ul fs-20 opacity-60"></i>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Categories') }}</span>
            </a>
        </div>
        <div class="col-auto">
            @php
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $cart = \App\Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = Session()->get('temp_user_id');
                if($temp_user_id) {
                    $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
                }
            }
            @endphp
            <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 cart-toggler cart-trigger" data-toggle="class-toggle" data-target=".cart-sidebar"  data-toggle="dropdown" data-display="static">
                <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="las la-shopping-cart la-2x text-white"></i>
                </span>
                        @if(isset($cart) && count($cart) > 0)

                            <span class="d-block fs-10 fw-600  opacity-60 ">{{ translate('Cart') }} ({{ count($cart) }})</span>
                        @else
                        <span class="d-block fs-10 fw-600  opacity-60 ">{{ translate('Cart') }} (0)</span>
                        @endif
            </a>
        </div>
        <div class="col">
            <a href="#" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-bell fs-20 opacity-60 "></i>
                    {{-- @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0) --}}
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>
                    {{-- @endif --}}
                </span>
                <span class="d-block fs-10 fw-600 opacity-60 ">{{ translate('Notifications') }}</span>
            </a>
        </div>
        <div class="col">
        @if (Auth::check())
            @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @else
                <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @endif
        @else
            <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
        @endif
        </div>
    </div>
</div>
{{-- aiz bottom nav menue for mobile --}}

{{-- <div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-12 fw-600 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 fw-600')}}">{{ translate('Home') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3" data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                <i class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-12 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 fw-600')}}">{{ translate('Categories') }}</span>
            </a>
        </div>
        @php
            if(auth()->user() != null) {
                $user_id = Auth::user()->id;
                $cart = \App\Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = Session()->get('temp_user_id');
                if($temp_user_id) {
                    $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
                }
            }
        @endphp
        <div class="col">
            <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 cart-trigger" data-toggle="class-toggle" data-target=".cart-sidebar">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-shopping-cart fs-20 opacity-60"></i>
                    @if(isset($cart) && count($cart) > 0)
                        <span class="badge badge-circle badge-primary position-absolute absolute-top-right cart-count" style="right: -5px;top: -5px;">{{ count($cart) }}</span>
                    @else
                        <span class="badge badge-circle badge-primary position-absolute absolute-top-right cart-count" style="right: -5px;top: -5px;">0</span>
                    @endif
                </span>
                <span class="d-block fs-12 fw-600 opacity-60 ">{{ translate('Cart') }}</span>
            </a>
        </div>
        <div class="col">
        @if (Auth::check())
            @if(isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-12 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @else
                <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                    <span class="d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                        @else
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                        @endif
                    </span>
                    <span class="d-block fs-12 fw-600 opacity-60">{{ translate('Account') }}</span>
                </a>
            @endif
        @else
            <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-12 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
        @endif
        </div>
    </div>
</div> --}}
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif

<div class="mobile-category-sidebar collapse-sidebar-wrap sidebar-all z-1035">
    <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-target=".mobile-category-sidebar" data-same=".mobile-category-trigger"></div>
    <div class="collapse-sidebar bg-white overflow-hidden">
        <div class="position-relative z-1 shadow-sm">
            <div class="sticky-top z-1 p-3 border-bottom">
                <a class="d-block mr-3 ml-0" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px" height="30">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px" height="30">
                    @endif
                </a>
                <div class="absolute-top-right mt-2">
                    <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-target=".mobile-category-sidebar" data-same=".mobile-category-trigger">
                        <i class="las la-times la-2x"></i>
                    </button>
                </div>
            </div>
            <div class="side-menu">
                <div class="side-menu-main c-scrollbar-light">
                    <div class="p-3 fs-16 fw-700 d-flex justify-content-between align-items-center border-bottom">
                        <span>{{ translate('Categories') }}</span>
                        <a href="{{ route('categories.all') }}" class="text-reset fs-11">{{ translate('See All') }}</a>
                    </div>
                    <div class="p-3">
                        @foreach (\App\Category::where('level', 0)->orderBy('created_at', 'asc')->get() as $key => $category)
                            @php
                                $childs = \App\Utility\CategoryUtility::get_immediate_children_ids($category)
                            @endphp
                            @if(count($childs) > 0)
                               <div class="d-flex align-items-center">
                                    <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ route('products.category', $category->slug) }}">
                                        {{  $category->getTranslation('name') }}
                                    </a>
                                    <i class="las la-angle-right ml-auto"  data-id="{{ $category->id }}"></i>
                               </div>

                            @else
                                <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ route('products.category', $category->slug) }}">
                                    {{  $category->getTranslation('name') }}
                                    <i class="las la-angle-right"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                {{-- <div class="sub-menu-wrap"> --}}
                    @foreach (\App\Category::where('level', 0)->orderBy('name', 'asc')->get() as $key => $category)
                        <div class="sub-menu c-scrollbar-light" id="cat-menu-{{ $category->id }}">
                            <a href="javascript:void(0)" class="back-to-menu border-bottom d-block fs-16 fw-600 p-3 text-reset">
                                <i class="las la-angle-left"></i>
                                <span>Back to menu</span>
                            </a>
                            @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                <div class="mb-2">
                                    <a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}" class="text-reset d-block px-4 pt-3 pb-1 fw-800">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>
                                    @php
                                        $childs = \App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id)
                                    @endphp
                                    @if(count($childs) > 0)
                                        <ul class="list-unstyled ">
                                            @foreach ($childs as $key => $second_level_id)
                                            <li class="mb-2">
                                                <a class="text-reset d-block px-4 py-1 mt-2 fw-600 opacity-70" href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}" >{{ \App\Category::find($second_level_id)->getTranslation('name') }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="sidebar-cart">
    <div class="collapse-sidebar-wrap sidebar-all sidebar-right z-1035 cart-sidebar">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".cart-sidebar" data-same=".cart-trigger"></div>
        <div class="bg-white d-flex flex-column shadow-lg collapse-sidebar c-scrollbar-light" id="sidebar-cart">
            @include('frontend.partials.sidebar_cart')
        </div>
    </div>
</div>
<div class="">
    <div class="collapse-sidebar-wrap sidebar-all sidebar-top z-1035 topbar-search">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static"></div>
        <div class="bg-white d-flex flex-column shadow-lg  collapse-sidebar c-scrollbar-light py-4">
            <div class="container">
                <div class="position-relative">
                    <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                        <div class="d-flex position-relative align-items-center">
                            <div class="input-group">
                                <input type="text" class="border-0 form-control form-control-lg" id="search" name="q" placeholder="{{translate('I am shopping for...')}}" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-icon" type="button" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                                        <i class="la la-times fs-20"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container container position-relative z-1020" style="top: 100px;">
            <div class="position-relative">
                <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                    <div class="search-preloader absolute-top-center">
                        <div class="dot-loader"><div></div><div></div><div></div></div>
                    </div>
                    <div class="search-nothing d-none p-3 text-center fs-16">

                    </div>
                    <div id="search-content" class="text-left">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
