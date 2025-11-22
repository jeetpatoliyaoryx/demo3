
@extends('backend.layouts.app')
@section('style')
<link href="{{ asset('frontend/fileinput.min.css')}}"  rel="stylesheet" type="text/css" />

<style type="text/css">
 
.kv-zoom-actions {
    display: none !important;
}
.kv-file-zoom{
    display: none !important;
}
.video-preview-wrapper {
    position: relative;
    display: inline-block;
}

.remove-video {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #ff4d4d;
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    text-align: center;
    line-height: 22px;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
}
.remove-video:hover {
    background: #ff1a1a;
}

.size-guide-box {
    width: 80px;
    cursor: pointer;
    position: relative;
}

.size-guide-checkbox {
    position: absolute;
    top: 0px;
    right: -4px;
    height: 10px;
    width: 10px;
    transform: scale(1.4);
}
.size-guide-checkbox:focus{
    box-shadow: none;
}

.size-guide-img {
    height: 80px;
    width: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.container {
    width: 500px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

.success {
    background: #2ecc71;
    color: white;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 10px;
}







.variant-wrapper {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
}

.shopify-label {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}

.option-box {
    border: 1px solid #e5e7eb;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 15px;
    background: #fafafa;
}

.option-title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
}

.option-name {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    margin-bottom: 15px;
}

.values-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.value-item {
    background: #f3f4f6;
    padding: 6px 12px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
}

.value-item button {
    background: none;
    border: none;
    cursor: pointer;
    font-weight: bold;
    color: #444;
}

.value-input {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #f5faff;
    width: 100%;
    /* min-width: 180px; */
}

.btn-add-option {
    background: #ffffff;
    border: 1px dashed #9ca3af;
    padding: 10px 14px;
    border-radius: 8px;
    width: 100%;
    margin-top: 10px;
    cursor: pointer;
    font-size: 14px;
}

.btn-generate {
    background: #008060;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    margin-top: 20px;
    cursor: pointer;
}

.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}

.switch input { display: none; }

.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 19px;
  width: 19px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #008060;
}

input:checked + .slider:before {
  transform: translateX(24px);
}





