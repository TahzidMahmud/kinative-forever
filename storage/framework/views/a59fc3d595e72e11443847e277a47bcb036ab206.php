<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3"><?php echo e(translate('All products')); ?></h1>
        </div>
        <?php if($type != 'Seller'): ?>
        <div class="col text-right">
            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-circle btn-info">
                <span><?php echo e(translate('Add New Product')); ?></span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<br>

<div class="card">
    <form class="" id="sort_products" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6"><?php echo e(translate('All Product')); ?></h5>
            </div>
            
            <div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    <?php echo e(translate('Bulk Action')); ?>

                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" onclick="bulk_delete()"> <?php echo e(translate('Delete selection')); ?></a>
                </div>
            </div>
            
            <?php if($type == 'Seller'): ?>
            <!-- <div class="col-md-2 ml-auto">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()">
                    <option value=""><?php echo e(translate('All Sellers')); ?></option>
                    <?php $__currentLoopData = App\Seller::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($seller->user != null && $seller->user->shop != null): ?>
                            <option value="<?php echo e($seller->user->id); ?>" <?php if($seller->user->id == $seller_id): ?> selected <?php endif; ?>><?php echo e($seller->user->shop->name); ?> (<?php echo e($seller->user->name); ?>)</option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div> -->
            <?php endif; ?>
            <?php if($type == 'All'): ?>
            <!-- <div class="col-md-2 ml-auto">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()">
                    <option value=""><?php echo e(translate('All Sellers')); ?></option>
                        <?php $__currentLoopData = App\User::where('user_type', '=', 'admin')->orWhere('user_type', '=', 'seller')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($seller->id); ?>" <?php if($seller->id == $seller_id): ?> selected <?php endif; ?>><?php echo e($seller->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div> -->
            <?php endif; ?>
            <div class="col-md-2 ml-auto">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="category_id" data-selected="<?php echo e($category_id); ?>" onchange="sort_products()">
                    <option value=""><?php echo e(translate('All Category')); ?></option>
                        <?php $__currentLoopData = App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" ><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="brand_id" data-selected="<?php echo e($brand_id); ?>" onchange="sort_products()">
                    <option value=""><?php echo e(translate('All Brand')); ?></option>
                        <?php $__currentLoopData = App\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brand->id); ?>" ><?php echo e($brand->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type" onchange="sort_products()">
                    <option value=""><?php echo e(translate('Sort By')); ?></option>
                    <option value="rating,desc" <?php if(isset($col_name , $query)): ?> <?php if($col_name == 'rating' && $query == 'desc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Rating (High > Low)')); ?></option>
                    <option value="rating,asc" <?php if(isset($col_name , $query)): ?> <?php if($col_name == 'rating' && $query == 'asc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Rating (Low > High)')); ?></option>
                    <option value="num_of_sale,desc"<?php if(isset($col_name , $query)): ?> <?php if($col_name == 'num_of_sale' && $query == 'desc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Num of Sale (High > Low)')); ?></option>
                    <option value="num_of_sale,asc"<?php if(isset($col_name , $query)): ?> <?php if($col_name == 'num_of_sale' && $query == 'asc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Num of Sale (Low > High)')); ?></option>
                    <option value="unit_price,desc"<?php if(isset($col_name , $query)): ?> <?php if($col_name == 'unit_price' && $query == 'desc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Base Price (High > Low)')); ?></option>
                    <option value="unit_price,asc"<?php if(isset($col_name , $query)): ?> <?php if($col_name == 'unit_price' && $query == 'asc'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Base Price (Low > High)')); ?></option>
                </select>
            </div>
            <div class="col-md-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control form-control-sm" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type & Enter')); ?>">
                </div>
            </div>
        </div>
    
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </th>
                        <!--<th data-breakpoints="lg">#</th>-->
                        <th><?php echo e(translate('Name')); ?></th>
                        <th data-breakpoints="sm"><?php echo e(translate('Info')); ?></th>
                        <th data-breakpoints="md"><?php echo e(translate('Stock - Price')); ?></th>
                        <th data-breakpoints="lg"><?php echo e(translate('Todays Deal')); ?></th>
                        <th data-breakpoints="lg"><?php echo e(translate('Published')); ?></th>
                        <th data-breakpoints="lg"><?php echo e(translate('Featured')); ?></th>
                        <th data-breakpoints="sm" class="text-right"><?php echo e(translate('Options')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <!--<td><?php echo e(($key+1) + ($products->currentPage() - 1)*$products->perPage()); ?></td>-->
                        <td>
                            <div class="form-group d-inline-block">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" class="check-one" name="id[]" value="<?php echo e($product->id); ?>">
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="row gutters-5 w-200px w-md-300px mw-100">
                                <div class="col-auto">
                                    <img src="<?php echo e(uploaded_asset($product->thumbnail_img)); ?>" alt="Image" class="size-50px img-fit">
                                </div>
                                <div class="col">
                                    <span class="text-muted text-truncate-2"><?php echo e($product->getTranslation('name')); ?></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong><?php echo e(translate('Added by')); ?>:</strong> <?php echo e($product->user->name); ?>  </br>
                            <strong><?php echo e(translate('Num of Sale')); ?>:</strong> <?php echo e($product->num_of_sale); ?> <?php echo e(translate('times')); ?> </br>
                            <!-- <strong><?php echo e(translate('Base Price')); ?>:</strong> <?php echo e(single_price($product->unit_price)); ?> </br> -->
                            <strong><?php echo e(translate('Rating')); ?>:</strong> <?php echo e($product->rating); ?> </br>
                        </td>
                        <td>
                            <?php
                                if($product->variant_product) {
                                    foreach ($product->stocks as $key => $stock) {
                                        echo $stock->variant.' - '.$stock->qty.' - '.single_price($stock->price);
                                        if($stock->qty <= $product->low_stock_quantity){
                                            echo '<span class="badge badge-inline badge-danger">Low</span>';
                                        }
                                        echo '<br>';
                                    }
                                }
                                else {
                                    //$qty = $product->current_stock;
                                    $qty = optional($product->stocks->first())->qty;
                                    echo $qty.' - '.single_price(optional($product->stocks->first())->price);
                                    if($qty <= $product->low_stock_quantity){
                                        echo '<span class="badge badge-inline badge-danger">Low</span>';
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_todays_deal(this)" value="<?php echo e($product->id); ?>" type="checkbox" <?php if ($product->todays_deal == 1) echo "checked"; ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_published(this)" value="<?php echo e($product->id); ?>" type="checkbox" <?php if ($product->published == 1) echo "checked"; ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_featured(this)" value="<?php echo e($product->id); ?>" type="checkbox" <?php if ($product->featured == 1) echo "checked"; ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td class="text-right">
                            <div class="dropdown">
                                <button class="btn p-0" type="button" data-toggle="dropdown">
                                    <i class="las la-ellipsis-v la-2x opacity-60"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item p-0">
                                            <a class="text-reset d-block px-4 py-2" onclick="quick_update(this)" data-href="<?php echo e(route('products.quick_update',$product->id)); ?>" href="javascript:void(0)" title="<?php echo e(translate('Quick Update')); ?>">
                                                <?php echo e(translate('Quick Update')); ?>

                                            </a>
                                        </li>
                                        <li class="list-group-item p-0">
                                            <a class="text-reset d-block px-4 py-2"  href="<?php echo e(route('product', $product->slug)); ?>" target="_blank" title="<?php echo e(translate('View')); ?>">
                                                <?php echo e(translate('View')); ?>

                                            </a>
                                        </li>
                                        <li class="list-group-item p-0">
                                            <?php if($type == 'Seller'): ?>
                                                <a class="text-reset d-block px-4 py-2" href="<?php echo e(route('products.seller.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )); ?>" title="<?php echo e(translate('Edit')); ?>">
                                                    <?php echo e(translate('Edit')); ?>

                                                </a>
                                            <?php else: ?>
                                                <a class="text-reset d-block px-4 py-2" href="<?php echo e(route('products.admin.edit', ['id'=>$product->id, 'lang'=>env('DEFAULT_LANGUAGE')] )); ?>" title="<?php echo e(translate('Edit')); ?>">
                                                    <?php echo e(translate('Edit')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </li>
                                        <li class="list-group-item p-0">
                                            <a class="text-reset d-block px-4 py-2" href="<?php echo e(route('products.duplicate', ['id'=>$product->id, 'type'=>$type]  )); ?>" title="<?php echo e(translate('Duplicate')); ?>">
                                                <?php echo e(translate('Duplicate')); ?>

                                            </a>
                                        </li>
                                        <li class="list-group-item p-0">
                                            <a href="#" class="text-reset d-block px-4 py-2 confirm-delete" data-href="<?php echo e(route('products.destroy', $product->id)); ?>" title="<?php echo e(translate('Delete')); ?>">
                                                <?php echo e(translate('Delete')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="aiz-pagination">
                <?php echo e($products->appends(request()->input())->links()); ?>

            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="modal fade" tabindex="-1" id="show-details-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(translate('Quick Update')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="show-details-modal-body">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        
        $(document).on("change", ".check-all", function() {
            if(this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;                       
                });
            }
          
        });

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function quick_update(e){
            $('#show-details-modal').modal('show');
            $('#show-details-modal-body').html(null).html('<div class="text-center"><div class="mb-0 spinner-border spinner-border-sm text-primary border-gray-700"></div></div>');
            $.ajax({
                type:"GET",
                url:$(e).data('href'),
                success: function(data) {
                    $('#show-details-modal-body').html(data);
                    setTimeout(function(){
                        // AIZ.plugins.fooTable();
                    }, 500);
                }
           });
        }

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('products.todays_deal')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '<?php echo e(translate('Todays Deal updated successfully')); ?>');
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('products.published')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '<?php echo e(translate('Published products updated successfully')); ?>');
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('products.featured')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '<?php echo e(translate('Featured products updated successfully')); ?>');
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }
        
        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(route('bulk-product-delete')); ?>",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/product/products/index.blade.php ENDPATH**/ ?>