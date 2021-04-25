<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Restaurant_order_detail;
use App\Models\Restaurant_Order_head;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class OtherInfoController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function OtherInfo()
    {
        $tables = RestaurantTable::where('is_deleted',0)->where('is_active',1)->get();
        return view('restaurant.chui.otherinfo.kot_history',compact('tables'));
    }


    public function KotHistorySearch(Request $request)
    {
     

        if(isset($request->table_no)){
            $kothistory = Restaurant_order_detail::where('table_no',$request->table_no)->whereBetween('kot_date', [$request->from_date, $request->to_date])->where('is_active',1)->where('kot_status',1)->get();

            $kothistory = $kothistory->groupBy('invoice_id');
            $kothistores= $kothistory->all();
            return view('restaurant.chui.otherinfo.ajax.kot_history_ajax',compact('kothistores'));

        }else{
            $kothistory = Restaurant_order_detail::whereBetween('kot_date', [$request->from_date, $request->to_date])->where('is_active',1)->where('kot_status',1)->get();
            
            $kothistory = $kothistory->groupBy('invoice_id');
            $kothistores= $kothistory->all();
            return view('restaurant.chui.otherinfo.ajax.kot_history_ajax',compact('kothistores'));
        }
      
    }


    public function inHouseGuest()
    {
        
        $checkins = Checkin::where('is_deleted',0)->where('is_occupy',1)->orderBy('id', 'DESC')->get();
        return view('restaurant.chui.otherinfo.in_house_guest', compact('checkins'));
    }
}
