<?php $__env->startSection('content'); ?>

<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6"><?php echo e(translate('System Default Currency')); ?></h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="<?php echo e(route('business_settings.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="control-label"><?php echo e(translate('System Default Currency')); ?></label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="system_default_currency" data-live-search="true">
                                <?php $__currentLoopData = $active_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($currency->id); ?>" <?php if(get_setting('system_default_currency') == $currency->id) echo 'selected'?> >
                                        <?php echo e($currency->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <input type="hidden" name="types[]" value="system_default_currency">
                        <div class="col-lg-3">
                            <button class="btn btn-sm btn-primary" type="submit"><?php echo e(translate('Save')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6"><?php echo e(translate('Set Currency Formats')); ?></h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="<?php echo e(route('business_settings.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="symbol_format">
                        <div class="col-lg-3">
                            <label class="control-label"><?php echo e(translate('Symbol Format')); ?></label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="symbol_format">
                                <option value="1" <?php if(get_setting('symbol_format') == 1): ?> selected <?php endif; ?>>[Symbol][Amount]</option>
                                <option value="2" <?php if(get_setting('symbol_format') == 2): ?> selected <?php endif; ?>>[Amount][Symbol]</option>
                                <option value="3" <?php if(get_setting('symbol_format') == 3): ?> selected <?php endif; ?>>[Symbol] [Amount]</option>
                                <option value="4" <?php if(get_setting('symbol_format') == 4): ?> selected <?php endif; ?>>[Amount] [Symbol]</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="decimal_separator">
                        <div class="col-lg-3">
                            <label class="control-label"><?php echo e(translate('Decimal Separator')); ?></label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="decimal_separator">
                                <option value="1" <?php if(get_setting('decimal_separator') == 1): ?> selected <?php endif; ?>>1,23,456.70</option>
                                <option value="2" <?php if(get_setting('decimal_separator') == 2): ?> selected <?php endif; ?>>1.23.456,70</option>
                                <option value="3" <?php if(get_setting('decimal_separator') == 3): ?> selected <?php endif; ?>>12345</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="types[]" value="no_of_decimals">
                        <div class="col-lg-3">
                            <label class="control-label"><?php echo e(translate('No of decimals')); ?></label>
                        </div>
                        <div class="col-lg-6">
                            <select class="form-control aiz-selectpicker" name="no_of_decimals">
                                <option value="0" <?php if(get_setting('no_of_decimals') == 0): ?> selected <?php endif; ?>>12345</option>
                                <option value="1" <?php if(get_setting('no_of_decimals') == 1): ?> selected <?php endif; ?>>1234.5</option>
                                <option value="2" <?php if(get_setting('no_of_decimals') == 2): ?> selected <?php endif; ?>>123.45</option>
                                <option value="3" <?php if(get_setting('no_of_decimals') == 3): ?> selected <?php endif; ?>>12.345</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3"><?php echo e(translate('All Currencies')); ?></h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a onclick="currency_modal()" href="#" class="btn btn-circle btn-primary">
				<span><?php echo e(translate('Add New Currency')); ?></span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header row gutters-5">
        <div class="col text-center text-md-left">
            <h5 class="mb-md-0 h6"><?php echo e(translate('All Currencies')); ?></h5>
        </div>
        <div class="col-md-4">
            <form class="" id="sort_currencies" action="" method="GET">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type name & Enter')); ?>">
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th><?php echo e(translate('Currency name')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Currency symbol')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Currency code')); ?></th>
                    <th><?php echo e(translate('Exchange rate')); ?>(1 USD = ?)</th>
                    <th data-breakpoints="lg"><?php echo e(translate('Status')); ?></th>
                    <th class="text-right"><?php echo e(translate('Options')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(($key+1) + ($currencies->currentPage() - 1)*$currencies->perPage()); ?></td>
                        <td><?php echo e($currency->name); ?></td>
                        <td><?php echo e($currency->symbol); ?></td>
                        <td><?php echo e($currency->code); ?></td>
                        <td><?php echo e($currency->exchange_rate); ?></td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_currency_status(this)" value="<?php echo e($currency->id); ?>" type="checkbox" <?php if($currency->status == 1) echo "checked";?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" onclick="edit_currency_modal('<?php echo e($currency->id); ?>');" title="<?php echo e(translate('Edit')); ?>">
                                <i class="las la-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="aiz-pagination">
            <?php echo e($currencies->appends(request()->input())->links()); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

    <!-- Delete Modal -->
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="modal fade" id="add_currency_modal">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="currency_modal_edit">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">

        function sort_currencies(el){
            $('#sort_currencies').submit();
        }

        function currency_modal(){
            $.get('<?php echo e(route('currency.create')); ?>',function(data){
                $('#modal-content').html(data);
                $('#add_currency_modal').modal('show');
            });
        }

        function update_currency_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }

            $.post('<?php echo e(route('currency.update_status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '<?php echo e(translate('Currency Status updated successfully')); ?>');
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

        function edit_currency_modal(id){
            $.post('<?php echo e(route('currency.edit')); ?>',{_token:'<?php echo e(@csrf_token()); ?>', id:id}, function(data){
                $('#currency_modal_edit .modal-content').html(data);
                $('#currency_modal_edit').modal('show', {backdrop: 'static'});
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/setup_configurations/currencies/index.blade.php ENDPATH**/ ?>