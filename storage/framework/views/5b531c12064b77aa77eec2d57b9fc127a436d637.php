<?php $__env->startSection('content'); ?>
<section class="text-center py-6">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<img src="<?php echo e(static_asset('assets/img/404.svg')); ?>" class="mw-100 mx-auto mb-5" height="300">
			    <h1 class="fw-700"><?php echo e(translate('Page Not Found!')); ?></h1>
			    <p class="fs-16 opacity-60"><?php echo e(translate('The page you are looking for has not been found on our server.')); ?></p>
			</div>
		</div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/errors/404.blade.php ENDPATH**/ ?>