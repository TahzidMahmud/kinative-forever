<?php $__env->startSection('content'); ?>
<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6"><?php echo e(translate('Add New Product')); ?></h5>
</div>
<div class="">
    <form class="form form-horizontal mar-top" action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data" id="choice_form">
        <div class="row gutters-5">
            <div class="col-lg-8">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="added_by" value="admin">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product Information')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Product Name')); ?> <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" placeholder="<?php echo e(translate('Product Name')); ?>" onchange="update_sku()" required>
                            </div>
                        </div>
                        <div class="form-group row" id="category">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Category')); ?> <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->getTranslation('name')); ?></option>
                                    <?php $__currentLoopData = $category->childrenCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('categories.child_category', ['child_category' => $childCategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="brand">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Brand')); ?></label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">
                                    <option value=""><?php echo e(translate('Select Brand')); ?></option>
                                    <?php $__currentLoopData = \App\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->getTranslation('name')); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Unit')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="unit" placeholder="<?php echo e(translate('Unit (e.g. KG, Pc etc)')); ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Minimum Purchase Qty')); ?> <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="number" lang="en" class="form-control" name="min_qty" value="1" min="1" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Tags')); ?> <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="<?php echo e(translate('Type and hit enter to add a tag')); ?>">
                                <small class="text-muted"><?php echo e(translate('This is used for search. Input those words by which cutomer can find this product.')); ?></small>
                            </div>
                        </div>

                        <?php
                        $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
                        ?>
                        <?php if($pos_addon != null && $pos_addon->activated == 1): ?>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Barcode')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="barcode" placeholder="<?php echo e(translate('Barcode')); ?>">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php
                        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                        ?>
                        <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Refundable')); ?></label>
                            <div class="col-md-8">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="refundable">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product Images')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Gallery Images')); ?> <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                    <input type="hidden" name="photos" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small class="text-muted"><?php echo e(translate('These images are visible in product details page gallery. Use 600x600 sizes images.')); ?></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Thumbnail Image')); ?> <small>(300x300)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                    <input type="hidden" name="thumbnail_img" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                                <small class="text-muted"><?php echo e(translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product Videos')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Video Provider')); ?></label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                                    <option value="youtube"><?php echo e(translate('Youtube')); ?></option>
                                    <option value="dailymotion"><?php echo e(translate('Dailymotion')); ?></option>
                                    <option value="vimeo"><?php echo e(translate('Vimeo')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Video Link')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="video_link" placeholder="<?php echo e(translate('Video Link')); ?>">
                                <small class="text-muted"><?php echo e(translate("Use proper link without extra parameter. Don't use short share link/embeded iframe code.")); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product Variation')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="<?php echo e(translate('Colors')); ?>" disabled>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple disabled>
                                    <?php $__currentLoopData = \App\Color::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option  value="<?php echo e($color->code); ?>" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:<?php echo e($color->code); ?>'></span><span><?php echo e($color->name); ?></span></span>"></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input value="1" type="checkbox" name="colors_active">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="<?php echo e(translate('Attributes')); ?>" disabled>
                            </div>
                            <div class="col-md-8">
                                <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="<?php echo e(translate('Choose Attributes')); ?>">
                                    <?php $__currentLoopData = \App\Attribute::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->getTranslation('name')); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <p><?php echo e(translate('Choose the attributes of this product and then input values of each attribute')); ?></p>
                            <br>
                        </div>

                        <div class="customer_choice_options" id="customer_choice_options">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product price + stock')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Unit price')); ?> <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="<?php echo e(translate('Unit price')); ?>" name="unit_price" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
	                        <label class="col-sm-3 control-label" for="start_date"><?php echo e(translate('Discount Date Range')); ?></label>
	                        <div class="col-sm-9">
	                          <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">
	                        </div>
	                    </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Discount')); ?> <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="<?php echo e(translate('Discount')); ?>" name="discount" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control aiz-selectpicker" name="discount_type">
                                    <option value="amount"><?php echo e(translate('Flat')); ?></option>
                                    <option value="percent"><?php echo e(translate('Percent')); ?></option>
                                </select>
                            </div>
                        </div>

                        <?php if(\App\Addon::where('unique_identifier', 'club_point')->first() != null &&
                            \App\Addon::where('unique_identifier', 'club_point')->first()->activated): ?>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">
                                    <?php echo e(translate('Set Point')); ?>

                                </label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="1" placeholder="<?php echo e(translate('1')); ?>" name="earn_point" class="form-control">
                                </div>
                            </div>
                        <?php endif; ?>

                        <div id="show-hide-div">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label"><?php echo e(translate('Quantity')); ?> <span class="text-danger">*</span></label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="1" placeholder="<?php echo e(translate('Quantity')); ?>" name="current_stock" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">
                                    <?php echo e(translate('SKU')); ?>

                                </label>
                                <div class="col-md-6">
                                    <input type="text" placeholder="<?php echo e(translate('SKU')); ?>" name="sku" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="sku_combination" id="sku_combination">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product Description')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Description')); ?></label>
                            <div class="col-md-8">
                                <textarea class="aiz-text-editor" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

