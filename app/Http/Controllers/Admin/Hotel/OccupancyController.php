<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Room;
use Illuminate\Http\Request;

class OccupancyController extends Controller
{
    public function inhouseGuestReport()
    {
        
        
        $inhouseguest = Room::where('room_status',3)->with('checkin')->get();
        return view('hotelbooking.occupancy.in_house_guest', compact('inhouseguest'));
    }

    public function expCheckoutReport()
    {
       $occupancyreports = Room::where('room_status',3)->with('checkin')->get();

        return view('hotelbooking.occupancy.exp_checkout_report',compact('occupancyreports'));
    }

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



        return view('hotelbooking.occupancy.occupancy_report',compact('data','rooms'));
    }


    public function occupancyReportIcon()
    {
  
        $rooms = Room::where('is_active',1)->with('checkin')->where('is_deleted',0)->get();
        return view('hotelbooking.occupancy.occupancy_report_icon',compact('rooms'));
        
    }


    

}
