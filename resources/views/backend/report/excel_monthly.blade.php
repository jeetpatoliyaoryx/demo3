<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Total</th>
            <th>Shipment Price</th>
            <th>Purchase Price</th>
            <th>Profit</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            @php
                $purchaseTotal = $order->items->sum(fn($item) => (float)$item->product->purchase_price);
                $profit = (float)$order->total - ((float)$order->shipments_price + $purchaseTotal);
            @endphp
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->shipments_price }}</td>
                <td>{{ $purchaseTotal }}</td>
                <td>{{ $profit }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
