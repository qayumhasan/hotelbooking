<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\Checkin;
use App\Models\Emploayee_Sales_Report;
use App\Models\Employee;
use App\Models\ItemEntry;
use App\Models\Restaurant_order_detail;
use App\Models\Restaurant_Order_head;
use App\Models\Restaurant_Tax_head;
use App\Models\RestaurantTable;
use App\Models\Room;
use App\Models\SideMenu;
use App\Models\TaxDetails;
use App\Models\TaxHead;
use App\Models\TaxSetting;
use App\Traits\KotTaxCalculate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

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
                } else {

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
                $amount = $item->rate * $request->quantity;
                $kotdetails->rate = $item->rate;
                $kotdetails->amount = $item->rate * $request->quantity;

                // if waiter alreay exist than update sale_amount

                if ($employecheck) {

                    // if empoyee month and year is same than increment

                    if (date('n') == $employecheck->month_no && date('Y') == $employecheck->year) {
                        Emploayee_Sales_Report::where('waiter_id', $request->Waiter_name)->increment('slae_amount', $amount);
                    } else {
                        $employeesales =  new Emploayee_Sales_Report();
                        $employeesales->waiter_id = $request->Waiter_name;
                        $employeesales->slae_amount = $amount;
                        $employeesales->month_no = date('n');
                        $employeesales->month_name = date('F');
                        $employeesales->year = date('Y');
                        $employeesales->save();
                    }
                } else {

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

        $kotdetails = Restaurant_order_detail::where('kot_status', 0)->where('is_active', 0)->where('table_no', $request->table_no)->orderBy('id', 'DESC')->get();

        return view('restaurant.chui.home.ajax.kot_ajax', compact('kotdetails'));

        // return response()->json($kotdetails);
    }


    public function getKotStatusByTableID($id)
    {
        $kotdetails = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 0)->orderBy('id', 'DESC')->get();
        return view('restaurant.chui.home.ajax.kot_ajax', compact('kotdetails'));
        // return response()->json($itemdetails);
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

        if (isset($items->freemenu)) {
            $sidemenus = json_decode($items->freemenu->items);
        } else {
            $sidemenus = Null;
        }

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
            'invoice_id' => 'KOT-' . $date . 'T-' . $year . $book_no . $request->tbl_no,
        ]);


        if (count($kotdetails) > 0) {

            $qtysum = $kotdetails->sum(function ($item) {
                return $item->qty;
            });
            $amountsum = $kotdetails->sum(function ($item) {
                return $item->amount;
            });
            


            $head = new Restaurant_Order_head();

            $head->invoice_no = 'KOT-' . $date . 'T-' . $year . $book_no . $request->tbl_no;

            $head->number_of_item = count($kotdetails);
            $head->number_of_qty = $qtysum;
            $head->total_amount = $amountsum;
            $head->gross_amount = $amountsum;
            $head->food_amount = $amountsum;
            $head->save();



            $kotdetails = Restaurant_order_detail::where('table_no', $request->tbl_no)->where('kot_status', 0)->where('is_active', 0)->latest('id')->first();

            $restable = RestaurantTable::findOrFail($request->tbl_no);
            $restable->waiter_id = $kotdetails->waiter_id;
            $restable->total_amounnt = $amountsum;
            $restable->data = Carbon::now();
            $restable->is_booked = 1;
            $restable->save();

            $notification = array(
                'messege' => 'Kot store Successfully',
                'alert-type' => 'success'
            );

            $kotdata = Restaurant_order_detail::where('table_no', $request->tbl_no)->where('kot_status', 0)->where('is_active', 0)->get();
         
            $data = [
                'kotdata'=>$kotdata,
                'kotdetails'=>$kotdetails,
            ];
            $request->session()->put('kotdata',$data);
            return Redirect()->route('admin.chui.restaurant')->with($notification);
        } else {

            $notification = array(
                'messege' => ' No item selected!',
                'alert-type' => 'warning'
            );
            return Redirect()->route('admin.chui.restaurant')->with($notification);
        }
    }


    public function kotTaxEdit($id)
    {
        $taxhead = Restaurant_Tax_head::findOrFail($id);
        return response()->json($taxhead);

    }

    public function kotTaxUpdate(Request $request)
    {
        $taxhead=Restaurant_Tax_head::findOrFail($request->update_tax);
        if($taxhead){
            $this->KotEditDelete($taxhead);
            $taxhead->delete();
        }
        

        $tax = new KotTaxCalculate($request);
        $tax->Tax();



        $texdatas = Restaurant_Tax_head::where('invoice_id', $request->invoice_no)->get();



        $resgross = Restaurant_Order_head::where('invoice_no', $request->invoice_no)->first();




        return view('restaurant.chui.home.ajax.tax_details_ajax', compact('texdatas', 'resgross'));
    }

    public function kotTaxDelete($id)
    {
        $taxhead = Restaurant_Tax_head::findOrFail($id);
        $this->KotEditDelete($taxhead);

        if ($taxhead) {
            $taxhead->delete();
        }


        $resgross = Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->first();

        return response()->json($resgross);
    }


    public function KotEditDelete($taxhead)
    {
        if ($taxhead->effect == 'Add') {

            if ($taxhead->calculation_id == 1) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('gross_amount', $taxhead->amount);
            } elseif ($taxhead->calculation_id == 2) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('food_amount', $taxhead->amount);
            } elseif ($taxhead->calculation_id == 3) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('discount_amount', $taxhead->amount);
            } elseif ($taxhead->calculation_id == 4) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('total_amount', $taxhead->amount);
            }
        } elseif ($taxhead->effect == 'Deduct') {


            if ($taxhead->calculation_id == 1) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('discount_amount', $taxhead->amount);
            } elseif ($taxhead->calculation_id == 2) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('food_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('discount_amount', $taxhead->amount);
            } elseif ($taxhead->calculation_id == 3) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('discount_amount', $taxhead->amount);
            } elseif ($taxhead->calculation_id == 4) {

                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('gross_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->increment('total_amount', $taxhead->amount);
                Restaurant_Order_head::where('invoice_no', $taxhead->invoice_id)->decrement('discount_amount', $taxhead->amount);
            }
        }
    }


    public function getKotItemHistoryByTableID($id)
    {


        $kotdetails = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 0)->where('is_active', 0)->get();

        $kotdetailamounts = Restaurant_order_detail::where('table_no', $id)->where('kot_status', 0)->where('is_active', 0)->first();

        $taxs =  TaxSetting::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('restaurant.chui.home.ajax.billing_ajax', compact('kotdetails', 'kotdetailamounts', 'taxs'));


        // return response()->json($kotdetails);
    }



    public function getKotItemTaxValue(Request $request)
    {


        $request->validate([
            'tax_discription' => 'required',
            'calculation_on' => 'required',
            'base_on' => 'required',
            'rate' => 'required',
        ]);

        $tax = new KotTaxCalculate($request);
        return $tax->amount();
    }


    public function getKotTaxItem($id)
    {
        $tax = TaxSetting::findOrFail($id);
        return response()->json($tax);
    }

    public function getKotItemTaxCalculate(Request $request)
    {
  
        $request->validate([
            'rate' => 'required',
        ]);





        $resorderhead = Restaurant_Order_head::where('invoice_no', $request->invoice_no)->first();

        if ($resorderhead) {
            switch ($request->base_on) {
                case 'percentage':
                    $amount = $this->getTotalValue($request, $resorderhead);
                    $totalpercent = ($amount * $request->rate) / 100;
                    return response()->json($totalpercent);
                    break;
                case 'amount':
                    $totalpercent = $request->rate;
                    return response()->json($totalpercent);
                    break;
            }
        }
    }

    public function addToGridKotBillingItem(Request $request)
    {

        $tax = new KotTaxCalculate($request);
        $tax->Tax();



        $texdatas = Restaurant_Tax_head::where('invoice_id', $request->invoice_no)->get();



        $resgross = Restaurant_Order_head::where('invoice_no', $request->invoice_no)->first();




        return view('restaurant.chui.home.ajax.tax_details_ajax', compact('texdatas', 'resgross'));
    }


    public function getTotalValue($request, $head)
    {


        switch ($request->calculation_on) {
            case '1':
                return $head->total_amount + $head->gross_amount;
                break;
            case '2':
                return $head->total_amount;
                break;

            case '3':
                return (int)0;
                break;
            case '4':
                return $head->total_amount;
                break;
        }
    }


    public function slectRoomForBilling()
    {
        $rooms = Room::where('room_status', 3)->with('checkin')->get();
        return response()->json($rooms);
    }

    public function slectRoomForBillingGet($id)
    {
        $roomdata = Checkin::where('room_id', $id)->where('is_occupy',1)->first();
        return response()->json($roomdata);
    }




    public function storeKotItemHistoryByTableID(Request $request)
    {


        
    

        $kothead = Restaurant_Order_head::where('invoice_no', $request->invoice_no)->first();

        if (isset($request->payment_method)) {

            if ($kothead) {

                $kothead->no_of_pax = $request->no_of_pax;
                $kothead->payment_date = $request->paymentdate;

                if (isset($request->payment_method)) {
                    $kothead->is_payment = 1;
                    $kothead->payment_method = $request->payment_method;

                    // payment with cash

                    if ($request->payment_method == 1) {
                        $kothead->payment_method = $request->payment_method;
                        $kothead->payment_details = $request->cash_name;
                    }

                
                    // Add Payment with bank

                    if ($request->payment_method == 2) {
                        $kothead->payment_method = $request->payment_method;
                        
                        $kothead->payment_details = $request->bank_name;
                        $kothead->card_number = $request->card_number;
                    }

                    // add Credit payment

                    if ($request->payment_method == 4) {
                        $kothead->payment_method = $request->payment_method;
                        $kothead->payment_details = $request->customar_name;
                        $kothead->pay_amount = $request->customar_pay;
                        $kothead->credit_balance =$kothead->gross_amount-$request->customar_pay;
                        $kothead->customar_credit_date = Carbon::now()->toDateTimeString();
                        
                    }

                    // payment with post to room

                    if ($request->payment_method == 5) {
                        $kothead->payment_method = $request->payment_method;
                        $kothead->room_no = $request->room_no;
                        $kothead->booking_no = $request->booking_no;
                    }
                }

                $kothead->table_no = $request->table_no;
                $kothead->mobile_no = $request->mobile_no;
                $kothead->remarks = $request->remarks;
                $kothead->entry_by = auth()->user()->id;
                $kothead->entry_date = Carbon::now()->toDateTimeString();
            }


            if (isset($request->payment_method)) {
                $kotdetails = Restaurant_order_detail::where('table_no', $request->table_no)->where('is_active', 0)->where('kot_status', 0)->get();

                if (count($kotdetails) > 0) {
                    $kotdetails = Restaurant_order_detail::where('table_no', $request->table_no)->where('is_active', 0)->where('kot_status', 0)->update([
                        'is_active' => 1,
                        'kot_status' => 1,
                        'room_booking_no' => $request->booking_no,
                    ]);
                }
            }

            if (isset($request->payment_method)) {
                $table = RestaurantTable::findOrFail($request->table_no);
                $table->waiter_id = 0;
                $table->total_amounnt = 0;
                $table->data = null;
                $table->is_booked = 0;
                $table->save();
            }

            if ($kothead->save()) {
               return redirect()->route('admin.chui.restaurant.tax.print',$request->invoice_no);
            }
        } else {
            $notification = array(
                'messege' => ' Select A Payment Method!',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
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
    // history data
    public function getHistory($t_id)
    {

        $to = Carbon::now()->format('Y-m-d');
        $from = date('Y-m-d', strtotime('-7 days', strtotime($to)));
        $alldata = Restaurant_order_detail::where('table_no', $t_id)->where('kot_status', 1)->where('is_active', 1)->OrderBy('id', 'DESC')->limit(10)->get();
        $table_id = $t_id;
        return view('restaurant.chui.home.ajax.mainhistory', compact('alldata', 'table_id'));
    }

    // ata a glance 
    public function getataglance($t_id)
    {
        $to = Carbon::now()->format('d/m/Y');
        $alldata = Restaurant_order_detail::where('table_no', $t_id)->where('kot_status', 1)->where('is_active', 1)->where('kot_date', $to)->OrderBy('id', 'DESC')->get();
        $table = Restaurant_order_detail::where('table_no', $t_id)->first();
        return view('restaurant.chui.home.ajax.mainataglance', compact('alldata', 'to', 'table'));
    }
    // 
    public function gethistorysearch(Request $request)
    {
        $table_id = $request->table_id;
        $alldata = Restaurant_order_detail::where('table_no', $request->table_id)->where('kot_status', 1)->where('is_active', 1)->whereBetween('kot_date', [$request->formdate, $request->todate])->OrderBy('id', 'DESC')->get();

        return view('restaurant.chui.home.ajax.mainhistory', compact('alldata', 'table_id'));
    }

    public function billingInfoPrint($id)
    {
        $orderhead = Restaurant_Order_head::where('invoice_no', $id)->first();
        $orderdetails = Restaurant_order_detail::where('invoice_id', $id)->get();

        $allwaiter = Employee::get();

        $allitem = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->orderBy('id', 'DESC')->get();
        $tables = RestaurantTable::where('is_deleted', 0)->where('is_active', 1)->orderBy('id', 'DESC')->get();
      
        return view('restaurant.chui.home.index', compact('allwaiter', 'allitem', 'tables', 'orderhead', 'orderdetails'));
    }

    public function getCashAccount()
    {
        $cashdata = ChartOfAccount::select('desription_of_account','code','id')->where('subcategoryone_code',17)->get();
        return response()->json($cashdata);
    }

    public function getBankAccount()
    {
        
        $cashdata = ChartOfAccount::select('desription_of_account','code','id')->where('subcategoryone_code',18)->get();
        return response()->json($cashdata);
    }

    public function getCreditCustomar()
    {
        $creditCustomars = Restaurant_Order_head::where('payment_method',4)->where('is_active',0)->where('is_deleted',0)->get();

        return view('restaurant.chui.reports.credit_customar', compact('creditCustomars'));

    }


    public function getCreditVoucher($id)
    {
        $guestname = Restaurant_Order_head::findOrFail($id);
        return view('restaurant.chui.reports.voucher',compact('guestname'));
    }
}
