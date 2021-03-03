<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkin;
use App\Models\Room;
use Session;
use Auth;
use Carbon\Carbon;
use DateTime;



class HotelServiceController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function SingleCheckoutGroupbooking($id){

        $checkin = Checkin::findOrFail($id);
        return view('hotelbooking.checking.services.checkoutgroupbooking.singlecheckout',compact('checkin'));

    }

    // incomplate
    public function SingleCheckoutRequest(Request $request){
        $current=date("d-m-Y");
        
        $checkindata=Checkin::where('booking_no',$request->booking_no)->where('room_id',$request->room_id)->first();
        $origin = new DateTime($checkindata->checkin_date);
        $target=Carbon::parse("{$current}")->toFormattedDateString();
        $target = new DateTime($target);

        $interval =$origin->diff($target);

        $date =abs($interval->format('%R%a'));

       return $totalamountroom = (int)$date * $checkindata->tarif;
    




        $validated = $request->validate([
            'room_id' => 'required',
        ]);
        
        $amount=$check->tarif;
        $checkindate=$check->checkin_date;
         $checkoutdate=$request->date;
        return  $checkoutdate - $checkindate;


        $update=Checkin::where('id',$check->id)->update([
            'is_active'=>1,
            'is_occupy'=>0,
            // 'final_checkout_amount'=>
            // 'final_checkout_date'=>$request->date
            // 'final_checkout_time'=>$request->time
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $room_update=Room::where('id',$request->room_id)->update([
            'room_status'=>2,
        ]);
        if($update){
            return back();
        }else{
            return back();
        }
    
    }

    // add room in existing booking
    public function addroom($id){
        $checkin = Checkin::findOrFail($id);
        return view('hotelbooking.checking.services.checkoutgroupbooking.addroom',compact('checkin'));
    }
    public function addroomsubmit(Request $request){
        $validated = $request->validate([
            'room_id' => 'required',
        ]);
        $checkindata=Checkin::where('booking_no',$request->booking_no)->first();
        $room=Room::where('id',$request->room_id)->first();

        $checkin= new Checkin;
        $checkin->room_id =$request->room_id;

        $checkin->checking_by = auth()->user()->id;
        $checkin->date = $request->date;
        $checkin->booking_no = $checkindata->booking_no;

        $checkin->room_type = $room->room_type;
        $checkin->room_no = $room->room_no;


        $checkin->booking_type = $checkindata->booking_type;
        $checkin->checkout_time = $checkindata->checkout_time;
        $checkin->advance_booking = $checkindata->addvance_booking;
        $checkin->adv_guest_name = $checkindata->adv_guest_name;
        $checkin->adv_booking_no =$checkindata->adv_booking_no;
        $checkin->title =$checkindata->title;

        $checkin->guest_name = $request->guest_name;
        $checkin->print_name = $request->guest_name;

        $checkin->gender = $checkindata->gender;
        $checkin->father_name =$checkindata->father_name;
        $checkin->address = $checkindata->address;
        $checkin->city = $checkindata->city;
        $checkin->mobile = $checkindata->mobile;
        $checkin->nationality = $checkindata->nationality;
        $checkin->email = $checkindata->email;
        $checkin->date_of_birth = $checkindata->date_of_birth;
        $checkin->doc_type =$checkindata->doc_type;
        $checkin->id_no = $checkindata->id_no;
        $checkin->file_no = $checkindata->file_no;

        $checkin->checkin_date = $request->date;
        $checkin->checkin_time = $request->time;

        $checkin->exp_checkin_date = $checkindata->expected_checkout_date;
        $checkin->exp_checkin_time = $checkindata->exp_checkout_time;

        $checkin->tarif = $request->tarrif;
    
        $checkin->non_taxable = $checkindata->non_taxable;
        $checkin->company_name = $checkindata->company_name;
        $checkin->default_grace_time = $checkindata->default_grace_time;
        $checkin->find_us = $checkindata->find_us;
        $checkin->own_vehicle = $checkindata->own_vehicle;
        $checkin->vehicle_type = $checkindata->vehicle_type;
        $checkin->vehicle_no = $checkindata->vehicle_no;
        $checkin->thru_agent = $checkindata->true_agent;
        $checkin->comming_form = $checkindata->comming_from;
        $checkin->comming_to = $checkindata->comming_to;
        $checkin->purpose_of_visit = $checkindata->purpose_of_visit;
        $checkin->number_of_person = $checkindata->number_of_person;
        $checkin->relationship = $checkindata->relationship;
        $checkin->male_no = $checkindata->male_no;
        $checkin->female_no = $checkindata->female_no;
        $checkin->children_no = $checkindata->children_no;
        $checkin->is_occupy = 1;
        $room=Room::where('id',$request->room_id)->update([
            'room_status'=>3,
        ]);

        if($checkin->save()){
            $notification=array(
                'messege'=>'Floor Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Floor Created faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }




       
    }

    // get ajax price
    public function getprice($room_id){
        //return $room_id;
        $data=Room::where('id',$room_id)->select(['tariff'])->first();
        return response()->json($data);

    }
    // chenge room ingroup boooking
    public function ChangeRoomGroupBooking($id){
        $checkin = Checkin::findOrFail($id);
        return view('hotelbooking.checking.services.checkoutgroupbooking.changeroom',compact('checkin'));
    }
    // change 
    public function ChangeRoomGroupBookingSubmit(Request $request){
      // return $request;
        $validated = $request->validate([
            'room_id' => 'required',
        ]);
        $room=Room::where('id',$request->room_id)->first();

        $update=Checkin::where('id',$request->id)->update([
            'room_no'=>$room->room_no,
            'room_id'=>$room->id,
            'tarif'=>$request->tarrif,
            'room_type'=>$room->room_type,
            'updated_by'=>Auth::user()->id,
            'updated_by'=>Carbon::now()->toDateTimeString(),
        ]);
        $roomupdate=Room::where('id',$request->room_id)->update([
                'room_status'=>3,
        ]);
        $oldroom=Room::where('id',$request->old_room)->update([
            'room_status'=>2,

        ]);
        if($update){
            $notification=array(
                'messege'=>'Update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

      // cheange master room
      public function ChangeRoomMaster($id){

        $checkin = Checkin::findOrFail($id);
        $booking_no=$checkin->booking_no;
        $masterroom=Checkin::where('booking_no',$booking_no)->first();
        return view('hotelbooking.checking.services.checkoutgroupbooking.masterroomchange',compact('checkin','masterroom'));
    }

    public function ChangeRoomMasterSubmit(Request $request){
        //return $request;
        $validated = $request->validate([
            'room_id' => 'required',
        ]);
        $booking_no=Checkin::where('booking_no',$request->booking_no)->first();
    
        $room=Room::where('id',$request->room_id)->first();
        $update=Checkin::where('id',$booking_no->id)->update([
            'room_no'=>$room->room_no,
            'room_id'=>$room->id,
            'tarif'=>$request->tarrif,
            'room_type'=>$room->room_type,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $roomupdate=Room::where('id',$request->room_id)->update([
                'room_status'=>3,
        ]);
        $oldroom=Room::where('id',$request->old_room)->update([
            'room_status'=>2,
        ]);
        if($update){
            $notification=array(
                'messege'=>'success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    // 
    public function changetariff($id){
        
        $checkin = Checkin::findOrFail($id);
        $booking_no=$checkin->booking_no;
        $masterroom=Checkin::where('booking_no',$booking_no)->first();
        return view('hotelbooking.checking.services.checkoutgroupbooking.changetarif',compact('checkin','masterroom'));
    }
    //
    public function changetariffsubmit(Request $request){
        //return $request;
        $validated = $request->validate([
            'new_tarrif' => 'required',
        ]);
        $id=$request->id;
        $update=Checkin::where('id',$id)->update([
            'tarif'=>$request->new_tarrif,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
