<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Order Confirmation</title>

    <style>
        body {
            background: #000;
            color: #fff !important;
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 750px;
            margin: auto;
            padding: 20px;
            background: #111;
        }

        h2,
        h3,
        p,
        td,
        th {
            color: #fff !important;
        }

        .box {
            background: #1b1b1b;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #333;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            background: #1b1b1b;
        }

        .order-table th {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #333;
            font-size: 15px;
            color: #ffd447 !important;
        }

        .order-table td {
            padding: 10px;
            border-bottom: 1px solid #222;
            color: #fff !important;
        }

        .order-item img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .total td {
            font-weight: bold;
            font-size: 16px;
        }

        .section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 30px;
        }

        .billing-address,
        .shipping-address {
            width: 48%;
            background: #1b1b1b;
            padding: 15px;
            border-radius: 10px;
        }

        h3 {
            color: #ffd447 !important;
            margin-bottom: 10px;
        }

        .track-btn {
            display: block;
            width: 180px;
            margin: 30px auto;
            text-align: center;
            padding: 12px 0;
            background: #ffd447;
            color: #000 !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 30px;
        }

        .header {
            text-align: center;
            padding: 20px;
            background: #1b1b1b;
        }

        .header {
            color: #ffd447 !important;
            margin: 0;
        }

        .footer {
            text-align: center;
            padding: 25px 10px;
            color: #ffffff;
            font-size: 14px;
            background: #111111;
        }
    </style>
</head>

<body>

    <table width="100%" role="presentation" cellpadding="0" cellspacing="0">
        <!-- HEADER -->
  

        <tr>
            <td>
                <div class="container">

                <h1 class="header" style="
                text-align:center;
                background:#000;
                padding:25px 0;
                margin:0 0 25px 0;
                color:#ffd447;
                font-size:26px;
                font-weight:600;
                    ">
                    YourStore.ina
                </h1>

                    <h2 style="color:#ffd447 !important;">Order Confirmed ✨</h2>

                    <p>
                        Hi <strong>{{ $order->first_name }} {{ $order->last_name }}</strong>,
                        your order <strong>#YS{{ $order->id }}</strong> has been confirmed successfully.
                    </p>

                    <div class="box">
                        <p><strong>Order Date:</strong> {{ date('M d, Y', strtotime($order->created_at)) }}</p>
                        <p><strong>Payment:</strong> {{ $order->payment_method }} {{ ucfirst($order->payment_status) }}
                        </p>
                        <p><strong>Delivery:</strong> Expected by {{ date('M d, Y', strtotime('+5 days')) }}</p>
                    </div>

                    <!-- ORDER TABLE -->
                    <table class="order-table" role="presentation">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($items as $item)
                                @php
                                    $imageRow = $item->product->image->first() ?? null;
                                    $imgFile = $imageRow->small ?? $imageRow->name ?? $imageRow->orignal ?? null;

                                    $imgUrl = $imgFile
                                        ? url('upload/' . $item->product_id . '/' . $imgFile)
                                        : url('/no-image.png');

                                    $itemPrice = (float) $item->price;
                                    $itemQty = (int) $item->qty;
                                    $itemSubtotal = number_format($itemQty * $itemPrice, 2);

                                    $productName = $item->product->title ?? $item->product->name ?? 'Product';
                                @endphp

                                <tr class="order-item">

                                    <td>
                                        <img src="{{ $imgUrl }}" alt="Product">
                                    </td>

                                    <td>{{ $productName }}</td>

                                    <td>{{ $itemQty }}</td>

                                    <td>₹{{ $itemSubtotal }}</td>

                                </tr>

                            @endforeach

                            <tr class="total">
                                <td colspan="3" align="right">Total:</td>
                                <td align="right">
                                    ₹{{ number_format($order->final_total ?? $order->total, 2) }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- BILLING + SHIPPING -->
                    <div class="section">
                        <div class="billing-address">
                            <h3>Billing Address</h3>
                            <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p>{{ $order->street_address }}{{ $order->flat_other ? ', ' . $order->flat_other : '' }}</p>
                            <p>{{ $order->city }}, {{ $order->state }} {{ $order->pin_code }}</p>
                            <p>{{ $order->country->name ?? '' }}</p>
                        </div>

                        <div class="shipping-address">
                            <h3>Shipping Address</h3>
                            <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p>{{ $order->street_address }}{{ $order->flat_other ? ', ' . $order->flat_other : '' }}</p>
                            <p>{{ $order->city }}, {{ $order->state }} {{ $order->pin_code }}</p>
                            <p>{{ $order->country->name ?? '' }}</p>
                        </div>
                    </div>

                    <!-- TRACK ORDER BUTTON -->
                    <a href="{{ route('admin.orders.track', $order->id) }}" class="track-btn">Track Order</a>

                    <div class="footer" style="
    text-align: center;
    padding: 25px 10px;
    color: #ffffff;
    font-size: 14px;
    background: #111111;
    margin-top:40px;
    border-top:1px solid #222;
">
                        <p style="margin: 0 0 6px; color:#ffffff;">
                            Need help? Contact us:
                        </p>

                        <p style="margin: 0 0 10px; color:#ffffff;">
                            📧
                            <a href="mailto:{{ config('mail.from.address') ?? 'support@yourstore.in' }}"
                                style="color:#f4c542; text-decoration:none;">
                                {{ config('mail.from.address') ?? 'support@yourstore.in' }}
                            </a>
                            <br>

                            💬
                            <a href="https://wa.me/919999999999"
                                style="color:#f4c542; text-decoration:none;">WhatsApp</a> |

                            📸
                            <a href="https://instagram.com/yourstore"
                                style="color:#f4c542; text-decoration:none;">Instagram</a>
                            |

                            👍
                            <a href="https://facebook.com/yourstore"
                                style="color:#f4c542; text-decoration:none;">Facebook</a>
                        </p>

                        <p style="margin: 10px 0 0; color:#aaaaaa; font-size:13px;">
                            © {{ date('Y') }} YourStore.in — All Rights Reserved
                        </p>
                    </div>



                </div>
            </td>
        </tr>

    </table>

</body>

</html>