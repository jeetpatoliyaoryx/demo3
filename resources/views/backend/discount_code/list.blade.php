@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5> Coupon Code</h5>
                    <form class="d-inline-flex">
                        <a href="{{ url('admin/couponcode/add') }}" class="align-items-center btn btn-theme">
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
                                       @include('_message')
                                   <div class="coupon-code-page">
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name </th>
                                                        <th>Type </th>
                                                        <th>Price </th>
                                                        <th>Maximum Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                     @forelse($getrecord as $value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->discount_code }}</td>
                                                        <td>{{ !empty($value->type)?'Amount':'Percentage' }}</td>
                                                        <td>{{ $value->discount_price }}</td>
                                                        <td>{{ $value->maximum_price }}</td>
                                                        
                                                        <td>
                                                            <ul>
                                                      
                                                                <li>
                                                                    <a href="{{ url('admin/couponcode/edit/'.$value->id) }}">
                                                                        <span class="lnr lnr-pencil"></span>
                                                                    </a>
                                                                </li>

                                                                 <li>
                                                                    <a href="{{ url('admin/couponcode/delete/'.$value->id) }}">
                                                                        <span class="lnr lnr-trash"></span>
                                                                    </a>
                                                                </li> 
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