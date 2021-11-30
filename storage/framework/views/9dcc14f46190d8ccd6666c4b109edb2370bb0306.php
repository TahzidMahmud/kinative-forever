<?php $__env->startSection('content'); ?>

<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4"><?php echo e(translate('Blog')); ?></h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="<?php echo e(route('home')); ?>">
                            <?php echo e(translate('Home')); ?>

                        </a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="<?php echo e(route('blog')); ?>">
                            "<?php echo e(translate('Blog')); ?>"
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="pb-4">
    <div class="container">
        <div class="card-columns">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3 overflow-hidden shadow-sm">
                    <a href="<?php echo e(url("blog").'/'. $blog->slug); ?>" class="text-reset d-block">
                        <img
                            src="<?php echo e(static_asset('assets/img/placeholder-rect.jpg')); ?>"
                            data-src="<?php echo e(uploaded_asset($blog->banner)); ?>"
                            alt="<?php echo e($blog->title); ?>"
                            class="img-fluid lazyload "
                        >
                    </a>
                    <div class="p-4">
                        <h2 class="fs-18 fw-600 mb-1">
                            <a href="<?php echo e(url("blog").'/'. $blog->slug); ?>" class="text-reset">
                                <?php echo e($blog->title); ?>

                            </a>
                        </h2>
                        <?php if($blog->category != null): ?>
                        <div class="mb-2 opacity-50">
                            <i><?php echo e($blog->category->category_name); ?></i>
                        </div>
                        <?php endif; ?>
                        <p class="opacity-70 mb-4">
                            <?php echo e($blog->short_description); ?>

                        </p>
                        <a href="<?php echo e(url("blog").'/'. $blog->slug); ?>" class="btn btn-soft-primary">
                            <?php echo e(translate('View More')); ?>

                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
        <div class="aiz-pagination aiz-pagination-center mt-4">
            <?php echo e($blogs->links()); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/blog/listing.blade.php ENDPATH**/ ?>