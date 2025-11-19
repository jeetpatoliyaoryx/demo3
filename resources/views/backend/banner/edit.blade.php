@extends('backend.layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('style')
<style type="text/css">
    .banner-preview {
        width: 1440px;
        height: 548px;
        object-fit: cover;
        border: 1px solid #ccc;
        margin-top: 10px;
    }
</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Edit Banner</h5>
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
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="title" type="text" placeholder="Title" class="form-control" value="{{ $getrecord->title }}">
                                                        </div>
                                                    </div>
                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Sub Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="sub_title" type="text" class="form-control" placeholder="Sub Title" value="{{ $getrecord->sub_title }}">
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Desktop Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="desktop_banner" type="file" class="file picimg">  
                                                          @if(!empty($getrecord->desktop_banner))
                                                          <img src="{{ $getrecord->get_desktop_banner() }}" style="height:100px;"> <br>
                                                          @endif
                                                                  {{-- <img id="bannerPreview" class="banner-preview" style="display:none;" /> --}}
                                                        <span class="pt-2 highlight-text">(<b>Important:-</b> Please upload an image with resolution of exactly 1440×548 px.)</span>
                                                        </div>
                                                    </div>
                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Mobile Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="mobile_banner" type="file" class="file picimg">  
                                                          @if(!empty($getrecord->mobile_banner))
                                                          <img src="{{ $getrecord->get_mobile_banner() }}" style="height:100px;"> <br>
                                                          @endif
                                                                  {{-- <img id="bannerPreview" class="banner-preview" style="display:none;" /> --}}
                                                       
                                                        </div>
                                                    </div>

                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Button Text</label>
                                                        <div class="col-sm-10">
                                                          <input name="button_text" type="text" class="form-control" placeholder="Button Text" value="{{ $getrecord->button_text }}">
                                                          
                                                        </div>
                                                    </div>

                                                    

                                           <div class="mb-4 row align-items-center">
                                              <label class="form-label-title col-sm-2 mb-0">Select</label>
                                              <div class="col-md-9">
                                                <div class="radio-section">
                                                  <label>
                                                    <input type="radio" name="type_catalogue_category" value="1" {{ $getrecord->type_catalogue_category == 1 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Catalogue</span>
                                                  </label>

                                                  <label>
                                                    <input type="radio" name="type_catalogue_category" value="2" {{ $getrecord->type_catalogue_category == 2 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Category</span>
                                                  </label>
                                                </div>
                                              </div>
                                            </div>

                                    <div id="catalogueSection" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Catalogue Name</label>
                                      <div class="col-sm-10">
                                        <select id="catalogueSelect" class="js-example-basic-single w-100" name="catalogue_id">
                                          <option value="">Select Catalogue</option>
                                          @foreach($getCatalogue as $value)
                                            <option value="{{ $value->id }}" 
                                                    {{ $getrecord->catalogue_id == $value->id ? 'selected' : '' }}>
                                              {{ $value->catalogue_name }}
                                            </option> 
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                                                      
                                      <div id="categorySection" class="row align-items-center" style="display: none;">
  <label class="col-sm-2 col-form-label form-label-title">Select Category Name</label>
  <div class="col-sm-10">
    <select id="categorySelect" class="js-example-basic-single w-100" name="category_id">
      <option value="">Select Category</option>
      @foreach($getParentCategory as $value)
        @foreach($value->subcategory as $subcategory)
          <option value="{{ $subcategory->id }}" 
                  {{ $getrecord->category_id == $subcategory->id ? 'selected' : '' }}>
            {{ $subcategory->name }}
          </option>
        @endforeach
      @endforeach
    </select>
  </div>
</div>

                                                    {{--      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Button Link</label>
                                                        <div class="col-sm-10">
                                                          <input name="button_link" type="text" placeholder="Button Link" class="form-control" value="{{ $getrecord->button_link }}">
                                                        </div>
                                                    </div> --}}
                                                   
                                             
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
document.querySelector('input[name="desktop_banner"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const img = new Image();
    img.src = URL.createObjectURL(file);

    img.onload = function() {
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


<script>
document.addEventListener("DOMContentLoaded", function() {
  const radios = document.querySelectorAll('input[name="type_catalogue_category"]');
  const catalogueSection = document.getElementById("catalogueSection");
  const categorySection = document.getElementById("categorySection");
  const catalogueSelect = document.getElementById("catalogueSelect");
  const categorySelect = document.getElementById("categorySelect");

  function toggleSections(value) {
    if (value === "1") {
      catalogueSection.style.display = "flex";
      categorySection.style.display = "none";
      catalogueSelect.setAttribute("required", "required");
      categorySelect.removeAttribute("required");
    } else {
      catalogueSection.style.display = "none";
      categorySection.style.display = "flex";
      categorySelect.setAttribute("required", "required");
      catalogueSelect.removeAttribute("required");
    }
  }

  // Handle change event
  radios.forEach(elem => {
    elem.addEventListener("change", function() {
      toggleSections(this.value);
    });
  });

  // Initialize based on current record
  const selectedValue = document.querySelector('input[name="type_catalogue_category"]:checked')?.value;
  if (selectedValue) {
    toggleSections(selectedValue);
  }
});
</script>


<script type="text/javascript">

     
</script>
@endsection