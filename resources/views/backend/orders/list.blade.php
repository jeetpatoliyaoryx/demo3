@extends('backend.layouts.app')
@section('style')
<style type="text/css">
    .status-badge {
  display: inline-block;
  padding: 4px 10px;
  font-size: 12px;
  font-weight: 600;
  border-radius: 9999px; /* pill shape */
  color: #fff;
}

.status-pending { background-color: #f59e0b; }   /* amber */
.status-processing { background-color: #3b82f6; } /* blue */
.status-delivery { background-color: #6366f1; }   /* indigo */
.status-completed { background-color: #10b981; }  /* green */

</style>
@endsection 
@section('content')

      
            <!-- Container-fluid starts-->
            <div class="page-body">
                <div class="title-header title-header-1">
                    <h5>All Order</h5>
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


                                     {{-- Search Box Start --}}
                                    <div class="panel panel-default">
                                        <div class="panel-body" style="overflow: auto;">
                                            <form action="" method="get" name="submitform">
                                                <div class="row">
                                                <div class="col-md-3" style="margin-bottom: 10px;">
                                                <label>ID</label>
                                                <input type="text" value="{{ Request()->id }}" class="form-control" placeholder="ID" name="id">
                                                </div>

                                                <!-- <div class="col-md-4" style="margin-bottom: 10px;">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" value="{{ Request()->first_name }}" placeholder="First Name  " name="first_name">
                                                </div>

                                                <div class="col-md-4" style="margin-bottom: 10px;">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" value="{{ Request()->last_name }}" placeholder="Last Name  " name="last_name">
                                                </div> -->


                                                <div class="col-md-4">
                                                <label>Email</label>
                                                <input type="email" class="form-control" value="{{ Request()->email }}" placeholder="Email" name="email">
                                                </div>

                                            
                                                <div class="col-md-3">
                                                <label>Payment</label>
                                                <select class="form-control" name="is_payment" >
                                                    <option value="">Select Payment</option>
                                                    <option {{ (Request()->is_payment == '1000')?'selected':'' }} value="1000">Pending</option>
                                                    <option {{ (Request()->is_payment == '1')?'selected':'' }} value="1">Done</option>
                                                </select>
                                                </div>
                                                </div>
                                                                        
                                                <div style="clear: both;"></div>
                                                <br>
                                                <div class="col-md-12" style="margin-bottom: 10px;">
                                                <input type="submit" class="btn btn-primary" value="Search">
                                                <a href="{{ url('admin/orders') }}" class="btn btn-success">Reset</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>  

                                    {{-- Section Start --}}
                                    {{-- <a href="" class="btn btn-danger"  onclick="return confirm('Are you sure you want to create?');" id="getCreateURL">Create</a> --}}

                                    <!-- Bulk Create Form -->
                                    <form id="bulkShiprocketForm" action="{{ route('admin.orders.ship.bulk') }}" method="POST">
                                        @csrf

                                        <!-- <button type="submit" 
                                                class="btn btn-danger my-3" 
                                                id="bulkCreateButton"
                                                onclick="return confirm('Create Shiprocket orders for selected items?');">
                                            Ship Bulk Orders
                                        </button> -->


                                        <ul class="nav nav-tabs my-3" id="staticOrderTabs" role="tablist">
                                            <li class="nav-item">
                                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#newOrdersTab" type="button">New Orders</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#readytoship" type="button">Ready to Ship</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pickups" type="button">Pickups & Manifests</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#intransit" type="button">In Transit</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivered" type="button">Delivered</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rto" type="button">RTO</button>
                                            </li>
                                            <li class="nav-item">
                                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#return" type="button">Return</button>
                                            </li>
                                        </ul>


                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="newOrdersTab">
                                                <button type="submit" 
                                                        class="btn btn-danger mb-3" 
                                                        id="bulkCreateButton"
                                                        onclick="return confirm('Create Shiprocket orders for selected items?');">
                                                    Ship Bulk Orders
                                                </button>
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Order</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Ship Order</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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
                                            <div class="tab-pane fade" id="readytoship">
                                                <button type="submit" 
                                                        class="btn btn-danger mb-3" 
                                                        id="bulkCreateButton"
                                                        onclick="return confirm('Create Shiprocket orders for selected items?');">
                                                    Download Bulk Invoice
                                                </button>
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Download Invoice</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Download Invoice</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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
                                            <div class="tab-pane fade" id="pickups">
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Order</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Ship Order</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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
                                            <div class="tab-pane fade" id="intransit">
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Order</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Ship Order</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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
                                            <div class="tab-pane fade" id="delivered">
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Order</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Ship Order</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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
                                            <div class="tab-pane fade" id="rto">
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Order</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Ship Order</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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
                                            <div class="tab-pane fade" id="return">
                                                <div class="order-table">
                                                    <div class="table-responsive table-desi">
                                                        <table class="user-table table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <!-- <th>  <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Rocket</th>
                                                                    <th>First Name  </th>
                                                                    <th>Last Name   </th>
                                                                    <th>Email </th>
                                                                    <th>Phone Nnumber</th>
                                                                    <th>Street Address</th>
                                                                    <th>Flat Other</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th> -->

                                                                    <th> <input type="checkbox" class="select-all-checkbox" id="select-all"> <span></span></th>
                                                                    <th>ID</th>
                                                                    <th>Ship Order</th>
                                                                    <th>Order Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Payment Method</th>
                                                                    <th>Order Date</th>
                                                                    <th>Name</th>
                                                                    <!-- <th>Last Name   </th> -->
                                                                    <th>Email </th>
                                                                    <th>Phone Number</th>
                                                                    <th>Address</th>
                                                                    <th>City</th>
                                                                    <th>Country</th>
                                                                    <th>Pin Code </th>
                                                                    <th>Total QTY </th>
                                                                    <th>Total</th>
                                                                    <th>Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($getRecord as $value)
                                                                <tr>
                                                                    <td>
                                                                    {{-- <input class="create-shiprocket-order-all-option" value="{{ $value->id }}" type="checkbox" > --}}
                                                                    <input type="checkbox" name="order_ids[]" value="{{ $value->id }}" class="order-checkbox">
                                                                    </td>
                                                                    <td>{{ $value->id }}</td>
                                                                    <td>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/ship') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-primary" type="submit">Ship Order</button>
                                                                        </form>

                                                                    {{--     <form action="{{ url('admin/orders/'.$value->id.'/assign-awb') }}" method="POST" style="display:inline">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-warning" type="submit">Assign AWB</button>
                                                                        </form>

                                                                        <a href="{{ url('admin/orders/'.$value->id.'/label') }}" class="btn btn-sm btn-success">Label / Download</a>
                                                                        <a href="{{ url('admin/orders/'.$value->id.'/track') }}" class="btn btn-sm btn-info">Track</a>

                                                                        <form action="{{ url('admin/orders/'.$value->id.'/pickup') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-danger" type="submit">Generate Pickup</button>
                                                                    </form>

                                                                    <form action="{{ url('admin/orders/'.$value->id.'/print-invoice') }}" method="POST" style="display:inline">
                                                                        @csrf
                                                                        <button class="btn btn-sm btn-dark" type="submit">Print Invoice</button>
                                                                    </form>
                                                                    --}}

                                                                    </td>


                                                                    <td>
                                                                    @if($value->status == 1)
                                                                        <span class="status-badge status-pending">Pending</span>
                                                                    @elseif($value->status == 2)
                                                                        <span class="status-badge status-processing">Processing</span>
                                                                    @elseif($value->status == 3)
                                                                        <span class="status-badge status-delivery">Delivery</span>
                                                                    @elseif($value->status == 4)
                                                                        <span class="status-badge status-completed">Completed</span>
                                                                    @endif
                                                                    </td>

                                                                    <td>{{ ($value->is_payment == 0) ? 'Pending' : 'Done' }}</td>
                                                                    <td>
                                                                        @if($value->payment_method == 'Razorpay')
                                                                            Online
                                                                        @elseif($value->payment_method == 'Cash')
                                                                            COD
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>



                                                                    <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                                    <!-- <td>{{ $value->last_name }}</td> -->
                                                                    <td>{{ $value->email }}</td>
                                                                    <td>{{ $value->phone_number }}</td>
                                                                    <td>{{ $value->flat_other }}, {{ $value->street_address }}</td>
                                                                    <td>{{ $value->city }}</td>
                                                                    <td>{{ !empty($value->country->name) ?  $value->country->name : ''}}</td>
                                                                    <td>{{ $value->pin_code }}</td>
                                                                    <td>{{ $value->total_qty }}</td>
                                                                    <td>{{ $value->total }}</td>   
                                                                    
                                                                    <td>
                                                                            <a href="{{ url('admin/orders/orders_item/'.$value->id) }}">
                                                                                <span class="lnr lnr-eye"></span>
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

                                        </div>




                                        








                                    </form>

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
{{-- 
<script type="text/javascript">
$(document).ready(function(){

    // Function to update URL whenever checkboxes change
    function updateCreateUrl() {
        var total = '';
        $('.create-shiprocket-order-all-option:checked').each(function(){
            total += $(this).val() + ',';
        });
        var url = '{{ url('admin/orders/create_shiprocket_order_all_option?id=') }}' + total;
        $('#getCreateURL').attr('href', url);
    }

    // Individual checkbox change event
    $('.create-shiprocket-order-all-option').change(function(){
        updateCreateUrl();
    });

    // "Select All" checkbox
    $('#select-all').change(function(){
        var isChecked = $(this).is(':checked');
        $('.create-shiprocket-order-all-option').prop('checked', isChecked);
        updateCreateUrl();
    });
});
</script> --}}

<script>
$(document).ready(function(){
    // Select all toggle
    $('#select-all').on('change', function(){
        $('.order-checkbox').prop('checked', this.checked);
        toggleBulkButton();
    });

    // Individual checkbox change
    $('.order-checkbox').on('change', toggleBulkButton);

    // Disable/enable bulk button based on selection
    function toggleBulkButton(){
        const anyChecked = $('.order-checkbox:checked').length > 0;
        $('#bulkCreateButton').prop('disabled', !anyChecked);
    }

    toggleBulkButton();
});
</script>

@endsection