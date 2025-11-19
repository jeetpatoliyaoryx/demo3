<?php
namespace App\Exports;

use App\Models\OrdersModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MonthlyReportExport implements FromView
{
    protected $year, $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function view(): View
    {
        $start_date = $this->year . '-' . str_pad($this->month, 2, '0', STR_PAD_LEFT) . '-01';
        $end_date   = date("Y-m-t", strtotime($start_date));

        $orders = OrdersModel::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where('is_payment', 1)
            ->with(['items.product'])
            ->get();

        return view('backend.report.excel_monthly', [
            'orders' => $orders,
            'year'   => $this->year,
            'month'  => $this->month,
        ]);
    }
}
?>