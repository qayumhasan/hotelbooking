<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ItemEntry;
use App\Models\Restaurant_order_detail;
use App\Models\SideMenu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChuiController extends Controller
{
    public function chuiIndex()
    {
        
        $allwaiter=Employee::get();
        
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
    
        return view('restaurant.chui.home.index',compact('allwaiter','allitem'));
    }

    public function getFreemenuSideMenuItem($id)
    {
        $sidemenu= SideMenu::where('main_id',$id)->where('is_deleted',0)->where('is_active',1)->first();
        if($sidemenu){
            return json_decode($sidemenu->items);
        }
    }


    public function storeKotDetails(Request $request)
    {

        $request->validate([
            'Waiter_name'=>'required',
            'free_items'=>'required',
            'items'=>'required',
            'quantity'=>'required',
            'remarks'=>'required',
            'res_date'=>'required',
            'res_hour'=>'required',
        ]);

        

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $sec= Carbon::now()->format('s');
        

        $kotdetails = new Restaurant_order_detail();
        $kotdetails->table_no = $request->table_no;
        $kotdetails->kot_date = $request->res_date;
        $kotdetails->kot_time = $request->res_hour;
        $kotdetails->waiter_id = $request->Waiter_name;
        $kotdetails->item_id = $request->items;
        $kotdetails->complement = $request->free_items;
        $kotdetails->qty = $request->quantity;
        $kotdetails->kot_remarks = $request->remarks;
        $kotdetails->invoice_id = 'KOT'.$date.'_B_'.$year.$sec.rand(111,999);
        $kotdetails->booking_no = $request->book_no;

        $item = ItemEntry::findOrFail($request->items);
        if($item){
            $kotdetails->rate = $item->rate;
            $kotdetails->amount = $item->rate * $request->quantity;
        }

        $kotdetails->save();

        $kotdetails = Restaurant_order_detail::findOrFail($kotdetails->id);

        return response()->json($kotdetails);

    }


    public function getKotStatusByTableID($id)
    {
        $itemdetails = Restaurant_order_detail::where('table_no',$id)->where('kot_status',0)->get();   

        return response()->json($itemdetails);
    }

    public function deleteKotStatusByTableID($id)
    {
        Restaurant_order_detail::findOrFail($id)->delete();
    }

    public function editKotStatusByTableID($id)
    {
        $items =Restaurant_order_detail::findOrFail($id);
        $sidemenus =json_decode($items->freemenu->items);
        
        return response()->json([$items,$sidemenus]);
    }
}
