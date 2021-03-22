<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Checkin;
use App\Models\Guest;
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


}
