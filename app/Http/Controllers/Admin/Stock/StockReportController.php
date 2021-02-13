<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhysicalStockHead;
use DB;

class StockReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function dailytransfer(){
        return view('stock.reports.dailytransferreport');
    }
    // 
    public function dailytransferresult(Request $request){
       // return $request;
         $todate=$request->todate;
         $formdate=$request->formdate;

         $alldata = DB::table('physical_stock_heads')
            ->join('stock_centers', 'physical_stock_heads.stock_center', '=', 'stock_centers.id')
            ->select('physical_stock_heads.*', 'stock_centers.name')
            ->where('physical_stock_heads.is_deleted',0)
            ->whereBetween('physical_stock_heads.date', [$formdate, $todate])
            ->get();
        return view('stock.reports.dailytransferreport',compact('alldata'));
    }

    // item wise stock
    public function itemwisestock(){
        return view('stock.reports.itemwisestock');
    }
    // item wise reports
    public function itemwisestockresult(Request $request){

        return $request;
        //  $todate=$request->todate;
        //  $formdate=$request->formdate;

        //  $alldata = DB::table('physical_stock_details')
        //     ->whereBetween('physical_stock_heads.date', [$formdate, $todate])
        //     ->get();
        //     return view('stock.reports.itemwisestock',compact('alldata'));

    }
}
