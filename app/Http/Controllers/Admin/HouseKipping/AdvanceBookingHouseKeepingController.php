<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\AdvanceBooking as ResourcesAdvanceBooking;
use App\Http\Resources\DayByDayCalenderCollection;
use App\Http\Resources\HouseKeepingAdvanceBooking;
use App\Http\Resources\HouseKeepingDayByDayCalenderCollection;
use App\Models\AdvanceBooking;
use App\Models\Checkin;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;

use Illuminate\Support\Facades\Validator;

class AdvanceBookingHouseKeepingController extends Controller
{
   public function showAdvanceBookingReportPage()
   {
    $advances = AdvanceBooking::where('is_deleted',0)->orderBy('id', 'DESC')->get();

    return view('housekipping.advancebooking.report.report', compact('advances'));
   }


   public function showAdvanceBookingReportEdit($id)
   {
       $roomtypes = RoomType::all();
       $guests = Guest::orderBy('id','desc')->get();
       $advancebooking =AdvanceBooking::findOrFail($id);
       return view('housekipping.advancebooking.report.edit', compact('advancebooking','roomtypes','guests'));
   }

   public function showAdvanceBookingReportUpdate (Request $request ,$id)
    {

        $request->validate([
            'room' => 'required',
            'booked_date' => 'required',
            'checkindate' => 'required',
            'checkintime' => 'required',
            'checkoutdate' => 'required',
            'checkouttime' => 'required',
            'guest_name' => 'required',
            'room_type' => 'required',
            'no_of_room' => 'required',
        ]);

        if(!$request->room){
            $notification=array(
                'messege'=>'Please!Select A Room!!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }

        $advancebooking = AdvanceBooking::findOrFail($id);

        if(!in_array($advancebooking->room_id,$request->room)){
         
            $advancebooking->delete();
        }

        foreach ($request->room as $row) {
            

            if($advancebooking->room_id == $row){
                $advancebooking->booking_id = $request->booking_id;
                $advancebooking->booked_by = auth()->user()->id;
                $advancebooking->booking_date = $request->booked_date;
                $advancebooking->checkindate = $request->checkindate;
                $advancebooking->checkintime = $request->checkintime;
                $advancebooking->checkoutdate = $request->checkoutdate;
                $advancebooking->checkouttime = $request->checkouttime;
                $advancebooking->guest_id = $request->guest_name;
                $advancebooking->room_type = $request->room_type;
                $advancebooking->no_of_rooms = $request->no_of_room;
                $advancebooking->year = (int)date('Y');
    
    
                // $room = Room::findOrFail($row);
                // if ($room) {
                //     $advancebooking->tariff = $room->tariff;
                // }
    
    
                $advancebooking->thru_agent = $request->thru_agent;
                $advancebooking->booking_source = $request->find_us;
                $advancebooking->remarks = $request->remarks;
                $advancebooking->is_active = $request->is_active;
                $advancebooking->save();

            }else{
            $advancebooking = new AdvanceBooking();
            $advancebooking->booking_id = $request->booking_id;
            $advancebooking->booked_by = auth()->user()->id;
            $advancebooking->booking_date = $request->booked_date;
            $advancebooking->checkindate = $request->checkindate;
            $advancebooking->checkintime = $request->checkintime;
            $advancebooking->checkoutdate = $request->checkoutdate;
            $advancebooking->checkouttime = $request->checkouttime;
            $advancebooking->guest_id = $request->guest_name;
            $advancebooking->room_type = $request->room_type;
            $advancebooking->no_of_rooms = $request->no_of_room;
            $advancebooking->room_id = $row;
            $advancebooking->year = (int)date('Y');
    
    
                $room = Room::findOrFail($row);
                if ($room) {
                $advancebooking->tariff = $room->tariff;
                }
    
    
            $advancebooking->thru_agent = $request->thru_agent;
            $advancebooking->booking_source = $request->find_us;
            $advancebooking->remarks = $request->remarks;
            $advancebooking->is_active = $request->is_active;
            $advancebooking->save();

            }
        }

        $notification=array(
            'messege'=>'Advance Booking Updated Successfully!',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.housekeeping.advance.booking.report.list')->with($notification);

    }


    
    public function statusAdvanceBookingReport ($id)
    {
       
        $advancebooking = AdvanceBooking::findOrFail($id);
        if($advancebooking->is_active == 1){
            $advancebooking->is_active = 0;
            $advancebooking->save();
        }else if($advancebooking->is_active == 0){
            $advancebooking->is_active = 1;
            $advancebooking->save();
        }
        
        $notification=array(
            'messege'=>'Advance Booking Status Changed Successfully!',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.housekeeping.advance.booking.report.list')->with($notification);
    }

    public function deleteAdvanceBookingReport ($id)
    {
        $advancebooking = AdvanceBooking::findOrFail($id);
        $advancebooking->delete();
        
        $notification=array(
            'messege'=>'Advance Booking Deleted Successfully!',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.housekeeping.advance.booking.report.list')->with($notification);
    }


    public function advanceBookingCalender()
    {
        $roomtypes = RoomType::where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.advancebooking.report.calender',compact('roomtypes'));
    }

    public function getadvanceBookingReport(Request $request)
    {
    
        $advancebooking = AdvanceBooking::where('room_type',$request->room_type)->where('year',$request->year)->get();
        return new HouseKeepingAdvanceBooking($advancebooking);
        
    }

    public function advanceBookingRoom($id)
    {
        $advancebooking = AdvanceBooking::findOrFail($id);
        return view('housekipping.advancebooking.report.booking_show',compact('advancebooking'));
    }

    public function advanceBookingCalenderDaybyDay()
    {
        
        $roomtypes = RoomType::where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.advancebooking.report.daybydaycalender',compact('roomtypes'));
    }

    public function getadvanceBookingReportDayByDay(Request $request)
    {
        $advancebooking = AdvanceBooking::where('room_type',$request->room_type)->where('year',$request->year)->get();
        return new HouseKeepingDayByDayCalenderCollection($advancebooking);
        
    }

}
