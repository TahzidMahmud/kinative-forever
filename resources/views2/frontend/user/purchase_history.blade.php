@extends('frontend.layouts.user_panel')

@section('panel_content')
    <h5 class="mb-5 h4">{{ translate('Purchase History') }}</h5>
    @if (count($orders) > 0)
        @foreach ($orders as $key => $order)
            <div class="card shadow-none">
                <div class="card-header">
                    <span>
                        <div class="text-primary c-pointer fs-15 fw-600" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</div>
                        <div>{{ date('d-m-Y', $order->date) }}</div>
                    </span>
                    <span>
                        @if ($order->orderDetails->first()->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('orders.destroy', $order->id)}}" title="{{ translate('Cancel') }}">
                               <i class="las la-times"></i>
                           </a>
                        @endif
                        <a href="javascript:void(0)" class="btn btn-soft-info btn-icon btn-circle btn-sm" onclick="show_purchase_history_details({{ $order->id }})" title="{{ translate('Order Details') }}">
                            <i class="las la-eye"></i>
                        </a>
                        <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('invoice.download', $order->id) }}" title="{{ translate('Download Invoice') }}">
                            <i class="las la-download"></i>
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="py-4">
                        {{ renderOrderSteps($order->delivery_status) }}
                    </div>
                    @if (count($order->orderDetails) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($order->orderDetails as $key => $orderDetail)
                        <li class="list-group-item">
                            <div class="row gutters-5">
                                <div class="col-lg-6">
                                    @if ($orderDetail->product != null)
                                        <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-reset d-flex">
                                            <img src="{{ uploaded_asset($orderDetail->product->thumbnail_img) }}" class="flex-shrink-0 size-40px mr-3">
                                            <span>
                                                <div>{{ $orderDetail->product->getTranslation('name') }}</div>
                                                <div>{{ $orderDetail->variation }}</div>
                                            </span>
                                        </a>
                                    @else
                                        <strong>{{  translate('Product Unavailable') }}</strong>
                                    @endif
                                </div>
                                <div class="col-lg-3">
                                    <span class="opacity-60">{{ translate('QTY') }}:</span>
                                    <span class="fw-600">{{ $orderDetail->quantity }}</span>
                                </div>
                                <div class="col-lg-3">
                                    <span class="fw-600">{{ translate(ucfirst(str_replace('_', ' ', $orderDetail->delivery_status))) }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        @endforeach
    <div class="aiz-pagination">
        {{ $orders->links() }}
    </div>
    @endif
@endsection

@section('modal')
    @include('modals.delete_modal')

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection
