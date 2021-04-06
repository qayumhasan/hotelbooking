<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\Emploayee_Sales_Report;
use Illuminate\Http\Request;

class WaiterReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function qtrWaiterPerformance()
    {
        $months =Emploayee_Sales_Report::whereIn('month_no',[date('n', strtotime('0 month')),date('n', strtotime('-1 month')),date('n', strtotime('-2 month'))])->get();
        $months = $months->groupBy('month_name');
        $months = $months->all();

        
        $employees =Emploayee_Sales_Report::whereIn('month_no',[date('n', strtotime('0 month')),date('n', strtotime('-1 month')),date('n', strtotime('-2 month'))])->get();
        $employees = $employees->groupBy('waiter_id');
       

      
       

        return view('restaurant.chui.waiter_report.waiter_qtr_report',compact('employees','months'));
    }

    public function totalWaiterSale()
    {
        $sales = Emploayee_Sales_Report::where('month_no',date('n'))->where('year',date('Y'))->get();

        return view('restaurant.chui.waiter_report.waiter_sale',compact('sales'));
    }


    public function totalWaiterSaleSearch(Request $request)
    {
        $request->validate([
            'month'=>'required',
            'year'=>'required',
        ],
        [
            'month.required'=>'Month must not be empty!',
            'year.required'=>'Year must not be empty!'
        ]
        );
        
        $sales = Emploayee_Sales_Report::where('month_no',$request->month)->where('year',$request->year)->get();
        
        return view('restaurant.chui.waiter_report.ajax.waiter_sale_ajax',compact('sales'));
    }
}
