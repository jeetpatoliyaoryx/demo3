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
                    <h5>Add New Category</h5>
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
                                                <h5>Category</h5>
                                            </div>

                                            <form class="theme-form theme-form-2 mega-form" method="post" action="" enctype="multipart/form-data"> 
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Name</label>
                                                        <div class="col-sm-10">

                                                               <input name="name" type="text"  class="form-control" required value="{{ old('name', !empty($getrecord) ? $getrecord->name : '') }}">
                                                                 <span style="color:red">{{  $errors->first('name') }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                       <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0"> Image</label>
                                                        <div class="col-sm-10">
                                                         <input name="category_image" type="file"  class="form-control">
                                                        <span class="pt-2 highlight-text">(<b>Important:-</b> Add Only Square Image, i.e 1000X1000 or 2000X2000)</span>
                                                        </div>
                                                    </div>

                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0"> Category Banner Image</label>
                                                        <div class="col-sm-10">
                                                         <input name="category_banner_image" type="file"  class="form-control">
                                                        <span class="pt-2 highlight-text">(<b>Important:-</b>  Please upload an image with resolution of exactly 1440×548 px.)</span>
                                                        </div>
                                                    </div>

                                                  <hr />

                                                  @php
                                                    $status = 0;
                                                    $parent_id = '';
                                                    if(!empty($getrecord))
                                                    {
                                                       $status = $getrecord->status;
                                                       $parent_id = $getrecord->parent_id;               
                                                    }
                                                    @endphp


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Parent Category  </label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100"  id="ParentCategory" name="parent_id[]" >
                                                                 <option value="">None</option>
                                                                  @foreach($getParentCategory as $value)
                                                                    <option {{ ($parent_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                                  @endforeach
                                                            </select>
                                                              <div id="appendCategory"></div>
                                                        </div>

                                                    </div>


                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-sm-2 col-form-label form-label-title">Status  </label>
                                                        <div class="col-sm-10">
                                                            <select class="js-example-basic-single w-100" required name="status">
                                                                <option {{ ($status==0) ? 'selected' : '' }} value="0">Active</option>
                                                                <option {{ ($status==1) ? 'selected' : '' }} value="1">Inactive</option>
                                                            </select>
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
                <!-- New Product Add End -->

           </div>
            <!-- Container-fluid End -->

@endsection
@section('script')
<script type="text/javascript">
   $('#ParentCategory').change(function() {
         var parent_id = $(this).val();
         var CSRF_TOKEN = "{{ csrf_token() }}";
         $('#appendCategory').html('');
         $.ajax({
               type:'POST',
               url:"{{url('admin/category/parent')}}",
               data: {
                     _token: CSRF_TOKEN,
                     parent_id:parent_id,
               },
               dataType: 'JSON',
               success:function(data) {
                  if(data.success != 0)
                  {
                     $('#appendCategory').html(data.success);   
                  }
                  else
                  {
                     $('#appendCategory').html('');     
                  }
                  
               }
         });
      });


</script>


<script>
document.querySelector('input[name="category_banner_image"]').addEventListener('change', function(event) {
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

@endsection