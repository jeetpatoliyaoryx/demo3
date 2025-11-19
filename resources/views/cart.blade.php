@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

@if(!empty(Cart::getContent()->count()))


      <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}} )">
            <div class="container">
                <h3 class="heading text-center">Shopping Cart</h3>
                <!--<ul class="breadcrumbs d-flex align-items-center justify-content-center">-->
                <!--    <li><a class="link" href="{{ url('/') }}">Home</a></li>-->
                <!--    <li><i class="icon-arrRight"></i></li>-->
                <!--    <li>Shopping Cart</li>-->
                <!--</ul>-->
            </div>
        </div>
        <section class="flat-spacing">
            <div class="container">
                     @php
                    $rowi = 1;
                    @endphp
                   <form action="{{ url('update_cart') }}" id="SubmitForm" method="post">
                        {{ csrf_field() }}
                <div class="row">
                    <!-- Cart Info (left side) -->
                 
                    <div class="col-xl-8">
                        
        
                        <!-- Cart Table -->
                        <div id="cartForm">
                            <table class="tf-table-page-cart">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cartBody">
                                    <!-- Product 1 -->
                                
                                    @foreach(Cart::getContent() as $row)

                                   
                                    @php
                                  $getProduct = App\Models\ProductModel::get_single($row->id);

                                  // $color_name = null;
                    //   $size_name = null;

                                        $color_name = App\Models\ProductColorModel::find($row->attributes->color_id);
                                        $size_name =  App\Models\ProductSizeModel::find($row->attributes->size_id);

                                        // $color_name = App\Models\ProductColorModel::where('product_id', '=', $row->id)->first();
                                        // $size_name = App\Models\ProductSizeModel::where('product_id', '=', $row->id)->first();

                                  @endphp

                                       
                                       <input type="hidden" name="cart[{{$rowi}}][rowid]" value="{{ $row->id }}">

                                  
                                    <tr class="tf-cart-item">
                                        <td class="tf-cart-item_product">
                                            <a class="img-box" href="{{ $getProduct->getURL() }}">
                                                <img src="{{ $getProduct->photo() }}" width="80" alt="V-neck T-shirt"  data-src="{{ $getProduct->photo() }}" alt="{{ $getProduct->title }}">
                                            </a>
                                            <div class="cart-info">
                                                <div class="cart-title-wrap">
                                                    <a class="cart-title link" href="{{ $getProduct->getURL() }}">
                                                        {{ $getProduct->title }}
                                                    </a>
                                                    <span class="item-price"> :- ₹{{ number_format($row->price, 2) }}</span>
                                                </div>

                                                <div class="variant-box">
                                                    @if(!empty($size_name))
                                                    <div class="list-item">
                                                        <label>Size : </label>
                                                        <strong class="lbl-price">{{ $size_name->name }}</strong>
                                                    </div>
                                                    @endif  

                                                    @if(!empty($color_name))
                                                    <div class="list-item">
                                                        <label>Color : </label>
                                                        <strong class="lbl-price">{{ $color_name->name }}</strong>
                                                    </div>
                                                    @endif 
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center price">₹{{ number_format($row->price,2) }}</td>
                                        <td class="tf-cart-item_quantity">
                                            <div class="wg-quantity mx-md-auto">
                                                <span class="btn-quantity btn-decrease">-</span>
                                                <input class="quantity-product" readonly type="text" value="{{ $row->quantity }}" name="cart[{{$rowi}}][qty]">
                                                <span class="btn-quantity btn-increase">+</span>
                                            </div>
                                            <a href="{{ url('remove/'.$row->id) }}" class="btn-remove">X</a>
                                        </td>
                                        <td class="text-center item-total">₹{{ number_format($row->price * $row->quantity,2) }}</td>
                                        <td class="close-remove">
                                           <a href="{{ url('remove/'.$row->id) }}" class="px-3 py-2 btn btn-danger btn-sm">X</a>
                                        </td>
                                    </tr>
                                      @php
                                     $rowi++;
                                  @endphp
                                    @endforeach        
        
                                
        
                                </tbody>
                            </table>
        

                        </div>

                        <!-- Empty Cart Message -->
                        <div id="emptyCartMessage" class="text-center mt-4" style="display:none;">
                            <div>Your wishlist is empty. Start adding your favorite products to save them for later!</div>
                          
                        </div>
                    </div>
        
                    <!-- Order Summary (right side) -->
                    <div class="col-xl-4">
                        <div class="fl-sidebar-cart">
                            <div class="box-order bg-surface">
                                <h5 class="title">Order Summary</h5>
                                <div class="subtotal text-button d-flex justify-content-between align-items-center">
                                    <span>Subtotal</span><span class="total" id="subtotal">₹0.00</span>
                                </div>
                            
                                <h5 class="total-order d-flex justify-content-between align-items-center">
                                    <span>Total</span><span class="total" id="grandTotal">$0.00</span>
                                </h5>
                                <div class="box-progress-checkout">
                                    <fieldset class="check-agree">
                                        {{-- <input type="checkbox" id="check-agree" class="tf-check-rounded" required> --}}
                                        <label for="check-agree">I agree with the <a href="{{ url('terms') }}">terms and
                                                conditions</a></label>
                                    </fieldset>
                                     {{-- <a class="tf-btn btn-reset" href="{{ url('checkout') }}">Process To Checkout</a> --}}
                                    
                                      <button type="submit" class="tf-btn btn-reset">
                                                    <span>Process To Checkout </span>
                                       </button>

                                    <p class="text-button text-center">Or
                                        <a href="{{ url('/') }}">continue shopping</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                                    </form>
            </div>
        </section>


