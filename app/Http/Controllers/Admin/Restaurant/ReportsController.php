<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuType;
use App\Models\RestaurantTable;
use App\Models\Restaurant_order_detail;
use App\Models\MenuCategory;
use App\Models\ItemEntry;
use App\Models\Restaurant_Order_head;
use DB;

class ReportsController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }


    public function itemwisesell(){
        $alltable=RestaurantTable::where('is_deleted',0)->where('is_active',1)->OrderBy('id','DESC')->get();
        return view('restaurant.chui.reports.dailysalereport',compact('alltable'));
    }
    // 
    public function itemwisesellreports(Request $request){
        $request->validate([
            'table_id' => 'required',
        ]);
        $formdate=$request->formdate;
        $todate=$request->todate;
        $alltable=RestaurantTable::where('is_deleted',0)->where('is_active',1)->OrderBy('id','DESC')->get();
      // $allreports=Restaurant_order_detail::where('kot_status',1)->where('is_active',1)->where('kot_date','<=',$request->todate)->where('kot_date','=<',$request->formdate)->get();
        // $allreports=Restaurant_order_detail::where('kot_status',1)->where('is_active',1)->WhereBetween('kot_date',[$formdate, $todate])->get();
        $allreports=DB::table('restaurant_order_details')
        ->select(DB::Raw('sum(qty) as qty'))
        ->addselect(DB::Raw('sum(amount) as amount'))
        ->addselect('item_id')
        ->groupBy('item_id')
        ->where('kot_status',1)
        ->where('is_active',1)
        ->where('kot_date','>=',$request->todate)
        ->WhereBetween('kot_date',[$formdate, $todate])
        ->get();
        //dd($allreports);
        return view('restaurant.chui.reports.dailysalereport',compact('allreports','alltable'));

    }

    public function categorysell(){
        $allcategory=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('restaurant.chui.reports.categorywisesell',compact('allcategory'));
    }

    public function categorysellreports(Request $request){
        $request->validate([
            'category' => 'required',
        ]);
        $todate=$request->todate;
        $formdate=$request->formdate;
        $allcategory=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $itemcategory=ItemEntry::where('category_name',$request->category)->select(['id','item_name'])->get();
        return view('restaurant.chui.reports.categorywisesell',compact('allcategory','itemcategory','todate','formdate'));

    }

    // view data
    public function viewdata($id){
        //$alldata=Restaurant_order_detail::where('kot_status',1)->where('is_active',1)->where('item_id',$id)->get();

        $alldata = DB::table('restaurant_order_details')
            ->join('item_entries', 'restaurant_order_details.item_id', '=', 'item_entries.id')
            ->select('restaurant_order_details.*', 'item_entries.item_name')
            ->where('restaurant_order_details.kot_status',1)
            ->where('restaurant_order_details.is_active',1)
            ->where('restaurant_order_details.item_id',$id)
            ->orderBy('restaurant_order_details.id','DESC')
            ->get();
        return view('restaurant.chui.reports.viewitem',compact('alldata'));
    }


    public function getDateWiseReport()    {

        $datewise = Restaurant_order_detail::all();
        $datewise=$datewise->groupBy('kot_date');
        $datewise=$datewise->all();
        return view('restaurant.chui.reports.date_wise_report',compact('datewise'));
    }


    public function dateWiseAjaxReport(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        
        
        $datewise = Restaurant_order_detail::whereBetween('kot_date',[$from_date,$to_date])->get();
        $datewise=$datewise->groupBy('kot_date');
       $datewise=$datewise->all();

        return view('restaurant.chui.reports.ajax.date_wise_ajax',compact('datewise'));

    }

    public function getPaymentMethodWise()
    {

        $paymentwise = Restaurant_Order_head::where('is_payment',1)->get();
        $paymentwise =$paymentwise->groupBy('payment_method'); 
        $paymentwise =$paymentwise->all(); 

        return view('restaurant.chui.reports.method_wise_report',compact('paymentwise'));
    }

    public function paymentMethodWiseAjaxReport(Request $request)
    {

       

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        

        $paymentwise = Restaurant_Order_head::where('payment_method',$request->pay_method)->get();
        
        $paymentwise =$paymentwise->groupBy('payment_method'); 
        $paymentwise =$paymentwise->all(); 
        return view('restaurant.chui.reports.ajax.payment_wise_report',compact('paymentwise'));
    }
}
