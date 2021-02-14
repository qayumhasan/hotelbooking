<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ItemEntry;
use App\Models\Restaurant_order_detail;
use App\Models\RestaurantTable;
use App\Models\SideMenu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChuiController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function chuiIndex()
    {

        $allwaiter = Employee::get();

        $allitem = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->orderBy('id', 'DESC')->get();
        $tables = RestaurantTable::where('is_deleted', 0)->where('is_active', 1)->orderBy('id', 'DESC')->get();
        return view('restaurant.chui.home.index', compact('allwaiter', 'allitem','tables'));
    }

    public function getFreemenuSideMenuItem($id)
    {
        $sidemenu = SideMenu::where('main_id', $id)->where('is_deleted', 0)->where('is_active', 1)->first();
        if ($sidemenu) {
            return json_decode($sidemenu->items);
        }
    }


    public function storeKotDetails(Request $request)
    {


        $request->validate([
            'Waiter_name' => 'required',
            'free_items' => 'required',
            'items' => 'required',
            'quantity' => 'required',
            'remarks' => 'required',
            'res_date' => 'required',
            'res_hour' => 'required',
        ]);

        $year = Carbon::now()->format('Y');
        $date = Carbon::now()->format('d');
        $sec = Carbon::now()->format('s');

       $kotdetails = Restaurant_order_detail::where('booking_no', $request->book_no)->where('waiter_id', $request->Waiter_name)->where('item_id', $request->items)->where('complement', $request->free_items)->first();

        if ($kotdetails) {
            $kotdetails->table_no = $request->table_no;
            $kotdetails->kot_date = $request->res_date;
            $kotdetails->kot_time = $request->res_hour;
            $kotdetails->waiter_id = $request->Waiter_name;
            $kotdetails->item_id = $request->items;
            $kotdetails->complement = $request->free_items;
            $kotdetails->qty = $request->quantity;
            $kotdetails->kot_remarks = $request->remarks;
            $kotdetails->updated_by = Auth::user()->id;
            $kotdetails->updated_date = Carbon::now();
            $kotdetails->invoice_id = 'KOT' . $date . '_B_' . $year. round($request->book_no,4);
            $kotdetails->booking_no = $request->book_no;

            $item = ItemEntry::findOrFail($request->items);
            if ($item) {
                $kotdetails->rate = $item->rate;
                $kotdetails->amount = $item->rate * $request->quantity;
            }

            $kotdetails->save();

        } else {
            $kotdetails = new Restaurant_order_detail();
            $kotdetails->table_no = $request->table_no;
            $kotdetails->kot_date = $request->res_date;
            $kotdetails->kot_time = $request->res_hour;
            $kotdetails->waiter_id = $request->Waiter_name;
            $kotdetails->item_id = $request->items;
            $kotdetails->complement = $request->free_items;
            $kotdetails->qty = $request->quantity;
            $kotdetails->kot_remarks = $request->remarks;
            $kotdetails->entry_by = Auth::user()->id;
            $kotdetails->entry_date = Carbon::now();
            $kotdetails->invoice_id = 'KOT' . $date . '_B_' . $year .round($request->book_no,4);
            $kotdetails->booking_no = $request->book_no;

            $item = ItemEntry::findOrFail($request->items);
            if ($item) {
                $kotdetails->rate = $item->rate;
                $kotdetails->amount = $item->rate * $request->quantity;
            }

            $kotdetails->save();
        }

        $kotdetails = Restaurant_order_detail::where('booking_no', $request->book_no)->where('table_no',$request->table_no)->get();

        return response()->json($kotdetails);
    }


    public function getKotStatusByTableID($id)
    {
        $itemdetails = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 0)->get();

        return response()->json($itemdetails);
    }

    public function deleteKotStatusByTableID($id)
    {
        Restaurant_order_detail::findOrFail($id)->delete();
    }

    public function editKotStatusByTableID($id)
    {
        $items = Restaurant_order_detail::findOrFail($id);
        $sidemenus = json_decode($items->freemenu->items);

        return response()->json([$items, $sidemenus]);
    }

    public function storeKot(Request $request)
    {
        $kotdetails = Restaurant_order_detail::where('table_no',$request->tbl_no)->where('booking_no',$request->book_no)->get();

        if(count($kotdetails) > 0){
            $kotdetails = Restaurant_order_detail::where('table_no',$request->tbl_no)->where('booking_no',$request->book_no)->update([
                'kot_status'=>1,
            ]);
            $notification = array(
                'messege' => 'Kot store Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);

        }else{

            $notification = array(
                'messege' => ' No item selected!',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);

        }
    }


    public function getKotItemHistoryByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no',$id)->where('kot_status',1)->where('is_active',0)->get();

        return response()->json($kotdetails);
    }


    public function storeKotItemHistoryByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no',$id)->where('is_active',0)->where('kot_status',1)->get();

        if(count($kotdetails) > 0){
            $kotdetails = Restaurant_order_detail::where('table_no',$id)->where('is_active',0)->where('kot_status',1)->update([
                'is_active'=>1,
            ]);
           return response()->json(['msg'=>1]);

        }else{
            return response()->json(['msg'=>0]);

        }
    }


    public function getKotItematglanceByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no',$id)->where('is_active',1)->where('kot_status',1)->get();
        $kotdetails = $kotdetails->groupBy('invoice_id');
        $kotdetails=$kotdetails->all();
        return view('restaurant.chui.home.ajax.at_a_glance',compact('kotdetails'));
    }


    public function kothistorydelete($id)
    {

        Restaurant_order_detail::where('invoice_id',$id)->delete();
        $kotdetails =Restaurant_order_detail::where('invoice_id',$id)->get();
        $kotdetails = $kotdetails->groupBy('invoice_id');
        $kotdetails=$kotdetails->all();

        return view('restaurant.chui.home.ajax.at_a_glance',compact('kotdetails'));

    }
}
