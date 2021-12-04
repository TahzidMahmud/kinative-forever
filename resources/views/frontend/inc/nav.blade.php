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
<div class="top-navbar bg-alter-4 py-10px z-1035 text-white fs-11 fw-500 ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-lg-3  ">
               <span class="d-none d-lg-block">{{ get_setting('topbar_call_text') }}:{{ get_setting('topbar_call_number') }}</span><span class=" custmb">Care:{{ get_setting('topbar_call_number') }}</span>
            </div>
            <div class="col-12 col-lg-6 text-center d-none d-lg-block ml-auto">
                <div class="text-center">
                    {{ get_setting('topbar_left') }}
                    {{-- Welcome to Forever Strength --}}
                </div>
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-end">
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex justify-content-between align-items-center">
                    <li  class="list-inline-item   d-none d-lg-block "> <a href="#faq" class="text-white mx-1">About Us</a> </li>

                    <li  class="list-inline-item "><a href=" {{ get_setting('policy_link') }}" class="text-white">Store Locations</a></li>

                    <li  class="list-inline-item  d-none d-lg-block mr-0 "><a href=" {{ get_setting('topbar_left') }}" class="text-white">Contact </a></li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- END Top Bar -->
<header class=" sticky-top z-1021 bg-white shadow-sm" >
    <div class="position-relative logo-bar-area z-1 bg-primary">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">

                <div class="pl-0 pr-2 d-flex align-items-center pr-xl-3 t-logo py-2 ">
                    <a class="d-block py-5px mr-2 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-46px">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-15px" height="15">
                        @endif
                    </a>
                </div>

                <div class="d-lg-none ml-auto mr-0 my-2">
                    <a href="javascript:void(0)" class="active d-block lh-1 p-1 position-relative rounded text-white" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                        <img src="{{ static_asset("assets/img/search.png") }}" alt="" class="mr-2">
                    </a>
                </div>

                <div class="d-none d-lg-block">
                        <div class="col-xl d-none d-xl-block d-lg-block mx-auto">
                            <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center">
                                <li class="list-inline-item mr-0 ml-0 text-white">
                                    <a href="{{ route('home') }}" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
                                        home
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0 ml-0 text-white">
                                    <a href="{{ route('home') }}" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
                                       shop
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0 ml-0 text-white">
                                    <a href="javascript:void(0)" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase " data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                                        categories <i class="las la-angle-down" style=""></i>
                                     </a>
                                </li>
                                @if ( get_setting('topbar_menu_labels') !=  null )
                                    @foreach (json_decode( get_setting('topbar_menu_labels', null, App::getLocale()), true) as $key => $value)

                                    <li class="list-inline-item mr-0 ml-0 text-white">

                                        <div class="dropdown">
                                            <a href="{{ json_decode( get_setting('topbar_menu_links'), true)[$key] }}" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
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
                                @endif
                            </ul>
                        </div>

               </div>

                   <div class="d-none d-lg-block ml-auto">
                       <div class=" d-flex justify-content-between align-items-center">
                        <div class="">
                            <div class="h-100 d-flex align-items-center">
                                <a href="javascript:void(0)" class="active lh-1 p-1 position-relative rounded text-white" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                                    <img src="{{ static_asset("assets/img/search.png") }}" alt="" class="mr-2">
                                </a>
                            </div>
                        </div>
                        <div class="mr-0 d-none d-lg-block  border-gray-500 px-3 border-right border-left" data-hover="dropdown" >
                            <div class="dropdown h-100  pt-1">
                                <a href="javascript:void(0)" class="d-flex align-items-center text-primary h-100" data-toggle="dropdown" data-display="static">
                                    <img src="{{ static_asset("assets/img/account.png") }}" alt="">
                                </a>
                                <div class=" dropdown-menu dropdown-menu-right p-0 stop-propagation">
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


                        <div class="d-none d-lg-block align-self-stretch ml-3" data-hover="dropdown">
                            <div class="nav-cart-box dropdown h-100" id="cart_items" style="margin-bottom: 1px;">
                                @include('frontend.partials.cart')
                            </div>
                        </div>
                       </div>

                   </div>


                {{-- @if(get_setting('topbar_call_icon') || get_setting('topbar_call_text') || get_setting('topbar_call_number'))
                    <div class="d-none d-md-flex border-left  align-items-center">

                        <img src="{{ uploaded_asset(get_setting('topbar_call_icon')) }}" class="pb-1" >

                        <div class="ml-2 lh-1">
                            <div class="text-dark opacity-80 fs-13 fw-500 pb-1" style="font-family: georgia;">{{ get_setting('topbar_call_text') }}</div>
                            <div class="text-primary fw-600 fs-14">{{ get_setting('topbar_call_number') }}</div>
                        </div>
                    </div>
                @endif --}}
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
.dropdown-content a:hover {background-color: #e40404;color: rgb(255, 255, 255);}
.dropdown-content a:hover .dropdown-content{display: block;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */

</style>

