<a href="<?php echo e(route('wishlists.index')); ?>" class="position-relative  d-inline-block ">
    
    <img src="<?php echo e(static_asset("assets/img/wishlist.png")); ?>" alt="">
    <span class="absolute-top-right" style="right: -10px;top: -10px;">
        <?php if(Auth::check()): ?>
            <span class="badge bg-dark text-light badge-inline badge-pill badge-circle badge-sm"><?php echo e(count(Auth::user()->wishlists)); ?></span>
        <?php else: ?>
            <span class="badge bg-dark text-light badge-inline badge-pill badge-circle badge-sm ">0</span>
        <?php endif; ?>
    </span>
</a>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/partials/wishlist.blade.php ENDPATH**/ ?>