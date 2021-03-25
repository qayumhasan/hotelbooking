<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Guest;
use App\Models\Restaurant_Order_head;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CollectionReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function dailyCollection()
    {
        $employees = Admin::where('is_active',1)->get();
        return view('hotelbooking.collection_report.daily_collection',compact('employees'));
    }

    public function dailyCollectionAjaxReport(Request $request)
    {
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
            'employee'=>'required',
        ]);

        $vouchers = Voucher::where('entry_by',$request->employee)->whereBetween('date',[$request->from_date,$request->to_date])->where('type',1)->get();

        return view('hotelbooking.collection_report.ajax.daily_collection_ajax',compact('vouchers'));
    }


    public function guestPaymentHistory()
    {

        $guests =Guest::where('is_active',1)->where('is_deleted',0)->get();
        $checkinguests = Checkin::where('is_occupy',0)->get();
        $checkinguests = $checkinguests->unique('booking_no');


        
        return view('hotelbooking.collection_report.guest_payment_history',compact('guests','checkinguests'));
    }


    public function ajaxGuestPaymentHistory(Request $request)
    {
        $guest= Guest::findOrFail($request->guestid);

        if($guest){
            $checkinguests = Checkin::where('guest_name',$guest->guest_name)->where('is_occupy',0)->get();
            $checkinguests = $checkinguests->unique('booking_no');

            return view('hotelbooking.collection_report.ajax.guest_payment_history_ajax',compact('checkinguests'));
        }


    }


    public function invoiceSummaryList()

    {
        
        $guests =Guest::where('is_active',1)->where('is_deleted',0)->get();
        $bookinghistory = Checkout::with(['checkin','voucherData'])->where('is_active',0)->get();
        return view('hotelbooking.collection_report.invoice_summery',compact('bookinghistory','guests'));
    }


    public function invoiceSummaryAjaxList(Request $request)
    {
        
        $request->validate([
            'guest_name'=>'required',
        ]);

        $guestname = $request->guest_name;
        $bookinghistory = Checkout::whereHas('checkin',function($query) use ($guestname){
            $query->where('guest_name', 'like', '%'.$guestname.'%');

        })
        ->with(['checkin'=>function($query) use ($guestname){
            $query->where('guest_name', 'like', '%'.$guestname.'%');

        }])->get();

        return view('hotelbooking.collection_report.ajax.invoice_summery_ajax',compact('bookinghistory'));
    }


    public function postToRoomList()
    {
        $guests =Guest::where('is_active',1)->where('is_deleted',0)->get();

        
        $postToRooms = Restaurant_Order_head::with(['orderDetail','checkin'])->where('payment_method',5)->get();

        return view('hotelbooking.collection_report.post_to_room',compact('guests','postToRooms'));
    }


    public function postToRoomInvoice($id)
    { 

        
        $postToRooms = Restaurant_Order_head::with(['orderDetails','checkin'])->where('id',$id)->first();
        return view('hotelbooking.collection_report.ajax.post_to_room_invoice_ajax',compact('postToRooms'));
    }


    public function postToRoomAjaxList(Request $request)
    {

        $request->validate([
            'from_date'=>'required',
            'guest_name'=>'required',
            'to_date'=>'required',
        ]);

        $guestname = $request->guest_name;
        $postToRooms = Restaurant_Order_head::whereHas('checkin',function($query) use($guestname,$request){
                $query->where('guest_name', 'like', '%'.$guestname.'%')->orWhereNotBetween('checkin_date',[$request->from_date,$request->to_date]);
        })->with(['orderDetail','checkin'=>function($query) use($guestname){
            $query->where('guest_name', 'like', '%'.$guestname.'%');
        }])->where('payment_method',5)->get();



        return view('hotelbooking.collection_report.ajax.post_to_room_ajax',compact('postToRooms'));
        
    }


}
