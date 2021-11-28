@extends('backend.layouts.app')

@section('content')

<div class="row">
	<div class="col-xl-8 mx-auto">
		<div class="aiz-titlebar text-left mt-2 mb-3">
			<div class=" align-items-center">
		       <h1 class="h3">{{translate('Sale Stats')}}</h1>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<span class="h6 mb-0">Sale report</span>
				<form action="" method="GET">
	                <div class="form-group row offset-lg-1">
	                    <div class="col-md-7">
							<div>
								<input type="text" class="aiz-date-range form-control" name="date" value="{{ $date }}" placeholder="Select Date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off" />
							</div>
	                    </div>
	                    <div class="col-md-2">
	                        <button class="btn btn-light" type="submit">{{ translate('Filter') }}</button>
	                    </div>
						<div class="col-md-3">
							<button class="btn btn-light" type="submit" value="export" name="button">{{ translate('Export') }}</button>
	                    </div>
	                </div>
	            </form>
			</div>
			<div class="card-body">
				<div class="row no-gutters border">
					<div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ single_price($net) }}</h4>
							<div class="opacity-60">{{ translate('Net sales') }}</div>
						</div>
					</div>
					<div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ single_price($profit) }}</h4>
							<div class="opacity-60">{{ translate('Net profit') }}</div>
						</div>
					</div>
					<div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ $items }}</h4>
							<div class="opacity-60">{{ translate('Item purchased') }}</div>
						</div>
					</div>
					<div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ $num_orders }}</h4>
							<div class="opacity-60">{{ translate('orders placed') }}</div>
						</div>
					</div>
					<div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ single_price($tax) }}</h4>
							<div class="opacity-60">{{ translate('Total Tax') }}</div>
						</div>
					</div>
					<div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ single_price($shipping) }}</h4>
							<div class="opacity-60">{{ translate('Shipping cost') }}</div>
						</div>
					</div>
					{{-- <div class="com-sm-6 col-lg-4">
						<div class="border px-3 py-4">
							<h4 class="mb-0">{{ single_price($coupon) }}</h4>
							<div class="opacity-60">{{ translate('Coupon used') }}</div>
						</div>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
