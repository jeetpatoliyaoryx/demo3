@extends('backend.layouts.app')
@section('style')
<style type="text/css">
</style>
@endsection 
@section('content')

            <!-- index body start -->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- chart caard section start -->
                       
                          <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="b-b-success border-5 border-0 card o-hidden">
                                <div class="custome-4-bg b-r-4 card-body">
                                    <a href="{{ url('admin/users') }}">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total User</span>
                                            <h4 class="mb-0 counter">{{ !empty($TotalUser) ? $TotalUser : '0' }}
                                            
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i data-feather="user-plus"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="b-b-primary border-5 border-0 card o-hidden">
                                <div class="custome-1-bg b-r-4 card-body">
                                 <a href="{{ url('admin/users') }}">    
                                    <div class="media align-items-center static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Active User</span>
                                            <h4 class="mb-0 counter">
                                                {{ !empty($TotalActiveUser) ? $TotalActiveUser : '0' }}
                                            </h4>
                                        </div>
                                        <div class="align-self-center text-center">
                                            <i data-feather="database"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="b-b-danger border-5 border-0 card o-hidden">
                                <div class=" custome-2-bg  b-r-4 card-body">
                                    <a href="{{ url('admin/product') }}">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Products</span>
                                            <h4 class="mb-0 counter">
                                                   {{ !empty($TotalProducts) ? $TotalProducts : '0' }} 
                                            </h4>
                                        </div>
                                        <div class="align-self-center text-center">
                                            <i data-feather="shopping-bag"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="b-b-secondary border-5 border-0  card o-hidden">
                                <div class=" custome-3-bg b-r-4 card-body">
                                    <a href="{{ url('admin/orders') }}">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Total Order</span>
                                            <h4 class="mb-0 counter">
                                                {{ !empty($TotalOrder) ? $TotalOrder : '0' }}    
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i data-feather="message-circle"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                      
                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="b-b-secondary border-5 border-0  card o-hidden">
                                <div class=" custome-3-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Today Revenue</span>
                                            <h4 class="mb-0 counter">1200
                                                <span class="badge badge-light-secondary grow ">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i data-feather="message-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xxl-3 col-lg-6">
                            <div class="b-b-success border-5 border-0 card o-hidden">
                                <div class=" custome-4-bg b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="media-body p-0">
                                            <span class="m-0">Last 7 Days Revenue</span>
                                            <h4 class="mb-0 counter">11200
                                                <span class="badge badge-light-success grow">
                                                    <i data-feather="trending-up"></i>12%</span>
                                            </h4>
                                        </div>

                                        <div class="align-self-center text-center">
                                            <i data-feather="user-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>Income Overview</h5>
                                    <select id="incomeRange" class="form-select w-auto">
                                        <option value="7">Last 7 Days</option>
                                        <option value="30" selected>Last 30 Days</option>
                                        <option value="90">Last 90 Days</option>
                                        <option value="365">Last 365 Days</option>
                                    </select>
                                </div>
                                <div id="incomeChart"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Orders Overview (Total: 1000)</h5>
                                    <select id="orderRange" class="form-select w-auto">
                                    <option value="7">Last 7 Days</option>
                                    <option value="30" selected>Last 30 Days</option>
                                    <option value="90">Last 90 Days</option>
                                    <option value="365">Last 365 Days</option>
                                    </select>
                                </div>
                                <div id="orderPieChart"></div>
                            </div>
                        </div>

                    </div>
                    

                    <div class="row best-seller-table">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                            <div class="card-header d-flex justify-content-between align-items-center py-3 px-4 border-0">
                                <h5 class="mb-0 fw-semibold">Top 5 Best Selling Items</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>

                            <div class="card-body pt-0 px-4 pb-3">
                                <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">Id</th>
                                        
                                        <th style="width: 60px;">Image</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Orders</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="#">
                                                <img src="{{ url('backend/assets/images/profile/1.jpg') }}" alt="Product 1" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <strong>Wireless Earbuds</strong></td>
                                            </a>
                                        <td>Electronics</td>
                                        <td>₹1,499</td>
                                        <td><span class="badge bg-success">320</span></td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/2.jpg') }}" alt="Product 2" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Smartwatch</strong></td>
                                        <td>Accessories</td>
                                        <td>₹2,999</td>
                                        <td><span class="badge bg-success">295</span></td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/3.jpg') }}" alt="Product 3" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Bluetooth Speaker</strong></td>
                                        <td>Electronics</td>
                                        <td>₹1,899</td>
                                        <td><span class="badge bg-success">260</span></td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/4.jpg') }}" alt="Product 4" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Sports Shoes</strong></td>
                                        <td>Fashion</td>
                                        <td>₹3,499</td>
                                        <td><span class="badge bg-success">210</span></td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/1.jpg') }}" alt="Product 5" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Backpack</strong></td>
                                        <td>Travel</td>
                                        <td>₹1,199</td>
                                        <td><span class="badge bg-success">185</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="row inventory-table">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                            <div class="card-header d-flex justify-content-between align-items-center py-3 px-4 border-0">
                                <h5 class="mb-0 fw-semibold text-danger">
                                <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>
                                Inventory Alert
                                </h5>
                                <a href="#" class="btn btn-sm btn-outline-danger">View All</a>
                            </div>

                            <div class="card-body pt-0 px-4 pb-3">
                                <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th style="width: 60px;">Image</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Available Qty</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/1.jpg') }}" alt="Product 6" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Bluetooth Neckband</strong></td>
                                        <td>Electronics</td>
                                        <td><span class="fw-bold text-danger">5</span></td>
                                        <td><span class="badge">Low Stock</span></td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/2.jpg') }}" alt="Product 7" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Cotton T-Shirt</strong></td>
                                        <td>Fashion</td>
                                        <td><span class="fw-bold text-danger">3</span></td>
                                        <td><span class="badge">Low Stock</span></td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/3.jpg') }}" alt="Product 8" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Sports Water Bottle</strong></td>
                                        <td>Accessories</td>
                                        <td><span class="fw-bold text-warning">8</span></td>
                                        <td><span class="badge">Low Stock</span></td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/4.jpg') }}" alt="Product 9" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Wireless Mouse</strong></td>
                                        <td>Electronics</td>
                                        <td><span class="fw-bold text-danger">2</span></td>
                                        <td><span class="badge">Low Stock</span></td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>
                                        <img src="{{ url('backend/assets/images/profile/1.jpg') }}" alt="Product 10" class="rounded" style="width:40px; height:40px; object-fit:cover;">
                                        </td>
                                        <td><strong>Leather Wallet</strong></td>
                                        <td>Men’s Fashion</td>
                                        <td><span class="fw-bold text-warning">9</span></td>
                                        <td><span class="badge">Low Stock</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    
                    <!-- <div class="row">
                        <div class="col-xl-4">
                            <div class="card o-hidden card-hover">
                                <div class="card-header border-0 pb-1">
                                    <div class="card-header-title">
                                        <h4>Earning</h4>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div id="bar-chart-earning"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="card o-hidden ">
                                <div class="card-header border-0 pb-1">
                                    <div class="card-header-title">
                                        <h4>Revenue Report</h4>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div id="report-chart"></div>
                                </div>
                            </div>
                        </div>

            
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="h-100">
                                <div class="card o-hidden card-hover">
                                    <div class="card-header border-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="card-header-title">
                                                <h4>Visitors</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="pie-chart">
                                            <div id="pie-chart-visitors"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    
                </div>

            </div>
            <!-- index body end -->



      
