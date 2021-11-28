<?php
    $total = 0;
    if(auth()->user() != null) {
        $user_id = Auth::user()->id;
        $cart = \App\Cart::where('user_id', $user_id)->get();
    } else {
        $temp_user_id = Session()->get('temp_user_id');
        if($temp_user_id) {
            $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
        }
    }
?>

<div class="d-flex align-items-center justify-content-between border-bottom px-3 py-2 bg-white sticky-top position-sticky">
    <h5 class="mb-0 h6 strong-600">
        <i class="la la-shopping-cart"></i>
        <?php if(isset($cart) && count($cart) > 0): ?>
            <span class=""><?php echo e(count($cart)); ?> Item(s)</span>
        <?php else: ?>
            <span class="">0 Item(s)</span>
        <?php endif; ?>
    </h5>
    <button class="btn btn-icon" data-toggle="class-toggle" data-target=".cart-sidebar"><i class="la la-times"></i></button>
</div>
<?php if(isset($cart) && count($cart) > 0): ?>
    <div class="p-3 flex-grow-1">
        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $product = \App\Product::find($cartItem['product_id']);
                $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                $total = $total + $cartItem['price']*$cartItem['quantity'];
            ?>
            <div class="cart-item d-flex align-items-center">
                <div class="flex-shrink-0 mr-3">
                    <img src="<?php echo e(uploaded_asset($product->thumbnail_img)); ?>" class="mw-100 size-60px" width="60">
                </div>
                <div class="flex-grow-1 minw-0">
                    <div class="fs-13 text-truncate fw-600"><?php echo e($product->getTranslation('name')); ?></div>
                    <div class="my-1 c-base-1 fw-600"><?php echo e(single_price($cartItem['price'])); ?> x <?php echo e($cartItem['quantity']); ?></div>
                    <div class="row no-gutters align-items-center aiz-plus-minus w-120px">
                        <button class="btn col-auto btn-icon btn-sm btn-light" type="button" data-type="minus" data-field="quantity[<?php echo e($cartItem['id']); ?>]" style="width: 30px;height: 30px;padding: 5px;">
                            <i class="las la-minus"></i>
                        </button>
                        <input type="number" name="quantity[<?php echo e($cartItem['id']); ?>]" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="<?php echo e($cartItem['quantity']); ?>" min="<?php echo e($product->min_qty); ?>" max="<?php echo e($product_stock->qty); ?>" onchange="updateQuantity(<?php echo e($cartItem['id']); ?>, this)">
                        <button class="btn col-auto btn-icon btn-sm btn-light" type="button" data-type="plus" data-field="quantity[<?php echo e($cartItem['id']); ?>]" style="width: 30px;height: 30px;padding: 5px;">
                            <i class="las la-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="ml-3">
                    <button class="btn btn-default btn-icon btn-sm border" onclick="removeFromCart(<?php echo e($cartItem['id']); ?>)"><i class="la la-trash fs-18"></i></button>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="bg-white border-top px-3 py-2 sticky-bottom position-sticky">
        <a href="<?php echo e(route('checkout.shipping_info')); ?>" class="btn btn-primary btn-block">
            <span>Checkout</span>
            <span class="ml-2">(<?php echo e(single_price($total)); ?>)</span>
        </a>
    </div>
<?php else: ?>
    <div class="p-3 flex-grow-1  text-center">
        <!-- <img src="<?php echo e(static_asset('frontend/images/no-shop.jpg')); ?>" class="img-fluid"> -->
        <h4>Your shopping bag is empty. Start shopping</h4>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/sidebar_cart.blade.php ENDPATH**/ ?>