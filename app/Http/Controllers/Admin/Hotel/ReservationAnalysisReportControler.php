<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class ReservationAnalysisReportControler extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function roomwiseReport()
    {
        $rooms = Room::with('checkindata')->where('is_active',1)->where('is_deleted',0)->get();
        return view('hotelbooking.reservation_analysis.room_wise_report',compact('rooms'));    
    }

    public function roomtypewiseReport()
    {
        $roomtypes = RoomType::where('is_active',1)->where('is_deleted',0)->get();
        return view('hotelbooking.reservation_analysis.room_type_report',compact('roomtypes')); 
    }
}
