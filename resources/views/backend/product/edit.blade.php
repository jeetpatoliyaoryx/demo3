
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
                                                        <label class="form-label-title col-sm-2 mb-0">Total Product</label>
                                                        <div class="col-sm-10">
                                                            <input name="total_product" type="text" class="form-control only-numeric" placeholder="Total Product" required value="{{ $product->total_product }}">
                                                             
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
                                                        <label class="form-label-title col-sm-2 mb-0">Video File </label>
                                                        <div class="col-sm-10">
                                                              <input name="video_file" accept="video/mp4,video/x-m4v,video/*" type="file" class="form-control" placeholder="Video File" style="padding-top: 2px;" value="{{ $product->video_file }}">

                                                               @if(!empty($product->getVideoFile()))
                                                                  <video width="220" height="140" controls autoplay>
                                                                       <source src="{{ $product->getVideoFile(); }}" type="video/mp4">
                                                                  </video>
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
                <!-- New Product Add End -->

           </div>
            <!-- Container-fluid End -->

@endsection

@section('script')

<script type="text/javascript" src="{{ url('frontend/tinymce/tinymce.min.js') }}"></script>

<script src="{{ asset('frontend/fileinput.min.js')}}" type="text/javascript"></script>

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
           /* Delete picture */
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

@endsection