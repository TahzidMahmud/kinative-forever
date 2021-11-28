<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
		body{
			font-size: 0.875rem;
            font-family: 'san-serif';
            font-weight: normal;
            text-align: left;
			padding:0;
			margin:0; 
		}
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		table{
			width: 100%;
			border: 1px solid #ddd;
            text-align: left;
		}
		.table-bordered>tbody>tr>td,
		.table-bordered>tbody>tr>th,
		.table-bordered>tfoot>tr>td,
		.table-bordered>tfoot>tr>th,
		.table-bordered>thead>tr>td,
		.table-bordered>thead>tr>th{
			border-left: 1px solid #ddd;
			border-right: 1px solid #ddd;
			border-top: 1px solid #ddd;
			border-bottom: 1px solid #ddd;
		}
		.table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
		    border-bottom-width: 2px;
		}
		table th{
			font-weight: normal;
			text-align:left;
		}
		table.padding th{
			padding: 1rem;
		}
		table.padding td{
			padding: 1;
		}
		.text-center{
			text-align:center;
		}
	</style>
</head>
<body>
	<div>
		<table clas="table-bordered padding">
			<thead>
				<tr>
					<th width="40%">Name</th>
					<th width="20%">Image</th>
					<th width="20%">Order Number</th>
					<th width="20%" class="text-center">Quantity</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $key => $order)
					@foreach($order->orderDetails as $key => $orderDetail)
						@if($orderDetail->product)
						<tr>
							<td>{{ $orderDetail->product->name }}</td>
							<td>
								<img src="{{ uploaded_asset($orderDetail->product->thumbnail_img) }}" style="height: 60px;width: 60px">
							</td>
							<td>{{ $order->code }}</td>
							<td class="text-center">{{ $orderDetail->quantity }}</td>
						</tr>
						@endif
					@endforeach
				@endforeach
			</tbody>
		</table>
	</div>

	<script type="text/javascript">
        try { this.print(); } catch (e) { window.onload = window.print; }
        window.onbeforeprint = function() {
            setTimeout(function(){
                window.close();
            }, 1500);
        }
    </script>
</body>