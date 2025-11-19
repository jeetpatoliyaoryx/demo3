@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>All Products</h5>
                    <form class="d-inline-flex">
                        <a href="{{ url('admin/product/add') }}" class="align-items-center btn btn-theme">
                            <i data-feather="plus-square"></i>Add New
                        </a> 
                    </form>
                </div>
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">


                            <div class="card">


 @include('_message') 
                                <div class="card-body">

                                     {{-- Search Box Start --}}
            <div class="panel panel-default">
              

                  <div class="panel-body" style="overflow: auto;">
                    <form action="" method="get" name="submitform">
                        <div class="row">
                        <div class="col-md-2">
                           <label>ID</label>
                           <input type="text" value="{{ Request()->id }}" class="form-control" placeholder="ID" name="id">
                        </div>

                        <div class="col-md-4">
                           <label>Title</label>
                           <input type="text" class="form-control" value="{{ Request()->title }}" placeholder="Title" name="title">
                        </div>


                        <div class="col-md-4">
                           <label>SKU</label>
                           <input type="text" class="form-control" value="{{ Request()->sku }}" placeholder="SKU" name="sku">
                        </div>

                     
                        

                        <div class="col-md-2">
                           <label>Status</label>
                           <select class="form-control" name="is_public" >
                              <option value="">Select Status</option>
                              <option {{ (Request()->is_public == '1000')?'selected':'' }} value="1000">Active</option>
                              <option {{ (Request()->is_public == '1')?'selected':'' }} value="1">Inactive</option>
                           </select>
                        </div>
                        </div>
                                                 
                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                           <input type="submit" class="btn btn-primary" value="Search">
                           <a href="{{ url('admin/product') }}" class="btn btn-success">Reset</a>
                        </div>
                     </form>
                  </div>
               </div>  

                    {{-- Section Start --}}

                                   <div class="product-table">
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                        
                                                        <!-- <th>ID</th>
                                                        <th>Image</th>
                                                        <th>Title & Category</th>
                                                        <th>SKU</th>
                                                        <th>Total Product </th>
                                                        <th>Old Price </th>
                                                        <th>Price </th>
                                                        <th>Purchase Price </th>
                                                        <th>Featured</th>
                                                        <th>New Arrivals</th>
                                                        <th>Best Selling</th>
                                                        <th>Status</th>
                                                        <th>Created Date</th>
                                                        <th>Action</th> -->


                                                        <th>ID</th>
                                                        <th>Image</th>
                                                        <th>Product Name & Category</th>
                                                        <th>SKU</th>
                                                        <th>Stock/Quantity </th>
                                                        <!-- <th>Old Price (MRP) </th> -->
                                                        <th>Price (Sale) </th>
                                                        <th>Purchase Price </th>
                                                        <!-- <th>Featured</th> -->
                                                        <!-- <th>New Arrivals</th> -->
                                                        <!-- <th>Best Selling</th> -->
                                                        <th>Product Status</th>
                                                        <!-- <th>Created Date</th> -->
                                                        <th>Action</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($getRecord as $value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td style="min-width: 1px;">
                                                            @if(!empty($value->photo()))    
                                                            <span>
                                                                <img src="{{ $value->photo() }}" alt="users">
                                                            </span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @if(!empty($value->total_product))
                                                            <a href="javascript:void(0)">
                                                                <span class="d-block "><a href="{{ url('item/'.$value->slug) }}" target="_blank">{{ $value->title }}</a></span><br>
                                                                <span>{{ !empty($value->category) ? $value->category->name : '' }}</span>
                                                            </a>
                                                            @else
                                                            <a href="javascript:void(0)">
                                                                <span class="d-block ">{{ $value->title }}</span><br>
                                                                <span>{{ !empty($value->category) ? $value->category->name : '' }}</span>
                                                            </a>
                                                            @endif
                                                        </td>

                                                        <td>{{ $value->sku }}</td>
                                                        <td>{{ $value->total_product }}</td>
                                                        <!-- <td>{{ $value->old_price }}</td> -->
                                                        <td>{{ $value->price }}</td>
                                                        <td>{{ $value->purchase_price }}</td>

                                                        <!-- <td>
                                                            @if(!empty($value->is_featured))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($value->is_new_arrival))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!empty($value->is_best_selling))
                                                            <i class="fa fa-check"></i>
                                                            @endif
                                                        </td> -->

                                                        <td>{{ ($value->is_public == 0) ? 'Active' : 'Inactive' }}</td>
                                                        <!-- <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td> -->

                                                        <td>
                                                            <ul>
                                                               {{--  <li>
                                                                    <a href="order-detail.html">
                                                                        <span class="lnr lnr-eye"></span>
                                                                    </a>
                                                                </li>
 --}}
                                                                <li>
                                                                    <a href="{{ url('admin/product/edit/'.$value->id) }}">
                                                                        <span class="lnr lnr-pencil"></span>
                                                                    </a>
                                                                </li>

                                                                {{-- <li>
                                                                    <a href="javascript:void(0)">
                                                                        <span class="lnr lnr-trash"></span>
                                                                    </a>
                                                                </li> --}}
                                                            </ul>
                                                        </td>
                                                    </tr>

                                                  @empty
                                                  <tr>
                                                      <td colspan="100%">Record not found.</td>
                                                  </tr>
                                                  @endforelse


                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="pagination-box">
                                    <nav class="ms-auto me-auto " aria-label="...">
                                        <ul class="pagination pagination-primary">
                                              {!! $getRecord->appends(request()->query())->links() !!}
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