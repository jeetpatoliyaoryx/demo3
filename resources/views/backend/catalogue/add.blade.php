@extends('backend.layouts.app')
<link rel="stylesheet" type="text/css" href="{{ url('backend/assets/css/select2.min.css') }}">
@section('style')


@endsection
@section('content')



    <div class="page-body">
        <div class="title-header">
            <h5>Add Catalogue</h5>
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


                                        <form class="theme-form theme-form-2 mega-form" method="post" action=""
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0">
                                                        Title</label>
                                                    <div class="col-sm-10">
                                                        <input name="catalogue_name" type="text" placeholder="Title"
                                                            class="form-control" required>
                                                    </div>
                                                </div>


                                                <div class="mb-4 row align-items-center">
                                                    <label class="form-label-title col-sm-2 mb-0"> Image </label>
                                                    <div class="col-sm-10">
                                                        <input name="catalogue_image" type="file" class="file picimg"
                                                            required>
                                                        <span class="pt-2 highlight-text">(<b>Important:-</b> Please upload
                                                            an image with resolution
                                                            of exactly 1440×548 px.)</span>
                                                    </div>
                                                </div>

                                                <!-- <div class="row align-items-center">
                                                                                            <label class="col-sm-2 col-form-label form-label-title">Select Product Name</label>
                                                                                            <div class="col-sm-10">
                                                                                                <select class="js-example-basic-single w-100" name="product_id[]" required multiple="multiple">
                                                                                                     <option value="">Select Product</option>
                                                                                                     @foreach($ProductCatalogue as $value)
                                                                                                     <option value="{{ $value->id }}">{{ $value->title }}</option> 
                                                                                                      @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div> -->


                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label form-label-title">Select Product
                                                        Name</label>
                                                    <div class="col-sm-10">
                                                        <select id="productSelect" class="js-example-basic-single w-100"
                                                            name="product_id[]" required multiple>
                                                            <option value="" disabled>Select Product</option>
                                                            @foreach($ProductCatalogue as $value)
                                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                            @endforeach
                                                        </select>

                                                        <!-- Selected Products Will Show Here -->
                                                        <div id="selectedProducts" class="mt-3"></div>
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

        <script>
            document.querySelector('input[name="catalogue_image"]').addEventListener('change', function (event) {
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="{{ url('backend/assets/js/select2.min.js') }}"></script>
        <script src="{{ url('backend/assets/js/select2-custom.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                let select = $("#productSelect");

                select.select2();

                function renderSelected() {
                    let container = $("#selectedProducts");
                    container.html("");

                    let selected = select.find(":selected");

                    selected.each(function () {
                        let id = $(this).val();
                        let title = $(this).text();

                        let item = `
                                                    <div class="selected-item" data-id="${id}">
                                                        <span>${title}</span>
                                                        <span class="remove-selected">&times;</span>
                                                    </div>
                                                `;

                        container.append(item);
                    });
                }

                // On select change, update custom list
                select.on("change", function () {
                    renderSelected();
                });

                // Remove item when clicking remove icon
                $("#selectedProducts").on("click", ".remove-selected", function () {
                    let id = $(this).parent().data("id");

                    // Unselect option in Select2
                    let option = select.find(`option[value='${id}']`);
                    option.prop("selected", false);

                    select.trigger("change");
                });
            });


        </script>
    @endsection