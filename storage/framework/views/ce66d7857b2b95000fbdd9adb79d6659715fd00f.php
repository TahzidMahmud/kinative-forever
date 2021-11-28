<div class="aiz-card-box hov-shadow-md mb-2 has-transition bg-white">
    <?php
        $discount_applicable = false;
        $lowest_price = $product->stocks->min('price');
        if($lowest_price == 0){
        $lowest_price=1;
        }
      
        $discount_percent = 0;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }
        
        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $discount_percent = round($product->discount);
            }
            elseif($product->discount_type == 'amount'){
              
                $discount_percent = round($product->discount*100/$lowest_price);
            }
        }
    ?>

    <div class="position-relative">
        <?php if($discount_percent > 0): ?>
        <span class="badge badge-inline badge-danger absolute-top-right z-1 fs-12 text-uppercase px-2 py-1 d-inline-block h-auto" style="background:#f00"><?php echo e($discount_percent); ?>% OFF</span>
        <?php endif; ?>
        <a href="<?php echo e(route('product', $product->slug)); ?>" class="d-block">
            <img
                class="img-fit lazyload mx-auto h-160px h-md-230px"
                src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                data-src="<?php echo e(uploaded_asset($product->thumbnail_img)); ?>"
                alt="<?php echo e($product->getTranslation('name')); ?>"
                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
            >
        </a>
        <div class="absolute-top-right aiz-p-hov-icon  ">
            <a href="javascript:void(0)" onclick="addToWishList(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-title="<?php echo e(translate('Add to wishlist')); ?>" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a href="javascript:void(0)" onclick="addToCompare(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-title="<?php echo e(translate('Add to compare')); ?>" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a href="javascript:void(0)" onclick="showAddToCartModal(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-title="<?php echo e(translate('Add to cart')); ?>" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
    </div>
    <div class="p-md-2 p-2 text-left">
        <h3 class="fw-500 fs-13 text-truncate lh-1-4 h-16px mb-2 mt-2">
            <a href="<?php echo e(route('product', $product->slug)); ?>" class="d-block text-reset"><?php echo e($product->getTranslation('name')); ?></a>
        </h3>
        <div class="fs-15 mb-1">
            <?php if(home_base_price($product) != home_discounted_base_price($product)): ?>
                <del class="fw-800 opacity-50 mr-1"><?php echo e(home_base_price($product)); ?></del>
            <?php endif; ?>
            <span class="fw-800 text-primary"><?php echo e(home_discounted_base_price($product)); ?></span>
        </div>
        
        <?php if(\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated): ?>
            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                <?php echo e(translate('Club Point')); ?>:
                <span class="fw-700 float-right"><?php echo e($product->earn_point); ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/product_box_1.blade.php ENDPATH**/ ?>