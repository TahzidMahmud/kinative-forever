<?php $__env->startSection('content'); ?>
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3"><?php echo e(translate('All Blog Categories')); ?></h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="<?php echo e(url('admin/blog-category/create')); ?>" class="btn btn-primary">
                <span><?php echo e(translate('Add New category')); ?></span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6"><?php echo e(translate('Blog Categories')); ?></h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type name & Enter')); ?>">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th><?php echo e(translate('Name')); ?></th>
                    <th width="10%" class="text-right"><?php echo e(translate('Options')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(($key+1) + ($categories->currentPage() - 1)*$categories->perPage()); ?></td>
                    <td><?php echo e($category->category_name); ?></td>
                    <td class="text-right">
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="<?php echo e(url('admin/blog-category/'.$category->id.'/edit')); ?>" title="<?php echo e(translate('Edit')); ?>">
                            <i class="las la-edit"></i>
                        </a>
                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="<?php echo e(route('blog-category.destroy', $category->id)); ?>" title="<?php echo e(translate('Delete')); ?>">
                            <i class="las la-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="aiz-pagination">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('modal'); ?>
<?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/blog_system/category/index.blade.php ENDPATH**/ ?>