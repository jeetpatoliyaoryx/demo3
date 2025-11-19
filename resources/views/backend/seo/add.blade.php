@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Add Social</h5>
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
                                                

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/seo/add') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                    
                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Slug</label>
                                                        <div class="col-sm-10">
                                                            <input name="slug" type="text"  class="form-control" required value="{{ old('slug') }}">
                                                            <span style="color:red">{{  $errors->first('slug') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                           Name</label>
                                                        <div class="col-sm-10">
                                                           <input name="name" type="text"  class="form-control" required value="{{ old('name') }}">
                                                            <span style="color:red">{{  $errors->first('name') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                           Meta Title </label>
                                                        <div class="col-sm-10">
                                                           <input name="meta_title" type="text"  class="form-control" required value="{{ old('meta_title') }}">
                                                            <span style="color:red">{{  $errors->first('meta_title') }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                           Meta Description </label>
                                                        <div class="col-sm-10">
                                                               <textarea class="form-control" name="meta_description">{{ old('meta_description') }}</textarea>
                                                                <span style="color:red">{{  $errors->first('meta_description') }}</span>
                                                        </div>
                                                    </div>

                                             
                                                </div>
                                                
                                                <br>
                                                 <div class="panel-footer">
                                                    <button class="btn btn-primary" type="submit">Add</button>
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