<?php

namespace App\Http\Controllers\Admin\hotel;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\CheckinService;
use App\Models\ItemEntry;
use App\Models\MenuCategory;
use App\Models\Room;
use Illuminate\Http\Request;
use Image;
use PDF;

class CheckingController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function index($id)
    {
        $room = Room::findOrFail($id);
        return view('hotelbooking.checking.checking',compact('room'));
    }

    public function getRoom()
    {
        $rooms = Room::where('room_status',1)->with('roomtype')->select(['id','room_no','room_type','tariff'])->get();
        return response()->json($rooms);
    }


    // Checkin area start from here

    public function store(Request $request)
    {
        $request->validate([
            'guest_name'=>'required',
            'print_name'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'city'=>'required',
            'mobile'=>'required',
            'nationality'=>'required',
            'doc_type'=>'required',
            'id_no'=>'required',
            'file_no'=>'required',
            'checkin_date'=>'required',
            'checkin_time'=>'required',
            'expected_checkout_date'=>'required',
            'exp_checkout_time'=>'required',
            'tariff'=>'required',
            'purpose_of_visit'=>'required',
            'no_of_person'=>'required',
            'relationship'=>'required',
            'client_img'=>'required',
            'id_proof_img'=>'required',
        ]);


        $room = Room::findOrFail($request->room_id);
        $room->update([
            'room_status'=> 3,
        ]);

        $checkin = new Checkin();
        $checkin->room_id =$request->room_id;
        $checkin->checking_by = auth()->user()->id;
        $checkin->date = $request->date;
        $checkin->booking_no = $request->booking_no;
        $checkin->room_type = $request->room_type;
        $checkin->room_no = $request->room_no;
        $checkin->booking_type = $request->booking_type;
        $checkin->checkout_time = $request->checkout_time;
        $checkin->advance_booking = $request->addvance_booking;
        $checkin->adv_guest_name = $request->dadv_guest_name;
        $checkin->adv_booking_no = $request->adv_booking_no;
        $checkin->title = $request->person_title;
        $checkin->guest_name = $request->guest_name;
        $checkin->print_name = $request->print_name;
        $checkin->gender = $request->gender;
        $checkin->father_name = $request->father_name;
        $checkin->address = $request->address;
        $checkin->city = $request->city;
        $checkin->mobile = $request->mobile;
        $checkin->nationality = $request->nationality;
        $checkin->email = $request->email;
        $checkin->date_of_birth = $request->date_of_birth;
        $checkin->doc_type = $request->doc_type;
        $checkin->id_no = $request->id_no;
        $checkin->file_no = $request->file_no;
        $checkin->checkin_date = $request->checkin_date;
        $checkin->checkin_time = $request->checkin_time;
        $checkin->exp_checkin_date = $request->expected_checkout_date;
        $checkin->exp_checkin_time = $request->exp_checkout_time;
        $checkin->tarif = $request->tariff;
        $checkin->non_taxable = $request->non_tax;
        $checkin->company_name = $request->company_name;
        $checkin->default_grace_time = $request->default_grace_time;
        $checkin->find_us = $request->find_us;
        $checkin->own_vehicle = $request->own_vehicle;
        $checkin->vehicle_type = $request->vehicle_type;
        $checkin->vehicle_no = $request->vehicle_no;
        $checkin->thru_agent = $request->true_agent;
        $checkin->comming_form = $request->comming_from;
        $checkin->comming_to = $request->going_to;
        $checkin->purpose_of_visit = $request->purpose_of_visit;
        $checkin->number_of_person = $request->no_of_person;
        $checkin->relationship = $request->relationship;
        $checkin->male_no = $request->male_no;
        $checkin->female_no = $request->female_no;
        $checkin->children_no = $request->children_no;
        
        

        if ($request->hasFile('client_img')) {
            $client_img = $request->file('client_img');
            $imagename = rand(111111,9999999) . '.' . $client_img->getClientOriginalExtension();
            Image::make($client_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
            $checkin->client_img = $imagename;
        }

        if ($request->hasFile('id_proof_img')) {
            $id_proof_img = $request->file('id_proof_img');
            $imagename = rand(111111,9999999) . '.' . $id_proof_img->getClientOriginalExtension();
            Image::make($id_proof_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
            $checkin->id_proof_imag = $imagename;
        }

        if($request->add_room_price){
            $count = count($request->add_room_price);
            $add_rooms = [];
            for($i=0; $i<$count;$i++){
                $item = array();
                $item['id'] =$request->add_room_id[$i];
                $item['price'] =$request->add_room_price[$i];
                $item['name'] =$request->add_room_guest[$i]?$request->add_room_guest[$i]:' ';
                array_push($add_rooms,$item);
                
            }
            $checkin->additional_room = json_encode($add_rooms);
        }

        
        $checkin->save();
        $notification=array(
            'messege'=>'Guest Check In successfully',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);

    }



    public function checkinReport()
    {
        $checkins = Checkin::with('user')->get();
        return view('hotelbooking.checking.index',compact('checkins'));
    }

    public function checkinEdit($id = null)
    {
        if(!$id){
            $notification=array(
                'messege'=>'Sorry! Check In Report Not Found or Null',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

        $checkin = Checkin::findOrFail($id);
        $rooms = Room::where('is_active',1)->where('is_deleted',0)->get();
        $items = ItemEntry::where('is_active',1)->where('is_deleted',0)->get();
        $menucategores = MenuCategory::where('is_active',1)->where('is_deleted',0)->get();


        return view('hotelbooking.checking.services.edit',compact('checkin','rooms','items','menucategores'));
    }

    public function serviceStore(Request $request)
    {
      // return $request;
        $request->validate([
            'service_date'=>'required',
            'service_time'=>'required',
            'service_category'=>'required',
            'services'=>'required',
            'rate'=>'required',
            'qty'=>'required',
        ]);
        $item_name=ItemEntry::where('id',$request->services)->select(['item_name','id'])->first();

        $services = new CheckinService();
        $services->service_no =$request->service_no;
        $services->checkin_id =$request->service_id;
        $services->service_date =$request->service_date;
        $services->service_time =$request->service_time;
        $services->service_category =$request->service_category;
        $services->services =$request->services;
        $services->item_name =$item_name->item_name;
        $services->stock_center ='CheckinServices';
        $services->remarks =$request->remarks;
        $services->rate =$request->rate;
        $services->qty =$request->qty;
        $services->is_third =$request->is_third;
        if($request->is_third == 1){
            $services->third_party =$request->third_party;
        }
        $services->save();

        $notification=array(
            'messege'=>'Services Added Successffully!',
            'alert-type'=>'success'
            );
        
        return redirect()->back()->with($notification);
    }

    public function getService($id)
    {
        $services = CheckinService::with('checkin')->where('checkin_id',$id)->get();
        $items = ItemEntry::where('is_active',1)->where('is_deleted',0)->get();
        $menucategores = MenuCategory::where('is_active',1)->where('is_deleted',0)->get();

        return view('hotelbooking.checking.services.ajax.edit',compact('services','items','menucategores'));
    }

    public function serviceUpdate(Request $request)
    {
       
        
        
        $request->validate([
            'service_date'=>'required',
            'service_time'=>'required',
            'service_category'=>'required',
            'services'=>'required',
            'rate'=>'required',
            'qty'=>'required',
        ]);
        $item_name=ItemEntry::where('id',$request->services)->select(['item_name','id'])->first();

        $services = CheckinService::findOrFail($request->service_id);
        $services->service_no =$request->service_no;
        $services->service_date =$request->service_date;
        $services->service_time =$request->service_time;
        $services->service_category =$request->service_category;
        $services->item_name =$item_name->item_name;
        $services->services =$request->services;
        $services->remarks =$request->remarks;
        $services->rate =$request->rate;
        $services->qty =$request->qty;
        
        if(isset($request->is_third) && $request->is_third == 1){
            $services->is_third =$request->is_third;
            $services->third_party =$request->third_party;
        }else{
            $services->is_third =0;
            $services->third_party =null;
        }


        if(isset($request->is_return) && $request->is_return == 1){
            
            $services->is_return =$request->is_return;
            $services->return_date =$request->return_date;
            $services->return_time =$request->return_time;
        }else{
            $services->is_return =0;
            $services->return_date =null;
            $services->return_time =null;
        }
        
        $services->save();

        $notification=array(
            'messege'=>'Services Updated Successffully!',
            'alert-type'=>'success'
            );
        
        return redirect()->back()->with($notification);
    }

    public function deleteService($id)
    {
        $services = CheckinService::with('checkin')->where('checkin_id',$id)->get();
        return view('hotelbooking.checking.services.ajax.delete',compact('services'));
    }

    public function deletedService($id)
    {
        $service = CheckinService::findOrFail($id)->delete();
        $notification=array(
            'messege'=>'Services Deleted Successffully!',
            'alert-type'=>'success'
            );
        
        return redirect()->back()->with($notification);
    }

    public function viewService($id)
    {
        $services = CheckinService::with('checkin')->where('checkin_id',$id)->get();
        return view('hotelbooking.checking.services.ajax.view',compact('services'));
    }

    public function printService($id)
    {
        $checkin = Checkin::findOrFail($id);
        $services = CheckinService::with('checkin')->where('checkin_id',$id)->get();
        $pdf = PDF::loadView('hotelbooking.checking.services.printServices',compact('checkin','services'));
        $serialno = rand(9999999,999999989);
        return $pdf->download($serialno.'.pdf');
    }

    public function ServiceCategores ($id)
    {
        $itemscategore= ItemEntry::findOrFail($id);
        return response()->json($itemscategore);
    }

    public function bookingCheckout($id)
    {
        $checkindata = Checkin::where('room_id',$id)->get();

        return view('hotelbooking.home.checkout',compact('checkindata'));
    }
}
