
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
                        <h3 class="heading text-center">Withdraw History</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="">Homepage</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="">My Account</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Withdraw History</li>
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

                    <div class="m-wallet my-account-content">
                        <div class="account-orders">
                        
                            <div class="wrap-account-order">
                                <div class="table-responsive">
                                    <table>
                                        <thead>  
                                            <tr>
                                            
                                                <th class="fw-6">Date</th>
                                                <th class="fw-6">Status</th>
                                                <th class="fw-6">Amount</th>
                                                <th class="fw-6">Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach($getRecord as $t)
                                            <tr class="tf-order-item">
                                                <td>{{ date('d-m-Y', strtotime($t->created_at)) }}</td>
                                                <td>@if($t->type == 1)
                                                        Pending
                                                    @elseif($t->type == 2)
                                                        Withdraw
                                                    @elseif($t->type == 3)
                                                        Rejected
                                                    @endif
                                                </td>
                                                 
                                                <td>{{ $t->amount }}</td>
                                                 <td>
                                                           {{ $t->reason }}  
                                                        </td>
                                            </tr>
                                            @endforeach
                                            
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