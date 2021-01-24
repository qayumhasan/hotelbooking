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
        return view('housekipping.home.index');
    }

    public function reportList()
    {
        $roomtypes = RoomType::where('is_active',1)->where('is_deleted',0)->get();
        $rooms = Room::with('housekeeping')->where('is_active',1)->where('is_deleted',0)->paginate(10);
        return view('housekipping.report.list',compact('rooms','roomtypes'));
    }

    public function reporAjaxList($id)
    {
        $rooms = Room::where('room_type',$id)->where('is_active',1)->where('is_deleted',0)->paginate(10);

        return view('housekipping.report.ajax.ajax_list',compact('rooms'));

    }

    public function reportUpdate(Request $request)
    {
        
       

        $housekeeping = HouseKeeping::where('room_id',$request->room_id)->first();

        if($housekeeping){
            $housekeeping->room_id=$request->room_id;
            $housekeeping->log_date=$request->keeping_date;
            $housekeeping->log_time=$request->keeping_time;
            $housekeeping->keeping_name=$request->kepping_name;
            $housekeeping->keeping_status=$request->kepping_status;
            $housekeeping->keeping_assign_name=auth()->user()->id;
            $housekeeping->remarks=$request->last_log;
            $housekeeping->save();
            $notification=array(
                'messege'=>'HouseKeeping Updated successfully!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);

        }else{
            $housekeeping = new HouseKeeping();
            $housekeeping->room_id=$request->room_id;
            $housekeeping->log_date=$request->keeping_date;
            $housekeeping->log_time=$request->keeping_time;
            $housekeeping->keeping_name=$request->kepping_name;
            $housekeeping->keeping_status=$request->kepping_status;
            $housekeeping->keeping_assign_name=auth()->user()->id;
            $housekeeping->remarks=$request->last_log;
            $housekeeping->save();
            $notification=array(
                'messege'=>'HouseKeeping Insert successfully!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);

        }
        

    }
}
