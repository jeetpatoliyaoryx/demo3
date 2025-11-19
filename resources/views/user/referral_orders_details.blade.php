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
                        <h3 class="heading text-center">Order Details</h3>
                        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                            <li><a class="link" href="">Homepage</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="">My Account</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li><a class="link" href="">Yoyr Orders</a></li>
                            <li><i class="icon-arrRight"></i></li>
                            <li>Order Details</li>
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
                        <div class="account-order-details">
                            <div class="wd-form-order">
                                <div class="order-head d-block d-sm-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <figure class="img-product">
                                            <img alt="product" loading="lazy" width="600"
                                                height="800" decoding="async" data-nimg="1" style="color:transparent"
                                                src="{{ $getRecord->product->photo() }}" />
                                        </figure>
                                        <div class="content ps-2">
                                            <div>{{ $getRecord->product_name }}</div>
                                            <h6 class="mt-8 fw-5">Order #{{ $getRecord->id }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="referral-section">
                                    <div class="ref-heading">
                                        <p class="pb-3">Referral Income per code: <b>{{ number_format($getRecord->referralCodes->first()->referral_amount ?? 0,2) }} INR</b></p>
                                      
                                        <div class="refer-box">
                                            <p class="pb-2">  {{ $getRecord->referralCodes->first()->owner ? $getRecord->referralCodes->first()->owner->name : 'User ID '.$getRecord->referralCodes->first()->owner_user_id }} Your referral code:</p>
                         
                                            <div class="d-flex flex-wrap justify-content-between">
                                                
                                                @foreach($getRecord->referralCodes as $ref)
                                                <div class="ref-name col-6 col-sm-3 pe-1 active">
                                                    <h6>{{ $ref->code }}</h6>

                                                      @if($ref->status==1) Used by {{ $ref->usedBy? $ref->usedBy->name : 'User ID '.$ref->used_by_user_id }} on {{ date('d-m-Y', strtotime($ref->used_at)) }}
                                                         @else
                                                            <span>Unused</span>
                                                        @endif
                                                         {{-- <button class="btn-copy" data-code="{{ $ref->code }}">Copy</button> --}}
                                                </div>
                                                @endforeach
                                               
                                            </div>
                                        </div>

                                  @if($getRecord->referralCodes && $getRecord->referralCodes->count() > 0)      
                                    @foreach($getRecord->referralCodes as $ref)  

                                        <div class="refer-box">
                                           @if($ref->usedBy || $ref->used_by_user_id)
                                            <p class="pb-2">
                                                {{ $ref->usedBy ? $ref->usedBy->name : 'User ID '.$ref->used_by_user_id }} Your referral code:
                                            </p>
                                        @endif

                                              <div class="d-flex flex-wrap justify-content-between">
                                             

                                                    @if($ref->childReferrals && $ref->childReferrals->count())
                                                      @foreach($ref->childReferrals as $child)
                                             
                                                <div class="ref-name col-6 col-sm-3 pe-1 active">
                                                
                                                    <h6>{{ $child->code}}</h6>
                                             
                                                        @if($child->status == 1)
                                                            Used by {{ $child->usedBy ? $child->usedBy->name : 'User ID '.$child->used_by_user_id }} 
                                                            on {{ $child->used_at ? date('d-m-Y', strtotime($child->used_at)) : '' }}
                                                        @else
                                                            <span>Unused</span>
                                                        @endif
                                                </div>
                                                  @endforeach
                                                @endif
                                      
                                              
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                   
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

             


                </div>

            </div>
        </section>

@endsection
@section('script')

<script>
document.querySelectorAll('.btn-copy').forEach(btn=>{
    btn.addEventListener('click',()=>{
        navigator.clipboard.writeText(btn.dataset.code);
        alert('Copied: '+btn.dataset.code);
    })
})
</script>

<script type="text/javascript">


</script>
@endsection