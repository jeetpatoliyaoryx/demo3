
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update Trending Categories</h5>
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
                                                @include('_message')  

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/spacing_udpate') }}" enctype="multipart/form-data">
                                                   {{ csrf_field() }}
                                                <div class="row">
                                                   
                                           
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="title" type="text" placeholder="Title" class="form-control" required value="{{ old('title', !empty($getRecord) ? $getRecord->title : '') }}">
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Sub Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="sub_title" type="text" placeholder="Sub Title" class="form-control" required value="{{ old('sub_title', !empty($getRecord) ? $getRecord->sub_title : '') }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="image" type="file" class="file picimg">
                                                             @if(!empty($getRecord->image))
                                                          <img src="{{ $getRecord->getImage() }}" style="height:100px; width: 80px;"><br>
                                                        @endif
                                                            <span class="highlight-text pt-2">(<b>Important:-</b> Add Only Square Image, i.e 1000X1000 or 2000X2000)</span>
                                                        </div>
                                                    </div>

                                            <div class="mb-4 row align-items-center">
                                              <label class="form-label-title col-sm-2 mb-0">Select</label>
                                              <div class="col-md-9">
                                                <div class="radio-section">
                                                  <label>
                                                    <input type="radio" name="type_catalogue_category_1" value="1" {{ $getRecord->type_catalogue_category_1 == 1 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Catalogue</span>
                                                  </label>

                                                  <label>
                                                    <input type="radio" name="type_catalogue_category_1" value="2" {{ $getRecord->type_catalogue_category_1 == 2 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Category</span>
                                                  </label>
                                                </div>
                                              </div>
                                            </div>

                                    <div id="catalogueSection1" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Catalogue Name</label>
                                      <div class="col-sm-10">
                                        <select id="catalogueSelect1" class="js-example-basic-single w-100" name="catalogue_id_1">
                                          <option value="">Select Catalogue</option>
                                          @foreach($getCatalogue as $value)
                                            <option value="{{ $value->id }}" 
                                                    {{ $getRecord->catalogue_id_1 == $value->id ? 'selected' : '' }}>
                                              {{ $value->catalogue_name }}
                                            </option> 
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                                                      
                                    <div id="categorySection1" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Category Name</label>
                                      <div class="col-sm-10">
                                        <select id="categorySelect1" class="js-example-basic-single w-100" name="category_id_1">
                                          <option value="">Select Category</option>
                                          @foreach($getParentCategory as $value)
                                            @foreach($value->subcategory as $subcategory)
                                              <option value="{{ $subcategory->id }}" 
                                                      {{ $getRecord->category_id_1 == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                              </option>
                                            @endforeach
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>



                                                    <hr>

                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title 1</label>
                                                        <div class="col-sm-10">
                                                          <input name="title_1" type="text" placeholder="Title 1" class="form-control" required value="{{ old('title_1', !empty($getRecord) ? $getRecord->title_1 : '') }}">
                                                        </div>
                                                    </div>


                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Sub Title 1</label>
                                                        <div class="col-sm-10">
                                                          <input name="sub_title_1" type="text" placeholder="Sub Title 1" class="form-control" required value="{{ old('sub_title_1', !empty($getRecord) ? $getRecord->sub_title_1 : '') }}">
                                                        </div>
                                                    </div>

                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Description</label>
                                                        <div class="col-sm-10">
                                                          <input name="description" type="text" placeholder="Description" class="form-control" required value="{{ old('description', !empty($getRecord) ? $getRecord->description : '') }}">
                                                        </div>
                                                    </div>

                                                    <hr>
                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Image 1</label>
                                                        <div class="col-sm-10">
                                                            <input name="image_1" type="file" class="file picimg">  
                                                             @if(!empty($getRecord->image_1))
                                                              <img src="{{ $getRecord->getImage1() }}" style="height:100px; width: 80px;"><br>
                                                            @endif
                                                            <span class="highlight-text pt-2">(<b>Important:-</b> Add Only Square Image, i.e 1000X1000 or 2000X2000)</span>
                                                        </div>
                                                    </div>

                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Image Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="image_title" type="text" placeholder="Image Title" class="form-control" required value="{{ old('image_title', !empty($getRecord) ? $getRecord->image_title : '') }}">
                                                        </div>
                                                    </div>


                                                             <div class="mb-4 row align-items-center">
                                              <label class="form-label-title col-sm-2 mb-0">Select</label>
                                              <div class="col-md-9">
                                                <div class="radio-section">
                                                  <label>
                                                    <input type="radio" name="type_catalogue_category_2" value="1" {{ $getRecord->type_catalogue_category_2 == 1 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Catalogue</span>
                                                  </label>

                                                  <label>
                                                    <input type="radio" name="type_catalogue_category_2" value="2" {{ $getRecord->type_catalogue_category_2 == 2 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Category</span>
                                                  </label>
                                                </div>
                                              </div>
                                            </div>

                                    <div id="catalogueSection2" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Catalogue Name</label>
                                      <div class="col-sm-10">
                                        <select id="catalogueSelect2" class="js-example-basic-single w-100" name="catalogue_id_2">
                                          <option value="">Select Catalogue</option>
                                          @foreach($getCatalogue as $value)
                                            <option value="{{ $value->id }}" 
                                                    {{ $getRecord->catalogue_id_2 == $value->id ? 'selected' : '' }}>
                                              {{ $value->catalogue_name }}
                                            </option> 
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                                                      
                                    <div id="categorySection2" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Category Name</label>
                                      <div class="col-sm-10">
                                        <select id="categorySelect2" class="js-example-basic-single w-100" name="category_id_2">
                                          <option value="">Select Category</option>
                                          @foreach($getParentCategory as $value)
                                            @foreach($value->subcategory as $subcategory)
                                              <option value="{{ $subcategory->id }}" 
                                                      {{ $getRecord->category_id_2 == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                              </option>
                                            @endforeach
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>



                                                      <hr>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Image 2</label>
                                                        <div class="col-sm-10">
                                                            <input name="image_2" type="file" class="file picimg">  
                                                             @if(!empty($getRecord->image_2))
                                                          <img src="{{ $getRecord->getImage2() }}" style="height:100px; width: 80px;"><br>
                                                        @endif
                                                            <span class="highlight-text pt-2">(<b>Important:-</b> Add Only Square Image, i.e 1000X1000 or 2000X2000)</span>
                                                        </div>
                                                    </div>

                                                         <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Image Title 2</label>
                                                        <div class="col-sm-10">
                                                          <input name="image_title_2" type="text" placeholder="Image Title 2" class="form-control" required value="{{ old('image_title_2', !empty($getRecord) ? $getRecord->image_title_2 : '') }}">
                                                        </div>
                                                    </div>




                                                             <div class="mb-4 row align-items-center">
                                              <label class="form-label-title col-sm-2 mb-0">Select</label>
                                              <div class="col-md-9">
                                                <div class="radio-section">
                                                  <label>
                                                    <input type="radio" name="type_catalogue_category_3" value="1" {{ $getRecord->type_catalogue_category_3 == 1 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Catalogue</span>
                                                  </label>

                                                  <label>
                                                    <input type="radio" name="type_catalogue_category_3" value="2" {{ $getRecord->type_catalogue_category_3 == 2 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Category</span>
                                                  </label>
                                                </div>
                                              </div>
                                            </div>

                                    <div id="catalogueSection3" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Catalogue Name</label>
                                      <div class="col-sm-10">
                                        <select id="catalogueSelect3" class="js-example-basic-single w-100" name="catalogue_id_3">
                                          <option value="">Select Catalogue</option>
                                          @foreach($getCatalogue as $value)
                                            <option value="{{ $value->id }}" 
                                                    {{ $getRecord->catalogue_id_3 == $value->id ? 'selected' : '' }}>
                                              {{ $value->catalogue_name }}
                                            </option> 
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                                                      
                                    <div id="categorySection3" class="row align-items-center" style="display: none;">
                                      <label class="col-sm-2 col-form-label form-label-title">Select Category Name</label>
                                      <div class="col-sm-10">
                                        <select id="categorySelect3" class="js-example-basic-single w-100" name="category_id_3">
                                          <option value="">Select Category</option>
                                          @foreach($getParentCategory as $value)
                                            @foreach($value->subcategory as $subcategory)
                                              <option value="{{ $subcategory->id }}" 
                                                      {{ $getRecord->category_id_3 == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                              </option>
                                            @endforeach
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>


                                             
                                                    <div class="clear-both"></div>
                                                    

                                                  
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

    const inputs = document.querySelectorAll('input[type="file"][name^="image"]');

    inputs.forEach(function (input) {
        input.addEventListener('change', function (event) {
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
                        text: 'Please upload ONLY a square image (1000×1000, 2000×2000, etc.)',
                    });

                    event.target.value = ""; 
                }

                URL.revokeObjectURL(img.src);
            };
        });
    });

});
</script>



<script type="text/javascript">

     
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const radios = document.querySelectorAll('input[name="type_catalogue_category_1"]');
  const catalogueSection1 = document.getElementById("catalogueSection1");
  const categorySection1 = document.getElementById("categorySection1");
  const catalogueSelect1 = document.getElementById("catalogueSelect1");
  const categorySelect1 = document.getElementById("categorySelect1");

  function toggleSections1(value) {
    if (value === "1") {
      catalogueSection1.style.display = "flex";
      categorySection1.style.display = "none";
      catalogueSelect1.setAttribute("required", "required");
      categorySelect1.removeAttribute("required");
    } else {
      catalogueSection1.style.display = "none";
      categorySection1.style.display = "flex";
      categorySelect1.setAttribute("required", "required");
      catalogueSelect1.removeAttribute("required");
    }
  }

  // Handle change event
  radios.forEach(elem => {
    elem.addEventListener("change", function() {
      toggleSections1(this.value);
    });
  });

  // Initialize based on current record
  const selectedValue1 = document.querySelector('input[name="type_catalogue_category_1"]:checked')?.value;
  if (selectedValue1) {
    toggleSections1(selectedValue1);
  }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const radios = document.querySelectorAll('input[name="type_catalogue_category_2"]');
  const catalogueSection2 = document.getElementById("catalogueSection2");
  const categorySection2 = document.getElementById("categorySection2");
  const catalogueSelect2 = document.getElementById("catalogueSelect2");
  const categorySelect2 = document.getElementById("categorySelect2");

  function toggleSections2(value) {
    if (value === "1") {
      catalogueSection2.style.display = "flex";
      categorySection2.style.display = "none";
      catalogueSelect2.setAttribute("required", "required");
      categorySelect2.removeAttribute("required");
    } else {
      catalogueSection2.style.display = "none";
      categorySection2.style.display = "flex";
      categorySelect2.setAttribute("required", "required");
      catalogueSelect2.removeAttribute("required");
    }
  }

  // Handle change event
  radios.forEach(elem => {
    elem.addEventListener("change", function() {
      toggleSections2(this.value);
    });
  });

  // Initialize based on current record
  const selectedValue2 = document.querySelector('input[name="type_catalogue_category_2"]:checked')?.value;
  if (selectedValue2) {
    toggleSections2(selectedValue2);
  }
});
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
  const radios = document.querySelectorAll('input[name="type_catalogue_category_3"]');
  const catalogueSection3 = document.getElementById("catalogueSection3");
  const categorySection3 = document.getElementById("categorySection3");
  const catalogueSelect3 = document.getElementById("catalogueSelect3");
  const categorySelect3 = document.getElementById("categorySelect3");

  function toggleSections3(value) {
    if (value === "1") {
      catalogueSection3.style.display = "flex";
      categorySection3.style.display = "none";
      catalogueSelect3.setAttribute("required", "required");
      categorySelect3.removeAttribute("required");
    } else {
      catalogueSection3.style.display = "none";
      categorySection3.style.display = "flex";
      categorySelect3.setAttribute("required", "required");
      catalogueSelect3.removeAttribute("required");
    }
  }

  // Handle change event
  radios.forEach(elem => {
    elem.addEventListener("change", function() {
      toggleSections3(this.value);
    });
  });

  // Initialize based on current record
  const selectedValue3 = document.querySelector('input[name="type_catalogue_category_3"]:checked')?.value;
  if (selectedValue3) {
    toggleSections3(selectedValue3);
  }
});
</script>



@endsection