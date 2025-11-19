
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update All Title</h5>
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
                                                @include('_message')  

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/all_title_udpate') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   

                                                    <h4>Categories</h4>
                                                
                                                    <br> <br>
                                           
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="categories_title" type="text" placeholder="Title" class="form-control" required value="{{ old('categories_title', !empty($getRecord) ? $getRecord->categories_title : '') }}">
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <h4>Customer Say</h4>
                                                
                                                    <br> <br>
                                           

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="customer_1" type="text" placeholder="Title" class="form-control" required value="{{ old('customer_1', !empty($getRecord) ? $getRecord->customer_1 : '') }}">
                                                        </div>
                                                    </div>

                                                
                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Sub Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="customer_2" type="text" placeholder="Sub Title" class="form-control" required value="{{ old('customer_2', !empty($getRecord) ? $getRecord->customer_2 : '') }}">
                                                        </div>
                                                    </div>

                                                    <hr>
                                                     <h4>Shop Instagram</h4>
                                               
                                                    <br> <br>
                                           

                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="instagram_1" type="text" placeholder="Title" class="form-control" required value="{{ old('instagram_1', !empty($getRecord) ? $getRecord->instagram_1 : '') }}">
                                                        </div>
                                                    </div>


                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Sub Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="instagram_2" type="text" placeholder="Sub Title" class="form-control" required value="{{ old('instagram_2', !empty($getRecord) ? $getRecord->instagram_2 : '') }}">
                                                        </div>
                                                    </div>

                                             
                                                    <div class="clear-both"></div>
                                                    

                                                  
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