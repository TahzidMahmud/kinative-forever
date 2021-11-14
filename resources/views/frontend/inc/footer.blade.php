
{{-- map i frame code  --}}
{{-- <div class="embed-responsive embed-responsive-21by9">

    {!! get_page_setting('g_map_iframe_code',$page->id) !!}
</div> --}}

<section class="bg-white border-top mt-auto .bg-alter-3">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="#">
                    <i class="la la-file-text la-3x fs-24 fw-700 text-primary mb-2"></i>
                    <h6 class="h6 opacity-80 fw-500">{{ translate('Terms & conditions') }}</h6>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="#">
                    <i class="la la-mail-reply la-3x fs-24 fw-700 text-primary mb-2"></i>
                    <h6 class="h6 opacity-80 fw-500">{{ translate('Return Policy') }}</h6>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left text-center p-4 d-block" href="#">
                    <i class="la la-comments-o la-3x fs-24 fw-700 text-primary mb-2"></i>
                    <h6 class="h6 opacity-80 fw-500">{{ translate('Support Policy') }}</h6>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a class="text-reset border-left border-right text-center p-4 d-block" href="#">
                    <i class="las la-exclamation-circle la-3x fs-24 fw-700 text-primary mb-2"></i>
                    <h6 class="h6 opacity-80 fw-500">{{ translate('Privacy Policy') }}</h6>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="bg-primary pt-5 text-light  bg-center bg-alter-5" >
    <div class="container">
        <div class="mt-4 text-center border-bottom" style="border-color: #bebebe85 !important;">
            <div class="row">
                <div class="col-xl-6 col-lg-8 mx-auto pb-4" >
                    <a href="{{ route('home') }}" class="d-block">
                        @if(get_setting('footer_logo') != null)
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="56">
                        @else
                            <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="44">
                        @endif
                    </a>
                    <div class="my-3">
                        @php
                            echo get_setting('about_us_description',null,App::getLocale());
                        @endphp
                    </div>
                    <ul class="list-inline mt-4 mb-2  social colored text-center">
                        @if ( get_setting('facebook_link') !=  null )
                        <li class="list-inline-item ">
                            <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook "><i class="lab la-facebook-f"></i></a>
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
        </div>

        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="text-center text-xl-left">
                    <ul class="list-inline long-gap ">
                        @if ( get_setting('widget_one_labels',null,App::getLocale()) !=  null )
                            @foreach (json_decode( get_setting('widget_one_labels',null,App::getLocale()), true) as $key => $value)
                            <li class="list-inline-item">
                                <a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}" class="text-reset text-uppercase">
                                    {{ $value }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="text-center text-xl-right">
                    <ul class="list-inline my-3">
                        @if ( get_setting('payment_method_images') !=  null )
                            @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                                <li class="list-inline-item">
                                    <img src="{{ uploaded_asset($value) }}" height="40" class="mw-100">
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="py-xl-4 bg-primary text-white">
    <div class="container">
        <div class="text-center">
            @php
                echo get_setting('frontend_copyright_text',null,App::getLocale());
            @endphp
        </div>
    </div>
</footer>


<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
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

                            <span class="d-block fs-10 fw-600  opacity-60 text-dark">{{ translate('Cart') }} ({{ count($cart) }})</span>
                        @else
                        <span class="d-block fs-10 fw-600  opacity-60 text-dark ">{{ translate('Cart') }} (0)</span>
                        @endif
            </a>
        </div>
        <div class="col">
            <a href="{{ route('all-notifications') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i class="las la-bell fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 text-primary')}}"></i>
                    @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                        <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>
                    @endif
                </span>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 fw-600')}}">{{ translate('Notifications') }}</span>
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
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif


<div class="sidebar-cart">
    @php
        $total = 0;
        if(auth()->user() != null) {
            $user_id = Auth::user()->id;
            $cart = \App\Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = Session()->get('temp_user_id');
            if($temp_user_id) {
                $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
            }
        }
        if(isset($cart) && count($cart) > 0){
            foreach($cart as $key => $cartItem){
                $product = \App\Product::find($cartItem['product_id']);
                $total = $total + $cartItem['price'] * $cartItem['quantity'];
            }
        }
    @endphp
    {{-- <button class="cart-toggler cart-trigger bg-base-1 rounded-left text-center px-3 z-1021" type="button" data-toggle="class-toggle" data-target=".cart-sidebar" style="min-width: 72px">
        <span class="d-inline-block position-relative">
            <i class="la la-shopping-cart la-2x text-white pr-1"></i>
            <span class="absolute-top-right badge bg-white badge-inline badge-pill text-dark fw-700 mr-n1 shadow-md cart-count">
                @if(isset($cart) && count($cart) > 0)
                    {{ count($cart)}}
                @else
                    0
                @endif
            </span>
        </span>
        <span class="d-block fs-10 border-top lh-1 pt-1 border-top border-gray-500 opacity-50">{{ translate('Total') }}</span>
        <span class="d-block strong-700 c-base-1">
            <span class="total-price">{{ single_price($total) }}</span>
        </span>
    </button> --}}
    <div class="collapse-sidebar-wrap sidebar-all sidebar-right z-1035 cart-sidebar">
        <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".cart-sidebar" data-same=".cart-trigger"></div>
        <div class="bg-white d-flex flex-column shadow-lg cart-sidebar collapse-sidebar c-scrollbar-light" id="sidebar-cart">
            @include('frontend.partials.sidebar_cart')
        </div>
    </div>
</div>

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
                        <!--<img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 h-30px" height="30">-->
                         <img class="mw-100 h-30px brand-icon" height="30" src="{{ uploaded_asset(get_setting('system_logo_white')) }}"  alt="{{ get_setting('site_name') }}">
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
                     {{-- top bar menue --}}
                     <div class="p-3 fs-16 fw-700 d-flex justify-content-between align-items-center border-bottom ">
                        <span>{{ translate( 'Menu') }}</span>
                        {{-- <a href="{{ route('categories.all') }}" class="text-reset fs-11">{{ translate('See All') }}</a> --}}
                    </div>
                    <div class="p-3">
                        @if ( get_setting('header_menu_labels') !=  null )
                            @foreach (json_decode( get_setting('header_menu_labels'), true) as $ke => $val)
                            <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ json_decode( get_setting('header_menu_links'), true)[$ke] }}">
                                {{ translate($val) }}
                            </a>
                                @if( get_setting('sub_menu_labels')!=null)
                                    @foreach (json_decode( get_setting('sub_menu_labels'), true) as $k => $v)
                                        @if ($k==$val)
                                             <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="javascript:void(0)" style="margin-top:-2.7rem;margin-left:16.2rem!important;padding-top:1rem;" value="{{ $val }}"  id="10{{$ke}}" data-id="10{{ $ke }}">
                                                 <i class="las la-angle-right mt-1 ml-1"></i>

                                            </a>
                                            <div class="dropdown-content" id="down">
                                                @foreach ($v as $kel =>$vale )
                                                    <a href="{{ json_decode( get_setting('sub_menu_links'), true)[$val][$kel] }}" class="text-center mx-auto px-auto" >{{ translate($vale) }}</a>
                                                @endforeach
                                            </div>
                                        @else
                                            {{-- <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ json_decode( get_setting('header_menu_links'), true)[$ke] }}">
                                                {{ translate($val) }}
                                            </a> --}}
                                        @endif
                                    @endforeach
                                @else
                                    <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ json_decode( get_setting('header_menu_links'), true)[$ke] }}">
                                        {{ translate($val) }}

                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="p-3 fs-16 fw-700 d-flex justify-content-between align-items-center border-bottom">
                        <span>{{ translate('Categories') }}</span>
                        <a href="{{ route('categories.all') }}" class="text-reset fs-11">{{ translate('See All') }}</a>
                    </div>
                    <div class="p-3">
                        @foreach (\App\Category::where('level', 0)->orderBy('name', 'asc')->get() as $key => $category)
                            @php
                                $childs = \App\Utility\CategoryUtility::get_immediate_children_ids($category)
                            @endphp
                            @if(count($childs) > 0)
                                <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="javascript:void(0)" data-id="{{ $category->id }}">
                                    {{  $category->getTranslation('name') }}
                                    <i class="las la-angle-right"></i>
                                </a>
                            @else
                                <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ route('products.category', $category->slug) }}">
                                    {{  $category->getTranslation('name') }}
                                    <i class="las la-angle-right"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- top end --}}
                </div>

                <div class="sub-menu-wrap">
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
                     {{-- submen --}}
                    @foreach (json_decode( get_setting('header_menu_labels'), true) as $ke => $val)
                                @if( get_setting('sub_menu_labels')!=null)
                                    <div class="sub-menu c-scrollbar-light" id="cat-menu-10{{ $ke}}">
                                        <a href="javascript:void(0)" class="back-to-menu border-bottom d-block fs-16 fw-600 p-3 text-reset">
                                            <i class="las la-angle-left"></i>
                                            <span>Back to menu</span>
                                        </a>
                                        @foreach (json_decode( get_setting('sub_menu_labels'), true) as $k => $v)
                                            @if ($k==$val)
                                                <div class="">
                                                    <ul class="list-unstyled ">
                                                        @foreach ($v as $kel =>$vale )
                                                            <li class="mb-2">
                                                                <a href="{{ json_decode( get_setting('sub_menu_links'), true)[$val][$kel] }}" class="text-reset d-block px-4 py-1 mt-2 fw-700 opacity-90"  >{{ $vale }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
{{-- ihw search bar --}}

<div class="">
    <div class="collapse-sidebar-wrap sidebar-all sidebar-top z-1035 topbar-search">
        <div class="overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static"></div>
        <div class="bg-white d-flex flex-column shadow-lg   c-scrollbar-light py-4">
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
        <div class="container container position-relative z-1020" style="top: 5px;">
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


{{-- ihw end --}}


{{-- scrooll to top --}}
<button onclick="topFunction()" id="myBtn" title="Go to top"><span class="d-flex flex-column"> <i class="las la-angle-double-up"></i>Top</span></button>

<style>
    #myBtn {
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 70px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: rgb(0, 139, 0); /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 12px; /* Some padding */
  border-radius: 10px; /* Rounded corners */
  font-size: 12px; /* Increase font size */
}

#myBtn:hover {
  background-color:red;  /* Add a dark-grey background on hover */
}
</style>
<script>
    //Get the button:
var mybutton = document.getElementById("myBtn");
// var img = document.getElementById("sidemg");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
    // img.style.display = "none";

  } else {
    mybutton.style.display = "none";
    // img.style.display = "block";
  }

}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    $('html, body').animate({
      scrollTop: $('html, body').offset().top,
    });
//   document.body.scrollTop = 0; // For Safari
//   document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>

<style>


    /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
    .nactive {
      background-color:rgb(30, 141, 30)!important;
    }
    
    
    </style>
    

    <script>
        var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
    
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
    
        this.classList.toggle("nactive");
    
      });
    }
    </script>