<?php $__env->startSection('content'); ?>
<?php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
?>
<div class="card">
    <form class="" action="" id="sort_orders" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6"><?php echo e(translate('All Orders')); ?></h5>
            </div>

            <div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    <?php echo e(translate('Bulk Action')); ?>

                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" onclick="bulk_delete()"> <?php echo e(translate('Delete selection')); ?></a>
                    <a class="dropdown-item" href="#" onclick="bulk_download()"> <?php echo e(translate('Download Details')); ?></a>
                    <a class="dropdown-item" href="#" onclick="bulk_print()"> <?php echo e(translate('Print Details')); ?></a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal"><?php echo e(translate('Change Order Status')); ?></a>
                </div>
            </div>

            <div class="col-lg-2 ml-auto">
                <select class="form-control aiz-selectpicker" name="delivery_status" id="delivery_status" data-title="Filter by delivery status">
                    <option value="pending" <?php if($delivery_status == 'pending'): ?> selected <?php endif; ?>><?php echo e(translate('Pending')); ?></option>
                    <option value="confirmed" <?php if($delivery_status == 'confirmed'): ?> selected <?php endif; ?>><?php echo e(translate('Confirmed')); ?></option>
                    <option value="picked_up" <?php if($delivery_status == 'picked_up'): ?> selected <?php endif; ?>><?php echo e(translate('Picked Up')); ?></option>
                    <option value="on_the_way" <?php if($delivery_status == 'on_the_way'): ?> selected <?php endif; ?>><?php echo e(translate('On The Way')); ?></option>
                    <option value="delivered" <?php if($delivery_status == 'delivered'): ?> selected <?php endif; ?>><?php echo e(translate('Delivered')); ?></option>
                    <option value="cancelled" <?php if($delivery_status == 'cancelled'): ?> selected <?php endif; ?>><?php echo e(translate('Cancel')); ?></option>
                    <option value="non_delivered" <?php if($delivery_status == 'non_delivered'): ?> selected <?php endif; ?>><?php echo e(translate('Non Delivered')); ?></option>
                    <option value="delivery_cancel" <?php if($delivery_status == 'delivery_cancel'): ?> selected <?php endif; ?>><?php echo e(translate('Delivery Canceled')); ?></option>
                </select>
            </div>
            <div class="col-lg-2">
                <div class="form-group mb-0">
                    <input type="text" class="aiz-date-range form-control" value="<?php echo e($date); ?>" name="date" placeholder="<?php echo e(translate('Filter by date')); ?>" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type Order code & hit Enter')); ?>">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Filter')); ?></button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <!--<th>#</th>-->
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
                        <th><?php echo e(translate('Order Code')); ?></th>
                        <th data-breakpoints="md"><?php echo e(translate('Num. of Products')); ?></th>
                        <th data-breakpoints="md"><?php echo e(translate('Customer')); ?></th>
                        <th data-breakpoints="md"><?php echo e(translate('Amount')); ?></th>
                        <th data-breakpoints="md"><?php echo e(translate('Delivery Status')); ?></th>
                        <th data-breakpoints="md"><?php echo e(translate('Payment Status')); ?></th>
                        <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                        <th><?php echo e(translate('Refund')); ?></th>
                        <?php endif; ?>
                        <th class="text-right" width="15%"><?php echo e(translate('options')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-one" name="id[]" value="<?php echo e($order->id); ?>">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php echo e($order->code); ?><?php if($order->viewed == 0): ?> <span class="badge badge-inline badge-info"><?php echo e(translate('New')); ?></span><?php endif; ?>
                            
                            <?php if($order->delivery_status =='non_delivered'): ?>

                            <span class="badge badge-inline badge-warning"><?php echo e(translate('Non-delivered')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e(count($order->orderDetails)); ?>

                        </td>
                        <td>
                            <?php if($order->user != null): ?>
                            <?php echo e($order->user->name); ?>

                            <?php else: ?>
                            Guest (<?php echo e($order->guest_id); ?>)
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e(single_price($order->grand_total)); ?>

                        </td>
                        <td>
                            <?php
                                $status = $order->delivery_status;
                                if($order->delivery_status == 'cancelled') {
                                    $status = '<span class="badge badge-inline badge-danger">'.translate('Cancelled').'</span>';
                                }else{
                                    $status = '<span class="badge badge-inline badge-info">'.ucfirst(str_replace('_', ' ', $status)).'</span>';
                                }

                            ?>
                            <?php echo $status; ?>

                        </td>
                        <td>
                            <?php if($order->payment_status == 'paid'): ?>
                            <span class="badge badge-inline badge-success"><?php echo e(translate('Paid')); ?></span>
                            <?php else: ?>
                            <span class="badge badge-inline badge-danger"><?php echo e(translate('Unpaid')); ?></span>
                            <?php endif; ?>
                        </td>
                        <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                        <td>
                            <?php if(count($order->refund_requests) > 0): ?>
                            <?php echo e(count($order->refund_requests)); ?> <?php echo e(translate('Refund')); ?>

                            <?php else: ?>
                            <?php echo e(translate('No Refund')); ?>

                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="javascript:void(0)" onclick="print_invoice('<?php echo e(route('invoice.print',$order->id)); ?>')" title="<?php echo e(translate('Print invoice')); ?>">
                            <i class="las la-print"></i>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="<?php echo e(route('all_orders.show', encrypt($order->id))); ?>" title="<?php echo e(translate('View')); ?>">
                                <i class="las la-eye"></i>
                            </a>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="<?php echo e(route('invoice.download', $order->id)); ?>" title="<?php echo e(translate('Download Invoice')); ?>">
                                <i class="las la-download"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="<?php echo e(route('orders.destroy', $order->id)); ?>" title="<?php echo e(translate('Delete')); ?>">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="aiz-pagination">
                <?php echo e($orders->appends(request()->input())->links()); ?>

            </div>

        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Change Status Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <?php echo e(translate('Choose an order status')); ?>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity" id="update_delivery_status" data-container="body">
                        <option value="pending"><?php echo e(translate('Pending')); ?></option>
                        <option value="confirmed"><?php echo e(translate('Confirmed')); ?></option>
                        <option value="picked_up"><?php echo e(translate('Picked Up')); ?></option>
                        <option value="on_the_way"><?php echo e(translate('On The Way')); ?></option>
                        <option value="delivered"><?php echo e(translate('Delivered')); ?></option>
                        <option value="cancelled"><?php echo e(translate('Cancel')); ?></option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="change_status()">Save changes</button>
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

       function change_status() {
           // var data = new FormData($('#order_form')[0]);
           var values = $("[name='id[]']:checked").map(function(){return $(this).val();}).get();
           var type = $("#update_delivery_status").val();
           $.ajax({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               url: "<?php echo e(route('bulk-order-status')); ?>",
               type: 'POST',
               data: {ids:values,status:type},
               success: function (response) {
                   if(response == 1) {
                       location.reload();
                   }
               }
           });
       }

        function bulk_download() {
            var data = new FormData($('#sort_orders')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(route('bulk-order-download')); ?>",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                }
            });
        }

        function bulk_print() {
            var h = $(window).height();
            var w = $(window).width();
            var values = $("[name='id[]']:checked").map(function(){return $(this).val();}).get();
            if(values.length > 0){
                window.open( '<?php echo e(URL('admin/bulk-order-print/')); ?>/'+values, '_blank', 'height='+h+',width='+w+',scrollbars=yes,status=no' );
            }
        }
        function bulk_delete() {
            var data = new FormData($('#sort_orders')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(route('bulk-order-delete')); ?>",
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
        function print_invoice(url){
            var h = $(window).height();
            var w = $(window).width();
            window.open( url, '_blank', 'height='+h+',width='+w+',scrollbars=yes,status=no' );
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kinative-top-face\resources\views/backend/sales/all_orders/index.blade.php ENDPATH**/ ?>