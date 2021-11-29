<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3"><?php echo e(translate('All Flash Deals')); ?></h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="<?php echo e(route('flash_deals.create')); ?>" class="btn btn-circle btn-info">
				<span><?php echo e(translate('Create New Flash Deal')); ?></span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6"><?php echo e(translate('Flash Deals')); ?></h5>
        <div class="pull-right clearfix">
            <form class="" id="sort_flash_deals" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type name & Enter')); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0" >
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th><?php echo e(translate('Title')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Banner')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Start Date')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('End Date')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Status')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Featured')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Page Link')); ?></th>
                    <th class="text-right"><?php echo e(translate('Options')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $flash_deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $flash_deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(($key+1) + ($flash_deals->currentPage() - 1)*$flash_deals->perPage()); ?></td>
                        <td><?php echo e($flash_deal->getTranslation('title')); ?></td>
                        <td><img src="<?php echo e(uploaded_asset($flash_deal->banner)); ?>" alt="banner" class="h-50px"></td>
                        <td><?php echo e(date('d-m-Y H:i:s', $flash_deal->start_date)); ?></td>
                        <td><?php echo e(date('d-m-Y H:i:s', $flash_deal->end_date)); ?></td>
                        <td>
							<label class="aiz-switch aiz-switch-success mb-0">
								<input onchange="update_flash_deal_status(this)" value="<?php echo e($flash_deal->id); ?>" type="checkbox" <?php if($flash_deal->status == 1) echo "checked";?> >
								<span class="slider round"></span>
							</label>
						</td>
						<td>
							<label class="aiz-switch aiz-switch-success mb-0">
								<input onchange="update_flash_deal_feature(this)" value="<?php echo e($flash_deal->id); ?>" type="checkbox" <?php if($flash_deal->featured == 1) echo "checked";?> >
								<span class="slider round"></span>
							</label>
						</td>
						<td><?php echo e(url('flash-deal/'.$flash_deal->slug)); ?></td>
						<td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="<?php echo e(route('flash_deals.edit', ['id'=>$flash_deal->id, 'lang'=>env('DEFAULT_LANGUAGE')] )); ?>" title="<?php echo e(translate('Edit')); ?>">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="<?php echo e(route('flash_deals.destroy', $flash_deal->id)); ?>" title="<?php echo e(translate('Delete')); ?>">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                <?php echo e($flash_deals->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function update_flash_deal_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('flash_deals.update_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }
        function update_flash_deal_feature(el){
            if(el.checked){
                var featured = 1;
            }
            else{
                var featured = 0;
            }
            $.post('<?php echo e(route('flash_deals.update_featured')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, featured:featured}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/marketing/flash_deals/index.blade.php ENDPATH**/ ?>