<!--                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Product Shipping Cost')); ?></h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>-->

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('PDF Specification')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('PDF Specification')); ?></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="document">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                    <input type="hidden" name="pdf" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('SEO Meta Tags')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Meta Title')); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="meta_title" placeholder="<?php echo e(translate('Meta Title')); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label"><?php echo e(translate('Description')); ?></label>
                            <div class="col-md-8">
                                <textarea name="meta_description" rows="8" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Meta Image')); ?></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                    </div>
                                    <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                    <input type="hidden" name="meta_img" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">
                            <?php echo e(translate('Shipping Configuration')); ?>

                        </h5>
                    </div>

                    <div class="card-body">
                        <?php if(get_setting('shipping_type') == 'product_wise_shipping'): ?>
                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Free Shipping')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="radio" name="shipping_type" value="free" checked>
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Flat Rate')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="radio" name="shipping_type" value="flat_rate">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="flat_rate_shipping_div" style="display: none">
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label"><?php echo e(translate('Shipping cost')); ?></label>
                                <div class="col-md-6">
                                    <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="<?php echo e(translate('Shipping cost')); ?>" name="flat_shipping_cost" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Is Product Quantity Mulitiply')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="is_quantity_multiplied" value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <?php else: ?>
                        <p>
                            <?php echo e(translate('Product wise shipping cost is disable. Shipping cost is configured from here')); ?>

                            <a href="<?php echo e(route('shipping_configuration.index')); ?>" class="aiz-side-nav-link <?php echo e(areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])); ?>">
                                <span class="aiz-side-nav-text"><?php echo e(translate('Shipping Configuration')); ?></span>
                            </a>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Low Stock Quantity Warning')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">
                                <?php echo e(translate('Quantity')); ?>

                            </label>
                            <input type="number" name="low_stock_quantity" value="1" min="0" step="1" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">
                            <?php echo e(translate('Stock Visibility State')); ?>

                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Show Stock Quantity')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="radio" name="stock_visibility_state" value="quantity" checked>
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Show Stock With Text Only')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="radio" name="stock_visibility_state" value="text">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Hide Stock')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="radio" name="stock_visibility_state" value="hide">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Cash On Delivery')); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php if(get_setting('cash_payment') == '1'): ?>
                            <div class="form-group row">
                                <label class="col-md-6 col-from-label"><?php echo e(translate('Status')); ?></label>
                                <div class="col-md-6">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input type="checkbox" name="cash_on_delivery" value="1" checked="">
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        <?php else: ?>
                            <p>
                                <?php echo e(translate('Cash On Delivery option is disabled. Activate this feature from here')); ?>

                                <a href="<?php echo e(route('activation.index')); ?>" class="aiz-side-nav-link <?php echo e(areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])); ?>">
                                    <span class="aiz-side-nav-text"><?php echo e(translate('Cash Payment Activation')); ?></span>
                                </a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Featured')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Status')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="featured" value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Todays Deal')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-6 col-from-label"><?php echo e(translate('Status')); ?></label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="todays_deal" value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Flash Deal')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">
                                <?php echo e(translate('Add To Flash')); ?>

                            </label>
                            <select class="form-control aiz-selectpicker" name="flash_deal_id" id="flash_deal">
                                <option value="">Choose Flash Title</option>
                                <?php $__currentLoopData = \App\FlashDeal::where("status", 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash_deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($flash_deal->id); ?>">
                                        <?php echo e($flash_deal->title); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">
                                <?php echo e(translate('Discount')); ?>

                            </label>
                            <input type="number" name="flash_discount" value="0" min="0" step="1" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">
                                <?php echo e(translate('Discount Type')); ?>

                            </label>
                            <select class="form-control aiz-selectpicker" name="flash_discount_type" id="flash_discount_type">
                                <option value="">Choose Discount Type</option>
                                <option value="amount"><?php echo e(translate('Flat')); ?></option>
                                <option value="percent"><?php echo e(translate('Percent')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('Estimate Shipping Time')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">
                                <?php echo e(translate('Shipping Days')); ?>

                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="est_shipping_days" placeholder="Shipping Days">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6"><?php echo e(translate('VAT & Tax')); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php $__currentLoopData = \App\Tax::where('tax_status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label for="name">
                            <?php echo e($tax->name); ?>

                            <input type="hidden" value="<?php echo e($tax->id); ?>" name="tax_id[]">
                        </label>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="<?php echo e(translate('Tax')); ?>" name="tax[]" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control aiz-selectpicker" name="tax_type[]">
                                    <option value="amount"><?php echo e(translate('Flat')); ?></option>
                                    <option value="percent"><?php echo e(translate('Percent')); ?></option>
                                </select>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="submit" name="button" value="draft" class="btn btn-warning"><?php echo e(translate('Save As Draft')); ?></button>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="Third group">
                        <button type="submit" name="button" value="unpublish" class="btn btn-primary"><?php echo e(translate('Save & Unpublish')); ?></button>
                    </div>
                    <div class="btn-group" role="group" aria-label="Second group">
                        <button type="submit" name="button" value="publish" class="btn btn-success"><?php echo e(translate('Save & Publish')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    $("[name=shipping_type]").on("change", function (){
        $(".flat_rate_shipping_div").hide();
        
        if($(this).val() == 'flat_rate'){
            $(".flat_rate_shipping_div").show();
        }

    });

    function add_more_customer_choice_option(i, name){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'<?php echo e(route('products.add-more-choice-option')); ?>',
            data:{
               attribute_id: i
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#customer_choice_options').append('\
                <div class="form-group row">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="'+i+'">\
                        <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="<?php echo e(translate('Choice Title')); ?>" readonly>\
                    </div>\
                    <div class="col-md-8">\
                        <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" multiple>\
                            '+obj+'\
                        </select>\
                    </div>\
                </div>');
                AIZ.plugins.bootstrapSelect('refresh');
           }
       });

        
    }

    $('input[name="colors_active"]').on('change', function() {
        if(!$('input[name="colors_active"]').is(':checked')) {
            $('#colors').prop('disabled', true);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        else {
            $('#colors').prop('disabled', false);
            AIZ.plugins.bootstrapSelect('refresh');
        }
        update_sku();
    });

    $(document).on("change", ".attribute_choice",function() {
        update_sku();
    });

    $('#colors').on('change', function() {
        update_sku();
    });

    $('input[name="unit_price"]').on('keyup', function() {
        update_sku();
    });

    $('input[name="name"]').on('keyup', function() {
        update_sku();
    });

    function delete_row(em){
        $(em).closest('.form-group row').remove();
        update_sku();
    }

    function delete_variant(em){
        $(em).closest('.variant').remove();
    }

    function update_sku(){
        $.ajax({
           type:"POST",
           url:'<?php echo e(route('products.sku_combination')); ?>',
           data:$('#choice_form').serialize(),
           success: function(data) {
                $('#sku_combination').html(data);
                AIZ.uploader.previewGenerate();
                AIZ.plugins.fooTable();
                if (data.length > 1) {
                   $('#show-hide-div').hide();
                }
                else {
                    $('#show-hide-div').show();
                }
           }
       });
    }

    $('#choice_attributes').on('change', function() {
        $('#customer_choice_options').html(null);
        $.each($("#choice_attributes option:selected"), function(){
            add_more_customer_choice_option($(this).val(), $(this).text());
        });

        update_sku();
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/product/products/create.blade.php ENDPATH**/ ?>