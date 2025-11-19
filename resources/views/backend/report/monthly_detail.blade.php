@extends('backend.layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Monthly Report - {{ date('F Y', strtotime($year.'-'.$month.'-01')) }}</h5>
                <br>
                <a href="{{ route('admin.report.export', ['year' => $year, 'month' => $month]) }}" class="btn btn-primary">
                    Download Excel
                </a>

            </div>
            <div class="card-body">
               <table class="table table-bordered table-striped">
                    <thead class="table-dark">
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
                                $purchaseTotal = $order->items->sum(function($item) {
                                    return (float)$item->product->purchase_price;
                                });
                                $profit = (float)$order->total - ((float)$order->shipments_price + $purchaseTotal);
                            @endphp
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>₹ {{ number_format($order->total, 2) }}</td>
                                <td>₹ {{ number_format($order->shipments_price, 2) }}</td>
                                <td>₹ {{ number_format($purchaseTotal, 2) }}</td>
                                <td>₹ {{ number_format($profit, 2) }}</td>
                                <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <a href="{{ url('admin/report?year='.$year) }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
