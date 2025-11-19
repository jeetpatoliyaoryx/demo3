
@extends('backend.layouts.app')
@section('style')

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Introduction Section</h5>
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

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/about_image_udpate') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="image" type="file" class="file picimg">  
                                                             @if(!empty($getRecord->image))
                                                          <img src="{{ $getRecord->getImage() }}" style="height:100px; width: 80px;">
                                                        @endif

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
                                                            Facebook Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="facebook_title" type="text" placeholder="Facebook Title" class="form-control" required value="{{ old('facebook_title', !empty($getRecord) ? $getRecord->facebook_title : '') }}">
                                                        </div>
                                                    </div>

                                               

                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Facebook Sub Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="facebook_sub_title" type="text" placeholder="Facebook Sub Title" class="form-control" required value="{{ old('facebook_sub_title', !empty($getRecord) ? $getRecord->facebook_sub_title : '') }}">
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