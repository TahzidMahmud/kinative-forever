<?php $__env->startSection('content'); ?>
    
    <?php if(get_setting('home_slider_images') != null): ?>
    <div class="home-banner-area text-white">
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height dot-small-white" data-dots="false" data-autoplay='true'>
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

    <div class="container-fluid mx-1 my-4">

      <div class="row m y-3">
        <?php if(get_setting('home_categories_2') != null): ?>
        <?php $__currentLoopData = json_decode(get_setting('home_categories_2'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $category=App\Category::findOrFAil($value)
            ?>
            <div class="col " >
                <div>
                    <div style="position: relative;">
                        <img src="<?php echo e(uploaded_Asset($category->banner)); ?>" alt="">
                    </div>

                    <div class="mx-2 py-3" style="margin-top:-1.5rem;background-color:#ffff;position:relative;">
                       <div  style="background-color:#ffff;">
                        <h6 class="text-center py-2"><b><?php echo e($category->cat_min_desc); ?></b></h6>
                        <p class="opacity-70 text-center text-truncate-2 lh-3-4 h-35px px-4"><?php echo e($category->cat_long_desc); ?></p>
                       <a href="<?php echo e(route('products.category',$category->slug)); ?>"> <p class="text-center fw-500 text-uppercase text-alter-2"><span class=" border-bottom border-primary py-1">view products</span></p></a>
                       </div>
                    </div>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
      </div>
    </div>



    
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
   
   <div id="section_home_categories_2">

    </div>

    
    <?php if(get_setting('home_banner1_images') != null): ?>
    <div class="mb-4">
        <div class="container px-10px">
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

    <div class="container my-2">
        <div class="row d-flex align-items-center">
            <div class="col-md-3 col">
                <h1 class="text-uppercase "><?php echo e(get_setting('midbanner_text_title')); ?></h1>
                <p class="text-left"><?php echo e(get_setting('midbanner_text_subtitle')); ?></p>
                <div class="">
                    <?php if(get_setting('mid_banner_icons') != null): ?>
                        <?php $__currentLoopData = json_decode(get_setting('mid_banner_icons'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(uploaded_asset($value)); ?>" class="mr-2" alt="">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-9 d-flex flex-row ">
                <?php if(get_setting('mid_banner_images') != null): ?>
                <?php $__empty_1 = true; $__currentLoopData = json_decode(get_setting('mid_banner_images'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="ml-2">
                    <a href="<?php echo e(json_decode(get_setting('mid_banner_links'), true)[$key]); ?>" class="mx-0 px-0">
                        <img src="<?php echo e(uploaded_asset($value)); ?>" class="img-fit" alt=""></a>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <?php endif; ?>
            <?php endif; ?>
            </div>


        </div>
    </div>
    
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


     
     <section class="py-5">
        <div class="container">
            <div class="d-flex my-5 justify-content-center align-items-center">
                <h5 class="h5 fw-600 mb-0 text-center text-alter-6">

                   <?php echo e(translate('From our blog')); ?>

                </h5>

            </div>
            <?php
            $latest_blogs= \App\Blog::where('status', 1)->latest()->limit(3)->get();
            ?>
            <?php if(!empty($latest_blogs)): ?>
                <div class="row ">
                    <?php $__currentLoopData = $latest_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-12 mb-3 overflow-hidden  px-4" style="padding-bottom: 2px;">
                            <a href="<?php echo e(route('blog.details', $blog->slug)); ?>" class="">
                                <img
                                    src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>"
                                    data-src="<?php echo e(uploaded_asset($blog->banner)); ?>"
                                    alt="<?php echo e($blog->title); ?>"
                                    class="img-fluid lazyload"
                                >
                            </a>
                            <div class="pb-4 px-4 d-flex flex-column align-items-center  bg-white shadow-md ">
                                <div class="bg-alter-2 " style="margin-top:-.7rem;">
                                    <span class="text-uppercase fs-12 fw-500 px-5 py-4 text-white " style="width:10rem;"><?php echo e($blog->category->category_name); ?></span>
                                </div>
                                <h2 class="fs-18 fw-600 mb-1 text-center mt-4">
                                    <a href="<?php echo e(route('blog.details', $blog->slug)); ?>" class="text-reset lh-1-6 text-turncate-2">
                                        <?php echo e($blog->title); ?>

                                    </a>
                                </h2>
                                <p class="opacity-70  my-2 text-center lh-2  text-truncate-2 ">
                                    <?php echo e($blog->short_description); ?>

                                </p>
                                <a href="<?php echo e(route('blog.details', $blog->slug)); ?>" class="text-uppercase text-alter-2 fs-12 fw-500 py-1" style="border-radius: 0px;">
                                    <?php echo e(translate('continue reading')); ?>

                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <div class="col d-flex justify-content-center align-items-center my-3">
                       <a href="<?php echo e(route('blog')); ?>"> <span class="text-uppercase border-bottom border-primary text-alter-2">view all</span></a>
                   </div>
                </div>
            <?php endif; ?>
        </div>
    </section>


<div style="background-image: url(<?php echo e(uploaded_asset(get_setting('bottom_image'))); ?>);">
    <div class="container">
        <div class="row" style="height: 333px;">
            <div class="col-md-6"></div>
            <div class="col-md-4 d-flex align-items-center">
              <div>
                <h1 class="text-uppercase text-left"><?php echo e(get_setting('bottom_title')); ?></h1>
                <p class="text-left text-white pr-5"><?php echo e(get_setting('bottom_sub_title')); ?></p>
                <span class="text-uppercase border-bottom border-primary p-1 text-alter">view all</span>
              </div>
            </div>
            <div class="col-md-2"></div>
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

            $.post('<?php echo e(route('home.section.best_selling')); ?>', {_token:'<?php echo e(csrf_token()); ?>'}, function(data){
                $('#section_home_categories_2').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/index.blade.php ENDPATH**/ ?>