</style>
@endsection 
@section('content')



            <div class="page-body">
                <div class="title-header">
                  @if(isset($product->sku))
                    <h5>Edit Product</h5>
                @else
                    <h5>Add Product</h5>
                @endif

                </div>

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
                                                        <label class="form-label-title col-sm-2 mb-0">Product
                                                            Name</label>
                                                        <div class="col-sm-10">
                                                          <input name="title" type="text"   placeholder="Product Name" class="form-control" required value="{{ $product->title }}">
                                                        </div>
                                                    </div>

                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">SKU
                                                            </label>
                                                        <div class="col-sm-10">
                                                          <input name="sku" type="text"   placeholder="SKU" class="form-control" required value="{{ $product->sku }}">
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Old Price</label>
                                                        <div class="col-sm-10">
                                                          <input name="old_price" type="text" class="form-control only-numeric" placeholder="Old Price" required value="{{ $product->old_price }}">
                                                          
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Price</label>
                                                        <div class="col-sm-10">
                                                            <input name="price" type="text" class="form-control only-numeric" placeholder="Price" required value="{{ $product->price }}">
                                                             
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Purchase Price</label>
                                                        <div class="col-sm-10">
                                                            <input name="purchase_price" type="text" class="form-control only-numeric" placeholder="Purchase Price" required value="{{ $product->purchase_price }}">
                                                             
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Referral Price</label>
                                                        <div class="col-sm-10">
                                                            <input name="referral_price" type="text" class="form-control only-numeric" placeholder="Referral Price" required value="{{ $product->referral_price }}">
                                                             
                                                        </div>
                                                    </div>



                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Title Description </label>
                                                        <div class="col-sm-10">
                                                             <textarea name="title_description" rows="3" class="form-control">{{ $product->title_description }}</textarea>
                                                        </div>
                                                    </div>

                                                    @if(!empty($product->category_id))

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Category  </label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100" id="ParentCategory" required name="parent_id[]">
                                                               <option value="">Select</option>
                                                                  @foreach($getParentCategory as $value)
                                                                  <option {{ ($first_category == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                                  @endforeach
                                                            </select>
                                                            <div id="appendCategory"></div>
                                                        </div>
                                                    </div>

                                                     @else

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Category </label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100" id="ParentCategory" required name="parent_id[]">
                                                                 <option value="">Select</option>
                                                               @foreach($getParentCategory as $value)
                                                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                              @endforeach
                                                            </select>
                                                              <div id="appendCategory"></div>
                                                        </div>
                                                       
                                                    </div>

                                                    @endif

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Available Stock</label>
                                                        <div class="col-sm-10">
                                                            <input name="total_product" type="text" class="form-control only-numeric" placeholder="Total Product" required value="{{ $product->total_product }}">
                                                             
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Do You Want To Add Variants?</label>
                                                        <div class="col-sm-10">
                                                            <label class="switch">
                                                                <input type="checkbox" id="variantToggle">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="mb-4 row align-items-center">
                                                        <div id="variantSection" style="display:none;">
                                                            <!-- your whole variant-wrapper goes here -->
                                                        <label class="form-label-title col-sm-2 mb-0">Variants</label>
                                                        <div class="col-sm-10">
                                                            <div class="variant-wrapper">

                                                                <label class="shopify-label">Variants</label>

                                                                <div id="variantOptions"></div>

                                                                <button type="button" class="btn-add-option" id="addOptionBtn">
                                                                    Add option
                                                                </button>

                                                                <button type="button" class="btn-generate" id="generateVariantsBtn" disabled>
                                                                    Generate all variants
                                                                </button>

                                                                <div id="variantTableWrapper"></div>

                                                            </div>
                                                        </div>

                                                        </div>

                                                        
                                                    </div>











                                                    

                                                    <!-- <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Varints </label>
                                                         <div class="col-sm-10">
                                                            <div class="variant-box">
                                                                <h3>Variants</h3>

                                                                <div id="variantWrapper"></div>

                                                                <button type="button" id="addOptionBtn" class="add-option-btn">
                                                                    Add another option
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div> -->




                                                    <!-- <div class="mb-4 row align-items-center">
                                                            <label class="form-label-title col-sm-2 mb-0">Color</label>
                                                            <div class="col-sm-4">
                                                                <input  class="form-control" id="getColor" placeholder="Name"  type="text">
                                                            </div>
                                                             <div class="col-sm-4">
                                                                <input  class="form-control" id="getColorCode" placeholder="Color Code"  type="color">
                                                            </div>
                                                            <div class="col-sm-2">
                                                            <button type="button"  class="btn btn-primary" id="addColor" data-val="{{ $product->id }}">Save</button>
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Color List</label>
                                                        <div class="col-sm-10" id="getitemscolor">
                                                              @include('backend.product.parts._color')
                                                        </div>
                                                    </div>

                                                        <div class="mb-4 row align-items-center">
                                                            <label class="form-label-title col-sm-2 mb-0">Size</label>
                                                            <div class="col-sm-4">
                                                                <input  class="form-control" id="getSize" placeholder="Name"  type="text">
                                                            </div>
                                                             <div class="col-sm-4">
                                                                <input  class="form-control only-numeric" id="getSizePrice" placeholder="Price"  type="text">
                                                            </div>
                                                            <div class="col-sm-2">
                                                            <button type="button"  class="btn btn-primary" id="addSize" data-val="{{ $product->id }}">Save</button>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Size List</label>
                                                        <div class="col-sm-10" id="getitemsSize">
                                                              @include('backend.product.parts._size')
                                                        </div>
                                                    </div> -->


                                                    <div class="mb-4 row align-items-center" id="sizeGuideRow">
                                                        <label class="col-sm-2 form-label-title fw-bold">Size Guide</label>

                                                        <div class="col-sm-10 d-flex align-items-center">
                                                            <div class="form-check">
                                                                <input type="checkbox" 
                                                                    id="sizeGuideCheck"
                                                                    class="form-check-input"
                                                                    {{ !empty($selectedSizeGuides) ? 'checked' : '' }}>
                                                                <label for="sizeGuideCheck" class="form-check-label">Enable Size Guide</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Image Selection Section -->
                                                    <div class="mb-4 row"
                                                        id="sizeGuideImages"
                                                        style="display: {{ !empty($selectedSizeGuides) ? 'flex' : 'none' }};">

                                                        <label class="col-sm-2 form-label-title fw-bold">Select Size Guide Images</label>

                                                        <div class="col-sm-10 d-flex flex-wrap gap-4">
                                                            @foreach($getSizeGuide as $img)
                                                                <label class="size-guide-box text-center">

                                                                    <input type="checkbox"
                                                                        name="size_guide_ids[]"
                                                                        value="{{ $img->id }}"
                                                                        class="form-check-input size-guide-checkbox"
                                                                        {{ in_array($img->id, $selectedSizeGuides) ? 'checked' : '' }}>

                                                                    <img src="{{ asset('upload/size_guide/'.$img->image) }}"
                                                                        class="img-thumbnail mt-2 size-guide-img">

                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>






                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Featured</label>
                                                        <div class="col-sm-10">
                                                       <input   name="is_featured" {{ !empty($product->is_featured)?'checked':'' }} type="checkbox">
                                                             
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">New Arrivals</label>
                                                        <div class="col-sm-10">
                                                             <input   name="is_new_arrival" {{ !empty($product->is_new_arrival)?'checked':'' }} type="checkbox">
                                                             
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Best Selling </label>
                                                        <div class="col-sm-10">
                                                              <input   name="is_best_selling" {{ !empty($product->is_best_selling)?'checked':'' }} type="checkbox">
                                                        </div>
                                                    </div>

                                                    @php
                                                      $status = 0;
                                                      if(!empty($product)) {
                                                      $status = $product->is_public;
                                                      }
                                                      @endphp

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Public </label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100" name="is_public" required="">
                                                                <option {{ ($status==0) ? 'selected' : '' }} value="0">Active</option>
                                                                <option {{ ($status==1) ? 'selected' : '' }} value="1">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Description </label>
                                                        <div class="col-sm-10">
                                                             <textarea class="editor" name="description" rows="20" class="form-control">{{ $product->description }}</textarea>
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Video File</label>
                                                        <div class="col-sm-10">

                                                            <input name="video_file" accept="video/mp4,video/*" type="file" class="form-control">

                                                            @if(!empty($product->getVideoFile()))
                                                                <div class="video-preview-wrapper mt-4" id="videoPreviewWrapper">

                                                                    <span class="remove-video" id="removeVideo">&times;</span>

                                                                    <video width="220" height="140" controls>
                                                                        <source src="{{ $product->getVideoFile() }}" type="video/mp4">
                                                                    </video>
                                                                </div>

                                                                <input type="hidden" name="delete_video" id="deleteVideoInput" value="0">
                                                            @endif

                                                        </div>
                                                    </div>


                                                    <div class="mb-4 row align-items-center" id="picturesBloc">
                                                        <label class="form-label-title col-sm-2 mb-0">Image </label>
                                                        <div class="col-sm-10">
                                                            <input id="pictureField" name="pictures[]" type="file" multiple class="file picimg">  
                                                        </div>
                                                    </div>

                                                    <div class="clear-both"></div>
                                                    <div id="uploadError" style="margin-top:10px; display:none"></div>
                                                 <div id="uploadSuccess" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>
                                                  
                                                </div>
                                                
                                                <br>
                                                 <div class="panel-footer">
                                                      @if(isset($product->sku))
                                                      <input type="hidden" name="type_message" value="1">
                                                           <button class="btn btn-primary" type="submit">Update </button>
                                                        @else
                                                        <input type="hidden" name="type_message" value="2">
                                                           <button class="btn btn-primary" type="submit">Add Product</button>
                                                        @endif
                                                
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





<script type="text/javascript" src="{{ url('frontend/tinymce/tinymce.min.js') }}"></script>

<script src="{{ asset('frontend/fileinput.min.js')}}" type="text/javascript"></script>

<script>
    let variantList = document.getElementById("variant-list");
    let preview = document.getElementById("preview");

    document.getElementById("addVariantBtn").addEventListener("click", () => {
        addVariantRow();
    });

    function addVariantRow() {
        let row = document.createElement("div");
        row.classList.add("variant-box");

        row.innerHTML = `
            <input type="text" class="variant-name" type="button" placeholder="Variant Name (ex: Size)">
            <input type="text" class="variant-values" type="button" placeholder="Values (ex: M, L, XL)">
            <button class="remove-btn">X</button>
        `;

        row.querySelector(".remove-btn").addEventListener("click", () => {
            row.remove();
            updatePreview();
        });

        row.querySelectorAll("input").forEach(input => {
            input.addEventListener("input", updatePreview);
        });

        variantList.appendChild(row);
        updatePreview();
    }

    function updatePreview() {
        preview.innerHTML = "";

        let variants = document.querySelectorAll(".variant-box");

        variants.forEach(v => {
            let name = v.querySelector(".variant-name").value;
            let values = v.querySelector(".variant-values").value;

            if (name && values) {
                let box = document.createElement("div");
                box.classList.add("preview-box");
                box.innerText = `${name}: ${values}`;
                preview.appendChild(box);
            }
        });
    }

</script>

<script type="text/javascript">
   $('#pictureField').fileinput(
           {
               showUpload: false,
               overwriteInitial: false,
               showCaption: false,
               showPreview: true,
               uploadUrl: '{{ url('admin/product-image') }}',
               uploadAsync: true,
               uploadExtraData:{'_token': "{{ csrf_token() }}",'id':{{$product->id}} },
               allowedFileExtensions: ['png', 'jpg', 'gif', 'jpeg', 'webp'],
               showBrowse: true,
               showCancel: true,
               showUpload: false,
               showRemove: true,
               maxFileSize: 3000,
               browseOnZoneClick: true,
               minFileCount: 0,
               maxFileCount: 50,
               validateInitialCount: true,
               uploadClass: 'btn btn-success',
               elErrorContainer: '#uploadError',
               initialPreviewAsData: true,
               initialPreview: [
                   @foreach($product->image as $value)
                       @if(file_exists('upload/'.$product->id.'/'.$value->name))
                           '{{ url('upload/'.$product->id.'/'.$value->name) }}',
                       @endif
                   @endforeach
               ],
               initialPreviewFileType: 'image',
               initialPreviewConfig: [
                   @foreach($product->image as $value)
                       @if(file_exists('upload/'.$product->id.'/'.$value->name))
                           <?php
      // File size
      try {
         $fileSize = (int) File::size('upload/' . $product->id . '/' . $value->name);
      } catch (\Exception $e) {
         $fileSize = 0;
      }
      ?>
                           {
                               caption: '{{ $value->name }}',
                               size: {{ $fileSize }},
                               url: '{{ url('admin/product/'.$value->id.'/delete-photo') }}',
                               key: {{ (int)$value->id }},
                               extra: {_token: "{{ csrf_token() }}"}
                           },
                       @endif
                   @endforeach
               ],
           });
       $('#pictureField').on('filepredelete', function(jqXHR) {
           var abort = true;
           if (confirm("Are you sure you want to delete this picture?")) {
               abort = false;
           }
           return abort;
       });
   
       $('#pictureField').on('filebatchselected', function(event, data, id, index) {
           if (typeof data === 'object') {
               if (data.hasOwnProperty('0')) {
                   $(this).fileinput('upload');
                   return true;
               }
           }
           return false;
       });
   
   
    @if(!empty($first_category))
        ParentCategory({{ $first_category }});
    @endif
   
     $('#ParentCategory').change(function() {
       
        var parent_id = $(this).val();

        ParentCategory(parent_id);
     });
   
     function ParentCategory(parent_id) {
            var CSRF_TOKEN = "{{ csrf_token() }}";
            $('#appendCategory').html('');
            $.ajax({
                  type:'POST',
                  url:"{{url('admin/product/parent')}}",
                  data: {
                        _token: CSRF_TOKEN,
                        parent_id:parent_id,
                        scond_category: '{{ $scond_category }}'
                  },
                  dataType: 'JSON',
                  success:function(data) {
                     if(data.success != 0)
                     {
                        $('#appendCategory').html(data.success); 
                        @if(!empty($scond_category))
                            SubParentCategory({{ $scond_category }});
                        @endif
                     }
                     else
                     {
                        $('#appendCategory').html('');     
                     }
                     
                  }
            });
     }

     $('body').delegate('.SubParentCategory','change',function() {
           var parent_id = $(this).val();
           SubParentCategory(parent_id);
         
     });

     function SubParentCategory(parent_id) {
           var CSRF_TOKEN = "{{ csrf_token() }}";
           $.ajax({
                 type:'POST',
                 url:"{{url('admin/product/parent/sub')}}",
                 data: {
                       _token: CSRF_TOKEN,
                       parent_id:parent_id,
                       last_category: '{{ $last_category }}'
                 },
                 dataType: 'JSON',
                 success:function(data) {
                    if(data.success != 0)
                    {
                       $('#appendSubCategory').html(data.success);   
                    }
                    else
                    {
                       $('#appendSubCategory').html('');     
                    }
                 }
           });
     }
   
    $('#addColor').click(function(){
        var id = $(this).attr('data-val');
        var CSRF_TOKEN = "{{ csrf_token() }}";
        var value = $('#getColor').val()
        var color_code = $('#getColorCode').val()
        
        if(value != "") {
                $.ajax({
                    type:'POST',
                    url:"{{url('admin/ajax/add-color')}}",
                    data: {_token: CSRF_TOKEN,id:id,value:value,color_code:color_code},
                    dataType: 'JSON',
                    success:function(data){
                        $('#getColor').val('');
                        $('#getColorCode').val('');
                        $('#getitemscolor').html(data.items);
    
                    }
                });
        }
    });
   
   
    $('#addSize').click(function(){
        var id = $(this).attr('data-val');
        var CSRF_TOKEN = "{{ csrf_token() }}";
        var value = $('#getSize').val()
        var price = $('#getSizePrice').val()
    
        if(value != "") {
                $.ajax({
                    type:'POST',
                    url:"{{url('admin/ajax/add-size')}}",
                    data: {_token: CSRF_TOKEN,id:id,value:value,price:price},
                    dataType: 'JSON',
                    success:function(data){
                        $('#getSize').val('');
                        $('#getSizePrice').val('');
                        $('#getitemsSize').html(data.items);
                    }
                });
        }
    });
   




    $(".only-numeric").bind("keypress", function (evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            {
                return false;
            }
            return true;
        });

     
    tinymce.init({
            selector:'.editor',
            plugins:'link code image textcolor advlist',
            toolbar: [
            "fontselect | bullist numlist outdent indent | fontsizeselect | undo redo | styleselect | bold italic | link image",
            "alignleft aligncenter alignright Justify | forecolor backcolor",
            "fullscreen"
            ],
            fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
            font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
        });




    $('form.theme-form').on('submit', function (e) {
    let oldPrice = parseFloat($('input[name="old_price"]').val()) || 0;
    let price = parseFloat($('input[name="price"]').val()) || 0;
    let purchasePrice = parseFloat($('input[name="purchase_price"]').val()) || 0;

    // Validation conditions
    if (oldPrice <= price || oldPrice <= purchasePrice) {
        alert('❌ Old Price must be greater than both Price and Purchase Price.');
        e.preventDefault();
        return false;
    }

    if (price <= purchasePrice) {
        alert('❌ Price must be greater than Purchase Price.');
        e.preventDefault();
        return false;
    }

    return true; // allow form submit if all conditions pass
});

$('input[name="old_price"], input[name="price"], input[name="purchase_price"]').on('input', function () {
    let oldPrice = parseFloat($('input[name="old_price"]').val()) || 0;
    let price = parseFloat($('input[name="price"]').val()) || 0;
    let purchasePrice = parseFloat($('input[name="purchase_price"]').val()) || 0;
    
    let message = '';
    if (oldPrice && price && oldPrice <= price) message = 'Old Price should be greater than Price.';
    else if (oldPrice && purchasePrice && oldPrice <= purchasePrice) message = 'Old Price should be greater than Purchase Price.';
    else if (price && purchasePrice && price <= purchasePrice) message = 'Price should be greater than Purchase Price.';

    if (message) {
        console.warn(message);
    }
});



     
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {

    const toggle = document.getElementById("variantToggle");
    const variantSection = document.getElementById("variantSection");
    const totalStock = document.querySelector("input[name='total_product']");
    const variantTable = document.getElementById("variantTableWrapper");

    // Switch Toggle Logic
    toggle.addEventListener("change", function () {

        if (toggle.checked) {
            // ON → Enable Variants
            variantSection.style.display = "flex";
            totalStock.disabled = true;
            totalStock.value = "";
        } else {
            // OFF → Disable Variants
            variantSection.style.display = "none";
            totalStock.disabled = false;
        }
    });

    // Auto-update total stock based on variants
    const observer = new MutationObserver(() => updateTotalStock());
    observer.observe(variantTable, { childList: true, subtree: true });

    function updateTotalStock() {
        if (!toggle.checked) return;

        let sum = 0;
        const inputs = variantTable.querySelectorAll("tbody input[type='number']");
        
        inputs.forEach(i => {
            let v = parseInt(i.value);
            if (!isNaN(v)) sum += v;
        });

        totalStock.value = sum;
    }

    // Update on typing in variant stock inputs
    document.addEventListener("input", function (e) {
        if (e.target.closest("#variantTableWrapper")) {
            updateTotalStock();
        }
    });

});

</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {

    let options = [];

    const optionContainer = document.getElementById("variantOptions");
    const addOptionBtn = document.getElementById("addOptionBtn");
    const generateBtn = document.getElementById("generateVariantsBtn");
    const variantTableWrapper = document.getElementById("variantTableWrapper");

    // Disable Generate button initially
    generateBtn.disabled = true;
    generateBtn.style.opacity = 0.5;

    // Prevent Enter from submitting or printing anything
    window.addEventListener("keydown", (e) => {
        if (e.key === "Enter") e.preventDefault();
    });

    // Add option button
    addOptionBtn.addEventListener("click", () => {
        const id = Date.now();
        options.push({ id, name: "", values: [] });

        // Change label After first option
        if (options.length === 1) {
            addOptionBtn.innerText = "Add another option";
        }

        renderOptions();
        updateGenerateBtn();
    });

    // Render all options
    function renderOptions() {
        optionContainer.innerHTML = "";

        options.forEach(opt => {
            const box = document.createElement("div");
            box.className = "option-box";

            box.innerHTML = `
                <div class="option-title">Option name</div>
                <input type="text" class="option-name"
                       data-id="${opt.id}"
                       placeholder="Color, Size..." 
                       value="${opt.name}">

                <div class="option-title">Option values</div>
                <div class="values-list" id="values-${opt.id}"></div>
            `;

            optionContainer.appendChild(box);
            renderOptionValues(opt);
        });

        attachOptionNameEvents();
        updateGenerateBtn();
    }

    // Render value chips + 1 input + add button
    function renderOptionValues(opt) {
        const container = document.getElementById(`values-${opt.id}`);
        container.innerHTML = "";

        // Render Chips
        opt.values.forEach(val => {
            const chip = document.createElement("div");
            chip.className = "value-item";
            chip.innerHTML = `
                ${val}
                <button type="button" class="remove-value" data-opt="${opt.id}" data-val="${val}">x</button>
            `;
            container.appendChild(chip);
        });

        // Create Input + Add Button Row
        const row = document.createElement("div");
        row.style.display = "flex";
        row.style.gap = "10px";
        row.style.marginTop = "5px";

        const input = document.createElement("input");
        input.className = "value-input";
        input.placeholder = "Add value...";

        const addBtn = document.createElement("button");
        addBtn.type = "button";
        addBtn.innerText = "Add";
        addBtn.className = "add-value-btn";

        // Add value by clicking Add button
        addBtn.addEventListener("click", () => {
            const val = input.value.trim();
            if (val && !opt.values.includes(val)) {
                opt.values.push(val);
                renderOptions();
            }
        });

        // Auto-add on comma or space
        input.addEventListener("input", () => {
            const raw = input.value.trim();

            if (input.value.endsWith(",") || input.value.endsWith(" ")) {
                const val = raw.replace(",", "");
                if (val && !opt.values.includes(val)) {
                    opt.values.push(val);
                    renderOptions();
                }
            }
        });

        // Auto-add on blur
        input.addEventListener("blur", () => {
            const val = input.value.trim();
            if (val && !opt.values.includes(val)) {
                opt.values.push(val);
            }
            renderOptions();
        });

        row.appendChild(input);
        row.appendChild(addBtn);
        container.appendChild(row);

        attachRemoveValueEvents();
        updateGenerateBtn();
    }

    // Option name update
    function attachOptionNameEvents() {
        document.querySelectorAll(".option-name").forEach(input => {
            input.addEventListener("input", e => {
                const opt = options.find(o => o.id == e.target.dataset.id);
                opt.name = e.target.value;
                updateGenerateBtn();
            });
        });
    }

    // Remove chip
    function attachRemoveValueEvents() {
        document.querySelectorAll(".remove-value").forEach(btn => {
            btn.addEventListener("click", () => {
                const optId = btn.dataset.opt;
                const val = btn.dataset.val;

                const opt = options.find(o => o.id == optId);
                opt.values = opt.values.filter(v => v !== val);

                renderOptions();
            });
        });
    }

    // Enable/Disable Generate Button
    function updateGenerateBtn() {
        const ok =
            options.length > 0 &&
            options.every(o => o.name.trim().length > 0) &&
            options.every(o => o.values.length > 0);

        generateBtn.disabled = !ok;
        generateBtn.style.opacity = ok ? 1 : 0.5;
    }

    // Generate Variants
    generateBtn.addEventListener("click", () => {
        if (generateBtn.disabled) return;

        let arrays = options.map(o => o.values);

        // Fix for single option
        const combos = arrays.length === 1
            ? arrays[0].map(v => [v])
            : arrays.reduce((a, b) =>
                  a.flatMap(x => b.map(y => [].concat(x, y)))
              );

        renderVariantTable(combos);
    });

    // Variant Table
    function renderVariantTable(data) {
        let html = `
            <table border="1" cellpadding="10" style="margin-top:15px; width:100%;">
                <tr>
                    ${options.map(o => `<th>${o.name}</th>`).join("")}
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
        `;

        data.forEach(row => {
            html += `
                <tr>
                    ${row.map(v => `<td>${v}</td>`).join("")}
                    <td><input type="text" placeholder="₹0.00"></td>
                    <td><input type="number" value="0"></td>
                </tr>
            `;
        });

        html += `</table>`;
        variantTableWrapper.innerHTML = html;
    }

});

</script>

@endsection