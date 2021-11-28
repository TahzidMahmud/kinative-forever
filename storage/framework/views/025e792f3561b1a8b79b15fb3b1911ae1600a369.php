<?php $__env->startSection('content'); ?>
    
    <?php if(get_setting('home_slider_images') != null): ?>
    <div class="home-banner-area text-white">
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height dot-small-white" data-dots="true" data-autoplay='true'>
            <?php $slider_images = json_decode(get_setting('home_slider_images'), true);  ?>
            <?php $__currentLoopData = $slider_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="carousel-box">
                    <a href="<?php echo e(json_decode(get_setting('home_slider_links'), true)[$key]); ?>" class="d-block">
                        <img src="<?php echo e(uploaded_asset($value)); ?>" class="mw-100 w-100">
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php
        $featured_categories = \App\Category::where('featured', 1)->get();
    ?>

    <?php if(count($featured_categories) > 0): ?>
    <div class="py-5">
        <div class="container">
            <div class="px-md-3 px-xl-5">
                <div class="aiz-carousel gutters-10 full-outside-arrow ihw-arrow" data-items="7" data-xl-items="6" data-lg-items="5"  data-md-items="4" data-sm-items="3" data-xs-items="2" data-arrows='true'>
                    <?php $__currentLoopData = $featured_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-box py-2">
                            <a href="<?php echo e(route('products.category', $category->slug)); ?>" class="d-block p-2 text-reset text-center hov-shadow-md rounded">
                                <span class="h-50px d-block mb-3">
                                    <img
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($category->banner)); ?>"
                                        alt="<?php echo e($category->getTranslation('name')); ?>"
                                        class="lazyload img-fluid mh-100 mx-auto"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>';"
                                    >
                                </span>
                                <div class="text-truncate fs-11 text-uppercase fw-700 opacity-70"><?php echo e($category->getTranslation('name')); ?></div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    
    <?php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
    ?>
    <?php if($flash_deal != null && strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date && strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date): ?>
    <section class="mb-4">
        <div class="container">
            <div class="d-flex flex-wrap mb-3 align-items-center justify-content-between">
                <div class="d-flex">
                    <img src="<?php echo e(static_asset('assets/img/flash.png')); ?>" class="h-70px mr-4">
                    <span class="">
                        <h3 class="h5 fw-500 text-uppercase"><?php echo e(translate('Flash Sale')); ?></h3>
                        <div class="aiz-count-down align-items-center" data-date="<?php echo e(date('Y/m/d H:i:s', $flash_deal->end_date)); ?>"></div>
                    </span>
                </div>
                <a href="<?php echo e(route('flash-deal-details', $flash_deal->slug)); ?>" class="d-inline-block">
                    <span class="text-alter text-uppercase fs-13"><?php echo e(translate('View All')); ?></span>
                    <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 shadow-ihw justify-content-center align-items-center rounded-circle text-white"></i>
                </a>
            </div>

            <div class="aiz-carousel gutters-5 dot-small-black" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-dots='true' data-autoplay='true'>
                <?php $__currentLoopData = $flash_deal->flash_deal_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $flash_deal_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $product = \App\Product::find($flash_deal_product->product_id);
                    ?>
                    <?php if($product != null && $product->published != 0): ?>
                        <div class="carousel-box">
                            <?php echo $__env->make('frontend.partials.product_box_1',['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>


    
    <?php if(get_setting('home_banner1_images') != null): ?>
    <div class="mb-4">
        <div class="container-fluid px-10px">
            <div class="row gutters-5">
                <?php $banner_1_imags = json_decode(get_setting('home_banner1_images')); ?>
                <?php $__currentLoopData = $banner_1_imags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="<?php echo e(json_decode(get_setting('home_banner1_links'), true)[$key]); ?>" class="d-block text-reset position-relative">
                                <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>" data-src="<?php echo e(uploaded_asset($banner_1_imags[$key])); ?>" alt="<?php echo e(env('APP_NAME')); ?> promo" class="img-fluid lazyload w-100">
                                <div class="absolute-bottom-left align-items-center d-flex justify-content-between mb-3 px-5 text-white w-100">
                                    <span class="broadcast display-4"><?php echo e(json_decode(get_setting('home_banner1_labels'), true)[$key]); ?></span>
                                    <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 justify-content-center align-items-center rounded-circle text-white"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(get_setting('home_about_details') != null): ?>
    <div class="py-4 mb-5 d-none">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <img src="<?php echo e(uploaded_asset(get_setting('home_about_image'))); ?>" class="img-fluid w-100">
                </div>
                <div class="col-xl-6">
                    <div class="pl-xl-4">
                        <h2 class="broadcast brush-bg display-2 pt-3 mb-0">
                            <span class="opacity-80"><?php echo e(translate('About Us')); ?></span>
                        </h2>
                        <div class="lh-1-8 mb-4"><?php echo get_setting('home_about_details'); ?></div>
                        <a href="<?php echo e(get_setting('home_about_link')); ?>" class="d-inline-block">
                            <span class="text-alter text-uppercase fs-13"><?php echo e(translate('Learn More')); ?></span>
                            <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 justify-content-center align-items-center rounded-circle text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    
    <div id="section_home_categories">

    </div>



    <?php if(get_setting('home_specials_images') != null): ?>
    <div class="py-5 d-none d-lg-block">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="broadcast brush-bg bg-center display-2 pt-3 mb-0">
                    <span class="opacity-80"><?php echo e(get_setting('home_specials_title')); ?></span>
                </h2>
                <div><?php echo get_setting('home_specials_subtitle'); ?></div>
            </div>
            <div class="">
                <ul class="d-flex flex-column flex-lg-row pl-0 mb-0 special-carousel align-items-center justify-content-center">
                    <?php $__currentLoopData = json_decode(get_setting('home_specials_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-inline-item mb-3">
                            <a href="<?php echo e(json_decode(get_setting('home_specials_links'), true)[$key]); ?>" class="text-reset d-block text-center">
                                <img src="<?php echo e(uploaded_asset($value)); ?>" class="img-fluid w-100">
                                <div class="mt-2 text-uppercase fs-12"><?php echo e(json_decode(get_setting('home_specials_labels'), true)[$key]); ?></div>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <div id="section_home_categories_2">

    </div>

    
    <?php if(get_setting('home_banner2_images') != null): ?>
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-5">
                <?php $banner_2_imags = json_decode(get_setting('home_banner2_images')); ?>
                <?php $__currentLoopData = $banner_2_imags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl col-md-6">
                        <div class="mb-3 mb-lg-0">
                            <a href="<?php echo e(json_decode(get_setting('home_banner2_links'), true)[$key]); ?>" class="d-block text-reset position-relative">
                                <img src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>" data-src="<?php echo e(uploaded_asset($banner_2_imags[$key])); ?>" alt="<?php echo e(env('APP_NAME')); ?> promo" class="img-fluid lazyload w-100">
                                <div class="absolute-bottom-left align-items-center d-flex justify-content-center flex-column mb-3 px-5 text-white w-100">
                                    <span class="broadcast display-4"><?php echo e(json_decode(get_setting('home_banner2_titles'), true)[$key]); ?></span>
                                    <span class="mb-3"><?php echo e(json_decode(get_setting('home_banner2_sub_titles'), true)[$key]); ?></span>
                                    <i class="las la-arrow-right size-25px bg-primary d-inline-flex ml-2 justify-content-center align-items-center rounded-circle text-white"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>



    <div class="py-5 border-top">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="h5 text-uppercase fw-600"><?php echo e(translate('BRANDS')); ?></h3>
            </div>
            <div>
                <div class="aiz-carousel gutters-10 dot-small-black" data-items="3" data-xl-items="3" data-lg-items="2"  data-md-items="2" data-sm-items="1" data-xs-items="1" data-dots='true' data-infinite='true'>
                    <?php if(get_setting('customer_reviews_image') != null): ?>
                        <?php $__currentLoopData = json_decode(get_setting('customer_reviews_image'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-box">
                                <div class="mb-4">
                                    <img src="<?php echo e(uploaded_asset($value)); ?>" class="h-60px mb-3">
                                    <!--<div class="rating rating-sm mb-2">-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--    <i class="las la-star text-primary"></i>-->
                                    <!--</div>-->
                                    <div class="mb-3">
                                        <span class="fw-600"><?php echo e(json_decode(get_setting('customer_reviews_name'), true)[$key]); ?></span>
                                        <span class="ml-2 text-alter"><?php echo e(json_decode(get_setting('customer_reviews_title'), true)[$key]); ?></span>
                                    </div>
                                    <div class="lh-1-8 font-italic"><?php echo e(json_decode(get_setting('customer_reviews_details'), true)[$key]); ?></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function(){
            $.post('<?php echo e(route('home.section.home_categories')); ?>', {_token:'<?php echo e(csrf_token()); ?>'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            $.post('<?php echo e(route('home.section.best_sellers')); ?>', {_token:'<?php echo e(csrf_token()); ?>'}, function(data){
                $('#section_home_categories_2').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/index.blade.php ENDPATH**/ ?>