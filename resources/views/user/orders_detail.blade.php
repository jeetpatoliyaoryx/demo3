@extends('layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

    <div class="page-title" style="background-image:url({{ url('frontend/images/section/page-title.jpg')}})">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Your Order</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="">Home</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="">My Account</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Your Orders</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-sidebar-account"><button data-bs-toggle="offcanvas" data-bs-target="#mbAccount"><i
                    class="icon icon-squares-four"></i></button></div>
        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                   
                	@include('user.parts._sidebar')

                    <div class="my-account-content order-detail-page">
                        <div class="account-orders">
                            <div class="wrap-account-order">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="fw-6">Product</th>
                                                <th class="fw-6"> QTY</th>
                                                <th class="fw-6">Price</th>
                                                <th class="fw-6">Subtotal</th>
                                             
                                            </tr>
                                        </thead>
                                        <tbody>

                                        	   @foreach($get_order->get_item as $value)
										         <tr>
											       
											            <td>
											            	  <div class="table-item-product">
								                                 <div class="left">
								                                    <div class="img-table">
								                                       <a href="{{ $value->product->getURL() }}" target="_blank">
								                                       <img src="{{ $value->product->photo() }}" style="height: 50px;" data-src="" alt="" class="img-responsive post-image ls-is-cached lazyloaded">
								                                       </a>
								                                    </div>
								                                 </div>
								                                 <div class="right">
								                                    <a style="text-align: left;" href="{{ $value->product->getURL() }}" target="_blank" class="table-product-title">
								                                       {{ $value->product->title }}
								                                    </a>
								                                    <div class="list-item" style="margin-top: 10px;"></div>
								                                    @if(!empty($value->size))
								                                       <div class="list-item">
								                                          <label>Size : </label>
								                                          <strong class="lbl-price">
								                                             {{ $value->size->name }}
								                                           </strong>
								                                       </div>
								                                       @endif
								                                           @if(!empty($value->color))
								                                       <div class="list-item">
								                                          <label>Color : </label>
								                                          <strong class="lbl-price">
								                                             {{ $value->color->name }}
								                                           </strong>
								                                       </div>
								                                       @endif
								                                 </div>
								                              </div>

											            </td>
											            <td>{{ $value->qty }}</td>
											            <td>
											               <strong class="font-600">
											                     ₹{{ number_format($value->price,2) }}
											               </strong>
											            </td>
											            <td>      ₹{{ number_format($value->total,2) }}</td>
											          
											         </tr>
										  @endforeach

                                        {{--     <tr class="tf-order-item">
                                                <td>#123</td>
                                                <td>August 1, 2024</td>
                                                <td>On hold</td>
                                                <td>$200.0 for 1 items</td>
                                                <td><a class="tf-btn btn-fill radius-4" href="my-account-orders-details.html"><span
                                                            class="text">View</span></a></td>
                                            </tr>
                                            --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        

@endsection
@section('script')
<script type="text/javascript">


</script>
@endsection

