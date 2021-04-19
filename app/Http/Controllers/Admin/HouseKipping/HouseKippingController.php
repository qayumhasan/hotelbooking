<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\HouseKeeping;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HouseKippingController extends Controller
{
    public function index()
    {

                
        $roomtypes = RoomType::where('is_active',1)->where('is_deleted',0)->get();
        $rooms = Room::with('housekeepingreport')->where('is_active',1)->where('is_deleted',0)->where('room_status','!=',3)->get();

        return view('housekipping.home.index',compact('rooms','roomtypes'));
    }

    public function reportList()
    {
        
        $roomtypes = RoomType::where('is_active',1)->where('is_deleted',0)->get();
        $rooms = Room::with('housekeepingreport')->where('is_active',1)->where('is_deleted',0)->where('room_status','!=',3)->get();

        return view('housekipping.report.list',compact('rooms','roomtypes'));
    }

    public function reporAjaxList($id)
    {
        $rooms = Room::where('room_type',$id)->where('is_active',1)->where('is_deleted',0)->get();

        return view('housekipping.report.ajax.ajax_list',compact('rooms'));

    }

    public function reportUpdate(Request $request)
    {

        
        
       

        $housekeeping = HouseKeeping::where('room_id',$request->room_id)->where('id',$request->housekeeping_id)->where('is_active',1)->first();

        if($housekeeping){

            $roomstatus = Room::findOrFail($request->room_id);
            if($request->kepping_status == 'Dirty'){
                $roomstatus->room_status = 2;
                $roomstatus->save();
            }

            if($request->kepping_status == 'Repair'){
                $roomstatus->room_status = 4;
                $roomstatus->save();
            }

            if($request->kepping_status == 'Cleanded'){
                $roomstatus->room_status = 1;
                $roomstatus->save();
            }

            
            $housekeeping->room_id=$request->room_id;
            $housekeeping->log_date=$request->keeping_date;
            $housekeeping->log_time=$request->keeping_time;
            $housekeeping->keeping_name=$request->kepping_name;
            $housekeeping->keeping_status=$request->kepping_status;
            $housekeeping->keeping_assign_name=auth()->user()->id;
            $housekeeping->remarks=$request->last_log;
            $housekeeping->is_active=0;
            $housekeeping->save();
            $notification=array(
                'messege'=>'HouseKeeping Updated successfully!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);

        }else{

            $roomstatus = Room::findOrFail($request->room_id);
            if($request->kepping_status == 'Dirty'){
                $roomstatus->room_status = 2;
                $roomstatus->save();
            }

            if($request->kepping_status == 'Repair'){
                $roomstatus->room_status = 4;
                $roomstatus->save();
            }
            
            if($request->kepping_status == 'Cleanded'){
                $roomstatus->room_status = 1;
                $roomstatus->save();
            }

            $housekeeping = new HouseKeeping();
            $housekeeping->room_id=$request->room_id;
            $housekeeping->log_date=$request->keeping_date;
            $housekeeping->log_time=$request->keeping_time;
            $housekeeping->keeping_name=$request->kepping_name;
            $housekeeping->keeping_status=$request->kepping_status;
            $housekeeping->keeping_assign_name=auth()->user()->id;
            $housekeeping->remarks=$request->last_log;
            $housekeeping->is_active=0;
            $housekeeping->save();
            $notification=array(
                'messege'=>'HouseKeeping Insert successfully!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);

        }
        

    }


    public function getHousekeepingHistory($id)
    {
        $housekeepings = HouseKeeping::where('room_id',$id)->where('is_active',0)->get();

        return view('hotelbooking.home.ajax.housekeeping_history',compact('housekeepings'));
    }

    public function houseKeepingSearch($id,Request $request)
    {


        $from_date = strtotime($request->from_date);
        $to_date = strtotime($request->to_date);
        
        
        $housekeepings = HouseKeeping::where('room_id',$id)->where('keeping_name',$request->employee_name)->get();

        return view('hotelbooking.home.ajax.housekeeping_history',compact('housekeepings'));
    }
}
