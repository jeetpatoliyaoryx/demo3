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
                            <li><a class="link" href="">Homepage</a></li>
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
                            <th>Order</th>
                            <th>Date</th>
                            <th>Total Referral Income</th>
                            <th>Codes Used</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse($getRecord as $value)
                        <tr>
                            <td>#{{ $value->id }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                            <td>{{ number_format($value->referralCodes->sum('referral_amount'),2) }} INR</td>
                            <td>{{ $value->referralCodes->where('status',1)->count() }}/{{ $value->referralCodes->count() }}</td>
                            <td><a href="{{ url('user/referral_orders_details/'.$value->id) }}">View</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Order not found!</td>
                        </tr>
                        @endforelse
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