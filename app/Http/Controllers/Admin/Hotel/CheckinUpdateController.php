<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\ChangeTariff;
use App\Models\Checkin;
use App\Models\Room;
use Carbon\Carbon;
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
            'shift_date' => 'required',
            'sift_time' => 'required',
            'room_no' => 'required',
            'newroom' => 'required',
            'newtariff' => 'required',
        ]);
        $room = Room::findOrFail($request->newroom);
        $oldroom = Room::where('room_no', $request->room_no)->first();

        $checkin = Checkin::findOrFail($request->checkin_id);
        $checkin->change_date = $request->shift_date;
        $checkin->change_time = $request->sift_time;
        $checkin->old_room_no = $request->room_no;
        $checkin->room_id = $request->newroom;
        $checkin->room_no = $room->room_no ? $room->room_no : '';
        $checkin->room_type = $room->room_type ? $room->room_type : '';
        $checkin->tarif = $request->newtariff;
        $checkin->remarks = $request->remarks;
        $checkin->save();

        $room->room_status = 3;
        $room->save();

        $oldroom->room_status = 1;
        $oldroom->save();

        if ($room) {
            $notification = array(
                'messege' => 'Room Cheanged successfully!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'messege' => 'Room Cheanged Failed!',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }

    public function guestUpdate(Request $request, $id)
    {

        $request->validate([
            'person_title' => 'required',
            'guest_name' => 'required',
            'gender' => 'required',
            'print_name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'nationality' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
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
            $imagename = rand(111111, 9999999) . '.' . $id_proof_img->getClientOriginalExtension();
            Image::make($id_proof_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
            $checkin->id_proof_imag = $imagename;
        }
        $checkin->save();

        $notification = array(
            'messege' => 'Guest Information Cheanged successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editBookingShow($id)
    {
        $checkin = Checkin::findOrFail($id);

        return view('hotelbooking.checking.other.edit_booking', compact('checkin'));
    }

    public function bookingUpdate(Request $request, $id)
    {


        $request->validate([
            'expected_checkout_date' => 'required',
            'tariff' => 'required',
            'going_to' => 'required',
            'purpose_of_visit' => 'required',
            'no_of_person' => 'required',
        ]);

        $checkin = Checkin::findOrFail($id);
        $checkin->exp_checkin_date = $request->expected_checkout_date;
        $checkin->exp_checkin_time = $request->exp_checkout_time;
        $checkin->comming_form = $request->coming_from;
        $checkin->purpose_of_visit = $request->purpose_of_visit;
        $checkin->thru_agent = $request->thru_agent;
        if ($request->own_vehicle) {
            $checkin->own_vehicle = $request->own_vehicle;
        } else {
            $checkin->own_vehicle = 0;
        }

        $checkin->vehicle_type = $request->vehicle_type;
        $checkin->male_no = $request->male_no;
        $checkin->female_no = $request->female_no;
        $checkin->children_no = $request->children_no;
        $checkin->tarif = $request->tariff;
        if ($request->non_tax) {
            $checkin->non_taxable = $request->non_tax;
        } else {
            $checkin->non_taxable = 0;
        }

        $checkin->comming_to = $request->going_to;
        $checkin->find_us = $request->find_us;
        $checkin->checkout_time = $request->checkout_time;
        $checkin->vehicle_no = $request->vehicle_no;
        $checkin->number_of_person = $request->no_of_person;
        $checkin->remarks = $request->remarks;
        if ($request->post_to_room) {

            $checkin->is_active = $request->post_to_room;
        } else {
            $checkin->is_active = 0;
        }

        $checkin->save();
        $notification = array(
            'messege' => 'Booking Information Cheanged successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function tariffUpdate(Request $request, $id)
    {



        $request->validate([
            'tariff_change_date' => 'required',
            'tariff_change_time' => 'required',
            'new_tariff' => 'required',
        ]);

        $checkin = Checkin::findOrFail($id);
        if ($checkin) {

            $checkisexist = ChangeTariff::where('booking_no', $checkin->booking_no)->first();

            if ($checkisexist) {

                if($checkisexist->end_date != $request->tariff_change_date){
                    $tarrif = new ChangeTariff();
                    $tarrif->booking_no = $checkin->booking_no;
                    $tarrif->start_date = $checkisexist->end_date;
                    $tarrif->end_date = $request->tariff_change_date;
                    $tarrif->apply_time = $request->tariff_change_time;
                    $tarrif->room_no = $request->room_no;
                    $tarrif->old_tarrif = $checkisexist->new_tarrif;
    
                    $startdate = $checkisexist->end_date;
                    $enddate = $request->tariff_change_date;
    
                    $startdate = strtotime($startdate);
                    $startdate = date('Y-m-d', $startdate);
    
                    $enddate = strtotime($enddate);
                    $enddate = date('Y-m-d', $enddate);
    
    
                    $date = Carbon::parse($startdate);
                    $now = Carbon::parse($enddate);
                    $diff = $date->diffInDays($now);
    
                    $tarrif->old_apply_day = $diff > 0 ?$diff:1;
    
                    $tarrif->new_tarrif = $request->new_tariff;
                    $tarrif->tariff_remarks = $request->tariff_remarks;
                    $tarrif->save();
                }else{

                    
                    $checkisexist->new_tarrif = $request->new_tariff;
                    $checkisexist->save();
                }
               
            } else {

                $tarrif = new ChangeTariff();
                $tarrif->booking_no = $checkin->booking_no;
                $tarrif->start_date = $checkin->checkin_date;
                $tarrif->end_date = $request->tariff_change_date;
                $tarrif->apply_time = $request->tariff_change_time;
                $tarrif->room_no = $request->room_no;
                $tarrif->old_tarrif = $checkin->tarif;
                $tarrif->new_tarrif = $request->new_tariff;
                $tarrif->tariff_remarks = $request->tariff_remarks;

                $startdate = $checkin->checkin_date;
                $enddate = $request->tariff_change_date;

                $startdate = strtotime($startdate);
                $startdate = date('Y-m-d', $startdate);

                $enddate = strtotime($enddate);
                $enddate = date('Y-m-d', $enddate);


                $date = Carbon::parse($startdate);
                $now = Carbon::parse($enddate);
                $diff = $date->diffInDays($now);
                $tarrif->old_apply_day = $diff > 0 ?$diff:1;



                $tarrif->save();
            }

            $checkin->tarif = $request->new_tariff;
            $checkin->save();
        }


        $notification = array(
            'messege' => 'Tariff Information Cheanged successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteBooking($id)
    {
        $checkin = Checkin::findOrFail($id);
        $room = Room::findOrFail($checkin->room_id);
        $room->room_status = 1;
        $room->save();
        $checkin->delete();

        $notification = array(
            'messege' => 'Booking Deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.hotel')->with($notification);
    }
}
