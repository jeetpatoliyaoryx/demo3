@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Edit SEO</h5>
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
                                                

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/seo/edit/'.$getrecord->id) }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                 
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Slug</label>
                                                        <div class="col-sm-10">
                                                          <input name="slug" type="text"  class="form-control" required value="{{ old('slug', !empty($getrecord) ? $getrecord->slug : '') }}">
                                                          <span style="color:red">{{  $errors->first('slug') }}</span>
                                                        </div>
                                                    </div>
                                                 

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Name</label>
                                                        <div class="col-sm-10">
                                                          <input name="name" type="text"  class="form-control" required value="{{ old('name', !empty($getrecord) ? $getrecord->name : '') }}">
                                                         <span style="color:red">{{  $errors->first('name') }}</span>
                                                        </div>
                                                    </div>


                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Meta Title</label>
                                                        <div class="col-sm-10">
                                                        <input name="meta_title" type="text"  class="form-control" required value="{{ old('meta_title', !empty($getrecord) ? $getrecord->meta_title : '') }}">
                                                        <span style="color:red">{{  $errors->first('meta_title') }}</span>
                                                        </div>
                                                    </div>


                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Meta Description</label>
                                                        <div class="col-sm-10">
                                                        <textarea class="form-control" name="meta_description">{{ old('meta_description', !empty($getrecord) ? $getrecord->meta_description : '') }}</textarea>
                                                             <span style="color:red">{{  $errors->first('meta_description') }}</span>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Categories Title</label>
                                                        <div class="col-sm-10">
                                                        <input name="categories_title" type="text" class="form-control" value="{{ old('categories_title', !empty($getrecord) ? $getrecord->categories_title : '') }}">
                                                        <span style="color:red">{{  $errors->first('categories_title') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Customer Title</label>
                                                        <div class="col-sm-10">
                                                        <input name="customer_1" type="text" class="form-control" value="{{ old('customer_1', !empty($getrecord) ? $getrecord->customer_1 : '') }}">
                                                        <span style="color:red">{{  $errors->first('customer_1') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Customer Sub Title</label>
                                                        <div class="col-sm-10">
                                                        <input name="customer_2" type="text" class="form-control" value="{{ old('customer_2', !empty($getrecord) ? $getrecord->customer_2 : '') }}">
                                                        <span style="color:red">{{  $errors->first('customer_2') }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Instagram Title</label>
                                                        <div class="col-sm-10">
                                                        <input name="instagram_1" type="text" class="form-control" value="{{ old('instagram_1', !empty($getrecord) ? $getrecord->instagram_1 : '') }}">
                                                        <span style="color:red">{{  $errors->first('instagram_1') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Instagram Sub Title</label>
                                                        <div class="col-sm-10">
                                                        <input name="instagram_2" type="text" class="form-control" value="{{ old('instagram_2', !empty($getrecord) ? $getrecord->instagram_2 : '') }}">
                                                        <span style="color:red">{{  $errors->first('instagram_2') }}</span>
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