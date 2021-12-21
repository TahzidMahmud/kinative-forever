<?php if(get_setting('best_selling') == 1): ?>
    <section class="mb-4">
        <div class="container">
            <div class=" py-4  py-md-3">
                <div class="d-flex mb-3 align-items-baseline">
                    <?php if(filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->get()): ?>
                        <h5 class="h5 fw-500 mb-0">
                            <span class=" pb-3 d-inline-block"><?php echo e(translate('Best Selller Items')); ?></span>
                        </h5>
                    <?php endif; ?>
                    <a href="javascript:void(0)" class="ml-auto mr-0  text-alter-2 text-uppercase"><span class="border-bottom border-primary py-1"><?php echo e(translate('View aLL')); ?></span></a>
                </div>
                <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="2" data-xs-items="2" data-arrows='false' data-infinite='true' data-autoplay="true">
                    <?php $__currentLoopData = filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->inRandomOrder()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-box">
                            <?php echo $__env->make('frontend.partials.product_box_4',['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/best_selling_section.blade.php ENDPATH**/ ?>