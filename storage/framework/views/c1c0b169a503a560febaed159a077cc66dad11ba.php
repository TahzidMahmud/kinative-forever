<?php $__env->startSection('meta_title'); ?><?php echo e($blog->meta_title); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_description'); ?><?php echo e($blog->meta_description); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_keywords'); ?><?php echo e($blog->meta_keywords); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e($blog->meta_title); ?>">
    <meta itemprop="description" content="<?php echo e($blog->meta_description); ?>">
    <meta itemprop="image" content="<?php echo e(uploaded_asset($blog->meta_img)); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo e($blog->meta_title); ?>">
    <meta name="twitter:description" content="<?php echo e($blog->meta_description); ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="<?php echo e(uploaded_asset($blog->meta_img)); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e($blog->meta_title); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(route('product', $blog->slug)); ?>" />
    <meta property="og:image" content="<?php echo e(uploaded_asset($blog->meta_img)); ?>" />
    <meta property="og:description" content="<?php echo e($blog->meta_description); ?>" />
    <meta property="og:site_name" content="<?php echo e(env('APP_NAME')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="py-4">
    <div class="container">
        <div class="mb-4">
            <img
                src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>"
                data-src="<?php echo e(uploaded_asset($blog->banner)); ?>"
                alt="<?php echo e($blog->title); ?>"
                class="img-fluid lazyload w-100"
            >
        </div>
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4"> 
                    <div class="border-bottom">
                        <h1 class="h4">
                            <?php echo e($blog->title); ?>

                        </h1>

                        <?php if($blog->category != null): ?>
                        <div class="mb-2 opacity-50">
                            <i><?php echo e($blog->category->category_name); ?></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4 overflow-hidden">
                        <?php echo $blog->description; ?>

                    </div>
                    
                    <?php if(get_setting('facebook_comment') == 1): ?>
                    <div>
                        <div class="fb-comments" data-href="<?php echo e(route("blog",$blog->slug)); ?>" data-width="" data-numposts="5"></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <?php if(get_setting('facebook_comment') == 1): ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=<?php echo e(env('FACEBOOK_APP_ID')); ?>&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/blog/details.blade.php ENDPATH**/ ?>