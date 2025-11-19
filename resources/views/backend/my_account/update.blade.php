
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update My Account</h5>
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

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Name</label>
                                                        <div class="col-sm-10">
                                                          <input name="name" type="text" placeholder="Name" class="form-control" required value="{{ old('name', !empty($getRecord) ? $getRecord->name : '') }}">
                                                        </div>
                                                    </div>


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Email</label>
                                                        <div class="col-sm-10">
                                                          <input name="email" type="email" placeholder="Email ID" class="form-control" required value="{{ old('email', !empty($getRecord) ? $getRecord->email : '') }}">
                                                        </div>
                                                    </div>
                            
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Profile Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="profile_pic" type="file" class="file picimg">  
                                                               @if(!empty($getRecord->profile_pic))
                                                          <img src="{{ $getRecord->getImage() }}" style="height:100px;">
                                                        @endif

                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Password</label>
                                                        <div class="col-sm-10">
                                                          <input name="password" type="password" placeholder="Password" class="form-control" value="">
                                                             (Leave blank if you are not changing the password)
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