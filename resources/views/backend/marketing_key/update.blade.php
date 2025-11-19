
@extends('backend.layouts.app')
@section('style')

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update Marketing Key</h5>
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

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/marketing_key_udpate') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   
                                           
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Facebook Pixel ID</label>
                                                        <div class="col-sm-10">
                                                          <input name="facebook_pixel_id" type="text" placeholder="Facebook Pixel ID" class="form-control" required value="{{ old('facebook_pixel_id', !empty($getRecord) ? $getRecord->facebook_pixel_id : '') }}">
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Google Analytics ID</label>
                                                        <div class="col-sm-10">
                                                          <input name="google_analytics_id" type="text" placeholder="Google Analytics ID" class="form-control" required value="{{ old('google_analytics_id', !empty($getRecord) ? $getRecord->google_analytics_id : '') }}">
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