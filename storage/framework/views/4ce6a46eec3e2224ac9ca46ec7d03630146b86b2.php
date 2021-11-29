<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6"><?php echo e(translate('Flash Deal Information')); ?></h5>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">
                <?php $__currentLoopData = \App\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
                    <a class="nav-link text-reset <?php if($language->code == $lang): ?> active <?php else: ?> bg-soft-dark border-light border-left-0 <?php endif; ?> py-3" href="<?php echo e(route('flash_deals.edit', ['id'=>$flash_deal->id, 'lang'=> $language->code] )); ?>">
                      <img src="<?php echo e(static_asset('assets/img/flags/'.$language->code.'.png')); ?>" height="11" class="mr-1">
                      <span><?php echo e($language->name); ?></span>
                    </a>
                  </li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <form class="p-4" action="<?php echo e(route('flash_deals.update', $flash_deal->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="lang" value="<?php echo e($lang); ?>">

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name"><?php echo e(translate('Title')); ?> <i class="las la-language text-danger" title="<?php echo e(translate('Translatable')); ?>"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo e(translate('Title')); ?>" id="name" name="title" value="<?php echo e($flash_deal->getTranslation('title', $lang)); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="background_color"><?php echo e(translate('Background Color')); ?><small>(Hexa-code)</small></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo e(translate('#0000ff')); ?>" id="background_color" name="background_color" value="<?php echo e($flash_deal->background_color); ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label" for="text_color"><?php echo e(translate('Text Color')); ?></label>
                        <div class="col-lg-9">
                            <select name="text_color" id="text_color" class="form-control demo-select2" required>
                                <option value="">Select One</option>
                                <option value="white" <?php if($flash_deal->text_color == 'white'): ?> selected <?php endif; ?>><?php echo e(translate('White')); ?></option>
                                <option value="dark" <?php if($flash_deal->text_color == 'dark'): ?> selected <?php endif; ?>><?php echo e(translate('Dark')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Banner')); ?> <small>(1920x500)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                </div>
                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                <input type="hidden" name="banner" value="<?php echo e($flash_deal->banner); ?>" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <?php
                      $start_date = date('d-m-Y H:i:s', $flash_deal->start_date);
                      $end_date = date('d-m-Y H:i:s', $flash_deal->end_date);
                    ?>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="start_date"><?php echo e(translate('Date')); ?></label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control aiz-date-range" value="<?php echo e($start_date.' to '.$end_date); ?>" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="products"><?php echo e(translate('Products')); ?></label>
                        <div class="col-sm-9">
                            <select name="products[]" id="products" class="form-control aiz-selectpicker" multiple required data-placeholder="<?php echo e(translate('Choose Products')); ?>" data-live-search="true" data-selected-text-format="count">
                                <?php $__currentLoopData = \App\Product::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                                    ?>
                                    <option value="<?php echo e($product->id); ?>" <?php if($flash_deal_product != null) echo "selected";?> ><?php echo e($product->getTranslation('name')); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="alert alert-danger">
                        <?php echo e(translate('If any product has discount or exists in another flash deal, the discount will be replaced by this discount & time limit.')); ?>

                    </div>

                    <br>
                    <div class="form-group" id="discount_table">

                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                  </form>
              </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            get_flash_deal_discount();

            $('#products').on('change', function(){
                get_flash_deal_discount();
            });

            function get_flash_deal_discount(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('<?php echo e(route('flash_deals.product_discount_edit')); ?>', {_token:'<?php echo e(csrf_token()); ?>', product_ids:product_ids, flash_deal_id:<?php echo e($flash_deal->id); ?>}, function(data){
                        $('#discount_table').html(data);
                        AIZ.plugins.fooTable();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/marketing/flash_deals/edit.blade.php ENDPATH**/ ?>