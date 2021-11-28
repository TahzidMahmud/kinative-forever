<?php if(isset($category_id)): ?>
    <?php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    ?>
<?php elseif(isset($brand_id)): ?>
    <?php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    ?>
<?php else: ?>
    <?php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    ?>
<?php endif; ?>

<?php $__env->startSection('meta_title'); ?><?php echo e($meta_title); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description'); ?><?php echo e($meta_description); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e($meta_title); ?>">
    <meta itemprop="description" content="<?php echo e($meta_description); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="<?php echo e($meta_title); ?>">
    <meta name="twitter:description" content="<?php echo e($meta_description); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e($meta_title); ?>" />
    <meta property="og:description" content="<?php echo e($meta_description); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="mb-4 pt-3">
        <div class="container sm-px-0">
            <form class="" id="search-form" action="" method="GET">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                            <div class="collapse-sidebar c-scrollbar-light text-left">
                                <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                    <h3 class="h6 mb-0 fw-600"><?php echo e(translate('Filters')); ?></h3>
                                    <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" >
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>
                                <div class="bg-white shadow-sm rounded mb-3">
                                    <div class="fs-15 fw-600 p-3 border-bottom">
                                        <?php echo e(translate('Categories')); ?>

                                    </div>
                                    <div class="p-3">
                                        <ul class="list-unstyled">
                                            <?php if(!isset($category_id)): ?>
                                                <?php $__currentLoopData = \App\Category::where('level', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="mb-2 ml-2">
                                                        <a class="text-reset fs-14" href="<?php echo e(route('products.category', $category->slug)); ?>"><?php echo e($category->getTranslation('name')); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="<?php echo e(route('search')); ?>">
                                                        <i class="las la-angle-left"></i>
                                                        <?php echo e(translate('All Categories')); ?>

                                                    </a>
                                                </li>
                                                <?php if(\App\Category::find($category_id)->parent_id != 0): ?>
                                                    <li class="mb-2">
                                                        <a class="text-reset fs-14 fw-600" href="<?php echo e(route('products.category', \App\Category::find(\App\Category::find($category_id)->parent_id)->slug)); ?>">
                                                            <i class="las la-angle-left"></i>
                                                            <?php echo e(\App\Category::find(\App\Category::find($category_id)->parent_id)->getTranslation('name')); ?>

                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                                <li class="mb-2">
                                                    <a class="text-reset fs-14 fw-600" href="<?php echo e(route('products.category', \App\Category::find($category_id)->slug)); ?>">
                                                        <i class="las la-angle-left"></i>
                                                        <?php echo e(\App\Category::find($category_id)->getTranslation('name')); ?>

                                                    </a>
                                                </li>
                                                <?php $__currentLoopData = \App\Utility\CategoryUtility::get_immediate_children_ids($category_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="ml-4 mb-2">
                                                        <a class="text-reset fs-14" href="<?php echo e(route('products.category', \App\Category::find($id)->slug)); ?>"><?php echo e(\App\Category::find($id)->getTranslation('name')); ?></a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bg-white shadow-sm rounded mb-3">
                                    <div class="fs-15 fw-600 p-3 border-bottom">
                                        <?php echo e(translate('Price range')); ?>

                                    </div>
                                    <div class="p-3">
                                        <div class="aiz-range-slider">
                                            <div
                                                id="input-slider-range"
                                                data-range-value-min="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->min('unit_price')); ?> <?php endif; ?>"
                                                data-range-value-max="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->max('unit_price')); ?> <?php endif; ?>"
                                            ></div>

                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                        <?php if(isset($min_price)): ?>
                                                            data-range-value-low="<?php echo e($min_price); ?>"
                                                        <?php elseif($products->min('unit_price') > 0): ?>
                                                            data-range-value-low="<?php echo e($products->min('unit_price')); ?>"
                                                        <?php else: ?>
                                                            data-range-value-low="0"
                                                        <?php endif; ?>
                                                        id="input-slider-range-value-low"
                                                    ></span>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                        <?php if(isset($max_price)): ?>
                                                            data-range-value-high="<?php echo e($max_price); ?>"
                                                        <?php elseif($products->max('unit_price') > 0): ?>
                                                            data-range-value-high="<?php echo e($products->max('unit_price')); ?>"
                                                        <?php else: ?>
                                                            data-range-value-high="0"
                                                        <?php endif; ?>
                                                        id="input-slider-range-value-high"
                                                    ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white shadow-sm rounded mb-3">
                                    <div class="fs-15 fw-600 p-3 border-bottom">
                                        <?php echo e(translate('Filter by color')); ?>

                                    </div>
                                    <div class="p-3">
                                        <div class="aiz-radio-inline">
                                            <?php $__currentLoopData = $all_colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="<?php echo e(\App\Color::where('code', $color)->first()->name); ?>">
                                                <input
                                                    type="radio"
                                                    name="color"
                                                    value="<?php echo e($color); ?>"
                                                    onchange="filter()"
                                                    <?php if(isset($selected_color) && $selected_color == $color): ?> checked <?php endif; ?>
                                                >
                                                <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                    <span class="size-30px d-inline-block rounded" style="background: <?php echo e($color); ?>;"></span>
                                                </span>
                                            </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(\App\Attribute::find($attribute['id']) != null): ?>
                                        <div class="bg-white shadow-sm rounded mb-3">
                                            <div class="fs-15 fw-600 p-3 border-bottom">
                                                <?php echo e(translate('Filter by')); ?> <?php echo e(\App\Attribute::find($attribute['id'])->getTranslation('name')); ?>

                                            </div>
                                            <div class="p-3">
                                                <div class="aiz-checkbox-list">
                                                    <?php if(array_key_exists('values', $attribute)): ?>
                                                        <?php $__currentLoopData = $attribute['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $flag = false;
                                                                if(isset($selected_attributes)){
                                                                    foreach ($selected_attributes as $key => $selected_attribute) {
                                                                        if($selected_attribute['id'] == $attribute['id']){
                                                                            if(in_array($value, $selected_attribute['values'])){
                                                                                $flag = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                            <label class="aiz-checkbox">
                                                                <input
                                                                    type="checkbox"
                                                                    name="attribute_<?php echo e($attribute['id']); ?>[]"
                                                                    value="<?php echo e($value); ?>" <?php if($flag): ?> checked <?php endif; ?>
                                                                    onchange="filter()"
                                                                >
                                                                <span class="aiz-square-check"></span>
                                                                <span><?php echo e($value); ?></span>
                                                            </label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">

                        <ul class="breadcrumb bg-transparent p-0">
                            <li class="breadcrumb-item opacity-50">
                                <a class="text-reset" href="<?php echo e(route('home')); ?>"><?php echo e(translate('Home')); ?></a>
                            </li>
                            <?php if(!isset($category_id)): ?>
                                <li class="breadcrumb-item fw-600  text-dark">
                                    <a class="text-reset" href="<?php echo e(route('search')); ?>">"<?php echo e(translate('All Categories')); ?>"</a>
                                </li>
                            <?php else: ?>
                                <li class="breadcrumb-item opacity-50">
                                    <a class="text-reset" href="<?php echo e(route('search')); ?>"><?php echo e(translate('All Categories')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(isset($category_id)): ?>
                                <li class="text-dark fw-600 breadcrumb-item">
                                    <a class="text-reset" href="<?php echo e(route('products.category', \App\Category::find($category_id)->slug)); ?>">"<?php echo e(\App\Category::find($category_id)->getTranslation('name')); ?>"</a>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <div class="text-left">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h1 class="h6 fw-600 text-body">
                                        <?php if(isset($category_id)): ?>
                                            <?php echo e(\App\Category::find($category_id)->getTranslation('name')); ?>

                                        <?php elseif(isset($query)): ?>
                                            <?php echo e(translate('Search result for ')); ?>"<?php echo e($query); ?>"
                                        <?php else: ?>
                                            <?php echo e(translate('All Products')); ?>

                                        <?php endif; ?>
                                    </h1>
                                </div>
                                <div class="form-group ml-auto mr-0 w-200px d-none d-xl-block">
                                    <label class="mb-0 opacity-50"><?php echo e(translate('Brands')); ?></label>
                                    <select class="form-control form-control-sm aiz-selectpicker" data-live-search="true" name="brand" onchange="filter()">
                                        <option value=""><?php echo e(translate('All Brands')); ?></option>
                                        <?php $__currentLoopData = \App\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($brand->slug); ?>" <?php if(isset($brand_id)): ?> <?php if($brand_id == $brand->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($brand->getTranslation('name')); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group w-200px ml-0 ml-xl-3">
                                    <label class="mb-0 opacity-50"><?php echo e(translate('Sort by')); ?></label>
                                    <select class="form-control form-control-sm aiz-selectpicker" name="sort_by" onchange="filter()">
                                        <option value="newest" <?php if(isset($sort_by)): ?> <?php if($sort_by == 'newest'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Newest')); ?></option>
                                        <option value="oldest" <?php if(isset($sort_by)): ?> <?php if($sort_by == 'oldest'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Oldest')); ?></option>
                                        <option value="price-asc" <?php if(isset($sort_by)): ?> <?php if($sort_by == 'price-asc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Price low to high')); ?></option>
                                        <option value="price-desc" <?php if(isset($sort_by)): ?> <?php if($sort_by == 'price-desc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Price high to low')); ?></option>
                                    </select>
                                </div>
                                <div class="d-xl-none ml-auto ml-xl-3 mr-0 form-group align-self-end">
                                    <button type="button" class="btn btn-icon p-0" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                        <i class="la la-filter la-2x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="min_price" value="">
                        <input type="hidden" name="max_price" value="">
                        <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col">
                                    <?php echo $__env->make('frontend.partials.product_box_1',['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="aiz-pagination aiz-pagination-center mt-4">
                            <?php echo e($products->links()); ?>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/frontend/product_listing.blade.php ENDPATH**/ ?>