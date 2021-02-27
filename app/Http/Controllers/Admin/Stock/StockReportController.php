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

    public function stockavailabilityitem(){
        $allitem=ItemEntry::where('is_deleted',0)->select(['item_name','id'])->get();
        return view('stock.reports.stockavailabilityitem',compact('allitem'));
    }

    // item wise report
    public function stockavailabilityitemresult(Request $request){

        //return $request;
        $item_id=$request->item_name;
        $alldata=DB::table('ItemInOutLegderTbl')->where('ItemID',$item_id)->get();
        $grouped = $alldata->groupBy('Status');
        

        $allitem=ItemEntry::where('is_deleted',0)->select(['item_name','id'])->get();
        return view('stock.reports.stockavailabilityitem',compact('allitem','grouped','item_id'));
    }

    // sttock ledger
    public function stockledger(){
        $allitem=ItemEntry::where('is_deleted',0)->select(['item_name','id'])->get();
        $allstockcenter=DB::table('ItemInOutLegderTbl')->select(['Status'])->get();

        return view('stock.reports.stockledger',compact('allitem','allstockcenter'));
    }
    // 
    public function stockledgerresult(Request $request){
        //return $request->formdate;
        $validated = $request->validate([
            'item_name' => 'required',
            'stockcenter' => 'required',
        ]);
        $alldata=DB::table('ItemInOutLegderTbl')->where('Status',$request->stockcenter)->where('ItemID',$request->item_name)->whereBetween('Date', [$request->formdate,$request->todate])->get();
        $newdata =$alldata->groupBy('Date');
        $allitem=ItemEntry::where('is_deleted',0)->select(['item_name','id'])->get();
        $allstockcenter=DB::table('ItemInOutLegderTbl')->select(['Status'])->get();

        $ssscenter=$request->stockcenter;
        $item_id=$request->item_name;

        return view('stock.reports.stockledger',compact('allitem','allstockcenter','newdata','ssscenter','item_id'));

    }
    // 
    public function CategoryWiseStock(){
     
        $allstockcenter=DB::table('ItemInOutLegderTbl')->select(['Status'])->get();
        $allcategory=DB::table('ItemInOutLegderTbl')->select(['Category'])->get();
        return view('stock.reports.categorywisestockreport',compact('allcategory','allstockcenter'));
    }
    // 
    public function CategoryWiseStockReport(Request $request){
        
        $validated = $request->validate([
            'Catgeory' => 'required',
            'stockcenter' => 'required',
        ]);
        $allcategory=DB::table('ItemInOutLegderTbl')->select(['Category'])->get();
        $allstockcenter=DB::table('ItemInOutLegderTbl')->select(['Status'])->get();
        $alldata=DB::table('ItemInOutLegderTbl')->where('Status',$request->stockcenter)->where('Category',$request->Catgeory)->where('Date', '>=' ,$request->todate)->get();
        $newdata =$alldata->groupBy('ItemID');

        return view('stock.reports.categorywisestockreport',compact('allcategory','allstockcenter','newdata'));



    }
}
