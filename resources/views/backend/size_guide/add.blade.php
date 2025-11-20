@extends('backend.layouts.app')
@section('style')
    <style type="text/css">
    </style>
@endsection
@section('content')



    <div class="page-body">
        <div class="title-header">
            <h5>Add Size Guide</h5>
        </div>

        <!-- New Product Add Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                  

                                    <form class="theme-form theme-form-2 mega-form" method="post" action=""
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-2 mb-0"> Image</label>
                                                <div class="col-sm-10">
                                                    <input name="image" type="file" class="form-control">
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

    </div>

@endsection
@section('script')


@endsection