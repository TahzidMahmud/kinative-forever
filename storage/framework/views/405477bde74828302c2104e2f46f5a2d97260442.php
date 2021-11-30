<div class="modal-body p-4 c-scrollbar-light">
    <div class="row">
        <div class="col-lg-6">
            <div class="row gutters-10 flex-row-reverse">
                <?php
                    $photos = explode(',',$product->photos);
                ?>
                <div class="col">
                    <div class="aiz-carousel product-gallery" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                        <?php if($photos[0]!= ""): ?>
                            <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="carousel-box img-zoom rounded">
                                    <img
                                        class="img-fluid lazyload"
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($photo)); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                                    >
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <?php $__currentLoopData = $product->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($stock->image != null): ?>
                            <?php
                                $imgs=explode(",",$stock->image);
                            ?>
                              <?php $__currentLoopData = $imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <div class="carousel-box img-zoom rounded">
                                    <img
                                        class="img-fluid lazyload"
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($imgs[$key])); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                                    >
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-auto w-90px">
                    <div class="aiz-carousel product-gallery-thumb" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-vertical-sm='false' data-focus-select='true' data-arrows='true'>
                        <?php if($photos[0]!= ""): ?>
                            <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-box c-pointer border p-1 rounded" id="slider-<?php echo e($key); ?>">
                                <img
                                    class="lazyload mw-100 size-50px mx-auto"
                                    src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                    data-src="<?php echo e(uploaded_asset($photo)); ?>"
                                    onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                                >
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <?php $__currentLoopData = $product->stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($stock->image != null): ?>
                        <?php
                            $imgs=explode(",",$stock->image);
                        ?>
                         <?php $__currentLoopData = $imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                           <?php if($key==0): ?>
                            <div class="carousel-box c-pointer border p-1 rounded" data-variation="<?php echo e($stock->variant); ?>">
                                <img
                                    class="lazyload mw-100 size-50px mx-auto"
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($img)); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                                >
                            </div>
                            <?php else: ?>
                                <div class="carousel-box c-pointer border p-1 rounded" data-variation="<?php echo e($stock->variant); ?>" >
                                    <img
                                        class="lazyload mw-100 size-50px mx-auto"
                                        src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                        data-src="<?php echo e(uploaded_asset($img)); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                                    >
                                </div>
                           <?php endif; ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="text-left">
                <h2 class="mb-2 fs-20 fw-600">
                    <?php echo e($product->getTranslation('name')); ?>

                </h2>

                <?php if(home_price($product) != home_discounted_price($product)): ?>
                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <div class="opacity-50 mt-2"><?php echo e(translate('Price')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="fs-20 opacity-60">
                                <del>
                                    <?php echo e(home_price($product)); ?>

                                    <?php if($product->unit != null): ?>
                                        <span>/<?php echo e($product->getTranslation('unit')); ?></span>
                                    <?php endif; ?>
                                </del>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters mt-2">
                        <div class="col-2">
                            <div class="opacity-50"><?php echo e(translate('Discount Price')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="">
                                <strong class="h2 fw-600 text-primary">
                                    <?php echo e(home_discounted_price($product)); ?>

                                </strong>
                                <?php if($product->unit != null): ?>
                                    <span class="opacity-70">/<?php echo e($product->getTranslation('unit')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row no-gutters mt-3">
                        <div class="col-2">
                            <div class="opacity-50"><?php echo e(translate('Price')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="">
                                <strong class="h2 fw-600 text-primary">
                                    <?php echo e(home_discounted_price($product)); ?>

                                </strong>
                                <span class="opacity-70">/<?php echo e($product->unit); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $product->earn_point > 0): ?>
                    <div class="row no-gutters mt-4">
                        <div class="col-2">
                            <div class="opacity-50"><?php echo e(translate('Club Point')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="d-inline-block club-point bg-soft-primary px-3 py-1 border">
                                <span class="strong-700"><?php echo e($product->earn_point); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <hr>

                <?php
                    $qty = 0;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                ?>

                <form id="option-choice-form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($product->id); ?>">

                    <!-- Quantity + Add to cart -->
                    <?php if($product->digital !=1): ?>
                        <?php if($product->choice_options != null): ?>
                            <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="opacity-50 mt-2 "><?php echo e(\App\Attribute::find($choice->attribute_id)->getTranslation('name')); ?>:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="aiz-radio-inline">
                                            <?php $__currentLoopData = $choice->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="aiz-megabox pl-0 mr-2">
                                                <input
                                                    type="radio"
                                                    name="attribute_id_<?php echo e($choice->attribute_id); ?>"
                                                    value="<?php echo e($value); ?>"
                                                    <?php if($key == 0): ?> checked <?php endif; ?>
                                                >
                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center py-2 px-3 mb-2">
                                                    <?php echo e($value); ?>

                                                </span>
                                            </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if(count(json_decode($product->colors)) > 0): ?>
                            <div class="row no-gutters">
                                <div class="col-2">
                                    <div class="opacity-50 mt-2"><?php echo e(translate('Color')); ?>:</div>
                                </div>
                                <div class="col-10">
                                    <div class="aiz-radio-inline">
                                        <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="<?php echo e(\App\Color::where('code', $color)->first()->name); ?>">
                                            <input
                                                type="radio"
                                                name="color"
                                                value="<?php echo e(\App\Color::where('code', $color)->first()->name); ?>"
                                                <?php if($key == 0): ?> checked <?php endif; ?>
                                            >
                                            <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                <span class="size-30px d-inline-block rounded" style="background: <?php echo e($color); ?>;"></span>
                                            </span>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                            <hr>
                        <?php endif; ?>

                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="opacity-50 mt-2"><?php echo e(translate('Quantity')); ?>:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                        <button class="btn col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="minus" data-field="quantity" disabled="">
                                            <i class="las la-minus"></i>
                                        </button>
                                        <input type="text" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="<?php echo e($product->min_qty); ?>" min="<?php echo e($product->min_qty); ?>" max="10">
                                        <button class="btn  col-auto btn-icon btn-sm btn-circle btn-light" type="button" data-type="plus" data-field="quantity">
                                            <i class="las la-plus"></i>
                                        </button>
                                    </div>
                                    <div class="avialable-amount opacity-60">
                                        <?php if($product->stock_visibility_state == 'quantity'): ?>
                                        (<span id="available-quantity"><?php echo e($qty); ?></span> <?php echo e(translate('available')); ?>)
                                        <?php elseif($product->stock_visibility_state == 'text' && $qty >= 1): ?>
                                            (<span id="available-quantity"><?php echo e(translate('In Stock')); ?></span>)
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                    <?php endif; ?>

                    <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                        <div class="col-2">
                            <div class="opacity-50"><?php echo e(translate('Total Price')); ?>:</div>
                        </div>
                        <div class="col-10">
                            <div class="product-price">
                                <strong id="chosen_price" class="h4 fw-600 text-primary">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="mt-3">
                    <?php if($product->digital == 1): ?>
                        <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart" onclick="addToCart()">
                            <i class="la la-shopping-cart"></i>
                            <span class="d-none d-md-inline-block"> <?php echo e(translate('Add to cart')); ?></span>
                        </button>
                    <?php elseif($qty > 0): ?>
                        <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart" onclick="addToCart()">
                            <i class="la la-shopping-cart"></i>
                            <span class="d-none d-md-inline-block"> <?php echo e(translate('Add to cart')); ?></span>
                        </button>
                    <?php endif; ?>
                    <button type="button" class="btn btn-danger out-of-stock fw-600 d-none opacity-100" disabled>
                        <i class="la la-cart-arrow-down"></i> <?php echo e(translate('Out of Stock')); ?>

                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/addToCart.blade.php ENDPATH**/ ?>