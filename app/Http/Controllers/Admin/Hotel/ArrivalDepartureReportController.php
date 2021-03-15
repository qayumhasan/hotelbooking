<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
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
    
}
