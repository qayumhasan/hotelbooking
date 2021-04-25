<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Purchase;
use App\Models\PurchaseHead;
use App\Models\StockCenter;
use App\Models\MenuCategory;
use App\Models\Supplier;
use App\Models\ItemEntry;
use DB;
class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // daily purchase report
    public function dailypurchase(){
        
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");

        $purchase=Purchase::where('is_deleted',0)->where('is_active',1)->where('date',$current)->orderBy('id','DESC')->get();
        $total_amount=Purchase::where('is_deleted',0)->where('is_active',1)->where('date',$current)->sum('total_amount');

        return view('inventory.report.dailypurchasereport.dailypurchase',compact('maindate','purchase','total_amount'));
    }
    // 
    public function dailypurchasesearch(Request $request){
        $fromdate=$request->formdate;
        $todate=$request->todate;
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");

        $purchasedata=Purchase::where('is_active',1)->where('date','>=',$fromdate)->where('date','<=',$todate)->get();
        $total_amount=Purchase::where('is_active',1)->where('date','>=',$fromdate)->where('date','<=',$todate)->sum('total_amount');
        return view('inventory.report.dailypurchasereport.dailypurchasereport',compact('purchasedata','current','total_amount','maindate'));
    }
    // daily product purchase end
    // stock wise product purchase
    public function stockwise(){
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
        $allstockcenter=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allpurchase=Purchase::where('is_deleted',0)->where('is_active',1)->where('date',$current)->latest()->get();
        return view('inventory.report.stocktypewise.main',compact('current','maindate','allstockcenter','allpurchase'));
    }
// stocktype wise search
    public function stockwisesearch(Request $request){
        //return $request;
        if($request->stock_id == NULL){
            $fdate=$request->formdate;
            $tdate=$request->todate;

            $year= Carbon::now()->format('Y');
            $month= Carbon::now()->format('F');
            $date= Carbon::now()->format('d');
            $maindate=$date.' '.$month.' '.$year;
            date_default_timezone_set("asia/dhaka");
            $current = date("m/d/Y");
            $allstockcenter=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
            $allstock=$request->stock_id;
            return view('inventory.report.stocktypewise.result',compact('current','maindate','allstockcenter','fdate','tdate','allstock'));
        }else{
          
            $fdate=$request->formdate;
            $tdate=$request->todate;
            $year= Carbon::now()->format('Y');
            $month= Carbon::now()->format('F');
            $date= Carbon::now()->format('d');
            $maindate=$date.' '.$month.' '.$year;
            date_default_timezone_set("asia/dhaka");
            $current = date("m/d/Y");
            $allstockcenter=StockCenter::where('is_deleted',0)->where('is_active',1)->get();

            $stock_id=$request->stock_id;
           
            //$allpurchase=Purchase::where('is_deleted',0)->where('is_active',1)->where('stock_center',$request->stock_id)->whereBetween('date', [$fdate, $tdate])->get();
            $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->where('id',$request->stock_id)->first();
           //dd($allstock);
            return view('inventory.report.stocktypewise.result',compact('current','maindate','allstockcenter','fdate','tdate','allstock','stock_id'));
        }
       

    }
    // Category wise purchase report
    public function categorywisereport(){
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
        $allcategory=MenuCategory::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        $allpurchase=Purchase::where('is_deleted',0)->where('is_active',1)->where('date',$current)->get();
        return view('inventory.report.categorywise.main',compact('current','maindate','allcategory','allpurchase'));
    }

    // category wise search
    public function categoriwise(Request $request){
            $cateid=$request->cate_id;
            $fdate=$request->formdate;
            $tdate=$request->todate;
            $year= Carbon::now()->format('Y');
            $month= Carbon::now()->format('F');
            $date= Carbon::now()->format('d');
            $maindate=$date.' '.$month.' '.$year;
            date_default_timezone_set("asia/dhaka");
            $current = date("m/d/Y");
            $allcategory=MenuCategory::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
            return view('inventory.report.categorywise.result',compact('current','maindate','allcategory','cateid','fdate','tdate'));
       
    }

    public function supplierwisereport(){
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
        $allsupplier=Supplier::where('is_deleted',0)->latest()->get();
        return view('inventory.report.supplierwise.main',compact('current','maindate','allsupplier'));
    }

    // supplier wise
    public function supplierwise(Request $request){
        
        $supplierid=$request->supplier_id;
        $fdate=$request->formdate;
        $tdate=$request->todate;
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
        $allsupplier=Supplier::where('is_deleted',0)->latest()->get();
        return view('inventory.report.supplierwise.result',compact('current','maindate','allsupplier','supplierid','fdate','tdate'));

    }
    // date wise
    public function datewisereport(){
        //return "ok";
        $year= Carbon::now()->format('Y');
        $month= Carbon::now()->format('F');
        $date= Carbon::now()->format('d');
        $maindate=$date.' '.$month.' '.$year;
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
        $allitem=ItemEntry::where('is_deleted',0)->latest()->get();

        $alpurchase = Purchase::where('is_deleted',0)->where('is_active',1)->get();
        $grouped = $alpurchase->groupBy('date');
        $allpurchase=$grouped->all();
        //dd($allpurchase);

        return view('inventory.report.datewise.main',compact('current','maindate','allitem','allpurchase'));
    }


}
