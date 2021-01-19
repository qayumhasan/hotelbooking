<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\AdvanceBooking;
use App\Models\Checkin;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdvanceBookingController extends Controller
{
    /**
     * Show Advance Booking Form.
     * @return \Illuminate\View\View
     */

    public function showAdvanceBookingForm()
    {
        $roomtypes = RoomType::all();
        $guests = Guest::orderBy('id','desc')->get();
        return view('hotelbooking.advancebooking.create', compact('roomtypes', 'guests'));
    }

    public function advanceBookingGetRoom($id)
    {

        $rooms = Room::where('room_type', $id)->with('roomtype')->get();
        return response()->json($rooms);
    }

    public function guestNameStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'print_name' => 'required',
            'mobile' => 'required',
            'guest_name' => 'required',
            'gender' => 'required',
            'city' => 'required',
        ]);

        $guest = new Guest();
        $guest->title = $request->title;
        $guest->guest_name = $request->guest_name;
        $guest->print_name = $request->print_name;
        $guest->gender = $request->gender;
        $guest->city = $request->city;
        $guest->company_name = $request->company_name;
        $guest->mobile = $request->mobile;
        $guest->email = $request->email;

        if ($guest->save()) {
            return response()->json([
                'message' => 'Guest Store Successfully!',
            ]);
        }
    }

    public function advanceBookingStore(Request $request)
    {
        if(!$request->room){
            $notification=array(
                'messege'=>'Please!Select A Room!!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }
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

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            $notification=array(
                'messege'=>'Advance Booking Fails. Something is Missing!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }




        foreach ($request->room as $row) {


            $booking = new AdvanceBooking();
            $booking->booking_id = $request->booking_id;
            $booking->booked_by = auth()->user()->id;
            $booking->booking_date = $request->booked_date;
            $booking->checkindate = $request->checkindate;
            $booking->checkintime = $request->checkintime;
            $booking->checkoutdate = $request->checkoutdate;
            $booking->checkouttime = $request->checkouttime;
            $booking->guest_id = $request->guest_name;
            $booking->room_type = $request->room_type;
            $booking->no_of_rooms = $request->no_of_room;
            $booking->room_id = $row;


            $room = Room::findOrFail($row);
            if ($room) {
                $booking->tariff = $room->tariff;
            }


            $booking->thru_agent = $request->thru_agent;
            $booking->booking_source = $request->find_us;
            $booking->remarks = $request->remarks;
            $booking->is_active = $request->is_active;
            $booking->save();
        }

        $notification=array(
            'messege'=>'Advance Booking Create Successfully!',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function advanceBookingCheck(Request $request, $id)
    {
        

        $checkindate = $request->checkin;

        $checkindate = str_replace('/', '-', $checkindate);
        $newcheckindate = strtotime($checkindate);
        $checkindate = date('Y-m-d', $newcheckindate);


        $checkoutdate = $request->checkout;
        $checkoutdate = str_replace('/', '-', $checkoutdate);
        $newcheckoutdate = strtotime($checkoutdate);
        $checkoutdate = date('Y-m-d', $newcheckoutdate);

        $checkin = Checkin::where('room_id', $id)->whereBetween('exp_checkin_date', [$checkindate, $checkoutdate])->first();

    //    return $advancebooking = AdvanceBooking::where('room_id',$id)->whereBetween('checkoutdate', [$checkindate, $checkoutdate])->first();
      

        if ($checkin) {
            return response()->json([
                'checkindate' => $checkin->checkin_date,
                'checkoutdate' => $checkin->exp_checkin_date,
            ]);
        }
    }


    public function showAdvanceBookingReportPage()
    {
        
        $advances = AdvanceBooking::all();
        return view('hotelbooking.advancebooking.report.report', compact('advances'));
    }

    public function showAdvanceBookingReportEdit($id)
    {
        $roomtypes = RoomType::all();
        $guests = Guest::orderBy('id','desc')->get();
        $advancebooking =AdvanceBooking::findOrFail($id);
        return view('hotelbooking.advancebooking.report.edit', compact('advancebooking','roomtypes','guests'));
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
        return redirect()->route('admin.advance.booking.report')->with($notification);

    }

    public function deleteAdvanceBookingReport ($id)
    {
        $advancebooking = AdvanceBooking::findOrFail($id);
        $advancebooking->delete();
        
        $notification=array(
            'messege'=>'Advance Booking Deleted Successfully!',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.advance.booking.report')->with($notification);
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
        return redirect()->route('admin.advance.booking.report')->with($notification);
    }
}
