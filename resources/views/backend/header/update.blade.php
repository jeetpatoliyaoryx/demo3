
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update Header</h5>
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

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/header_udpate') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   
                                           
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
                                                        <label class="form-label-title col-sm-2 mb-0">Logo </label>
                                                        <div class="col-sm-10">
                                                            <input name="logo" type="file" class="file picimg">  
                                                             @if(!empty($getRecord->favicon_icon))
                                                          <img src="{{ $getRecord->getLogo() }}" style="height:100px; width: 80px;">
                                                        @endif

                                                        </div>
                                                    </div>

                                                        <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Favicon Icon </label>
                                                        <div class="col-sm-10">
                                                            <input name="favicon_icon" type="file" class="file picimg">  
                                                             @if(!empty($getRecord->favicon_icon))
                                                          <img src="{{ $getRecord->getFaviconLogo() }}" style="height:100px; width: 80px;">
                                                        @endif
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