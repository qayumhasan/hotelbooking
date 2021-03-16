<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\CheckinService;
use App\Models\HouseKeeping;
use App\Models\Room;
use Illuminate\Http\Request;

class HouseKeepingReportController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function extraServiceReport()
    {
        $services = CheckinService::with('itementry')->where('is_active',1)->where('is_deleted',0)->get();
        return view('hotelbooking.housekeeping_report.extra_service_report',compact('services'));
        
    }


    public function dayWiseReport()
    {
        return view('hotelbooking.housekeeping_report.day_wise_housekeeping');
    }




    public function roomWiseHousekeeping()
    {
        $rooms=Room::where('is_active',1)->where('is_deleted',0)->get();
        return view('hotelbooking.housekeeping_report.room_wise_housekeeping',compact('rooms'));
    }


    public function employeeWiseHousekeeping()
    {
        return view('hotelbooking.housekeeping_report.employee_wise_housekeeping');
    }

}
