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
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="{{ url('/') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Shopping Cart</li>
                </ul>
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
                                                <a class="cart-title link" href="{{ $getProduct->getURL() }}"> {{ $getProduct->title }}    </a>
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
                                        </td>
                                        <td class="text-center item-total">₹{{ number_format($row->price * $row->quantity,2) }}</td>
                                        <td>
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
                                        <label for="check-agree">I agree with the <a href="">terms and
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
                    @include('_message')  
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
@endsection