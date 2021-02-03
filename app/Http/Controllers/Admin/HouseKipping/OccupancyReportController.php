<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Room;
use Illuminate\Http\Request;

class OccupancyReportController extends Controller
{
    public function occupancyReport()
    {
        $checkins = Checkin::where('is_occupy',1)->where('is_active',1)->where('is_deleted',0)->get();

        $checkincount = $checkins->count();
        $total = $checkins->sum('tarif');


        $roomsCount = Room::where('room_status','!=',3)->where('is_active',1)->where('is_deleted',0)->count();
        $rooms = Room::where('is_active',1)->with('checkin')->where('is_deleted',0)->get();
        $data = collect([
                    'full' =>$checkincount, 
                    'vacant' => $roomsCount,
                    'total'=>$total
            ]);



        return view('housekipping.occupancy.occupancy_report',compact('data','rooms'));
    }


    public function occupancyReportIcon()
    {
  
        $rooms = Room::where('is_active',1)->with('checkin')->where('is_deleted',0)->get();
        return view('housekipping.occupancy.occupancy_report_icon',compact('rooms'));
        
    }
}
