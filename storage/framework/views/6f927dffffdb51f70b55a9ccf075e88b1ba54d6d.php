<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0 h6"><?php echo e(translate('General Settings')); ?></h1>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="<?php echo e(route('business_settings.update')); ?>" method="POST"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label"><?php echo e(translate('System Name')); ?></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="site_name">
                                <input type="text" name="site_name" class="form-control" value="<?php echo e(get_setting('site_name')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label"><?php echo e(translate('System Logo - White')); ?></label>
                            <div class="col-sm-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose Files')); ?></div>
                                    <input type="hidden" name="types[]" value="system_logo_white">
                                    <input type="hidden" name="system_logo_white" value="<?php echo e(get_setting('system_logo_white')); ?>" class="selected-files">
                                </div>
                                <div class="file-preview box sm"></div>
                                <small><?php echo e(translate('Will be used in admin panel side menu')); ?></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label"><?php echo e(translate('System Logo - Black')); ?></label>
                            <div class="col-sm-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose Files')); ?></div>
                                    <input type="hidden" name="types[]" value="system_logo_black">
                                    <input type="hidden" name="system_logo_black" value="<?php echo e(get_setting('system_logo_black')); ?>" class="selected-files">
                                </div>
                                <div class="file-preview box sm"></div>
                                <small><?php echo e(translate('Will be used in admin panel topbar in mobile + Admin login page')); ?></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label"><?php echo e(translate('System Timezone')); ?></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="timezone">
                                <select name="timezone" class="form-control aiz-selectpicker" data-live-search="true">
                                    <?php $__currentLoopData = timezones(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>" <?php if(app_timezone() == $value): ?>
                                            selected
                                        <?php endif; ?>><?php echo e($key); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label"><?php echo e(translate('Admin login page background')); ?></label>
                            <div class="col-sm-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose Files')); ?></div>
                                    <input type="hidden" name="types[]" value="admin_login_background">
                                    <input type="hidden" name="admin_login_background" value="<?php echo e(get_setting('admin_login_background')); ?>" class="selected-files">
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                        <div class="text-right">
    						<button type="submit" class="btn btn-primary"><?php echo e(translate('Update')); ?></button>
    					</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/setup_configurations/general_settings.blade.php ENDPATH**/ ?>