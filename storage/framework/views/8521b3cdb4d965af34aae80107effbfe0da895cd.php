<?php
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
<a href="javascript:void(0)" class="d-flex align-items-center text-alter h-100 cart-trigger" data-toggle="class-toggle" data-target=".cart-sidebar">
    <span class="position-relative">
        
        <img src="<?php echo e(static_asset("assets/img/cart.png")); ?>" alt="">
        <span class="absolute-top-right " style="right: -10px;top: -10px;">
            <?php if(isset($cart) && count($cart) > 0): ?>
                <span class="badge bg-dark text-light badge-inline badge-pill  cart-count badge-circle badge-sm"><?php echo e(count($cart)); ?></span>
            <?php else: ?>
                <span class="badge bg-dark text-light badge-inline badge-pill cart-count badge-circle badge-sm">0</span>
            <?php endif; ?>
        </span>
    </span>
</a>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/cart.blade.php ENDPATH**/ ?>