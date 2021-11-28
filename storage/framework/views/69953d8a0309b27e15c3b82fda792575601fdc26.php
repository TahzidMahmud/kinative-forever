<div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-flex">
        <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3" data-toggle="aiz-mobile-nav">
            <button class="aiz-mobile-toggler">
                <span></span>
            </button>
        </div>
        <div class="aiz-topbar-logo-wrap d-xl-none d-flex align-items-center justify-content-start">
            <?php
                $logo = get_setting('header_logo');
            ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="d-block">
                <?php if($logo != null): ?>
                    <img src="<?php echo e(uploaded_asset($logo)); ?>" class="brand-icon" alt="<?php echo e(get_setting('website_name')); ?>">
                <?php else: ?>
                    <img src="<?php echo e(static_asset('assets/img/logo.png')); ?>" class="brand-icon" alt="<?php echo e(get_setting('website_name')); ?>">
                <?php endif; ?>
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
            <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-icon btn-circle btn-light" href="<?php echo e(route('home')); ?>" target="_blank" title="<?php echo e(translate('Browse Website')); ?>">
                            <i class="las la-globe"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php if(\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated): ?>
                <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch ml-3">
                    <div class="aiz-topbar-item">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-icon btn-circle btn-light" href="<?php echo e(route('poin-of-sales.index')); ?>" target="_blank" title="<?php echo e(translate('POS')); ?>">
                                <i class="las la-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch">
            <?php
                $orders = DB::table('orders')
                            ->orderBy('code', 'desc')
                            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                            ->where('order_details.seller_id', \App\User::where('user_type', 'admin')->first()->id)
                            ->where('orders.viewed', 0)
                            ->select('orders.id')
                            ->distinct()
                            ->count();
                $sellers = \App\Seller::where('verification_status', 0)->where('verification_info', '!=', null)->count();
            ?>

            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon p-1">
                            <span class=" position-relative d-inline-block">
                                <i class="las la-bell la-2x"></i>
                                <?php if($orders > 0 || $sellers > 0): ?>
                                    <span class="badge badge-dot badge-circle badge-primary position-absolute absolute-top-right"></span>
                                <?php endif; ?>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="mb-0"><?php echo e(translate('Notifications')); ?></h6>
                        </div>
                        <ul class="list-group c-scrollbar-light overflow-auto" style="max-height:300px;">

                            <?php if($orders > 0): ?>
                            <li class="list-group-item">
                                <a href="<?php echo e(route('inhouse_orders.index')); ?>" class="text-reset">
                                    <span class="ml-2"><?php echo e($orders); ?> <?php echo e(translate('new orders')); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if($sellers > 0): ?>
                            <li class="list-group-item">
                                <a href="<?php echo e(route('sellers.index')); ?>" class="text-reset">
                                    <span class="ml-2"><?php echo e(translate('New verification request(s)')); ?></span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            
            <?php
                if(Session::has('locale')){
                    $locale = Session::get('locale', Config::get('app.locale'));
                }
                else{
                    $locale = env('DEFAULT_LANGUAGE');
                }
            ?>
            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown " id="lang-change">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon">
                            <img src="<?php echo e(static_asset('assets/img/flags/'.$locale.'.png')); ?>" height="11">
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-xs">

                        <?php $__currentLoopData = \App\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="javascript:void(0)" data-flag="<?php echo e($language->code); ?>" class="dropdown-item <?php if($locale == $language->code): ?> active <?php endif; ?>">
                                    <img src="<?php echo e(static_asset('assets/img/flags/'.$language->code.'.png')); ?>" class="mr-2">
                                    <span class="language"><?php echo e($language->name); ?></span>
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="avatar avatar-sm mr-md-2">
                                <img
                                    src="<?php echo e(uploaded_asset(Auth::user()->avatar_original)); ?>"
                                    onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/avatar-place.png')); ?>';"
                                >
                            </span>
                            <span class="d-none d-md-block">
                                <span class="d-block fw-500"><?php echo e(Auth::user()->name); ?></span>
                                <span class="d-block small opacity-60"><?php echo e(Auth::user()->user_type); ?></span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href="<?php echo e(route('profile.index')); ?>" class="dropdown-item">
                            <i class="las la-user-circle"></i>
                            <span><?php echo e(translate('Profile')); ?></span>
                        </a>

                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i>
                            <span><?php echo e(translate('Logout')); ?></span>
                        </a>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
        </div>
    </div>
</div><!-- .aiz-topbar -->
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/inc/admin_nav.blade.php ENDPATH**/ ?>