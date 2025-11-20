@extends('backend.layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('style')
    <style type="text/css">
    </style>
@endsection
@section('content')



    <div class="page-body">
        <div class="title-header">
            <h5>Edit Category</h5>
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
                                        <h5> Category</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form" method="post" action=""
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-2 mb-0">Image</label>
                                                <div class="col-sm-10">
                                                    <input name="image" type="file" class="form-control">
                                                    @if(!empty($getrecord->image))
                                                        <img src="{{ $getrecord->get_size_guide_image() }}"
                                                            style="height:100px;">
                                                    @endif
                                                    
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

   
@endsection