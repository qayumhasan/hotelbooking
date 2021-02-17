<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\Emploayee_Sales_Report;
use App\Models\Employee;
use App\Models\ItemEntry;
use App\Models\Restaurant_order_detail;
use App\Models\Restaurant_Order_head;
use App\Models\RestaurantTable;
use App\Models\SideMenu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChuiController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function chuiIndex()
    {

        $allwaiter = Employee::get();

        $allitem = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->orderBy('id', 'DESC')->get();
        $tables = RestaurantTable::where('is_deleted', 0)->where('is_active', 1)->orderBy('id', 'DESC')->get();
        return view('restaurant.chui.home.index', compact('allwaiter', 'allitem', 'tables'));
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
            'items' => 'required',
            'quantity' => 'required',
            'remarks' => 'required',
            'res_date' => 'required',
            'res_hour' => 'required',
        ]);

        date_default_timezone_set("Asia/Dhaka");



        $kotdetails = Restaurant_order_detail::where('table_no', $request->table_no)->where('waiter_id', $request->Waiter_name)->where('item_id', $request->items)->where('complement', $request->free_items)->where('kot_status', 0)->where('is_active', 0)->first();
        // check if kot already exist

        if ($kotdetails) {


            // decrement previous no_of_sale of this item
            $item = ItemEntry::where('id', $request->items)->decrement('no_of_sale', $kotdetails->qty);

            // Increment Current Item

            $item = ItemEntry::where('id', $request->items)->increment('no_of_sale', $request->quantity);




            // decrement current employee sales report amount

            Emploayee_Sales_Report::where('waiter_id', $request->Waiter_name)->decrement('slae_amount', $kotdetails->amount);


            // update previous kot item

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

            // get item price
            $item = ItemEntry::findOrFail($request->items);

            // check if employee sale report waiter already exist

            $employecheck =  Emploayee_Sales_Report::where('waiter_id', $request->Waiter_name)->first();

            // chek it item already exist

            if ($item) {

                $amount = $item->rate * $request->quantity;
                $kotdetails->rate = $item->rate;
                $kotdetails->amount = $item->rate * $request->quantity;

                // if waiter alreay exist than update sale_amount

                if ($employecheck) {
                    Emploayee_Sales_Report::where('waiter_id', $request->Waiter_name)->increment('slae_amount', $amount);
                }else{

                    // if waiter can not exist insert employee

                    $employeesales =  new Emploayee_Sales_Report();
                    $employeesales->waiter_id = $request->Waiter_name;
                    $employeesales->slae_amount = $amount;
                    $employeesales->month_no = date('n');
                    $employeesales->month_name = date('F');
                    $employeesales->year = date('Y');
                    $employeesales->save();
                }
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

            $employecheck =  Emploayee_Sales_Report::where('waiter_id', $request->Waiter_name)->first();

            $item = ItemEntry::findOrFail($request->items);
            if ($item) {
                $amount =$item->rate * $request->quantity;
                $kotdetails->rate = $item->rate;
                $kotdetails->amount = $item->rate * $request->quantity;

                 // if waiter alreay exist than update sale_amount

                 if ($employecheck) {

                    // if empoyee month and year is same than increment

                    if(date('n') == $employecheck->month_no && date('Y') == $employecheck->year){
                        Emploayee_Sales_Report::where('waiter_id', $request->Waiter_name)->increment('slae_amount', $amount);

                        
                    }else{
                        $employeesales =  new Emploayee_Sales_Report();
                        $employeesales->waiter_id = $request->Waiter_name;
                        $employeesales->slae_amount = $amount;
                        $employeesales->month_no = date('n');
                        $employeesales->month_name = date('F');
                        $employeesales->year = date('Y');
                        $employeesales->save();

                    }
                    

                }else{

                    // if waiter can not exist insert employee

                    $employeesales =  new Emploayee_Sales_Report();
                    $employeesales->waiter_id = $request->Waiter_name;
                    $employeesales->slae_amount = $amount;
                    $employeesales->month_no = date('n');
                    $employeesales->month_name = date('F');
                    $employeesales->year = date('Y');
                    $employeesales->save();
                }
            }
            $kotdetails->save();
            $item = ItemEntry::where('id', $request->items)->increment('no_of_sale', $request->quantity);
        }

        $kotdetails = Restaurant_order_detail::where('kot_status', 0)->where('is_active', 0)->where('table_no', $request->table_no)->get();

        return response()->json($kotdetails);
    }


    public function getKotStatusByTableID($id)
    {
        $itemdetails = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 0)->get();

        return response()->json($itemdetails);
    }

    public function deleteKotStatusByTableID($id)
    {

        $kotdelete = Restaurant_order_detail::findOrFail($id);

        $item = ItemEntry::where('id', $kotdelete->item_id)->decrement('no_of_sale', $kotdelete->qty);
        Emploayee_Sales_Report::where('waiter_id', $kotdelete->waiter_id)->decrement('slae_amount', $kotdelete->amount);
        $kotdelete->delete();
    }

    public function editKotStatusByTableID($id)
    {
        $items = Restaurant_order_detail::findOrFail($id);

        $sidemenus = json_decode($items->freemenu->items);

        return response()->json([$items, $sidemenus]);
    }

    public function storeKot(Request $request)
    {


        $kotdetails = Restaurant_order_detail::where('table_no', $request->tbl_no)->where('kot_status', 0)->where('is_active', 0)->get();

        $year = Carbon::now()->format('Y');
        $date = Carbon::now()->format('d');
        $sec = Carbon::now()->format('s');

        $book_no = rand(111111, 99999);

        Restaurant_order_detail::where('table_no', $request->tbl_no)->where('kot_status', 0)->where('is_active', 0)->update([
            'booking_no' => $book_no . $request->tbl_no,
            'invoice_id' => 'KOT' . $date . 'T' . $year . $book_no . $request->tbl_no,
        ]);


        if (count($kotdetails) > 0) {

            $qtysum = $kotdetails->sum(function ($item) {
                return $item->qty;
            });
            $amountsum = $kotdetails->sum(function ($item) {
                return $item->amount;
            });

            $head = new Restaurant_Order_head();

            $head->invoice_no = 'KOT' . $date . 'T' . $year . $book_no . $request->tbl_no;

            $head->number_of_item = count($kotdetails);
            $head->number_of_qty = $qtysum;
            $head->total_amount = $amountsum;
            $head->save();

            $kotdetails = Restaurant_order_detail::where('table_no', $request->tbl_no)->where('kot_status', 0)->where('is_active', 0)->update([
                'kot_status' => 1,
            ]);

            $notification = array(
                'messege' => 'Kot store Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);
        } else {

            $notification = array(
                'messege' => ' No item selected!',
                'alert-type' => 'warning'
            );
            return Redirect()->back()->with($notification);
        }
    }


    public function getKotItemHistoryByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 1)->where('is_active', 0)->get();

        $kotdetailamounts = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 1)->where('is_active', 0)->first();
        return view('restaurant.chui.home.ajax.history_ajax', compact('kotdetails', 'kotdetailamounts'));
        // return response()->json($kotdetails);
    }


    public function storeKotItemHistoryByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no', $id)->where('is_active', 0)->where('kot_status', 1)->get();

        if (count($kotdetails) > 0) {
            $kotdetails = Restaurant_order_detail::where('table_no', $id)->where('is_active', 0)->where('kot_status', 1)->update([
                'is_active' => 1,
            ]);
            return response()->json(['msg' => 1]);
        } else {
            return response()->json(['msg' => 0]);
        }
    }


    public function getKotItematglanceByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no', $id)->where('is_active', 1)->where('kot_status', 1)->get();
        $kotdetails = $kotdetails->groupBy('invoice_id');
        $kotdetails = $kotdetails->all();
        $kotdetailamounts = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 1)->where('is_active', 1)->first();
        return view('restaurant.chui.home.ajax.at_a_glance', compact('kotdetails', 'kotdetailamounts'));
    }


    public function kothistorydelete($id)
    {

        Restaurant_order_detail::where('invoice_id', $id)->delete();
        Restaurant_Order_head::where('invoice_no', $id)->delete();
        // $kotdetails =Restaurant_order_detail::where('invoice_id',$id)->where('is_active',1)->where('kot_status',1)->get();
        // $kotdetails = $kotdetails->groupBy('invoice_id');
        // $kotdetails=$kotdetails->all();
        // $kotdetailamounts = Restaurant_order_detail::where('invoice_id',$id)->where('kot_status',1)->where('is_active',1)->first();

        $notification = array(
            'messege' => ' Item Deleted Successfully!',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);

        // return view('restaurant.chui.home.ajax.at_a_glance',compact('kotdetails','kotdetailamounts'));

    }


    public function getKotItematglanceByInvoiceID($id)
    {
        $orderdetails = Restaurant_order_detail::where('invoice_id', $id)->where('is_active', 1)->where('kot_status', 1)->get();
        $orderhead = Restaurant_Order_head::where('invoice_no', $id)->first();

        return view('restaurant.chui.home.ajax.invoice_print', compact('orderdetails', 'orderhead'));
    }
}
