@extends('backend.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/select2.min.css') }}">
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Edit Catologue</h5>
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
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="catalogue_name" type="text" placeholder="Title" class="form-control" required value="{{ $editRecord->catalogue_name }}">
                                                        </div>
                                                    </div>
                                               
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0"> Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="catalogue_image" type="file" class="file picimg">  
                                                          @if(!empty($editRecord->catalogue_image))
                                                          <img src="{{ $editRecord->getCatalogueImage() }}" style="height:100px;"> <br>
                                                          @endif
                                                            <span class="pt-2 highlight-text">(<b>Important:-</b> Please upload an image with resolution of exactly 1440×548 px.)</span>
                                                        </div>
                                                    </div>


                                                     <div class="row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Select Product Name</label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100" name="product_id[]" required multiple="multiple">
                                                                 <option value="">Select Product</option>
                                                                 @foreach($ProductCatalogue as $value)
                                                                 <option value="{{ $value->id }}" 
                                                                        @if(in_array($value->id, $selectedProducts)) selected @endif>
                                                                        {{ $value->title }}
                                                                    </option>
                                                                  @endforeach
                                                            </select>
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



<script src="{{ url('backend/assets/js/select2.min.js') }}"></script>
<script src="{{ url('backend/assets/js/select2-custom.js') }}"></script>

<script type="text/javascript">

     
</script>
@endsection