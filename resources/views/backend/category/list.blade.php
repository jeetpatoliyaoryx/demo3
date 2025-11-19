@extends('backend.layouts.app')
@section('style')
<style type="text/css">
                                 
   .category-tree {
      list-style: none;
      padding-left: 0;
      font-family: "Segoe UI", sans-serif;
      font-size: 15px;
   }

   .category-tree li {
      position: relative;
      margin: 6px 0;
      padding: 8px 12px;
      background: #f9f9f9;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.08);
      transition: all 0.2s ease;
   }

   .category-tree li:hover {
      background: #eef6ff;
   }

   .category-tree li a {
      margin-left: 10px;
      color: #007bff;
      text-decoration: none;
   }

   .category-tree li a:hover {
      color: #0056b3;
   }

   .category-tree ul {
      margin-top: 6px;
      margin-left: 20px;
      padding-left: 15px;
      border-left: 2px solid #e0e0e0;
   }

   .category-tree i {
      margin-left: 8px;
      color: #555;
      cursor: pointer;
      transition: color 0.2s;
   }

   .category-tree i:hover {
      color: #007bff;
   }
</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>All Category</h5>
                    <form class="d-inline-flex">
                        <a href="{{ url('admin/category/add') }}" class="align-items-center btn btn-theme">
                            <i data-feather="plus-square"></i>Add New
                        </a> 
                    </form>
                </div>
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
 
                                <div class="card-body">
                                   <div class="category-table-page">
                                        @include('_message')
                                        <div class="table-responsive table-desi">
                               
                                            <ul class="category-tree">
                                               @foreach($getParentCategory as $value)
                                                  <li>
                                                     <strong>{{ $value->name }}</strong>
                                                     <a href="{{ url('admin/category/edit/'.$value->id) }}"><i class="fa fa-edit"></i></a>
                                                     @if($value->status == 1)
                                                          <span class="badge bg-danger">Inactive</span>
                                                      @else
                                                          <span class="badge bg-success">Active</span>
                                                      @endif
                                                     <ul>
                                                        @foreach($value->subcategoryBackend as $subcategory)
                                                           <li>
                                                              {{ $subcategory->name }}
                                                              <a href="{{ url('admin/category/edit/'.$subcategory->id) }}"><i class="fa fa-edit"></i></a>
                                                               @if($subcategory->status == 1)
                                                                   <span class="badge bg-danger">Inactive</span>
                                                               @else
                                                                   <span class="badge bg-success">Active</span>
                                                               @endif

                                                              <ul>
                                                                 @foreach($subcategory->subcategoryBackend as $subcategory_p)
                                                                    <li>
                                                                       {{ $subcategory_p->name }}
                                                                       <a href="{{ url('admin/category/edit/'.$subcategory_p->id) }}"><i class="fa fa-edit"></i></a>
                                                                     
                                                                     @if($subcategory_p->status == 1)
                                                                         <span class="badge bg-danger">Inactive</span>
                                                                     @else
                                                                         <span class="badge bg-success">Active</span>
                                                                     @endif

                                                                    </li>
                                                                 @endforeach
                                                              </ul>
                                                           </li>
                                                        @endforeach
                                                     </ul>
                                                  </li>
                                               @endforeach
                                            </ul>

                                      
                                        </div>
                                    </div>
                                </div>

                                <div class="pagination-box">
                                    <nav class="ms-auto me-auto " aria-label="...">
                                        <ul class="pagination pagination-primary">
                                           
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- All User Table Ends-->

            </div>
            <!-- Container-fluid end -->

@endsection

@section('script')


<script type="text/javascript">


</script>
@endsection