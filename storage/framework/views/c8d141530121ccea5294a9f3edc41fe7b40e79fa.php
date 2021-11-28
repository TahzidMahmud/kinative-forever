<?php $home_categories = json_decode(get_setting('home_categories')); ?>
<section class="mb-4">
    <div class="container" >
               <div class="row">
                   <div class="col" style="min-width: 15%;max-width:20%;"></div>
                   <div class="col"style="max-width:80%;">
                        <div class="nav flex-grow filters-button-group text-uppercase  mobile-hor-swipe d-block d-md-flex justify-content-around " style="background-color: rgba(255, 255, 255, 0)!important;">
                            <?php $__currentLoopData = $home_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $category = \App\Category::find($value); ?>
                                <?php if($category != null): ?>
                                    <?php if($key==0): ?>
                                        <a class=" border-0 button fw-700 px-2 py-4 text-uppercase text-reset fs-12 opacity-40 active" style="display: inline-block;" data-toggle="tab" href="#category-<?php echo e($category->id); ?>"><span class="py-4 my-4" style="background-color: rgba(255, 255, 255, 0.007)!important;"><?php echo e($category->getTranslation('name')); ?></span></a>
                                    <?php else: ?>
                                        <a class=" border-0 button fw-700 px-2 py-4 text-uppercase text-reset fs-12 opacity-40" style="display: inline-block;" data-toggle="tab" href="#category-<?php echo e($category->id); ?>"><span class="py-4 my-4" style="background-color: rgba(255, 255, 255, 0)!important;"><?php echo e($category->getTranslation('name')); ?></span></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                   </div>
                   <div class="col" style="min-width: 10%;max-width:10%;"></div>
               </div>
        <div class="tab-content p-2"  style="background-color: rgba(255, 255, 255, 0);">
            <?php $__currentLoopData = $home_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $category = \App\Category::find($value); ?>
                <?php if($category != null): ?>
                    <?php if($key==0): ?>
                        <div class="tab-pane show active" id="category-<?php echo e($category->id); ?>" >
                            <div class="row row-cols-xl-5 row-cols-lg-5 row-cols-md-5 row-cols-sm-2 row-cols-2 gutters-5">
                                <?php $__currentLoopData = get_cached_products($category->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col mb-2">
                                    <?php echo $__env->make('frontend.partials.product_box_1',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="tab-pane fade" id="category-<?php echo e($category->id); ?>" >
                            <div class="row row-cols-xl-5 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-2 gutters-5">
                                <?php $__currentLoopData = get_cached_products($category->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col mb-2">
                                    <?php echo $__env->make('frontend.partials.product_box_1',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/home_categories_section.blade.php ENDPATH**/ ?>