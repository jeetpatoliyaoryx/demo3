@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>All Withdraw Requests</h5>
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
                                   <div>
                                      @include('_message')
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Username</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Reason</th>
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
                                                            {{ $value->name }}  
                                                        </td>
                                                        <td>
                                                            {{ $value->amount }}  
                                                        </td>
                                                        <td>
                                                            {{ date('d-m-Y', strtotime($value->created_at)) }}  
                                                        </td>
                                                        <td class="font-primary">
                                                            @if($value->type == 1)
                                                                Pending
                                                            @elseif($value->type == 2)
                                                           <span style="color: green;">     Success  </span>
                                                            @elseif($value->type == 3)
                                                                Rejected
                                                            @endif
                                                        </td>
                                                         <td>
                                                           {{ $value->reason }}  
                                                        </td>
                                                        <td>
                                                              @if($value->type == 1)
                                                                  <a class="btn btn-primary" href="{{ url('admin/withdraw_requests/accept/'.$value->id) }}" Onclick="return confirm('Are you sure you want to approve?')">
                                                               Approve
                                                            </a>

                                                             


                                                             <a class="btn btn-danger AddReason" id="<?=$value->id?>" href="javascript:;">
                                                               Reject
                                                            </a>


                                
                                                        
                                                            @endif

                                                            <a class="btn btn-success" href="{{ url('admin/users/view/'.$value->user_id) }}">
                                                               User Bank Detail
                                                            </a>
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


 <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-md">
      <form method="post" action="{{ url('admin/withdraw_requests/add_reason') }}">
         {{ csrf_field() }}
         <input type="hidden" id="reason_no" name="reason_no" class="form-control">
         <div class="modal-content">
            <div class="modal-header">
              
               <h4 class="modal-title">Reason </h4>
            </div>
            <div class="modal-body">
               
               <div class="col-md-12">
                  <textarea name="reason" rows="6" required class="form-control"></textarea>
               </div>
               <div style="clear: both;"></div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </div>
      </form>
   </div>
</div>

@endsection
@section('script')
<script type="text/javascript">

 $('table').delegate('.AddReason','click',function(){
       var id = $(this).attr('id');
       $('#reason_no').val(id);
        $('#myModal').modal('show');
    });
 

</script>
@endsection