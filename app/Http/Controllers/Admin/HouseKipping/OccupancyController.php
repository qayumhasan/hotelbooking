<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Room;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class OccupancyController extends Controller
{
    
    public function inhouseGuestReport()
    {
        
        
        $inhouseguest = Room::where('room_status',3)->with('checkin')->get();
        return view('housekipping.occupancy.in_house_guest', compact('inhouseguest'));
    }

    public function expCheckoutReport()
    {
       $occupancyreports = Room::where('room_status',3)->with('checkin')->get();

        return view('housekipping.occupancy.exp_checkout_report',compact('occupancyreports'));
    }

    public function expCheckoutReportAjaxData(Request $request)
    {
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        $checkins = Checkin::whereBetween('exp_checkin_date',[$request->from_date,$request->to_date])->where('is_deleted',0)->orderBy('id', 'DESC')->where('is_occupy',1)->get();

        
        return view('housekipping.occupancy.ajax.exp_checkout_report_ajax',compact('checkins'));
        
    }
}
