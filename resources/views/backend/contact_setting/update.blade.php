
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update Contact</h5>
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

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/contact_setting_update') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Map Link</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="map_link" type="text" placeholder="Map Link" class="form-control" required>{{ old('map_link', !empty($getRecord) ? $getRecord->map_link : '') }}</textarea>
                                                        </div>
                                                    </div>


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="title" type="text" placeholder="Title" class="form-control" required value="{{ old('title', !empty($getRecord) ? $getRecord->title : '') }}">
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Sub Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="sub_title" type="text" placeholder="Sub Title" class="form-control" required value="{{ old('sub_title', !empty($getRecord) ? $getRecord->sub_title : '') }}">
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Information</label>
                                                        <div class="col-sm-10">
                                                          <input name="information" type="text" placeholder="Information" class="form-control" required value="{{ old('information', !empty($getRecord) ? $getRecord->information : '') }}">
                                                        </div>
                                                    </div>
                                

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Phone</label>
                                                        <div class="col-sm-10">
                                                          <input name="phone" type="text" placeholder="Phone" class="form-control" required value="{{ old('phone', !empty($getRecord) ? $getRecord->phone : '') }}">
                                                        </div>
                                                    </div>



                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Phone Number</label>
                                                        <div class="col-sm-10">
                                                          <input name="phone_number" type="text" placeholder="Phone Number" class="form-control" required value="{{ old(' phone_number', !empty($getRecord) ? $getRecord->phone_number : '') }}">
                                                        </div>
                                                    </div>
                                                
                                                 <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Email</label>
                                                        <div class="col-sm-10">
                                                          <input name="email" type="text" placeholder="Email" class="form-control" required value="{{ old(' email', !empty($getRecord) ? $getRecord->email : '') }}">
                                                        </div>
                                                    </div>
                                                
                                                 <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Email ID</label>
                                                        <div class="col-sm-10">
                                                          <input name="email_id" type="email" placeholder="Email ID"  class="form-control" required value="{{ old(' email_id', !empty($getRecord) ? $getRecord->email_id : '') }}">
                                                        </div>
                                                    </div>
                                                
                                                          <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Address</label>
                                                        <div class="col-sm-10">
                                                          <input name="address" type="text" placeholder="Address"  class="form-control" required value="{{ old(' address', !empty($getRecord) ? $getRecord->address : '') }}">
                                                        </div>
                                                    </div>
                                             

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Address Full</label>
                                                        <div class="col-sm-10">
                                                          <input name="address_full" type="text" placeholder="Address Full"  class="form-control" required value="{{ old(' address_full', !empty($getRecord) ? $getRecord->address_full : '') }}">
                                                        </div>
                                                    </div>  

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Open Time</label>
                                                        <div class="col-sm-10">
                                                          <input name="open_time" type="text" placeholder="Open Time"  class="form-control" required value="{{ old(' open_time', !empty($getRecord) ? $getRecord->open_time : '') }}">
                                                        </div>
                                                    </div>
                                                
                                                           <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Open Time 1</label>
                                                        <div class="col-sm-10">
                                                          <input name="open_time_1" type="text" placeholder="Open Time 1"  class="form-control" required value="{{ old(' open_time_1', !empty($getRecord) ? $getRecord->open_time_1 : '') }}">
                                                        </div>
                                                    </div>  

                                                        <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Open Time 2</label>
                                                        <div class="col-sm-10">
                                                          <input name="open_time_2" type="text" placeholder="Open Time 2"  class="form-control" required value="{{ old(' open_time_2', !empty($getRecord) ? $getRecord->open_time_2 : '') }}">
                                                        </div>
                                                    </div>
                                             
                                             
                                                    <div class="clear-both"></div>
                                                    <div id="uploadError" style="margin-top:10px; display:none"></div>
                                                 <div id="uploadSuccess" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>


                                                  
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