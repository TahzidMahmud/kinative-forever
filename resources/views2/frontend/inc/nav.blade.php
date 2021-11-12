@if(get_setting('topbar_banner') != null)
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset">
        <img src="{{ uploaded_asset(get_setting('topbar_banner')) }}" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
@endif
<!-- Top Bar -->
{{-- <div class="top-navbar bg-primary py-15px z-1035 text-white fs-11 fw-600 text-uppercase">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 d-flex justify-content-between justify-content-lg-start">
                <div class="">
                    <i class="las la-phone"></i>
                    {{ get_setting('topbar_left', null, App::getLocale()) }}
                </div>
                <div id="lang-change" class="ml-2">
                    @foreach (\App\Language::all() as $key => $language)
                        <a
                            href="javascript:void(0)"
                            data-flag="{{ $language->code }}"
                            class="text-reset ml-1 pl-2 @if(!$loop->first) border-left @endif  @if(Session::get('locale', Config::get('app.locale')) != $language->code) opacity-60 @endif"
                        >{{ $language->code }}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="">{{ get_setting('topbar_center', null, App::getLocale()) }}</div>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                <div class="">
                    @auth
                        @if(isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-reset d-inline-block">{{ translate('My Panel')}}</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-reset d-inline-block">{{ translate('My Panel')}}</a>
                        @endif
                            | <a href="{{ route('logout') }}" class="text-reset d-inline-block">{{ translate('Logout')}}</a>
                    @else
                        <a href="{{ route('user.login') }}" class="text-reset d-inline-block">{{ translate('Login')}}</a>
                        | <a href="{{ route('user.registration') }}" class="text-reset d-inline-block">{{ translate('Sign Up')}}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- END Top Bar -->


<header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 shadow-sm position-relative">
    <div class="bg-primary py-2 text-white web-topbar">
        <div class="container">
            <div class="row">
                <div class="col col-xl-auto">
                    <div type="button" class="mr-3 ml-0 mobile-category-trigger d-flex align-items-center" data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                        <button class="aiz-mobile-toggler">
                            <span></span>
                        </button>
                        <span class="text-uppercase ml-0 d-none d-xl-block text-uppercase fs-13 px-3 py-2 fw-600 hov-opacity-100 d-inline-block  hov-opacity-100 text-reset georgia ">{{ translate(' Categories') }}</span>
                    </div>
                </div>
                @php
                $current_route = Route::currentRouteName();
                $shop_menu_routes = ['home.shop','product','search','suggestion.search','products.category','products.brand'];
                @endphp
                @if(in_array($current_route,$shop_menu_routes))
                    @if ( get_setting('shop_menu_labels') !=  null )
                    <div class="col-xl d-none d-xl-block">
                        <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center w-100 d-none d-lg-block w-lg-auto">
                            @foreach (json_decode( get_setting('shop_menu_labels', null, App::getLocale()), true) as $key => $value)
                            <li class="list-inline-item mr-0">
                                <a href="{{ json_decode( get_setting('shop_menu_links'), true)[$key] }}" class="fs-13 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset georgia text-uppercase">
                                    {{ translate($value) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                @else
                    @if ( get_setting('header_menu_labels') !=  null )
                        <div class="col-xl d-none d-xl-block">
                            <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                                @foreach (json_decode( get_setting('header_menu_labels', null, App::getLocale()), true) as $key => $value)
                                <li class="list-inline-item mr-0">
                                    <div class="dropdown">

                                @if( get_setting('sub_menu_labels')!=null)
                                        @foreach (json_decode( get_setting('sub_menu_labels'), true) as $k => $v)
                                        @if ($k==$value)
                                            {{-- for sub menue --}}
                                            <a href="javascript:void(0)" value="{{ $value }}" style="position: relative;" onmouseover="expand(this)" id="{{$value}}" class=" dropbtn fs-13 px-2 py-2 d-inline-block fw-600 hov-opacity-100 text-reset georgia text-uppercase">
                                                {{ translate($value) }}
                                                {{-- <i class="las la-caret-down"></i> --}}
                                                <i class="las la-angle-down"></i>
                                            </a>
                                            <div class="dropdown-content">
                                                        @foreach ($v as $ke =>$val )
                                                            <a href="#" class="text-center mx-auto px-auto" >{{ $val }}</a>

                                                        @endforeach
                                            </div>
                                        @else
                                            {{-- for non sub-menue  --}}
                                            <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-13 px-2 py-2 d-inline-block fw-600 hov-opacity-100 text-reset georgia text-uppercase">
                                                {{ translate($value) }}
                                            </a>
                                        @endif
                                        @endforeach
                                    @else
                                        {{-- for non sub-menue  --}}
                                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-13 px-2 py-2 d-inline-block fw-700 hov-opacity-100 text-reset georgia text-uppercase">
                                            {{ translate($value) }}
                                        </a>
                                @endif
                                </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
                <div class="col col-xl-auto d-flex justify-content-end ">
                    <div class="border-right pr-2 d-none d-lg-block">
                        <div class="h-100 d-flex align-items-center">
                            <a href="javascript:void(0)" class="active  lh-1 p-1 position-relative rounded text-white" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                                <i class="la la-search la-flip-horizontal fs-24"></i>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="mr-0 border-left border-gray-800 ml-3 pl-3">
                        <div class="h-100 d-flex align-items-center" id="wishlist">
                            @include('frontend.partials.wishlist')
                        </div>
                    </div>

                    <div class="mr-0 border-left border-gray-800 ml-4 pl-3" data-hover="dropdown">
                        <div class="nav-cart-box dropdown h-100" id="cart_items">
                            @include('frontend.partials.cart')
                        </div>
                    </div> --}}
                    <div class="mr-0  border-white ml-2 pl-1" data-hover="dropdown">
                        <div class="dropdown h-100">
                            <a href="javascript:void(0)" class="d-flex align-items-center text-white h-100" data-toggle="dropdown" data-display="static">
                                <i class="la la-user-circle fs-24"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0 stop-propagation">
                                <ul class="pl-0 list-unstyled mb-0">
                                    @auth
                                        @if(isAdmin())
                                            <li><a href="{{ route('admin.dashboard') }}" class="py-2 px-3 text-reset d-inline-block">{{ translate('My Panel')}}</a></li>
                                        @else
                                            <li><a href="{{ route('dashboard') }}" class="py-2 px-3 text-reset d-inline-block">{{ translate('My Panel')}}</a></li>
                                        @endif
                                        <li><a href="{{ route('logout') }}" class="py-2 px-3 text-reset d-inline-block">{{ translate('Logout')}}</a></li>
                                    @else
                                        <li><a href="{{ route('user.login') }}" class="py-2 px-3 text-reset d-inline-block">{{ translate('Login')}}</a></li>
                                        <li><a href="{{ route('user.registration') }}" class="py-2 px-3 text-reset d-inline-block">{{ translate('Sign Up')}}</a></li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('home.shop') }}" class= " bg-alter btn btn-primary georgia align-items-center py-2 px-3 ml-3  d-none d-lg-flex text-uppercase">
                        <span class="fs-13">AFTAB BAZAR</span>
                    </a>
                </div>
                {{-- <div id="lang-change" class="ml-1">
                    @foreach (\App\Language::all() as $key => $language)
                        <a
                            href="javascript:void(0)"
                            data-flag="{{ $language->code }}"
                            class="text-reset ml-1 pl-2 @if(!$loop->first) border-left @endif  @if(Session::get('locale', Config::get('app.locale')) != $language->code) opacity-60 @endif"
                        >{{ $language->code }}</a>
                    @endforeach
                </div> --}}
                {{-- lang --}}
                    @if(get_setting('show_language_switcher') == 'on')
                    @php
                    if(Session::has('locale')){
                        $locale = Session::get('locale', Config::get('app.locale'));
                    }
                    else{
                        $locale = 'en';
                    }
                    @endphp
                    <div class="mr-0  border-white" id="lang-change" data-hover="dropdown">
                        <div class="dropdown h-100">
                            <a href="javascript:void(0)" class="dropdown-toggle text-white pt-2" data-toggle="dropdown" data-display="static">

                                <span class="opacity-100 mr-1">Lang: {{ \App\Language::where('code', $locale)->first()->code }}</span>
                                {{-- <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class=" lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11"> --}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-0 stop-propagation">
                                <ul class="pl-0 list-unstyled mb-0">
                                    @foreach (\App\Language::all() as $key => $language)
                                <li class="">
                                    <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                                        <span class="language">{{ $language->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                {{-- lang end  --}}

            </div>
        </div>
    </div>
    <div class="logo-bar-area z-1 d-none d-lg-block">
        <div class="container">
            <div class="d-flex align-items-center row gutters-10">
                <div class="col-auto col-xl-3">
                    <a class="d-block py-10px" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-50px h-md-70px" height="50">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-50px h-md-70px" height="50">
                        @endif
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>
<header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 bg-white shadow-sm d-lg-none">
    <div class="position-relative logo-bar-area z-1">
        <div class="container">
            <div class="d-flex align-items-center">

                <div class="col-auto pl-0 pr-lg-4 d-flex align-items-center">
                    <a class="d-block py-15px" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-40px h-md-60px" height="40">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-40px h-md-60px" height="40">
                        @endif
                    </a>
                </div>

                <div type="button" class="mr-3 ml-0 mobile-category-trigger d-none d-lg-block" data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                    <div class="navbar-light h-40px pl-2 c-pointer d-flex align-items-center justify-content-center georgia">
                        <span class="navbar-toggler-icon mr-2 size-30px"></span>
                    </div>
                </div>
                <div class="flex-grow-1 d-flex align-items-center bg-white mr-lg-4">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="border input-group overflow-hidden rounded-pill">
                                    <input type="text" class="border-0 form-control" id="search" name="q" placeholder="{{translate('Search product')}}" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary p-0 d-flex align-items-center justify-content-center" type="submit" style="width: 42px;height: 42px;border-radius: 50% 50% 50% 0;">
                                            <i class="la la-search la-flip-horizontal fs-18"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                            <div class="search-preloader absolute-top-center">
                                <div class="dot-loader"><div></div><div></div><div></div></div>
                            </div>
                            <div class="search-nothing d-none p-3 text-center fs-16">

                            </div>
                            <div id="search-content" class="c-scrollbar-light overflow-auto text-left" style="max-height: 75vh">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-none d-lg-none ml-3 mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>
                @php
                    $current_route = Route::currentRouteName();
                    $shop_menu_routes = ['home.shop','product','search','suggestion.search','products.category','products.brand'];
                @endphp
                @if(in_array($current_route,$shop_menu_routes))
                    @if ( get_setting('shop_menu_labels') !=  null )
                        <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center w-100 d-none d-lg-block w-lg-auto">
                            @foreach (json_decode( get_setting('shop_menu_labels', null, App::getLocale()), true) as $key => $value)
                            <li class="list-inline-item mr-0">
                                <a href="{{ json_decode( get_setting('shop_menu_links'), true)[$key] }}" class="fs-13 px-3 py-2 d-inline-block fw-700 hov-opacity-100 text-reset georgia text-uppercase">
                                    {{ translate($value) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                @else
                    @if ( get_setting('header_menu_labels') !=  null )
                        <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center w-100 d-none d-lg-block w-lg-auto">
                            @foreach (json_decode( get_setting('header_menu_labels', null, App::getLocale()), true) as $key => $value)
                            <li class="list-inline-item mr-0">
                                <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-13 px-3 py-2 d-inline-bloczk fw-700 hov-opacity-100 text-reset georgia text-uppercase">
                                    {{ translate($value) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                @endif

                <a href="{{ route('home.shop') }}" class="btn btn-primary georgia align-items-center py-2 px-3 ml-3  d-none d-lg-flex">
                    <i class="las la-shopping-cart fs-24 border-right pr-2 mr-2 border-gray-600"></i>
                    <span class="fs-12">SHOP NOW</span>
                </a>

            </div>
        </div>
    </div>
</header>
<style>
    /* Dropdown Button */
.dropbtn {

}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}


/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */

</style>

