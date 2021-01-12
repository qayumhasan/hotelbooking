<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Room;
use Illuminate\Http\Request;
use Image;

class CheckinUpdateController extends Controller
{
    public function getNewRoomtarif($id)
    {
        
        return $tariff = Room::findOrFail($id)->tariff;
    }
    public function roomChange(Request $request)
    {
        $request->validate([
            'shift_date'=>'required',
            'sift_time'=>'required',
            'room_no'=>'required',
            'newroom'=>'required',
            'newtariff'=>'required',
        ]);
        $room = Room::findOrFail($request->newroom);
        $oldroom = Room::where('room_no',$request->room_no)->first();
        $checkin=Checkin::findOrFail($request->checkin_id);
        $checkin->change_date = $request->shift_date;
        $checkin->change_time = $request->sift_time;
        $checkin->old_room_no = $request->room_no;
        $checkin->room_id = $request->newroom;
        $checkin->room_no = $room->room_no?$room->room_no:'';
        $checkin->room_type = $room->room_type?$room->room_type:'';
        $checkin->tarif = $request->newtariff;
        $checkin->remarks = $request->remarks;
        $checkin->save();

        $room->room_status = 3;
        $room->save();

        $oldroom->room_status = 1;
        $oldroom->save();
        
        if($room){
            $notification=array(
                'messege'=>'Room Cheanged successfully!',
                'alert-type'=>'success'
                );
        }else{
            $notification=array(
                'messege'=>'Room Cheanged Failed!',
                'alert-type'=>'error'
                );
        }
       
        return redirect()->back()->with($notification);
    }

    public function guestUpdate(Request $request,$id)
    {
        
        $request->validate([
            'person_title'=>'required',
            'guest_name'=>'required',
            'gender'=>'required',
            'print_name'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'nationality'=>'required',
            'id_type'=>'required',
            'id_no'=>'required',
        ]);

        $checkin = Checkin::findOrFail($id);
        $checkin->title = $request->person_title;
        $checkin->guest_name = $request->guest_name;
        $checkin->gender = $request->gender;
        $checkin->print_name = $request->print_name;
        $checkin->father_name = $request->father_name;
        $checkin->company_name = $request->company_name;
        $checkin->email = $request->email;
        $checkin->address = $request->address;
        $checkin->mobile = $request->mobile;
        $checkin->nationality = $request->nationality;
        $checkin->doc_type = $request->id_type;
        $checkin->id_no = $request->id_no;
        if ($request->hasFile('doc_img')) {

            if ($checkin->id_proof_imag) {
                $link = base_path('public/uploads/checkin/') . $checkin->id_proof_imag;
                unlink($link);
            }
            $id_proof_img = $request->file('doc_img');
            $imagename = rand(111111,9999999) . '.' . $id_proof_img->getClientOriginalExtension();
            Image::make($id_proof_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
            $checkin->id_proof_imag = $imagename;
        }
        $checkin->save();

        $notification=array(
            'messege'=>'Guest Information Cheanged successfully!',
            'alert-type'=>'success'
            );

        return redirect()->back()->with($notification);
        
    }

    public function editBookingShow($id)
    {
        $checkin = Checkin::findOrFail($id);
        
        return view('hotelbooking.checking.other.edit_booking',compact('checkin'));
    }
}
