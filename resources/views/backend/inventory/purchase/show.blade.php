<div>
	<div class="row mb-4">
		<div class="col-sm-6">
			<h5 class="mb-3 fs-16 opacity-60">Invoice Number:</h5>
			<h3 class="text-dark mb-1 fs-16">{{ $purchase->invoice_number }}</h3>
		</div>
		<div class="col-sm-6 ">
			<h5 class="mb-3 fs-16 opacity-60">Supplier:</h5>
			<h3 class="text-dark mb-1 fs-18">{{ optional($purchase->inventory_supplier)->name }}</h3>
			<div>{{ optional($purchase->inventory_supplier)->contact_person }}</div>
			<div>{{ optional($purchase->inventory_supplier)->phone }}</div>
			<div>{{ optional($purchase->inventory_supplier)->email }}</div>
			<div>{{ optional($purchase->inventory_supplier)->address }}</div>
		</div>
	</div>
	<div class="table-responsive-sm">
		<table class="table table-striped aiz-table">
			<thead>
				<tr>
					<th class="center">#</th>
					<th>Product</th>
					<th class="right">Selling Price</th>
					<th class="right">Buying Price</th>
					<th class="center">Qty</th>
					<th class="right">Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($purchase->inventory_stock as $key => $stock)
					<tr>
						<td class="center">{{ $key+1 }}</td>
						<td class="left strong">{{ $stock->product_stock->product->name }} <span class="badge badge-inline badge-soft-secondary">{{ $stock->product_stock->variant }}</span></td>
						<td class="right">{{ single_price($stock->unit_selling_price) }}</td>
						<td class="right">{{ single_price($stock->unit_purchase_price) }}</td>
						<td class="center">{{ $stock->purchased_qty }}</td>
						<td class="right">{{ $stock->total_purchase_price }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col-lg-4 col-sm-5">
		</div>
		<div class="col-lg-4 col-sm-5 ml-auto">
			<table class="table table-clear">
				<tbody>
					<tr>
						<td class="left">
							<strong class="text-dark">Paid</strong>
						</td>
						<td class="right">{{ single_price($purchase->paid) }}</td>
					</tr>
					<tr>
						<td class="left">
							<strong class="text-dark">Due</strong>
						</td>
						<td class="right">{{ single_price($purchase->due) }}</td>
					</tr>
					<tr>
						<td class="left">
							<strong class="text-dark">Total</strong>
						</td>
						<td class="right">
							<strong class="text-dark">{{ single_price($purchase->total) }}</strong>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>