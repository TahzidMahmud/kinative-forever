<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6"><?php echo e(translate('Color Information')); ?></h5>
</div>

<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-body p-0">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form class="p-4" action="<?php echo e(route('colors.update', $color->id)); ?>" method="POST">
                <input name="_method" type="hidden" value="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">
                        <?php echo e(translate('Name')); ?>

                    </label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Name')); ?>" id="name" name="name" class="form-control" required value="<?php echo e($color->name); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="code">
                        <?php echo e(translate('Color Code')); ?>

                    </label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Color Code')); ?>" id="code" name="code" class="form-control" required value="<?php echo e($color->code); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="code">
                        <label for="name"><?php echo e(translate('Color Image')); ?></label>
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                            </div>
                            <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>

                            <input type="hidden" name="image" value="<?php echo e($color->image); ?>" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>


                </div>

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/product/color/edit.blade.php ENDPATH**/ ?>