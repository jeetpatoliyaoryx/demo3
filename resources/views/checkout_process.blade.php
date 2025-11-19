@extends('layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')


      
        <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}})">
            <div class="container">
                <h3 class="heading text-center">Check Out</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="{{ url('/') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="">Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>View Cart</li>
                </ul>
            </div>
        </div>
        <section>
            <div class="container">
                
                
                <div class="row">


                    <div class="col-xl-6">
                        <div class="flat-spacing tf-page-checkout">
                      
                            <div class="wrap">
                                <h5 class="title">Information</h5>
                                <div class="info-box" >
                                   
                                    <div class="grid-2">
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^A-Za-z .]/g, '')"  name="first_name" placeholder="First Name*" required value="{{ old('first_name', !empty($user) ? $user->name : '') }}" />
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^A-Za-z .]/g, '')" name="last_name" placeholder="Last Name*" value="{{ old('last_name', !empty($user) ? $user->last_name : '') }}" required /></div>
                                    <div class="grid-2">
                                        <input type="email" readonly name="email" placeholder="Email Address*" value="{{ old('email', !empty($user) ? $user->email : '') }}" required=""/>
                                        <input type="text" readonly maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)" name="phone_number" placeholder="Phone Number*" value="{{ old('phone_number', !empty($user) ? $user->phone_number : '') }}" required=""/></div>
                               {{--      <div class="tf-select">
                                          @php
                                             $country_id = old('country', !empty($user) ? $user->country_id : '') ;
                                          @endphp

                                        <select  class="text-title" id="countries" name="country" required>
                                             <option value="">Select Country</option>
                                                @foreach($getCountry as $value)
                                                <option {{ ($country_id == $value->id) ? "selected" : "" }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="grid-2">
                                        <input readonly type="text" placeholder="Town/City*" name="city" required value="{{ old('city', !empty($user) ? $user->city : '') }}"/>
                                        <input readonly type="text" name="street_address" placeholder="Street,..." value="{{ old('street_address', !empty($user) ? $user->street_address : '') }}" required="" /></div>
                                    <div class="grid-2">
                                        <input readonly type="text" placeholder="Flat/Other *" name="flat_other" value="{{ old('flat_other', !empty($user) ? $user->flat_other : '') }}" required />
                                        <input readonly type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Postal Code*" name="pin_code" value="{{ old('pin_code', !empty($user) ? $user->pin_code : '') }}" required=""/>
                                    </div>
                                    <textarea readonly placeholder="Write note..."></textarea>
                                </div>
                            </div>

                            <div class="wrap">
                                 <h5 class="title">Choose payment Option:</h5> 
                                 <div class="form-payment"> 
                                     <div class="payment-box" id="payment-box">
                                        <div class="payment-item">
                                            <label for="delivery-method" class="payment-header collapsed" data-bs-toggle="collapse"
                                                data-bs-target="#delivery-payment" aria-controls="delivery-payment">
                                                <input type="radio" class="tf-check-rounded" id="delivery-method" name="payment-method" />
                                                <span class="text-title">Online Payment</span>
                                            </label>
                                            <div id="delivery-payment" class="collapse" data-bs-parent="#payment-box">
                                            </div>
                                        </div>
                                
                                    </div>
                                   
                                 </div> 
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-1">
                        <div class="line-separation"></div>
                    </div>


                    <div class="col-xl-5">
                        <div class="flat-spacing flat-sidebar-checkout">
                            <div class="sidebar-checkout-content">
                                <h5 class="title">Shopping Cart</h5>
                                <div class="list-product">
                                    @php 
                                        $subtotal = $getOrder->total;
                                        $discount = 0; // You can calculate dynamically if you apply coupons
                                        $shipping = 0; // If you charge shipping, update here
                                    @endphp

                                    @foreach($getOrder->get_item as $row)
                                    @php
                                        $getProduct = $row->product;
                                        $color_name = !empty($row->color) ? $row->color->name : '';
                                        $size_name = !empty($row->size) ? $row->size->name : '';
                                    @endphp

                                    <div class="item-product"><a class="img-product" href="{{ $getProduct->getURL() }}"><img alt="{{ $getProduct->title }}" loading="lazy"
                                                width="600" height="800" decoding="async" data-nimg="1" src="{{ $getProduct->photo() }}"
                                                style="color: transparent;"></a>
                                        <div class="content-box">
                                            <div class="info"><a class="name-product link text-title" href="{{ $getProduct->getURL() }}">{{ $getProduct->title }}</a>
                                                <div class="variant text-caption-1 text-secondary">
                                                   @if($size_name) <span class="size">{{ $size_name }}</span>@endif
                                            @if($color_name) / <span class="color">{{ $color_name }}</span>@endif
                                                   </div>
                                            </div>
                                            <div class="total-price text-button"><span class="count">{{ $row->qty }}</span>X<span class="price">₹{{ number_format($row->price,2) }}</span></div>
                                        </div>
                                    </div>
                                         @endforeach

                        
                                </div>
                     
                                <div class="sec-total-price">
                                    <div class="top">
                                        <div class="item d-flex align-items-center justify-content-between text-button">
                                            <span>Shipping</span><span>{{ $shipping > 0 ? '₹'.number_format($shipping,2) : 'Free' }}</span>
                                        </div>
                                        <div class="item d-flex align-items-center justify-content-between text-button">
                                            <span>Discounts</span><span>- ₹{{ number_format($discount,2) }}</span>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <h5 class="d-flex justify-content-between"><span>Total</span>
                                            <span class="total-price-checkout"> ₹{{ number_format(($subtotal - $discount) + $shipping, 2) }}</span></h5>
                                            
                                    </div>
                                </div>

                            </div>




        <br />
      

        <form action="{{ url('payment/callback') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order_tbl_id }}">
            <input type="hidden" name="referral_code" value="{{ $referral_code }}">    
            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ config('services.razorpay.key') }}"
                data-order_id="{{ $razorpayOrderId }}"
                data-amount="{{ $totalRazorpay * 100 }}"
                data-currency="INR"
                data-buttontext="Pay Now"
                data-name="My Store"
                data-description="Order Payment"
                data-prefill.name="{{ old('first_name', !empty($user) ? $user->name : '') }}"
                data-prefill.email="{{ old('email', !empty($user) ? $user->email : '') }}"
                data-prefill.contact="{{ old('phone_number', !empty($user) ? $user->phone_number : '') }}"
                data-theme.color="#F37254">
            </script>
        </form>



                        </div>

                    </div>



                </div>





                              

            </div>
        </section>


@endsection
@section('script')


@endsection