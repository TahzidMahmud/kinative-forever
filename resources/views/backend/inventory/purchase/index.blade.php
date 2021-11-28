@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">{{translate('All product purchase history')}}</h1>
        </div>
        <div class="col text-right">
            <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#add-new-modal">
                <span>{{translate('Add New Purchase')}}</span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <form class="" id="sort_products" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">{{ translate('All list') }}</h5>
            </div>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Invoice Number')}}</th>
                        <th data-breakpoints="md">{{translate('Supplier')}}</th>
                        <th data-breakpoints="sm">{{translate('Prices')}}</th>
                        <th data-breakpoints="lg">{{translate('Purchase Date')}}</th>
                        <th data-breakpoints="sm" class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $key => $purchase)
                    <tr>
                        <td>{{ ($key+1) + ($purchases->currentPage() - 1)*$purchases->perPage() }}</td>
                        <td>{{ $purchase->invoice_number }}</td>
                        <td>{{ optional($purchase->inventory_supplier)->name }} ({{optional($purchase->inventory_supplier)->phone}})</td>
                        <td>
                            Total: {{ $purchase->total }}<br>
                            Paid: {{ $purchase->paid }}<br>
                            Due: {{ $purchase->due }}<br>
                        </td>
                        <td>{{ $purchase->created_at }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="javascript:void(0)" onclick="show_details(this)" data-href="{{ route('inventory-purchase.show', $purchase->id) }}" title="{{ translate('Edit') }}">
                                <i class="las la-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $purchases->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>
@endsection
@section('modal')
<div class="modal fade" tabindex="-1" id="add-new-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate('Purchase details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventory-purchase.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Supplier <span class="text-danger">*</span></label>
                        <select class="form-control aiz-selectpicker" name="supplier" data-live-search="true" title="{{ translate('Select a supplier') }}" required="">
                            @foreach($suppliers as $key => $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name.' - '.$supplier->contact_person.' - '.$supplier->phone}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Invoice Number</label>
                        <input type="text" class="form-control" name="invoice_number" >
                    </div>
                    <div class="row align-items-end gutters-5">
                        <div class="col-xl">
                            <div class="form-group mb-0 mt-2">
                                <label>Product</label>
                                <select
                                    class="form-control aiz-selectpicker"
                                    name="contact_person"
                                    data-live-search="true"
                                    title="{{ translate('Select a product') }}"
                                    id="product_id"
                                >
                                    @foreach($products as $key => $product)
                                        <option
                                            data-content='<span class="d-flex minw-0"><span class="flex-grow-1 text-truncate mr-2">{{ $product->name }}</span><span class="badge badge-soft-secondary badge-inline ml-auto">{{ $product->variant }}</span></span>'
                                            value="{{ $product->stock_id }}"
                                            data-price="{{ $product->price }}"
                                        ></option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0 mt-2">
                                <label>Purchase Price</label>
                                <input type="number" class="form-control" name="phone" id="purchase_price">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0 mt-2">
                                <label>Selling Price</label>
                                <input type="number" class="form-control" name="phone" id="selling_price">
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group mb-0 mt-2">
                                <label>Qty</label>
                                <input type="number" class="form-control" name="phone" value="1" id="product_qty">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="align-items-center btn btn-icon btn-primary d-flex justify-content-center" type="button" onclick="add_product(this)">
                                <i class="las la-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="border-top border-bottom py-4 my-4" id="product_list">

                    </div>

                    <div class="row gutters-5">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>Paid</label>
                                <input type="number" class="form-control" name="paid" onchange="update_price()" value="0" required>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>Due</label>
                                <input type="number" class="form-control" name="due" value="0" readonly="">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>Total</label>
                                <input type="number" class="form-control" name="total" value="0" readonly="">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-primary" type="submit">{{ translate('Add') }}</button>
                    </div>                  

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="show-details-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate('Purchase details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="show-details-modal-body">
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        
        function add_product(e){
            $(e).attr('disabled',true).html(`<div class="mb-0 spinner-border spinner-border-sm text-primary"></div>`);
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find(":selected").data('content');
            var purchase_price = $('#purchase_price').val();
            var selling_price = $('#selling_price').val();
            var product_qty = $('#product_qty').val();

            purchase_price = (purchase_price == '') ? 0 : purchase_price;
            selling_price = (selling_price == '') ? 0 : selling_price;
            product_qty = (product_qty == '') ? 0 : product_qty;

            if(product_id == ''){
                AIZ.plugins.notify('warning', '{{ translate('Please select a product') }}');
                $(e).attr('disabled',false).html(`<i class="las la-plus"></i>`);
                return;
            }
            $('#product_list').append(
                `<div class="row gutters-5 product-row">
                    <div class="col-xl">
                        <div class="form-group">
                            <input type="hidden" class="form-control product_id" value="${ product_id }" name="product_ids[]">
                            <div class="form-control bg-light">${ product_name }</div>
                        </div>   
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <input type="number" class="form-control purchase_price" value="${ purchase_price }" name="purchase_prices[]" onchange="update_price()" required>
                        </div>                            
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <input type="number" class="form-control selling_price" value="${ selling_price }" name="selling_prices[]" required>
                        </div>                            
                    </div>
                    <div class="col-xl-2">
                        <div class="form-group">
                            <input type="number" class="form-control product_qty" value="${ product_qty }" name="product_qtys[]" onchange="update_price()" required>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" data-toggle="remove-parent" class="btn btn-icon p-0" data-parent=".row">
                            <i class="la-2x la-trash las opacity-70"></i>
                        </button>
                    </div>
                </div>`
            );


            $('#purchase_price').val();
            $('#selling_price').val();
            $('#product_qty').val();

            $(e).attr('disabled',false).html(`<i class="las la-plus"></i>`);
            update_price();
        }

        function update_price(){
            let paid = Number($('[name="paid"]').val());
            let due = 0;
            let total = 0;

            $('.product-row').each(function(e){
                total += Number($(this).find('[name="purchase_prices[]"]').val()) * Number($(this).find('[name="product_qtys[]"]').val());
            });
            console.log(total)
            $('[name="total"]').val(total);
            $('[name="due"]').val(total - paid);
        }

        function show_details(e){
            // $(e).
            $('#show-details-modal').modal('show');
            $('#show-details-modal-body').html(null).html('<div class="text-center"><div class="mb-0 spinner-border spinner-border-sm text-primary border-gray-700"></div></div>');
            $.ajax({
                type:"GET",
                url:$(e).data('href'),
                success: function(data) {
                    $('#show-details-modal-body').html(data);
                    setTimeout(function(){
                        AIZ.plugins.fooTable();
                    }, 500);
                }
           });
        }

    </script>
@endsection