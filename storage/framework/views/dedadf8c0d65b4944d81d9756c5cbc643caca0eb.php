<div class="aiz-card-box hov-shadow-md mb-2 has-transition ">
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
        $photos = explode(',', $product->photos);
    ?>

    <div class="position-relative">
        <?php if($discount_percent > 0): ?>
        <span class="badge badge-inline badge-danger absolute-top-right z-1 fs-12 text-uppercase px-2 py-1 d-inline-block h-auto" style="background:#f00"><?php echo e($discount_percent); ?>% OFF</span>
        <?php endif; ?>
        <?php if($product->todays_deal == 1): ?>
        <div class=" absolute-top-right fs-12 text-uppercase mx-2 my-2 px-3 py-3 d-inline-block h-auto d-flex justify-content-center align-items-center text-white" style="background:#f00;height:3rem;width:3rem;border-radius:50%;"><span class="fw-700 fs-11">Sale</span></div>
        <?php endif; ?>
        <div class=""  data-fade='true' data-auto-height='true'>
            <?php if($photos[0]!= ""): ?>
                

                    <div class="rounded">
                        <a href="<?php echo e(route('product', $product->slug)); ?>" class="d-block">
                        <img
                        id="productimgfst-<?php echo e($product->id); ?>"
                            class="img-fluid lazyload img-cus"
                            src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"

                            data-src="<?php echo e(uploaded_asset($photos[0])); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                        >
                        </a>
                    </div>
                
            <?php else: ?>
                     
            
                
                <?php
                    $imgs=explode(",",$product->stocks[0]->image);
                ?>
                
                    <div class=" rounded">
                        <a href="<?php echo e(route('product', $product->slug)); ?>" class="d-block">
                            <img
                            id="productimgfst-<?php echo e($product->id); ?>"
                                class="img-fluid lazyload img-cus"

                                src="<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>"
                                data-src="<?php echo e(uploaded_asset($imgs[0])); ?>"
                                onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';"
                            >
                        </a>
                    </div>
                
                
            
            <?php endif; ?>

        </div>

        <div class="absolute-top-right aiz-p-hov-icon  ">
            <a href="javascript:void(0)" onclick="addToWishList(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-title="<?php echo e(translate('Add to wishlist')); ?>" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a href="javascript:void(0)" onclick="addToCompare(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-title="<?php echo e(translate('Add to compare')); ?>" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a href="javascript:void(0)" onclick="showAddToCartModal(<?php echo e($product->id); ?>)" data-toggle="tooltip" data-title="<?php echo e(translate('Quick View')); ?>" data-placement="left">
                <i class="las la-eye"></i>
            </a>
        </div>
    </div>
    <div class="p-md-2 p-2 text-left">
        <h3 class="fw-500 fs-14 text-truncate lh-1-4 h-16px mb-2 mt-2">
            <a href="<?php echo e(route('product', $product->slug)); ?>" class="d-block text-reset text-center"><?php echo e($product->getTranslation('name')); ?></a>
        </h3>
       <div style="height: 2rem;">
            <?php if(count(json_decode($product->colors)) > 0): ?>
                <div class="row no-gutters d-flex justify-content-center align-items-center">
                    <div class="col newcar">
                        <div class="aiz-radio-inline">
                            <div class="aiz-carousel half-outside-arrow mobile-img-auto-height dot-small-white " data-dots="false" data-autoplay='true'  data-items="5" data-xl-items="5" data-lg-items="5"  data-md-items="5" data-sm-items="3" data-xs-items="3" data-arrows="true">
                                <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="carousel-box d-flex align-items-center" onclick="changephoto2(<?php echo e($product->id); ?>,<?php echo e($key); ?>)">
                                            <label class="aiz-megabox my-0 py-0" data-toggle="tooltip" data-title="<?php echo e(\App\Color::where('code', $color)->first()->name); ?>">

                                                <input
                                                type="radio"
                                                name="color"
                                                value="<?php echo e(\App\Color::where('code', $color)->first()->name); ?>"

                                            >
                                            <span class="size-25px d-inline-block  aiz-megabox-elem px-1" style="background: <?php echo e($color); ?>;border-radius: 25px;"></span>
                                            </label>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
       </div>

        <div class="fs-15 mb-1 text-center">
            <?php if(home_base_price($product) != home_discounted_base_price($product)): ?>
                <del class="fw-600 opacity-50 mr-1 text-dark"><?php echo e(home_base_price($product)); ?></del>
            <?php endif; ?>
            <span class="fw-600 text-alter-2"><?php echo e(home_discounted_base_price($product)); ?></span>
        </div>
        
        <?php if(\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated): ?>
            <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                <?php echo e(translate('Reward Point')); ?>:
                <span class="fw-500 float-right "><?php echo e($product->earn_point); ?></span>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>

    function changephoto2(id,tt){
        var p_id=id;
        var variation_id=tt;

        $.ajax({
                   type:"POST",
                   url: '<?php echo e(route('image.get')); ?>',
                   data:{
                    _token : AIZ.data.csrf,
                       id:p_id,
                       variation:variation_id
                   },
                   success: function(data){

                    var ids=`#productimgfst-${p_id}`;

                       $(ids).attr("src",data.image);
                    }
               });
    }
</script>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/product_box_3.blade.php ENDPATH**/ ?>