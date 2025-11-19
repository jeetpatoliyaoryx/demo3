@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Edit Coupon Code</h5>
                </div>

                <!-- New Product Add Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">
                                                

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">

                                                         <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Coupon Code Name</label>
                                                        <div class="col-sm-10">
                                                          <input value="{{ $getrecord->discount_code }}" name="discount_code" type="text" class="form-control" placeholder="Coupon Code Name" required>
                                                          
                                                        </div>
                                                    </div>

                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Type</label>
                                                        <div class="col-sm-10">
                                                          <select name="type" class="form-control">
                                                            <option {{ ($getrecord->type == '0') ? 'selected' : '' }} value="0">Percentage %</option>
                                                            <option {{ ($getrecord->type == '1') ? 'selected' : '' }} value="1">Amount</option>
                                                         </select>
                                                        </div>
                                                    </div>


                                                    
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                          Coupon Code Price</label>
                                                        <div class="col-sm-10">
                                                          <input value="{{ $getrecord->discount_price }}" name="discount_price" type="text" placeholder="Coupon Code Price" class="form-control" required>
                                                        </div>
                                                    </div>
                                         
 
                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                          Maximum Price</label>
                                                        <div class="col-sm-10">
                                                          <input value="{{ $getrecord->maximum_price }}" name="maximum_price" type="text" placeholder="Maximum Price" class="form-control" required>
                                                        </div>
                                                    </div>
                                                  

                                             
                                                </div>
                                                
                                                <br>
                                                 <div class="panel-footer">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                 </div>

                                            </form>
                                        </div>
                                    </div>

                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New Product Add End -->

           </div>
            <!-- Container-fluid End -->

@endsection
@section('script')
<script type="text/javascript">

     
</script>
@endsection