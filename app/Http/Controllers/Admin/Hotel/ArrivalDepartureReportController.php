<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Checkin;
use App\Models\Checkout;
use Illuminate\Http\Request;

class ArrivalDepartureReportController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }


    public function checkinReport()
    {
        $checkins= Checkin::with('checkout')->get();
        return view('hotelbooking.arrival_departture_report.checkin_report',compact('checkins'));
    }


    public function checkoutReport()
    {
        $checkins= Checkin::with('checkout')->where('is_occupy',0)->get();
        return view('hotelbooking.arrival_departture_report.checkout_report',compact('checkins'));
    }

    public function guestReport()
    {
        $checkins= Checkin::with('checkout')->where('is_occupy',0)->get();
        return view('hotelbooking.arrival_departture_report.guest_arrival_summery',compact('checkins'));
    }

    public function pendingInvoiceReport()
    {
       $checkouts = Checkout::with('checkin')->where('is_active',1)->get();
       
        return view('hotelbooking.arrival_departture_report.pending_invoice_report',compact('checkouts'));
    }
    

    public function pendingInvoiceReportCreate($booking_no)
    {
        return redirect()->route('admin.checkout.invoice.page',\Crypt::encrypt($booking_no));
    }

    public function pendingInvoiceReportDelete($booking_no)
    {
        $checkout =Checkout::where('booking_no',$booking_no)->where('is_active',1)->first();
        if($checkout){
            $checkout->delete();
        }
        
        $notification = array(
            'messege' => 'Pending Invoice Changing Successfully ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    
}
