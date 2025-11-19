@extends('layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')

<script>
    // Fire Facebook Pixel AddToCart event immediately
    fbq('track', 'InitiateCheckout');
</script>
      
        <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}})">
            <div class="container">
                <h3 class="heading text-center">Check Out</h3>
                <!--<ul class="breadcrumbs d-flex align-items-center justify-content-center">-->
                <!--    <li><a class="link" href="{{ url('/') }}">Home</a></li>-->
                <!--    <li><i class="icon-arrRight"></i></li>-->
                <!--    <li><a class="link" href="">Shop</a></li>-->
                <!--    <li><i class="icon-arrRight"></i></li>-->
                <!--    <li>View Cart</li>-->
                <!--</ul>-->
            </div>
        </div>
        <section>
            <div class="container">
                <form action="{{ url('checkout') }}"  method="post" id="MakePayment">
                      {{ csrf_field() }}
                <div class="row">


                    <div class="col-xl-6">
                        <div class="flat-spacing tf-page-checkout">
                      
                            <div class="wrap">
                                <h5 class="title">Information</h5>
                                <div class="info-box" >


                                    <div class="grid-2">
                                        <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z .]/g, '')"  name="first_name" placeholder="First Name*" required value="{{ old('first_name', !empty($user) ? $user->name : '') }}" />
                                        <input type="text" oninput="this.value = this.value.replace(/[^A-Za-z .]/g, '')" name="last_name" placeholder="Last Name*" value="{{ old('last_name', !empty($user) ? $user->last_name : '') }}" required /></div>
                                    <div class="grid-2">
                                        <input type="email" name="email" placeholder="Email Address*" value="{{ old('email', !empty($user) ? $user->email : '') }}" required=""/>
                                        <input type="text" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)" name="phone_number" placeholder="Phone Number*" value="{{ old('phone_number', !empty($user) ? $user->phone_number : '') }}" required=""/></div>
                                    <div class="tf-select">
                                          @php
                                             $country_id = old('country', !empty($user) ? $user->country_id : '') ;
                                          @endphp

                                        <select class="text-title" id="countries" name="country" required>
                                             <option value="">Select Country</option>
                                                @foreach($getCountry as $value)
                                                <option {{ ($country_id == $value->id) ? "selected" : "" }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="grid-2">
                                        <input type="text" placeholder="Town/City*" name="city" required value="{{ old('city', !empty($user) ? $user->city : '') }}"/>
                                        <input type="text" name="street_address" placeholder="Street,..." value="{{ old('street_address', !empty($user) ? $user->street_address : '') }}" required="" />
                                    </div>
                                    <div class="grid-2">
                                        <input type="text" placeholder="Flat/Other *" name="flat_other" value="{{ old('flat_other', !empty($user) ? $user->flat_other : '') }}" required />
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Postal Code*" name="pin_code" value="{{ old('pin_code', !empty($user) ? $user->pin_code : '') }}" required=""/>
                                    </div>
                                    <textarea placeholder="Write note..."></textarea>

                                    <!-- <div class="tf-select">
                                          <input type="text" placeholder="Referral Code" name="referral_code" value="{{ old('referral_code') }}" />
                                    </div> -->

                                    
                                </div>
                            </div>
                            <div class="wrap">
                                 <h5 class="title">Choose payment Option:</h5> 
                                 <div class="form-payment"> 
                                     <div class="payment-box" id="payment-box">
                                        <div class="payment-item">
                                            <label for="delivery-method" class="payment-header collapsed" data-bs-toggle="collapse"
                                                data-bs-target="#delivery-payment" aria-controls="delivery-payment">
                                                <input type="radio" class="tf-check-rounded" id="delivery-method" value="1" checked name="payment_method" />
                                                <span class="text-title">Online Payment</span>
                                            </label>

                                            <div id="delivery-payment" class="collapse" data-bs-parent="#payment-box">
                                            </div>
                                        </div>
                                
                                    </div>
                                    <br>
                                    <div class="payment-box" id="payment-box">
                                        <div class="payment-item">
                                            <label for="delivery-method" class="payment-header collapsed" data-bs-toggle="collapse"
                                                data-bs-target="#delivery-payment" aria-controls="delivery-payment">
                                                <input type="radio" class="tf-check-rounded" id="delivery-method" value="0" name="payment_method" />
                                                <span class="text-title">Cash On Delivery</span>
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
                                        $subtotal = 0;
                                        $discount = 0; // You can calculate dynamically if you apply coupons
                                        $shipping = 0; // If you charge shipping, update here
                                    @endphp

                                    @foreach(Cart::getContent() as $row)

                                    
                                    @php
                                        $getProduct = App\Models\ProductModel::get_single($row->id);
                                        $lineTotal = $row->price * $row->quantity;
                                        $subtotal += $lineTotal;
                                       
                                        $color_name = App\Models\ProductColorModel::find($row->attributes->color_id);
                                       
                                        $size_name =  App\Models\ProductSizeModel::find($row->attributes->size_id);
                                    @endphp


                                    <div class="item-product"><a class="img-product" href="{{ $getProduct->getURL() }}"><img alt="{{ $getProduct->title }}" loading="lazy"
                                                width="600" height="800" decoding="async" data-nimg="1" src="{{ $getProduct->photo() }}"
                                                style="color: transparent;"></a>
                                        <div class="content-box">
                                            <div class="info"><a class="name-product link text-title" href="{{ $getProduct->getURL() }}">{{ $getProduct->title }}</a>
                                                <div class="variant text-caption-1 text-secondary">
                                                   @if($size_name) <span class="size">{{ $size_name->name }}</span>@endif
                                            @if($color_name) / <span class="color">{{ $color_name->name }}</span>@endif
                                                   </div>
                                            </div>
                                            <div class="total-price text-button"><span class="count">{{ $row->quantity }}</span>X<span class="price">₹{{ number_format($row->price,2) }}</span></div>
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

                                            @php
                                            $totalRazorpay =  number_format(($subtotal - $discount) + $shipping, 2) 
                                            @endphp

                                            
                                    </div>
                                </div>

                            </div>

                            <input type="hidden" name="totalRazorpay" value="{{ $totalRazorpay}}">

                            <br /> 

                           <button id="makePaymentBtn"   style="width: 100%;" type="submit" class="tf-btn btn-reset">Make Payment</button>

                        </div>

                    </div>



                </div>
                </form>

        </div>
        </section>



@endsection
@section('script')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$('body').delegate('#MakePayment', 'submit', function(e){
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "{{ url('checkout') }}",
        data: $('#MakePayment').serialize(),
        dataType: "json",
        success: function (data) {
            if (data.status == false) 
            {
                  Swal.fire({
                    title: 'Error!',
                    text: data.message ?? 'Something went wrong.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
            else
            {
                if(data.type == 2)
                {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = data.redirect_url; // safe redirect after OK
                            }
                        });
                }
                else
                {
                    var options = {
                            "key": data.key,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "My Store",
                            "description": "Order Payment",
                            "order_id": data.order_id, // Razorpay order id
                            "handler": function (response) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('payment.callback') }}",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        db_order_id: data.db_order_id,  // local order id
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                    },
                                 dataType: "json",
                                 {{--    success: function (datas) {
                                       // alert(datas.message);
                                        if (datas.success) {
                                            //window.location.href = "{{ url('cart') }}";
                                             window.location.href = datas.redirect_url; // safe redirect
                                        }
                                    } --}}
                                    success: function (datas) {
                                        if (datas.success) {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: datas.message,
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = datas.redirect_url; // safe redirect after OK
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: datas.message ?? 'Something went wrong.',
                                                icon: 'error',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    }

                                });
                            },
                            "prefill": {
                                "name": "{{ old('first_name', !empty($user) ? $user->name : '') }} {{ old('last_name', !empty($user) ? $user->last_name : '') }}",
                                "email": "{{ old('email', !empty($user) ? $user->email : '') }}",
                                "contact": "{{ old('phone_number', !empty($user) ? $user->phone_number : '') }}"
                            },
                            "theme": {
                                "color": "#F37254"
                            }
                        };

                        var rzp1 = new Razorpay(options);
                        rzp1.open();      
                }
                  
            }

          
        }
    });
});
</script>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const makePaymentBtn = document.getElementById('makePaymentBtn');

    if (makePaymentBtn) {
      makePaymentBtn.addEventListener('click', function () {
        fbq('track', 'Purchase');
        console.log('Pixel Purchase fired ✅');
      });
    }
  });
</script>


<script>
    // Get references
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const paymentBtn = document.getElementById('makePaymentBtn');

    // Function to update button text
    function updateButtonText() {
        const selected = document.querySelector('input[name="payment_method"]:checked').value;
        paymentBtn.textContent = selected === "1" ? "Make Payment" : "Confirm Order";
    }

    // Listen for change event
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', updateButtonText);
    });

    // Set default text based on initial checked option
    updateButtonText();
</script>


@endsection