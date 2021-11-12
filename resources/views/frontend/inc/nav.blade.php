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
<!-- END Top Bar -->
<!-- Top Bar -->
<div class="top-navbar bg-primary py-10px z-1035 text-white fs-13 fw-500 ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-lg-3">
                <div class="text-left">
                    {{-- {{ get_setting('topbar_left') }} --}}
                    Welcome to Forever Strength
                </div>
            </div>
            <div class="col-12 col-lg-6 text-center d-none d-lg-block ml-auto">
               {{-- <div class="container">
                    @if ( get_setting('header_menu_labels') !=  null )
                        <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex justify-content-between align-items-center ">
                            @foreach (json_decode( get_setting('header_menu_labels'), true) as $key => $value)
                                    <li class="list-inline-item mr-0 text-white ">
                                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="text-uppercase fs-11 px-1 d-inline-block  hov-opacity-100 text-reset " >
                                        <span class="menue-top"> {{ translate($value) }}</span>
                                        </a>
                                    </li>
                        @endforeach
                        </ul>
                    @endif
               </div> --}}
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-end">
                {{-- <div class="">
                    @auth
                        @if(isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-reset fs-12 d-inline-block">{{ translate('My Panel')}}</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-reset fs-12 d-inline-block">{{ translate('My Panel')}}</a>
                        @endif
                            | <a href="{{ route('logout') }}" class="text-reset fs-12 d-inline-block">{{ translate('Logout')}}</a>
                    @else
                        <a href="{{ route('user.login') }}" class="text-reset fs-12 d-inline-block">{{ translate('Login')}}</a>
                        | <a href="{{ route('user.registration') }}" class="text-reset fs-12 d-inline-block">{{ translate('Registration')}}</a>
                    @endauth
                </div> --}}
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex justify-content-between align-items-center">
                    <li  class="list-inline-item mr-0 ">FAQ</li>
                    <li  class="list-inline-item mr-0 mx-2 ">|</li>
                    <li  class="list-inline-item mr-0  ">Policies</li>
                    <li  class="list-inline-item mr-0 mx-2">|</li>
                    <li  class="list-inline-item mr-0 ">Contact US</li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->

<header class="@if(get_setting('header_stikcy') == 'on') sticky-top @endif z-1021 bg-white border-bottom shadow-sm" >
    <div class="position-relative logo-bar-area z-1" style="background-image: url({{ static_asset("assets/img/header_patern.png") }});">
        <div class="container">
            <div class="d-flex align-items-center">

                <div class="pl-0 pr-2 d-flex align-items-center pr-xl-3 t-logo">
                    <a class="d-block py-25px mr-3 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-40px" style="width: 100px;">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-15px" height="15">
                        @endif
                    </a>
                </div>
                {{-- category toggle for hover --}}
                {{-- <div class="h-100 d-flex align-items-center" id="category-menu-icon">
                    <div class="d-flex align-items-center navbar-light text-dark bg-alter-10 h-50px rounded-0 c-pointer px-4">
                        <span class="navbar-toggler-icon"></span>
                        <span class="text-uppercase text-dark fs-14 fw-600 px-30px">{{ translate('All Categories') }}</span>
                    </div>
                </div> --}}
                {{-- category toggle for side --}}
                {{-- <div type="button" class="mr-4 ml-0 mobile-category-trigger d-none d-lg-block" data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                    <div class="navbar-light h-40px pl-2 c-pointer d-flex align-items-center justify-content-center">
                       <div class="border p-2 mr-2 new" style="border-radius: 5px;background-color:#ffffff;border:2px solid black!imoportant;">
                        <span class="navbar-toggler-icon  size-20px " style="color: black;"></span>
                       </div>
                        <span class="text-uppercase fs-12 fw-800 text-dark">{{ translate('All Categories') }}</span>
                    </div>
                </div> --}}

                <div class="d-lg-none ml-auto mr-0">
                    <a class="p-1 d-block text-reset" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                        <i class="las la-search la-flip-horizontal la-2x"></i>
                    </a>
                </div>

                <div class="flex-grow-1 front-header-search d-flex align-items-center bg-white " style="max-width: 400px;">
                    <div class="position-relative flex-grow-1">
                        <form action="{{ route('search') }}" method="GET" class="stop-propagation">
                            <div class="d-flex position-relative align-items-center">
                                <div class="d-lg-none" data-toggle="class-toggle" data-target=".front-header-search">
                                    <button class="btn px-3" type="button"><i class="la la-2x la-long-arrow-left"></i></button>
                                </div>
                                <div class="d-flex flex-grow-1 border overflow-hidden src-br align-items-center brdr" style="height:2.4rem;">
                                    <input type="text" class="form-control src-input px-1 " id="search" name="q" placeholder="{{translate('   Search Product')}}" autocomplete="off">
                                    <div class="d-none d-lg-block">
                                        <button class="btn btn-icon text-white btn-primary brdr " style="border-right: 0px!important;" type="submit">
                                            <i class="la la-search la-flip-horizontal  fs-21 fw-900 "></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 100px">
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

                <div class="d-none d-lg-none ml-3 mr-0">
                    <div class="nav-search-box">
                        <a href="#" class="nav-box-link">
                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                        </a>
                    </div>
                </div>
                <div class="">
                    @if ( get_setting('header_menu_labels') !=  null )
                        <div class="col-xl d-none d-xl-block">
                            <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                                @foreach (json_decode( get_setting('header_menu_labels', null, App::getLocale()), true) as $key => $value)

                                <li class="list-inline-item mr-0 ml-0 text-dark">

                                    <div class="dropdown">
                                        <a href="{{ json_decode( get_setting('header_menu_links'), true)[$key] }}" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
                                            {{ $value }}
                                        </a>
                                @if( get_setting('sub_menu_labels')!=null)
                                        @foreach (json_decode( get_setting('sub_menu_labels'), true) as $k => $v)
                                        @if ($k==$value)
                                            {{-- <a href="javascript:void(0)" value="{{ $value }}" style="position: relative;" onmouseover="expand(this)" id="{{$value}}" class="s-12 px-1 py-2 d-inline-block fw-700 hov-opacity-100 text-reset georgia text-uppercase"> --}}
                                                {{-- {{ translate($value) }} --}}
                                                 <i class="las la-angle-down" style="important;margin-left: -1rem;padding-left:5px;"></i>
                                            {{-- </a> --}}
                                            <div class="dropdown-content">
                                                @foreach ($v as $ke =>$val )
                                                    <a href="{{ json_decode( get_setting('sub_menu_links'), true)[$value][$ke] }}" class="text-left mx-auto px-auto" >{{ $val }}</a>
                                                @endforeach
                                            </div>
                                        @else

                                        @endif
                                        @endforeach
                                    @else

                                @endif
                                </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
               </div>
                <div class="mr-0  border-white ml-2 pl-1" data-hover="dropdown">
                    <div class="dropdown h-100">
                        <a href="javascript:void(0)" class="d-flex align-items-center text-primary h-100" data-toggle="dropdown" data-display="static">
                            <i class="la la-user-circle " style="font-size: 1.9rem;"></i>
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
                <div class="d-none d-lg-block mr-0 border-right border-left pr-3 pl-2 ml-2">
                    <div class="" id="wishlist">
                        @include('frontend.partials.wishlist')
                    </div>
                </div>

                <div class="d-none d-lg-block align-self-stretch mx-3" data-hover="dropdown">
                    <div class="nav-cart-box dropdown h-100" id="cart_items">
                        @include('frontend.partials.cart')
                    </div>
                </div>

                @if(get_setting('topbar_call_icon') || get_setting('topbar_call_text') || get_setting('topbar_call_number'))
                    <div class="d-none d-md-flex border-left pl-3 align-items-center">

                        <img src="{{ uploaded_asset(get_setting('topbar_call_icon')) }}" class="pb-1" >

                        <div class="ml-2 lh-1">
                            <div class="text-dark opacity-80 fs-13 fw-500 pb-1" style="font-family: georgia;">{{ get_setting('topbar_call_text') }}</div>
                            <div class="text-primary fw-600 fs-14">{{ get_setting('topbar_call_number') }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
<!--white nav bar-->

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
  background-color: white;
  border: 1px white!important;
  border-radius: 3px;
  min-width: 200px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1030!important;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #123798;color: white;}
.dropdown-content a:hover .dropdown-content{display: block;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */

</style>

