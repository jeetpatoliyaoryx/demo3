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
                            <li><a class="link" href="index.html">Homepage</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="my-account.html">My Account</a></li>
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
                                                <th class="fw-6">Date</th>
                                                <th class="fw-6">Status</th>
                                                <th class="fw-6">Total</th>
                                                <th class="fw-6">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tf-order-item">
                                                <td>#123</td>
                                                <td>August 1, 2024</td>
                                                <td>On hold</td>
                                                <td>$200.0 for 1 items</td>
                                                <td><a class="tf-btn btn-fill radius-4" href="my-account-orders-details.html"><span
                                                            class="text">View</span></a></td>
                                            </tr>
                                            <tr class="tf-order-item">
                                                <td>#345</td>
                                                <td>August 2, 2024</td>
                                                <td>On hold</td>
                                                <td>$300.0 for 1 items</td>
                                                <td><a class="tf-btn btn-fill radius-4" href="my-account-orders-details.html"><span
                                                            class="text">View</span></a></td>
                                            </tr>
                                            <tr class="tf-order-item">
                                                <td>#567</td>
                                                <td>August 3, 2024</td>
                                                <td>On hold</td>
                                                <td>$400.0 for 1 items</td>
                                                <td><a class="tf-btn btn-fill radius-4" href="my-account-orders-details.html"><span
                                                            class="text">View</span></a></td>
                                            </tr>
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