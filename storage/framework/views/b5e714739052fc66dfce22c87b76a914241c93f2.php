<?php if(count($product_ids) > 0): ?>
<table class="table table-bordered aiz-table">
    <thead>
      <tr>
        <td width="50%">
            <span><?php echo e(translate('Product')); ?></span>
        </td>
        <td data-breakpoints="lg" width="20%">
            <span><?php echo e(translate('Base Price')); ?></span>
        </td>
        <td data-breakpoints="lg" width="20%">
            <span><?php echo e(translate('Discount')); ?></span>
        </td>
        <td data-breakpoints="lg" width="10%">
            <span><?php echo e(translate('Discount Type')); ?></span>
        </td>
      </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $product_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $product = \App\Product::findOrFail($id);
              $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal_id)->where('product_id', $product->id)->first();
            ?>
            <tr>
                <td>
                  <div class="form-group row">
                      <div class="col-auto">
                          <img src="<?php echo e(uploaded_asset($product->thumbnail_img)); ?>" class="size-60px img-fit" >
                      </div>
                      <div class="col">
                          <span><?php echo e($product->getTranslation('name')); ?></span>
                      </div>
                  </div>
                </td>
                <td>
                    <span><?php echo e($product->unit_price); ?></span>
                </td>
                <td>
                    <input type="number" lang="en" name="discount_<?php echo e($id); ?>" value="<?php echo e($product->discount); ?>" min="0" step="1" class="form-control" required>
                </td>
                <td>
                    <select class="aiz-selectpicker" name="discount_type_<?php echo e($id); ?>">
                        <option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> ><?php echo e(translate('Flat')); ?></option>
                        <option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> ><?php echo e(translate('Percent')); ?></option>
                    </select>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/marketing/flash_deals/flash_deal_discount_edit.blade.php ENDPATH**/ ?>