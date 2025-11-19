

@extends('backend.layouts.app')
@section('style')
<style type="text/css">

</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>Order Tracking</h5>
                    <form class="d-inline-flex">
                     
                    </form>
                </div>
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">

                                <div class="card-body">
                                   <div>

                                     <p><strong>Order ID:</strong> {{ $shipment->order_id }}</p>
            <p><strong>AWB Code:</strong> {{ $shipment->awb_code }}</p>
            <p><strong>Courier:</strong> {{ $shipment->courier ?? 'N/A' }}</p>

                                        <div class="table-responsive table-desi">
                                             @if(isset($track['tracking_data']['shipment_track_activities']) && count($track['tracking_data']['shipment_track_activities']) > 0)
                                            <table class="user-table table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Location</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               
                                                  @foreach($track['tracking_data']['shipment_track_activities'] as $activity)
                                                            <tr>
                                                                <td>{{ $activity['date'] ?? '-' }}</td>
                                                                <td>{{ $activity['status'] ?? '-' }}</td>
                                                                <td>{{ $activity['location'] ?? '-' }}</td>
                                                                <td>{{ $activity['remark'] ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                               


                                                    
                                                </tbody>
                                            </table>
                                             @else
                <p class="text-muted">No tracking updates available.</p>
            @endif
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
