@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Edit Member</h5>
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
                                                        <label class="form-label-title col-sm-2 mb-0">Name</label>
                                                        <div class="col-sm-10">
                                                          <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $getrecord->name }}" required> 
                                                          
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Position</label>
                                                        <div class="col-sm-10">
                                                          <input name="position" type="text" placeholder="Position" class="form-control" required value="{{ $getrecord->position }}">
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="image" type="file" class="file picimg" >  
                                                           @if(!empty($getrecord->image))
                                                          <img src="{{ $getrecord->getImage() }}" style="height:100px;"> <br>
                                                          @endif
                                                          <span class="highlight-text pt-2">(<b>Important:-</b> Add Only Square Image, i.e 1000X1000 or 2000X2000)</span>
                                                        </div>
                                                    </div>

                                                  
                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Facebook Link</label>
                                                        <div class="col-sm-10">
                                                          <input name="facebook_link" type="text" required placeholder="Facebook Link" class="form-control" value="{{ $getrecord->facebook_link }}">
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