@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>Item Order</h5>
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
                                   <div>
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Product Name </th>
                                                        <th>Color Name</th>
                                                        <th>Size Name</th>
                                                        <th>QTY</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>Created AT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($getRecord as $value)
                                                    <tr>
                                                        <td>{{ $value->id }}</td>
                                                        <td>{{ $value->title }}</td>
                                                        <td>{{ $value->color_name }}</td>
                                                        <td>{{ $value->size_name }}</td>
                                                        <td>{{ $value->qty }}</td>
                                                        <td>{{ $value->price }}</td>
                                                        <td>{{ $value->total }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
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