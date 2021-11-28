<table>
    <thead>
        <tr>
            <th>Order Code</th>
            <th>Product</th>
            <th>Variant</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Tax</th>
            <th>Shipping Cost</th>
            <th>Profit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            @foreach ($order->orderDetails as $orderDetail)
                <tr>
                        <td>{{ $order->code }}</td>
                        <td>
                            @if ($orderDetail->product != null)
                                {{ $orderDetail->product->name }}
                            @endif
                        </td>
                        <td>{{ $orderDetail->variation }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ $orderDetail->price }}</td>
                        <td>{{ $orderDetail->tax }}</td>
                        <td>{{ $orderDetail->shipping_cost }}</td>
                        <td>{{ $orderDetail->profit }}</td>
                    </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