@endsection

@section('script')


<script type="text/javascript">
// Example dummy data
const incomeData = {
  7: [1200, 1400, 1800, 1000, 2300, 2200, 2600],
  30: [1500, 2000, 1800, 2100, 2500, 3000, 3200, 2800, 3400, 3100, 4000, 3800],
  90: [1000, 1500, 2000, 2500, 3000, 2800, 3500, 4000, 4200],
  365: [12000, 15000, 18000, 20000, 25000, 27000, 30000, 28000, 32000, 35000, 37000, 40000]
};

const incomeOptions = {
  chart: {
    type: 'line',
    height: 350,
    toolbar: { show: false }
  },
  series: [{
    name: 'Income',
    data: incomeData[30] // default 30 days
  }],
  colors: ['#00E396'],
  xaxis: {
    categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    title: { text: 'Period' }
  },
  yaxis: {
    title: { text: 'Income (₹)' }
  },
  stroke: {
    curve: 'smooth'
  }
};

let incomeChart = new ApexCharts(document.querySelector("#incomeChart"), incomeOptions);
incomeChart.render();

document.querySelector("#incomeRange").addEventListener("change", function () {
  const days = this.value;
  incomeChart.updateSeries([{ data: incomeData[days] }]);
});





// Dummy example data (you can replace these with backend values)
const orderPieData = {
  7: [120, 700, 50, 80, 50],      // Pending, Delivered, RTO, Cancelled, Return
  30: [200, 600, 60, 100, 40],
  90: [300, 500, 70, 80, 50],
  365: [400, 450, 60, 70, 20]
};

const orderPieOptions = {
  chart: {
    type: 'pie',
    height: 350
  },
  labels: ['Pending', 'Delivered', 'RTO', 'Cancelled', 'Return'],
  series: orderPieData[30],
  colors: ['#FFA500', '#00E396', '#775DD0', '#FF4560', '#FEB019'],
  legend: {
    position: 'bottom'
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: { width: 320 },
      legend: { position: 'bottom' }
    }
  }],
  dataLabels: {
    formatter: function (val, opts) {
      return val.toFixed(1) + "%";
    }
  },
  tooltip: {
    y: {
      formatter: (val) => `${val} Orders`
    }
  }
};

let orderPieChart = new ApexCharts(document.querySelector("#orderPieChart"), orderPieOptions);
orderPieChart.render();

// Change data on dropdown select
document.querySelector("#orderRange").addEventListener("change", function () {
  const days = this.value;
  orderPieChart.updateSeries(orderPieData[days]);
});


</script>
@endsection