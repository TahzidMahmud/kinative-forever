<div class="">
    <?php if(sizeof($keywords) > 0): ?>
        <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"><?php echo e(translate('Popular Suggestions')); ?></div>
        <ul class="list-group list-group-raw">
            <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item py-1">
                    <a class="text-reset hov-text-primary" href="<?php echo e(route('suggestion.search', $keyword)); ?>"><?php echo e($keyword); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
<div class="">
    <?php if(count($categories) > 0): ?>
        <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"><?php echo e(translate('Category Suggestions')); ?></div>
        <ul class="list-group list-group-raw">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item py-1">
                    <a class="text-reset hov-text-primary" href="<?php echo e(route('products.category', $category->slug)); ?>"><?php echo e($category->getTranslation('name')); ?></a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
<div class="">
    <?php if(count($products) > 0): ?>
        <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"><?php echo e(translate('Products')); ?></div>
        <ul class="list-group list-group-raw">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item">
                    <a class="text-reset" href="<?php echo e(route('product', $product->slug)); ?>">
                        <div class="d-flex search-product align-items-center">
                            <div class="mr-3">
                                <img class="size-40px img-fit rounded" src="<?php echo e(uploaded_asset($product->thumbnail_img)); ?>">
                            </div>
                            <div class="flex-grow-1 overflow--hidden minw-0">
                                <div class="product-name text-truncate fs-14 mb-5px">
                                    <?php echo e($product->getTranslation('name')); ?>

                                </div>
                                <div class="">
                                    <?php if(home_base_price($product) != home_discounted_base_price($product)): ?>
                                        <del class="opacity-60 fs-15"><?php echo e(home_base_price($product)); ?></del>
                                    <?php endif; ?>
                                    <span class="fw-600 fs-16 text-primary"><?php echo e(home_discounted_base_price($product)); ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>
</div>
<?php if(get_setting('vendor_system_activation') == 1): ?>
    <div class="">
        <?php if(count($shops) > 0): ?>
            <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary"><?php echo e(translate('Shops')); ?></div>
            <ul class="list-group list-group-raw">
                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item">
                        <a class="text-reset" href="<?php echo e(route('shop.visit', $shop->slug)); ?>">
                            <div class="d-flex search-product align-items-center">
                                <div class="mr-3">
                                    <img class="size-40px img-fit rounded" src="<?php echo e(uploaded_asset($shop->logo)); ?>">
                                </div>
                                <div class="flex-grow-1 overflow--hidden">
                                    <div class="product-name text-truncate fs-14 mb-5px">
                                        <?php echo e($shop->name); ?>

                                    </div>
                                    <div class="opacity-60">
                                        <?php echo e($shop->address); ?>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/search_content.blade.php ENDPATH**/ ?>