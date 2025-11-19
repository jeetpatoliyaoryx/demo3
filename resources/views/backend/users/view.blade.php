@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')

   <!-- tracking section start -->
            <div class="page-body">
                <div class="title-header title-header-block package-card">
                    <div>
                        <h5>Your Id #{{ $getRecord->id }}</h5>
                    </div>
                   
                </div>

                <!-- tracking table start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="bg-inner cart-section order-details-table">
                                        <div class="row g-4">
                                         	
                                         	 <div class="col-xl-6">
                                                <div class="order-success">
                                                    <div class="row g-4">
                                                        <h4>Information</h4>
                                                        <ul class="order-details">
                                                            <li>First Name: {{ $getRecord->name }}</li>
                                                            <li>Last Name: {{ $getRecord->last_name }}</li>
                                                            <li>Email: {{ $getRecord->email }}</li>
                                                            <li>Phone Number: {{ $getRecord->phone_number }}</li>
                                                            <li>Street Address: {{ $getRecord->street_address }}</li>
                                                            <li>Flat Other: {{ $getRecord->flat_other }}</li>
                                                            <li>State: {{ $getRecord->state }}</li>
                                                            <li>City: {{ $getRecord->city }}</li>
                                                            <li>Pin Code: {{ $getRecord->pin_code }}</li>
                                                        </ul>
                                                     
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-xl-6">
                                                <div class="order-success">
                                                    <div class="row g-4">
                                                        <h4>Bank Details</h4>
                                                        <ul class="order-details">
                                                            <li>Holder Name: {{ $getRecord->holder_name }}</li>
                                                            <li>Bank Name: {{ $getRecord->bank_name }}</li>
                                                            <li>IFSC Code: {{ $getRecord->ifsc_code }}</li>
                                                            <li>Account Number: {{ $getRecord->account_number }}</li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div> -->

                                        </div>
                                    </div>
                                    <!-- section end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tracking table end -->
            </div>


@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection