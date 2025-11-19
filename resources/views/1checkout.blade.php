@extends('layouts.app')

@section('content')

<div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}})">
    <div class="container">
        <h3 class="heading text-center">Checkout</h3>
        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
            <li><a class="link" href="{{ url('/') }}">Home</a></li>
            <li><i class="icon-arrRight"></i></li>
            <li>Checkout</li>
        </ul>
    </div>
</div>

<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <!-- Checkout Left (form / address) -->
            <div class="col-xl-8">
                {{-- Example checkout form --}}
                <form action="{{ url('place_order') }}" method="post">
                    @csrf
                    <h4>Billing Details</h4>
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Shipping Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <!-- Add more fields like phone, city, zip, payment option, etc -->
                </form>
            </div>

            <!-- Checkout Right (order summary) -->
            <div class="col-xl-4">
                <div class="sidebar-checkout-content">
                    <h5 class="title">Shopping Cart</h5>

                    <div class="list-product">
                        @php 
                            $subtotal = 0;
                            $discount = 0; // You can calculate dynamically if you apply coupons
                            $shipping = 0; // If you charge shipping, update here
                        @endphp

                        @foreach(Cart::getContent() as $row)
                            @php
                                $getProduct = App\Models\ProductModel::get_single($row->id);
                                $lineTotal = $row->price * $row->quantity;
                                $subtotal += $lineTotal;
                                
                                $color_name = !empty($row->attributes->color_id) ? 
                                    App\Models\ProductColorModel::get_single($row->attributes->color_id) : null;

                                $size_name = !empty($row->attributes->size_id) ? 
                                    App\Models\ProductSizeModel::get_single($row->attributes->size_id) : null;
                            @endphp

                            <div class="item-product">
                                <a class="img-product" href="{{ $getProduct->getURL() }}">
                                    <img alt="{{ $getProduct->title }}" src="{{ $getProduct->photo() }}" width="80">
                                </a>
                                <div class="content-box">
                                    <div class="info">
                                        <a class="name-product link text-title" href="{{ $getProduct->getURL() }}">
                                            {{ $getProduct->title }}
                                        </a>
                                        <div class="variant text-caption-1 text-secondary">
                                            @if($size_name) <span class="size">{{ $size_name->name }}</span>@endif
                                            @if($color_name) / <span class="color">{{ $color_name->name }}</span>@endif
                                        </div>
                                    </div>
                                    <div class="total-price text-button">
                                        <span class="count">{{ $row->quantity }}</span> × 
                                        <span class="price">₹{{ number_format($row->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="sec-total-price">
                        <div class="top">
                            <div class="item d-flex align-items-center justify-content-between text-button">
                                <span>Shipping</span>
                                <span>{{ $shipping > 0 ? '₹'.number_format($shipping,2) : 'Free' }}</span>
                            </div>
                            <div class="item d-flex align-items-center justify-content-between text-button">
                                <span>Discounts</span>
                                <span>- ₹{{ number_format($discount,2) }}</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <h5 class="d-flex justify-content-between">
                                <span>Total</span>
                                <span class="total-price-checkout">
                                    ₹{{ number_format(($subtotal - $discount) + $shipping, 2) }}
                                </span>
                            </h5>
                        </div>
                    </div>

                    <button type="submit" form="checkoutForm" class="tf-btn btn-reset w-100 mt-3">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
