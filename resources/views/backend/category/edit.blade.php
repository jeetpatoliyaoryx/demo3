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
.child-level { margin-top: 8px; }

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
                                                $status = 0;

                                                if (!empty($getrecord)) {
                                                    $status = $getrecord->status;

                                                }
                                            @endphp
                                            <div class="mb-4 row align-items-center">
    <label class="col-sm-2 col-form-label form-label-title">Parent Category</label>
    <div class="col-sm-10">
        {{-- Main root-level select --}}
        <select id="ParentCategory"
                class="form-control SubParentCategory"
                name="parent_id[]"
                data-level="0">
            <option value="">None</option>
            @foreach($getParentCategory as $value)
                <option value="{{ $value->id }}"
                    {{ (!empty($parentChain) && isset($parentChain[0]) && $parentChain[0] == $value->id) ? 'selected' : '' }}>
                    {{ $value->name }}
                </option>
            @endforeach
        </select>

        {{-- appended child selects will be injected here --}}
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
$(document).ready(function () {

    // Parent chain from server (example: [154,163,181])
    let parentChain = @json($parentChain ?? []);

    // ------------------------------------------------------------
    // Load children of selected category
    // ------------------------------------------------------------
    function loadChildren(parentId, level, selectedValue = null) {

        $.post("{{ url('admin/category/parent') }}", {
            _token: "{{ csrf_token() }}",
            parent_id: parentId,
            level: level
        }, function (res) {

            if (res.success == 0) return;

            // Append dropdown for this level
            let html = `
                <div class="child-level" data-level="${level}" style="margin-top:5px;">
                    ${res.success}
                </div>
            `;

            $("#appendCategory").append(html);

            // Get newly added dropdown
            let $select = $(`.child-level[data-level="${level}"]`).find("select");

            // Ensure it has correct level attribute
            $select.attr("data-level", level);

            // Set pre-selected value (if editing)
            if (selectedValue) {
                $select.val(selectedValue);
            }

        }, "json");
    }

    // ------------------------------------------------------------
    // When user manually selects a dropdown
    // ------------------------------------------------------------
    $(document).on("change", 'select[name="parent_id[]"]', function () {

        let level = parseInt($(this).data("level"));
        let parent_id = $(this).val();

        // Remove all levels below current
        $(".child-level").each(function () {
            if (parseInt($(this).data("level")) > level) {
                $(this).remove();
            }
        });

        // Load next level
        if (parent_id) {
            loadChildren(parent_id, level + 1);
        }
    });

    // ------------------------------------------------------------
    // Auto-build parent chain for edit mode
    // ------------------------------------------------------------
    if (parentChain.length > 0) {

        let i = 0;

        function buildChain() {

            // Stop at the last index
            if (i >= parentChain.length - 1) return;

            // Next value (if exists)
            let nextValue = parentChain[i + 1] ?? null;

            // Load next level
            loadChildren(parentChain[i], i + 1, nextValue);

            i++;
            setTimeout(buildChain, 200);
        }

        buildChain();
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