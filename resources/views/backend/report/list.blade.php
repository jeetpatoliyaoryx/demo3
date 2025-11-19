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
                       
                       


          
<div class="col-xl-12 mx-auto">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Income Report</h5>
            <form action="" method="get" class="d-flex align-items-center gap-2">
                @php
                    $year = !empty(Request::get('year')) ? Request::get('year') : date('Y');
                @endphp
                <select name="year" class="form-select w-auto">
                    @for($i=2024; $i<=date('Y'); $i++)
                        <option {{ ($year == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-light">Submit</button>
                <a href="{{ url('admin/report') }}" class="btn btn-outline-light reset-btn">Reset</a>
            </form>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Month</th>
                            <th>Total Orders Income</th>
                            <th>Total Profit Income</th>
                            <th>Total Business Turnover Income</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalOrdersIncome = 0; @endphp
                         @php $totalProfitIncome = 0; @endphp
                         @php $totalBusinessTurnoverIncome = 0; @endphp
                         
                        @foreach($result as $list)
                            @php $totalOrdersIncome += $list['totalOrdersIncome']; @endphp
                            @php $totalProfitIncome += $list['totalProfitIncome']; @endphp
                            @php $totalBusinessTurnoverIncome += $list['totalBusinessTurnoverIncome']; @endphp
                            <tr>
                                <td>{{ date('F - Y', strtotime($list['start_date'])) }}</td>
                                <td>
                                    @if($list['totalOrdersIncome'] == 0)
                                        <span class="text-danger">₹ {{ number_format($list['totalOrdersIncome'], 2) }}</span>
                                    @else
                                        <span class="text-success fw-bold">₹ {{ number_format($list['totalOrdersIncome'], 2) }}</span>
                                    @endif
                                </td>
                                 <td>
                                    @if($list['totalProfitIncome'] <= 0)
                                        <span class="text-danger">₹ {{ number_format($list['totalProfitIncome'], 2) }}</span>
                                    @else
                                        <span class="text-success fw-bold">₹ {{ number_format($list['totalProfitIncome'], 2) }}</span>
                                    @endif
                                </td>
                                 <td>
                                      @if($list['totalBusinessTurnoverIncome'] == 0)
                                        <span class="text-danger">₹ {{ number_format($list['totalBusinessTurnoverIncome'], 2) }}</span>
                                    @else
                                        <span class="text-success fw-bold">₹ {{ number_format($list['totalBusinessTurnoverIncome'], 2) }}</span>
                                    @endif
                                 </td>
                               
                                  <td>
                                        <a href="{{ route('admin.report.monthly', ['year' => date('Y', strtotime($list['start_date'])), 'month' => date('m', strtotime($list['start_date']))]) }}" class="btn btn-primary btn-sm">
                                            View
                                        </a>
                                   </td>

                            </tr>
                        @endforeach
                        <tr class="table-secondary fw-bold">
                            <td>Total</td>
                            <td>₹ {{ number_format($totalOrdersIncome, 2) }}</td>
                            <td>₹ {{ number_format($totalProfitIncome, 2) }}</td>
                            <td>₹ {{ number_format($totalBusinessTurnoverIncome, 2) }}</td>
                            <td></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

                     
                    </div>
                </div>

            </div>
            <!-- index body end -->



      
@endsection

@section('script')


<script type="text/javascript">


</script>
@endsection