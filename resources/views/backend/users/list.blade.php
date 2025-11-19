@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>All Users</h5>
                    <form class="d-inline-flex">
                     {{--    <a href="{{ url('admin/users/add') }}" class="align-items-center btn btn-theme">
                            <i data-feather="plus-square"></i>Add New
                        </a> --}}
                    </form>
                </div>
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">

                                <div class="card-body">


                                     {{-- Search Box Start --}}
            <div class="panel panel-default">
              

                  <div class="panel-body" style="overflow: auto;">
                    <form action="" method="get" name="submitform">
                        <div class="row">
                        <div class="col-md-3">
                           <label>ID</label>
                           <input type="text" value="{{ Request()->id }}" class="form-control" placeholder="ID" name="id">
                        </div>

                        <div class="col-md-4">
                           <label>Name</label>
                           <input type="text" class="form-control" value="{{ Request()->name }}" placeholder="Name  " name="name">
                        </div>


                        <div class="col-md-3">
                           <label>Email</label>
                           <input type="email" class="form-control" value="{{ Request()->email }}" placeholder="Email" name="email">
                        </div>

                     
                        <div class="col-md-2">
                           <label>Status</label>
                           <select class="form-control" name="status" >
                              <option value="">Select Status</option>
                              <option {{ (Request()->status == '1000')?'selected':'' }} value="1000">InActive</option>
                              <option {{ (Request()->status == '1')?'selected':'' }} value="1">Active</option>
                           </select>
                        </div>
                        </div>
                                                 
                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                           <input type="submit" class="btn btn-primary" value="Search">
                           <a href="{{ url('admin/users') }}" class="btn btn-success">Reset</a>
                        </div>
                     </form>
                  </div>
               </div>  

                    {{-- Section Start --}}

                                   <div class="user-page-table">
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                         <th>ID</th>
                                                        <th>User</th>
                                                        <th>Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                 @forelse($getRecord as $value)
                                                    <tr>
                                                         <td>
                                                            {{ $value->id }} 
                                                         </td>
                                                        <td>
                                                            <span>
                                                                <img src="{{ $value->getImage() }}" alt="users">
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <span class="d-block ">{{ $value->name }}</span>
                                                                <span>{{ $value->email }}</span>
                                                            </a>
                                                        </td>
                                                        <td class="font-primary">
                                                            @if($value->status == 1)
                                                                Active
                                                            @else
                                                                InActive
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('admin/users/view/'.$value->id) }}">
                                                                <span class="lnr lnr-eye"></span>
                                                            </a>

                                                            @if($value->is_delete == 1)
                                                            <a href="{{ url('admin/users/delete/'.$value->id) }}" class="btn btn-primary">
                                                              InActive
                                                            </a>
                                                            @else
                                                             <a href="{{ url('admin/users/delete/'.$value->id) }}"  class="btn btn-danger">
                                                                Active
                                                            </a>
                                                            @endif
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