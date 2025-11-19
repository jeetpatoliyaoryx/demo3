
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Update Mid Banner Collection</h5>
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

                                            <form class="theme-form theme-form-2 mega-form"  method="post" action="{{ url('admin/surface_udpate') }}" enctype="multipart/form-data">
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
                                                          <img src="{{ $getRecord->getImage() }}" style="height:100px; width: 80px;"> <br>
                                                        @endif
                                                        <span class="pt-2 highlight-text">(<b>Important:-</b> Add Only Wide Angle PNG Image For Good Layout (Image mainly show in right side))</span>

                                                        </div>
                                                    </div>

{{--                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Button Link</label>
                                                        <div class="col-sm-10">
                                                          <input name="button_link" type="text" placeholder="Button Link" class="form-control" required value="{{ old('button_link', !empty($getRecord) ? $getRecord->button_link : '') }}">
                                                        </div>
                                                    </div>

 --}}
                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Button Text</label>
                                                        <div class="col-sm-10">
                                                          <input name="button_text" type="text" placeholder="Button Text" class="form-control" required value="{{ old('button_text', !empty($getRecord) ? $getRecord->button_text : '') }}">
                                                        </div>
                                                    </div>


                                            <div class="mb-4 row align-items-center">
                                              <label class="form-label-title col-sm-2 mb-0">Select</label>
                                              <div class="col-md-9">
                                                <div class="radio-section">
                                                  <label>
                                                    <input type="radio" name="type_catalogue_category" value="1" {{ $getRecord->type_catalogue_category == 1 ? 'checked' : '' }}>
                                                    <i></i>
                                                    <span>Catalogue</span>
                                                  </label>

                                                  <label>
                                                    <input type="radio" name="type_catalogue_category" value="2" {{ $getRecord->type_catalogue_category == 2 ? 'checked' : '' }}>
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
                                                    {{ $getRecord->catalogue_id == $value->id ? 'selected' : '' }}>
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
                  {{ $getRecord->category_id == $subcategory->id ? 'selected' : '' }}>
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

<script type="text/javascript">

     
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

@endsection