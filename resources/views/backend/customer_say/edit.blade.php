@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')



  <div class="page-body">
                <div class="title-header">
                    <h5>Edit Customer Say</h5>
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
                                                        <label class="form-label-title col-sm-2 mb-0">Name</label>
                                                        <div class="col-sm-10">
                                                          <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $getrecord->name }}" required> 
                                                          
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Title</label>
                                                        <div class="col-sm-10">
                                                          <input name="title" type="text" placeholder="Title" class="form-control" required value="{{ $getrecord->title }}">
                                                        </div>
                                                    </div>
                                                     <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Rating</label>
                                                        <div class="col-sm-10">
                                                          
                                                          <select name="rating" class="form-control">
                                                            <option value="1" {{ old('rating', $getrecord->rating) == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ old('rating', $getrecord->rating) == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ old('rating', $getrecord->rating) == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ old('rating', $getrecord->rating) == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ old('rating', $getrecord->rating) == 5 ? 'selected' : '' }}>5</option>
                                                        </select>

                                                          
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Image </label>
                                                        <div class="col-sm-10">
                                                            <input name="image" type="file" class="file picimg" >  
                                                           @if(!empty($getrecord->image))
                                                          <img src="{{ $getrecord->getImage() }}" style="height:100px;"><br>
                                                          <span class="pt-2 highlight-text">(<b>Important:-</b> Add Only Square Image, i.e 1000X1000 or 2000X2000)</span>
                                                          @endif
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">Description </label>
                                                        <div class="col-sm-10">
                                                          
                                                            <textarea name="description" class="form-control" required placeholder="Description">{{ $getrecord->description }}</textarea>
                                                        </div>
                                                    </div>

                                                  
                                                      <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-2 mb-0">
                                                            Price</label>
                                                        <div class="col-sm-10">
                                                          <input name="price" type="text" required placeholder="Price" class="form-control" value="{{ $getrecord->price }}">
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
@endsection