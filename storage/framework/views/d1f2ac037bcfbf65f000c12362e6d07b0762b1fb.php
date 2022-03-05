<?php if(count($combinations[0]) > 0): ?>
<table class="table table-bordered aiz-table">
    <thead>
        <tr>
            <td class="text-center">
                <?php echo e(translate('Variant')); ?>

            </td>
            <td class="text-center">
                <?php echo e(translate('Variant Price')); ?>

            </td>
            <td class="text-center" data-breakpoints="lg">
                <?php echo e(translate('SKU')); ?>

            </td>
            <td class="text-center" data-breakpoints="lg">
                <?php echo e(translate('Quantity')); ?>

            </td>
            <td class="text-center" data-breakpoints="lg">
                <?php echo e(translate('Photo')); ?>

            </td>
            <td></td>
        </tr>
    </thead>
    <tbody>

        <?php $__currentLoopData = $combinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $combination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $variation_available = false;
                $sku = '';
                foreach (explode(' ', $product_name) as $key => $value) {
                    $sku .= substr($value, 0, 1);
                }

                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ) {
                        $str .= '-'.str_replace(' ', '', $item);
                        $sku .='-'.str_replace(' ', '', $item);
                    }
                    else {
                        if($colors_active == 1) {
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                            $sku .='-'.$color_name;
                        }
                        else {
                            $str .= str_replace(' ', '', $item);
                            $sku .='-'.str_replace(' ', '', $item);
                        }
                    }
                    $stock = $product->stocks->where('variant', $str)->first();
                    // if($stock != null) {
                    //     $variation_available = true;
                    // }
                }
            ?>
            <?php if(strlen($str) > 0): ?>
            <tr class="variant">
                <td>
                    <label for="" class="control-label"><?php echo e($str); ?></label>
                </td>
                <td>
                    <input type="number" lang="en" name="price_<?php echo e($str); ?>" value="<?php
                            if ($product->unit_price == $unit_price) {
                                if($stock != null){
                                    echo $stock->price;
                                }
                                else {
                                    echo $unit_price;
                                }
                            }
                            else{
                                echo $unit_price;
                            }
                           ?>" min="0" step="0.01" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="sku_<?php echo e($str); ?>" value="<?php
                            if($stock != null) {
                                echo $stock->sku;
                            }
                            else {
                                echo $str;
                            }
                           ?>" class="form-control">
                </td>
                <td>
                    <input type="number" lang="en" name="qty_<?php echo e($str); ?>" value="<?php
                            if($stock != null){
                                echo $stock->qty;
                            }
                            else{
                                echo '10';
                            }
                           ?>" min="0" step="1" class="form-control" required>
                </td>
                <td>
                    <div class=" input-group " data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                        </div>
                        <div class="form-control file-amount text-truncate"><?php echo e(translate('Choose File')); ?></div>
                        <input type="hidden" name="img_<?php echo e($str); ?>" class="selected-files" value="<?php
                                if($stock != null){
                                    echo $stock->image;
                                }
                                else{
                                    echo null;
                                }
                               ?>">
                    </div>
                    <div class="file-preview box sm"></div>
                </td>
                <td>
                    <button type="button" class="btn btn-icon btn-sm btn-danger" onclick="delete_variant(this)"><i class="las la-trash"></i></button>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/product/products/sku_combinations_edit.blade.php ENDPATH**/ ?>