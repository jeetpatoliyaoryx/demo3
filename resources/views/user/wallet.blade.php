
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
                        <h3 class="heading text-center">Wallet</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="">Home</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="">My Account</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Wallet</li>
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
                            <div class="wallet-text pb-3 pt-1">
                                <div class="d-sm-flex justify-content-between">
                                    <div class="d-flex justify-content-between align-items-center d-sm-block ">
                                        <p>Current Available Balance</p>
                                        <h5>{{ number_format($wallet->balance,2) }} INR</h5>
                                    </div>
                                    <div class="w-amount">
                                        <button class="tf-btn btn-fill w-100 rounded-1" type="submit" data-toggle="modal" data-target="#withdraw">
                                            <span class="text text-button">Withdraw Amount</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="wrap-account-order">
                                <div class="table-responsive">
                                    <table>
                                        <thead>  
                                            <tr>
                                                <th class="fw-6">Product Name</th>
                                                <th class="fw-6">Date</th>
                                                <th class="fw-6">Type</th>
                                                <th class="fw-6">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach($transactions as $t)
                                            <tr class="tf-order-item">
                                            <td>{{ optional($t->product_name)->title ?? 'Withdraw' }}</td>


                                                <td>{{ date('d-m-Y', strtotime($t->created_at)) }}</td>
                                                <td>{{ ucfirst($t->type) }}</td>
                                                <td>{{ $t->amount }}</td>
                                                
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


   <div class="modal" tabindex="-1" role="dialog" id="withdraw">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdraw</h5>
                    <button type="button" class="close py-0 px-3" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('wallet.withdraw') }}" method="POST">
                    @csrf
                    <div class="modal-body d-flex flex-column align-items-center">
                        <p class="pb-2">Withdraw Amount</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="pe-2">INR</span>
                            <input type="number" 
                                   name="amount" 
                                   class="form-control w-1000 text-center" 
                                   placeholder="Enter Amount" 
                                   min="1" 
                                   max="{{ $wallet->balance }}" 
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 d-flex flex-column">
                        <button type="submit" class="btn-fill w-100 rounded-1 justify-content-center">Submit</button>
                        <button type="button" class="btn-outline w-100 rounded-1 justify-content-center" data-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection