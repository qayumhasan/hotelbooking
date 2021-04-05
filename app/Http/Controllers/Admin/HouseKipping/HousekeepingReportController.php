<?php

namespace App\Http\Controllers\Admin\Housekipping;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\HouseKeeping;
use App\Models\Room;
use Illuminate\Http\Request;
use DB;


class HousekeepingReportController extends Controller
{
    public function cleaningDuration()
    {
        
        $rooms=Room::where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.report.clean_duration',compact('rooms'));   
    }


    public function dayWiseHousekeeping()
    {
        return view('housekipping.report.day_wise_housekeeping'); 
        
    }

    public function cleaningDurationGetAjaxData(Request $request)
    {
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
            'room_no'=>'required',
        ]);
        
        $rooms=HouseKeeping::whereBetween('log_date', [$request->from_date, $request->to_date])->where('room_id',$request->room_no)->where('is_deleted',0)->get();
        return view('housekipping.report.ajax.ajax_clean_duration',compact('rooms'));
        
    }

    public function cleaningDayWiseGetAjaxData(Request $request)
    {
        
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
        ]);
        
        $rooms=HouseKeeping::whereBetween('log_date', [$request->from_date, $request->to_date])->where('is_active',1)->where('is_deleted',0)->get();

        return view('housekipping.report.ajax.allajax_data',compact('rooms'));
    }

    public function roomWiseHousekeeping()
    {
        $rooms=Room::where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.report.room_wise_housekeeping',compact('rooms'));
    }

    public function roomWiseGetAjaxData(Request $request)
    {
        $request->validate([
            'room_no'=>'required',
        ]);
        
        $rooms=HouseKeeping::where('room_id',$request->room_no)->orwhereBetween('log_date', [$request->from_date, $request->to_date])->where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.report.ajax.allajax_data',compact('rooms'));
    }

    public function employeeWiseHousekeeping()
    {
        
        $employees = Employee::where('status',1)->get();
        return view('housekipping.report.employee_wise_housekeeping',compact('employees'));
    }

    public function employeeWiseGetAjaxData(Request $request)
    {

        
        $request->validate([
            'keeping_name'=>'required',
        ]);


    
        
        $rooms=HouseKeeping::where('keeping_name',$request->keeping_name)->orwhereBetween('log_date', [$request->from_date, $request->to_date])->where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.report.ajax.allajax_data',compact('rooms'));
    }
}
