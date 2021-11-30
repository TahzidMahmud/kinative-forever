<?php $home_categories = json_decode(get_setting('home_categories')); ?>
<section class="mb-4">
    <div class="container">
        <div>
            <h5 class="text-uppercase h5 mt-5 mb-3 text-center"><?php echo e(translate('Handpicked for you')); ?></h5>
        </div>
        <div class="nav filters-button-group text-uppercase mb-3 mb-md-4 mobile-hor-swipe d-block d-md-flex justify-content-center align-items-center" >
            <a class="text-reset bg-transparent border-0 button fw-500 px-3 pl-xl-0 py-2 text-uppercase fs-12 opacity-70 active" data-toggle="tab" href="#all-category">
                <div class="d-flex flex-column align-items-center">
                    <div class="img-back bg-alter-2 d-flex align-items-center justify-content-center my-2">
                        <img src="<?php echo e(static_asset('assets/img/all_featured_icon.png')); ?>" alt="">
                    </div>
                <?php echo e(translate('Featured Products')); ?>

                </div>
            </a>
            <?php $__currentLoopData = $home_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $category = \App\Category::find($value); ?>
                <?php if($category != null): ?>
                <a class="bg-transparent border-0 button fw-500 px-3 py-2 text-uppercase text-reset fs-12 opacity-70" data-toggle="tab" href="#category-<?php echo e($category->id); ?>">
                    <div class="d-flex flex-column align-items-center" >
                            <div class="img-back  bg-alter-2  d-flex align-items-center justify-content-center my-2">
                                <img  src="<?php echo e(uploaded_asset($category->icon)); ?>" alt="">
                            </div>
                        <?php echo e($category->getTranslation('name')); ?>

                    </div>
                </a>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="tab-content" >
            <div class="tab-pane fade show active" id="all-category" >
                <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                    <?php $__currentLoopData = \App\Product::where('published', '1')->where('featured', '1')->latest()->limit(10)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col mb-2">
                        <?php echo $__env->make('frontend.partials.product_box_1',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php $__currentLoopData = $home_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $category = \App\Category::find($value); ?>
                <?php if($category != null): ?>
                    <div class="tab-pane fade" id="category-<?php echo e($category->id); ?>" >
                        <div class="row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                            <?php $__currentLoopData = get_cached_products($category->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col mb-2">
                                <?php echo $__env->make('frontend.partials.product_box_1',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<script>
      $('a[data-toggle="tab"]').on('hidden.bs.tab', function (event) {
        event.target;// newly activated tab
        AIZ.plugins.slickCarousel();
        event.relatedTarget; // previous active tab

        })
</script>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/home_categories_section.blade.php ENDPATH**/ ?>