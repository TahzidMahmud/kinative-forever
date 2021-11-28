<?php $__env->startSection('content'); ?>
<section class="text-center py-6">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<img src="<?php echo e(static_asset('assets/img/500.svg')); ?>" class="img-fluid w-75">
				<h1 class="h2 fw-700 mt-5"><?php echo e(translate("Something went wrong!")); ?></h1>
		    	<p class="fs-16 opacity-60"><?php echo e(translate("Sorry for the inconvenience, but we're working on it.")); ?> <br> <?php echo e(translate("Error code")); ?>: 500</p>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/errors/500.blade.php ENDPATH**/ ?>