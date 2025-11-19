@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>All Contact Us</h5>
                    <form class="d-inline-flex">
                     
                    </form>
                </div>
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                  @include('_message')  

                                <div class="card-body">
                                   <div class="contact-us-page">
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                       <th>ID</th>
                                                        <th>Name </th>
                                                        <th>Email</th>
                                                        <th>Message</th>
                                                        <th>Created Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($getRecord as $value)
                                                   <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->name }}</td>
                                                        <td>{{ $value->email }}</td>
                                                        <td>{{ $value->message }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                        <td>
                                                             <a href="{{ url('admin/contact_us/delete/'.$value->id) }}">
                                                                        <span class="lnr lnr-trash"></span>
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

@endsection

@section('script')


<script type="text/javascript">


</script>
@endsection