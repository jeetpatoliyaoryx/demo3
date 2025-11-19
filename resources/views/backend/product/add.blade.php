@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Add New Product</h5>
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
                                                <h5>Product Add</h5>
                                            </div>

                                            <form class="theme-form theme-form-2 mega-form" method="post" action="" enctype="multipart/form-data"> 
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Product
                                                            Name</label>
                                                        <div class="col-sm-10">

                                                                <input name="title" type="text" placeholder="Product Name" class="form-control" required value="">
                                                                 <span style="color:red">{{  $errors->first('title') }}</span>
                                                        </div>
                                                    </div>
                                
                                                </div>
                                                
                                                <br>
                                                 <div class="panel-footer">
                                                    <button class="btn btn-primary" type="submit">Submit</button>
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