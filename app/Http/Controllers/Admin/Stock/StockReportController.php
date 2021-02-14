<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhysicalStockHead;
use App\Models\PhysicalStockDetails;
use App\Models\StockCenter;
use App\Models\ItemEntry;
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
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        return view('stock.reports.itemwisestock',compact('allitem'));
    }
    // item wise reports
    public function itemwisestockresult(Request $request){
        //return $request;
      //  $alldata = DB::select('select item_name as item, sum(qty) as total_qty from physical_stock_details group by item_name');
  
            $item_id=$request->item_id;
            $alldata=PhysicalStockHead::where('date','>=',$request->todate)->get();
            $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
             return view('stock.reports.itemwisestock',compact('alldata','allitem','item_id'));
       
       

    }
    // stock center wise 
    public function stockcentersreport(){
        $allstockcenter=StockCenter::where('is_deleted',0)->where('is_active',1)->get();
        return view('stock.reports.stockcenterwise',compact('allstockcenter'));
    }

    public function stockcenterreportresult(Request $request){
        $validated = $request->validate([
            'stock_center' => 'required',
        ]);
        $todate=$request->todate;
        $formdate=$request->formdate;
        //$alldata=PhysicalStockHead::whereBetween('date', [$formdate, $todate])->where('stock_center',$request->stock_center)->orderBy('id','DESC')->get();
        $alldata = DB::table('physical_stock_heads')
        ->join('stock_centers', 'physical_stock_heads.stock_center', '=', 'stock_centers.id')
        ->select('physical_stock_heads.*', 'stock_centers.name')
        ->where('physical_stock_heads.is_deleted',0)
        ->where('physical_stock_heads.stock_center',$request->stock_center)
        ->whereBetween('physical_stock_heads.date', [$formdate, $todate])
        ->get();
        $allstockcenter=StockCenter::where('is_deleted',0)->where('is_active',1)->get();
        return view('stock.reports.stockcenterwise',compact('allstockcenter','alldata'));

    }
}
