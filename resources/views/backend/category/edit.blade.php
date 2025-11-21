@extends('backend.layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('style')
    <style type="text/css">
        .SubParentCategory,
        #ParentCategory {
            -webkit-appearance: auto !important;
            -moz-appearance: auto !important;
            appearance: auto !important;
            background: #ffffff !important;
            cursor: pointer !important;
            border: 1px solid #ced4da !important;
            padding: 8px 10px !important;
            border-radius: 4px !important;
        }

        /* wrapper style for appended selects */
        .child-level {
            margin-top: 8px;
        }
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
                                                <label class="form-label-title col-sm-2 mb-0"> Name</label>
                                                <div class="col-sm-10">

                                                    <input name="name" type="text" class="form-control" required
                                                        value="{{ old('name', !empty($getrecord) ? $getrecord->name : '') }}">
                                                    <span style="color:red">{{  $errors->first('name') }}</span>
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-2 mb-0"> Image</label>
                                                <div class="col-sm-10">
                                                    <input name="category_image" type="file" class="form-control">
                                                    @if(!empty($getrecord->category_image))
                                                        <img src="{{ $getrecord->getCategoryImage() }}" style="height:100px;">
                                                    @endif
                                                    <span class="pt-2 highlight-text">(<b>Important:-</b> Add Only Square
                                                        Image, i.e 1000X1000 or 2000X2000)</span>
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-2 mb-0"> Category Banner Image</label>
                                                <div class="col-sm-10">
                                                    <input name="category_banner_image" type="file" class="form-control">
                                                    @if(!empty($getrecord->category_banner_image))
                                                        <img src="{{ $getrecord->getCategoryBannerImage() }}"
                                                            style="height:100px;">
                                                    @endif
                                                    <span class="pt-2 highlight-text">(<b>Important:-</b> Please upload an
                                                        image with resolution of exactly 1440×548 px.)</span>
                                                </div>
                                            </div>


                                            @php
                                                $status = $getrecord->status ?? 0;
                                                $chain = $parentChain ?? [];  
                                            @endphp

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-2 col-form-label form-label-title">Parent
                                                    Category</label>

                                                <div class="col-sm-10">

                                                    <select class="form-control ParentCategory" name="parent_id[]">
                                                        <option value="">None</option>
                                                        @foreach($getParentCategory as $value)
                                                            <option value="{{ $value->id }}" {{ (!empty($chain[0]) && $chain[0] == $value->id) ? 'selected' : '' }}>
                                                                {{ $value->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <div id="appendCategory"></div>

                                                </div>
                                            </div>



                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-2 col-form-label form-label-title">Status </label>
                                                <div class="col-sm-10">
                                                    <select class="js-example-basic-single w-100" required name="status">
                                                        <option {{ ($status == 0) ? 'selected' : '' }} value="0">Active
                                                        </option>
                                                        <option {{ ($status == 1) ? 'selected' : '' }} value="1">Inactive
                                                        </option>
                                                    </select>
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
    <script>
        $(document).ready(function () {
            let chain = @json($parentChain);
            if (chain.length > 0) {
                if ($(".ParentCategory").length && chain[0]) {
                    $(".ParentCategory").val(chain[0]);
                    loadNext(chain[0], chain, 1);
                }
            }


            $(document).on('change', '.ParentCategory, #appendCategory select', function () {
                let parent_id = $(this).val();
                let changedSelectIndex = $(this).closest('.col-sm-10').find('select').index(this);


                if (changedSelectIndex === 0) {
                    $("#appendCategory").empty();
                } else {
                    $('#appendCategory .form-group:gt(' + (changedSelectIndex - 1) + ')').remove();
                }

                if (parent_id) {
                    loadNext(parent_id, null, changedSelectIndex + 1);
                }
            });

        });


        function loadNext(parent_id, chain, index) {

            let url = (index === 1)
                ? "{{ url('admin/category/parent') }}"
                : "{{ url('admin/category/parent/sub') }}";

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    parent_id: parent_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function (data) {
                    let html = data.html || data.success;

                    if (html != 0) {
                        $("#appendCategory").append(html);
                        if (chain) {

                            $("#appendCategory select:last").val(chain[index]);
                        }
                    }

                    if (chain && chain[index + 1]) {
                        loadNext(chain[index], chain, index + 1);
                    }
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const squareInput = document.querySelector('input[name="category_image"]');
            if (squareInput) {
                squareInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const img = new Image();
                    img.src = URL.createObjectURL(file);

                    img.onload = function () {
                        if (img.width === img.height) {

                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Wrong Size!',
                                text: 'Please upload ONLY a square image (1000×1000 or 2000×2000, etc.)',
                            });

                            event.target.value = "";
                        }

                        URL.revokeObjectURL(img.src);
                    };
                });
            }

            const bannerInput = document.querySelector('input[name="category_banner_image"]');

            if (bannerInput) {
                bannerInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const img = new Image();
                    img.src = URL.createObjectURL(file);

                    img.onload = function () {
                        if (img.width === 1440 && img.height === 548) {



                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: 'Wrong Size!',
                                text: 'Please upload an image with EXACT dimensions: 1440×548 px.',
                            });

                            event.target.value = "";
                        }

                        URL.revokeObjectURL(img.src);
                    };
                });
            }

        });
    </script>

    <script>
        document.querySelector('input[name="category_banner_image"]').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function () {
                if (img.width === 1440 && img.height === 548) {
                    document.getElementById('bannerPreview').src = img.src;
                    document.getElementById('bannerPreview').style.display = "block";

                    Swal.fire({
                        icon: 'success',
                        title: 'Perfect!',
                        text: 'Image size is correct: 1440×548 px.',
                        timer: 2000,
                        showConfirmButton: false
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Wrong Size!',
                        text: 'Please upload an image with dimensions exactly 1440×548 px.',
                    });

                    event.target.value = ""; // clear input
                    document.getElementById('bannerPreview').style.display = "none";
                }
                URL.revokeObjectURL(img.src);
            };
        });
    </script>

    <script type="text/javascript">


    </script>
@endsection