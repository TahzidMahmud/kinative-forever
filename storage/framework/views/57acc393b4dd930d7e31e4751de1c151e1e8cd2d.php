<?php if(get_setting('topbar_banner') != null): ?>
<div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner" data-value="removed">
    <a href="<?php echo e(get_setting('topbar_banner_link')); ?>" class="d-block text-reset">
        <img src="<?php echo e(uploaded_asset(get_setting('topbar_banner'))); ?>" class="w-100 mw-100 h-50px h-lg-auto img-fit">
    </a>
    <button class="btn text-white absolute-top-right set-session" data-key="top-banner" data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
        <i class="la la-close la-2x"></i>
    </button>
</div>
<?php endif; ?>
<!-- END Top Bar -->
<!-- Top Bar -->
<div class="top-navbar bg-alter-4 py-10px z-1035 text-white fs-11 fw-500 ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 col-lg-3  ">
               <span class="d-none d-lg-block"><?php echo e(get_setting('topbar_call_text')); ?>:<?php echo e(get_setting('topbar_call_number')); ?></span><span class=" custmb">Care:<?php echo e(get_setting('topbar_call_number')); ?></span>
            </div>
            <div class="col-12 col-lg-6 text-center d-none d-lg-block ml-auto">
                <div class="text-center">
                    <?php echo e(get_setting('topbar_left')); ?>

                    
                </div>
            </div>
            <div class="col-6 col-lg-3 d-flex justify-content-end">
                <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex justify-content-between align-items-center">
                    <li  class="list-inline-item   d-none d-lg-block "> <a href="#faq" class="text-white mx-1">About Us</a> </li>

                    <li  class="list-inline-item "><a href=" <?php echo e(get_setting('policy_link')); ?>" class="text-white">Store Locations</a></li>

                    <li  class="list-inline-item  d-none d-lg-block mr-0 "><a href=" <?php echo e(get_setting('topbar_left')); ?>" class="text-white">Contact </a></li>

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
                    <a class="d-block py-5px mr-2 ml-0" href="<?php echo e(route('home')); ?>">
                        <?php
                            $header_logo = get_setting('header_logo');
                        ?>
                        <?php if($header_logo != null): ?>
                            <img src="<?php echo e(uploaded_asset($header_logo)); ?>" alt="<?php echo e(env('APP_NAME')); ?>" class="mw-100 h-46px">
                        <?php else: ?>
                            <img src="<?php echo e(static_asset('assets/img/logo.png')); ?>" alt="<?php echo e(env('APP_NAME')); ?>" class="mw-100 h-15px" height="15">
                        <?php endif; ?>
                    </a>
                </div>

                <div class="d-lg-none ml-auto mr-0 my-2">
                    <a href="javascript:void(0)" class="active d-block lh-1 p-1 position-relative rounded text-white" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                        <img src="<?php echo e(static_asset("assets/img/search.png")); ?>" alt="" class="mr-2">
                    </a>
                </div>

                <div class="d-none d-lg-block">
                        <div class="col-xl d-none d-xl-block d-lg-block mx-auto">
                            <ul class="list-inline mb-0 pl-0 mobile-hor-swipe text-center d-flex align-items-center">
                                <li class="list-inline-item mr-0 ml-0 text-white">
                                    

                                        
                                    
                                    <a href="javascript:void(0)" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase " data-toggle="class-toggle" data-target=".mobile-category-sidebar">
                                        <button class="aiz-mobile-toggler mt-0 mp-0">
                                            <span></span>
                                        </button>
                                     </a>
                                </li>
                                <li class="list-inline-item mr-0 ml-0 text-white">
                                    <a href="<?php echo e(route('home')); ?>" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
                                        home
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0 ml-0 text-white">
                                    <a href="<?php echo e(route('home')); ?>" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
                                       shop
                                    </a>
                                </li>

                                <?php if( get_setting('topbar_menu_labels') !=  null ): ?>
                                    <?php $__currentLoopData = json_decode( get_setting('topbar_menu_labels', null, App::getLocale()), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li class="list-inline-item mr-0 ml-0 text-white">

                                        <div class="dropdown">
                                            <a href="<?php echo e(json_decode( get_setting('topbar_menu_links'), true)[$key]); ?>" class="fs-13 px-3 py-2 d-inline-block fw-500 hov-opacity-100 text-reset  text-uppercase">
                                                <?php echo e($value); ?>

                                            </a>
                                        <?php if( get_setting('sub_menu_labels')!=null): ?>
                                                <?php $__currentLoopData = json_decode( get_setting('sub_menu_labels'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($k==$value): ?>
                                                    
                                                        
                                                        <i class="las la-angle-down" style="important;margin-left: -1rem;padding-left:5px;"></i>
                                                    
                                                    <div class="dropdown-content">
                                                        <?php $__currentLoopData = $v; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ke =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a href="<?php echo e(json_decode( get_setting('sub_menu_links'), true)[$value][$ke]); ?>" class="text-left mx-auto px-auto" ><?php echo e($val); ?></a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php else: ?>

                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>

                                        <?php endif; ?>
                                    </div>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>

               </div>

                   <div class="d-none d-lg-block ml-auto">
                       <div class=" d-flex justify-content-between align-items-center">
                        <div class="">
                            <div class="h-100 d-flex align-items-center">
                                <a href="javascript:void(0)" class="active lh-1 p-1 position-relative rounded text-white" data-toggle="class-toggle" data-target=".topbar-search" data-backdrop="static">
                                    <img src="<?php echo e(static_asset("assets/img/search.png")); ?>" alt="" class="mr-2">
                                </a>
                            </div>
                        </div>
                        <div class="mr-0 d-none d-lg-block  border-gray-500 px-3 border-right border-left" data-hover="dropdown" >
                            <div class="dropdown h-100  pt-1">
                                <a href="javascript:void(0)" class="d-flex align-items-center text-primary h-100" data-toggle="dropdown" data-display="static">
                                    <img src="<?php echo e(static_asset("assets/img/account.png")); ?>" alt="">
                                </a>
                                <div class=" dropdown-menu dropdown-menu-right p-0 stop-propagation">
                                    <ul class="pl-0 list-unstyled mb-0">
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(isAdmin()): ?>
                                                <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="py-2 px-3 text-reset d-inline-block"><?php echo e(translate('My Panel')); ?></a></li>
                                            <?php else: ?>
                                                <li><a href="<?php echo e(route('dashboard')); ?>" class="py-2 px-3 text-reset d-inline-block"><?php echo e(translate('My Panel')); ?></a></li>
                                            <?php endif; ?>
                                            <li><a href="<?php echo e(route('logout')); ?>" class="py-2 px-3 text-reset d-inline-block"><?php echo e(translate('Logout')); ?></a></li>
                                        <?php else: ?>
                                            <li><a href="<?php echo e(route('user.login')); ?>" class="py-2 px-3 text-reset d-inline-block"><?php echo e(translate('Login')); ?></a></li>
                                            <li><a href="<?php echo e(route('user.registration')); ?>" class="py-2 px-3 text-reset d-inline-block"><?php echo e(translate('Sign Up')); ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="d-none d-lg-block align-self-stretch ml-3" data-hover="dropdown">
                            <div class="nav-cart-box dropdown h-100" id="cart_items" style="margin-bottom: 1px;">
                                <?php echo $__env->make('frontend.partials.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                       </div>

                   </div>


                
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

<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/inc/nav.blade.php ENDPATH**/ ?>