<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class OccupancyController extends Controller
{
    
    public function inhouseGuestReport()
    {
        
        $checkins = Checkin::where('is_deleted',0)->orderBy('id', 'DESC')->get();
        return view('housekipping.occupancy.in_house_guest', compact('checkins'));
    }

    public function expCheckoutReport()
    {
        $checkins = Checkin::where('is_deleted',0)->orderBy('id', 'DESC')->get();

        return view('housekipping.occupancy.exp_checkout_report',compact('checkins'));
    }

    public function expCheckoutReportAjaxData(Request $request)
    {
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        $checkins = Checkin::whereBetween('exp_checkin_date',[$request->from_date,$request->to_date])->where('is_deleted',0)->orderBy('id', 'DESC')->get();

        
        return view('housekipping.occupancy.ajax.exp_checkout_report_ajax',compact('checkins'));
        
    }
}