@else

      <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}} )">
            <div class="container">
                    {{-- @include('_message')   --}}
                <h3 class="heading text-center">Your Shopping Cart Is Empty!</h3>
            </div>
        </div>

@endif


@endsection
@section('script')
<script type="text/javascript">
  $('body').delegate('.update-cart', 'click', function() {
         setTimeout(function() {
               $('#SubmitForm').submit();
         }, 800);
   });

</script>




<script>
(function() {
    // Wait until DOM ready
    document.addEventListener("DOMContentLoaded", function () {
        const cartBody = document.getElementById("cartBody");
        if (!cartBody) return;

        // First, remove any existing cart listener to avoid duplicates
        cartBody.replaceWith(cartBody.cloneNode(true)); // resets old attached listeners
        const newCartBody = document.getElementById("cartBody");

        newCartBody.addEventListener("click", function(e) {
            const btn = e.target;
            if (!btn.classList.contains("btn-increase") && !btn.classList.contains("btn-decrease")) return;

            e.stopPropagation(); // prevent bubbling to main.js

            const row = btn.closest("tr.tf-cart-item");
            if (!row) return;

            const input = row.querySelector("input.quantity-product");
            if (!input) return;

            let qty = parseInt(input.value) || 1;
            const unitPrice = parseFloat(row.querySelector(".price").textContent.replace(/[₹,]/g, "")) || 0;

            if (btn.classList.contains("btn-increase")) qty++;
            if (btn.classList.contains("btn-decrease") && qty > 1) qty--;

            input.value = qty;

            // Update totals
            const itemTotal = unitPrice * qty;
            row.querySelector(".item-total").textContent =
                "₹" + itemTotal.toLocaleString("en-IN", { minimumFractionDigits: 2 });

            let subtotal = 0;
            newCartBody.querySelectorAll(".item-total").forEach(td => {
                subtotal += parseFloat(td.textContent.replace(/[₹,]/g, "")) || 0;
            });

            document.getElementById("subtotal").textContent   = "₹" + subtotal.toLocaleString("en-IN", { minimumFractionDigits: 2 });
            document.getElementById("grandTotal").textContent = "₹" + subtotal.toLocaleString("en-IN", { minimumFractionDigits: 2 });
        });
    });
})();
</script>




@endsection