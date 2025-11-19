<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\OrdersModel;
use App\Models\OrdersItemModel;
use App\Models\User;

use App\Exports\MonthlyReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function list(Request $request)
    {
        if(!empty($request->get('year')))
        {
            $year = $request->get('year');
        }
        else
        {
            $year = date('Y');    
        }

        $getMonths = array(''.$year.'-01-01', 
                ''.$year.'-02-01',
                ''.$year.'-03-01', 
                ''.$year.'-04-01', 
                ''.$year.'-05-01', 
                ''.$year.'-06-01',
                ''.$year.'-07-01',
                ''.$year.'-08-01',
                ''.$year.'-09-01',
                ''.$year.'-10-01',
                ''.$year.'-11-01',
                ''.$year.'-12-01');

         $result = array();

        foreach ($getMonths as $start_date) 
        {
            $end_date =  date("Y-m-t", strtotime($start_date));
            
            $totalOrdersIncome = OrdersModel::getSumOrderTotal($start_date, $end_date, 'All', 'Subscription');
            $totalProfitIncome = OrdersModel::getSumProfit($start_date, $end_date);

            //copy
            $totalBusinessTurnoverIncome = OrdersModel::getSumOrderTotal($start_date, $end_date, 'All', 'Subscription');

            $dataY = array();                
            $dataY['start_date'] = $start_date;
            $dataY['end_date'] = $end_date;
            $dataY['totalOrdersIncome'] = $totalOrdersIncome;
            $dataY['totalProfitIncome'] = $totalProfitIncome;
            $dataY['totalBusinessTurnoverIncome'] = $totalBusinessTurnoverIncome;

            $result[] = $dataY;
        }

            
        $data['result'] = $result;

        $data['meta_title'] = "Report List";
        return view('backend.report.list', $data);               
	}


    public function monthlyDetail(Request $request, $year, $month)
    {
        $start_date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
        $end_date   = date("Y-m-t", strtotime($start_date));

        $orders = OrdersModel::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('is_payment', 1)
            ->with(['items.product'])
            ->get();

        return view('backend.report.monthly_detail', [
            'year'   => $year,
            'month'  => $month,
            'orders' => $orders,
        ]);
    }


public function exportMonthly($year, $month)
{
    return Excel::download(new MonthlyReportExport($year, $month), "monthly-report-{$year}-{$month}.xlsx");
}

}