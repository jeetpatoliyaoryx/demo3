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

                    <div class="my-account-content">
                        <div class="account-orders">
                            <div class="wrap-account-order">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="fw-6">Order</th>
                                                <th class="fw-6">QTY</th>
                                                <th class="fw-6">Total</th>
                                                <th class="fw-6">Delivery Status</th>
                                                <th class="fw-6">Payment Status</th>
                                                <th class="fw-6">Date</th>
                                                <th class="fw-6">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        	 @forelse($get_order as $value)
										         <tr>
											            <td>#{{ $value->id }}</td>
											            <td>{{ $value->total_qty }}</td>
											            <td><span>₹</span>{{ number_format($value->total, 2) }}</td>
											            <td>
											               <strong class="font-600">
											                  {{ $value->getStatus->name }}
											               </strong>
											            </td>
                                                        <td>
                                                             @if($value->payment_method == 'Razorpay')
                                                                 <strong class="font-600">
                                                              Online
                                                           </strong>
                                                            @elseif($value->payment_method == 'Cash')
                                                          <strong class="font-600">
                                                              COD
                                                           </strong>
                                                            @endif

                                                         
                                                          
                                                        </td>
											            <td>{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</td>
											            
                                                        <td class="d-flex flex-column">
											               <a class="text-center" href="{{ url('user/orders/details/'.base64_encode($value->id)) }}" 
                                                               style="color:#fff; background:#000; padding:6px 12px; border-radius:4px; text-decoration:none;">
                                                               Track Order
                                                            </a>

											               <a class="text-center mt-3" href="{{ url('user/orders/details/'.base64_encode($value->id)) }}" 
                                                               style="color:#fff; background:#000; padding:6px 12px; border-radius:4px; text-decoration:none;">
                                                               View Details
                                                            </a>

											            </td>
											         </tr>
											         @empty
											         <tr>
											            <td colspan="100%">Order not found!</td>
											         </tr>
											         @endforelse

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