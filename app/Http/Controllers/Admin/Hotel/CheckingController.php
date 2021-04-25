<?php

namespace App\Http\Controllers\Admin\hotel;

use App\Http\Controllers\Controller;
use App\Models\AccountTransectionDetails;
use App\Models\AccountTransectionHead;
use App\Models\CheckBookTransection;
use App\Models\Checkin;
use App\Models\CheckinService;
use App\Models\Checkout;
use App\Models\CheckOut_Tax_Details;
use App\Models\Guest;
use App\Models\HouseKeeping;
use App\Models\HouseKeepingGuestEntry;
use App\Models\ItemEntry;
use App\Models\MenuCategory;
use App\Models\Room;
use App\Models\Supplier;
use App\Models\TaxCalculation;
use App\Models\TaxSetting;
use App\Traits\calculationTax;
use Carbon\Carbon;
use CreateAccountTransectionDetailsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Image;
use PDF;

class CheckingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index($id)
    {
        $room = Room::findOrFail($id);

        $guests = Guest::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('hotelbooking.checking.checking', compact('room', 'guests'));
    }

    public function getRoom(Request $request)
    {

        $rooms = Room::where('room_status', 1)->where('id', '!=', $request->room_id)->with('roomtype')->select(['id', 'room_no', 'room_type', 'tariff'])->get();
        return response()->json($rooms);
    }


    // Checkin area start from here

    public function store(Request $request)
    {

        $request->validate([
            'guest_name' => 'required',
            'print_name' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'city' => 'required',
            'mobile' => 'required',
            'nationality' => 'required',
            'doc_type' => 'required',
            'id_no' => 'required',
            'file_no' => 'required',
            'checkin_date' => 'required',
            'checkin_time' => 'required',
            'expected_checkout_date' => 'required',
            'exp_checkout_time' => 'required',
            'tariff' => 'required',
            'purpose_of_visit' => 'required',
            'no_of_person' => 'required',
            'relationship' => 'required',
            'client_img' => 'required',
            'id_proof_img' => 'required',
        ]);

        if(isset($request->booking_type) && $request->booking_type == 2){

            if(!isset($request->add_room_price)){
                $notification = array(
                    'messege' => 'Additional Room Can not Selected!',
                    'alert-type' => 'error'
                );

                return redirect()->back()->with($notification);
            }
            
        }


        $room = Room::findOrFail($request->room_id);
        $room->update([
            'room_status' => 3,
        ]);

        // insert guest information

        if (!isset($request->is_old)) {
            $insert = Guest::insertGetId([
                'title' => $request->person_title,
                'guest_name' => $request->guest_name,
                'print_name' => $request->print_name,
                'gender' => $request->gender,
                'city' => $request->city,
                'address' =>$request->address,
                'nationality' =>$request->nationality,
                'date_of_birth' =>$request->date_of_birth,
                'company_name' => $request->company_name,
                'doc_type' => $request->doc_type,
                'id_no' => $request->id_no,
                'file_no' => $request->file_no,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'account_head' => "Accounts Receivable-Clients",
                'account_head_code' => "18-16-0024-20132",
                'client_img' => "18-16-0024-20132",
                'entry_by' => Auth::user()->id,
                'date' => Carbon::now()->toDateTimeString(),
            ]);
            
            $update=Guest::where('id', $insert)->update([
                'guest_id'=>'guest-'.$insert,
            ]);
            

            $update=Guest::where('id', $insert)->update([
                'guest_id'=>'guest-'.$insert,
            ]);

        }else{
            $guestID = $request->guest_id;
        }





        $checkin = new Checkin();
        $checkin->room_id = $request->room_id;
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
        $checkin->entry_by = auth()->user()->id;
        $checkin->entry_date = Carbon::now()->toDateTimeString();
        $checkin->is_occupy = 1;

        if(isset($insert)){
            $checkin->guest_id = $insert;
            $guestdata = Guest::findOrFail($insert);
        }else{
            $checkin->guest_id =$guestID;
        }

      


        if ($request->hasFile('client_img')) {
            $client_img = $request->file('client_img');
            $imagename = rand(111111, 9999999) . '.' . $client_img->getClientOriginalExtension();
            Image::make($client_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
            $checkin->client_img = $imagename;
            if(isset($guestdata)){
                $guestdata->client_img = $imagename;
                $guestdata->save();
            }
        }

        if ($request->hasFile('id_proof_img')) {
            $id_proof_img = $request->file('id_proof_img');
            $imagename = rand(111111, 9999999) . '.' . $id_proof_img->getClientOriginalExtension();
            Image::make($id_proof_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
            $checkin->id_proof_imag = $imagename;
            if(isset($guestdata)){
                $guestdata->id_proof_imag = $imagename;
                $guestdata->save();
            }
        }

        $checkin->save();



        // insert multi room in checkin

        if ($request->add_room_price) {

            $count = count($request->add_room_price);
            $add_rooms = [];
            for ($i = 0; $i < $count; $i++) {
                $item = array();
                $item['id'] = $request->add_room_id[$i];
                $item['price'] = $request->add_room_price[$i];
                $item['name'] = $request->add_room_guest[$i] ? $request->add_room_guest[$i] : ' ';
                array_push($add_rooms, $item);




                $room = Room::findOrFail($request->add_room_id[$i]);
                $room->update([
                    'room_status' => 3,
                ]);



                $checkin = new Checkin();
                $checkin->room_id = $request->add_room_id[$i];
                $checkin->checking_by = auth()->user()->id;
                $checkin->date = $request->date;
                $checkin->booking_no = $request->booking_no;
                $checkin->room_type = $request->room_type;
                $checkin->room_no = $room->room_no;
                $checkin->booking_type = $room->room_type;
                $checkin->checkout_time = $request->checkout_time;
                $checkin->advance_booking = $request->addvance_booking;
                $checkin->adv_guest_name = $request->dadv_guest_name;
                $checkin->adv_booking_no = $request->adv_booking_no;
                $checkin->title = $request->person_title;
                $checkin->guest_name = $request->add_room_guest[$i] ? $request->add_room_guest[$i] : $request->guest_name;
                $checkin->print_name = $request->add_room_guest[$i] ? $request->add_room_guest[$i] : $request->guest_name;
                $checkin->gender = $request->add_guest_gender[$i]?$request->add_guest_gender[$i] :$request->gender;
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
                $checkin->tarif = $request->add_room_price[$i];
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
                $checkin->number_of_person = $request->add_room_pax[$i] ?$request->add_room_pax[$i] : $request->no_of_person;
                $checkin->relationship =$request->add_room_relation[$i]?$request->add_room_relation[$i]: $request->relationship;
                $checkin->male_no = $request->male_no;
                $checkin->female_no = $request->female_no;
                $checkin->children_no = $request->children_no;
                $checkin->entry_by = auth()->user()->id;
                $checkin->entry_date = Carbon::now()->toDateTimeString();
                $checkin->is_occupy = 1;

                if(isset($insert)){
                    $checkin->guest_id = $insert;
                    $guestdata = Guest::findOrFail($insert);
                }else{
                    $checkin->guest_id =$guestID;
                }




                if ($request->hasFile('client_img')) {
                    $client_img = $request->file('client_img');
                    $imagename = rand(111111, 9999999) . '.' . $client_img->getClientOriginalExtension();
                    Image::make($client_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
                    $checkin->client_img = $imagename;
                }

                if ($request->hasFile('id_proof_img')) {
                    $id_proof_img = $request->file('id_proof_img');
                    $imagename = rand(111111, 9999999) . '.' . $id_proof_img->getClientOriginalExtension();
                    Image::make($id_proof_img)->resize(600, 400)->save(base_path('public/uploads/checkin/' . $imagename), 100);
                    $checkin->id_proof_imag = $imagename;
                }

                $checkin->additional_room = 1;
                $checkin->save();
            }
        }







        // $notification=array(
        //     'messege'=>'Guest Check In successfully',
        //     'alert-type'=>'success'
        //     );
        // return redirect()->back()->with($notification);
        return redirect()->route('admin.checkin.show.voucher', $request->booking_no);
    }





    public function checkinReport()
    {
        $checkins = Checkin::with('user')->get();
        return view('hotelbooking.checking.index', compact('checkins'));
    }

    public function checkinEdit($id = null)
    {
        if (!$id) {
            $notification = array(
                'messege' => 'Sorry! Check In Report Not Found or Null',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $checkin = Checkin::findOrFail($id);
        $rooms = Room::where('is_active', 1)->where('is_deleted', 0)->get();
        $items = ItemEntry::where('is_active', 1)->where('is_deleted', 0)->get();
        $menucategores = MenuCategory::where('is_active', 1)->where('is_deleted', 0)->get();
        $supliers = Supplier::where('is_active', 1)->where('is_deleted', 0)->get();


        return view('hotelbooking.checking.services.edit', compact('checkin', 'rooms', 'items', 'menucategores', 'supliers'));
    }

    public function serviceStore(Request $request)
    {



        $request->validate([
            'service_date' => 'required',
            'service_time' => 'required',
            'service_category' => 'required',
            'services' => 'required',
            'rate' => 'required',
            'qty' => 'required',
        ]);

        $item_name = ItemEntry::where('id', $request->services)->select(['item_name', 'id'])->first();

        $checkin = Checkin::findOrFail($request->service_id);
        if ($checkin) {
            $booking_no = $checkin->booking_no;
        }



        $services = new CheckinService();
        $services->room_no = $request->room_no;
        $services->service_no = $request->service_no;
        $services->checkin_id = $request->service_id;
        $services->booking_no = $booking_no;
        $services->service_date = $request->service_date;
        $services->service_time = $request->service_time;
        $services->service_category = $request->service_category;
        $services->services = $request->services;
        $services->item_name = $item_name->item_name;
        $services->stock_center = 'CheckinServices';
        $services->remarks = $request->remarks;
        $services->rate = $request->rate;
        $services->qty = $request->qty;
        $services->amount = $request->qty * $request->rate;
        $services->is_third = $request->is_third;
        $services->entry_by = auth()->user()->id;
        $services->entry_date = Carbon::now();
        if ($request->is_third == 1) {
            $services->third_party = $request->third_party;
        }
        $services->save();

        $notification = array(
            'messege' => 'Services Added Successffully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function getService($id)
    {
        $services = CheckinService::with('checkin')->where('checkin_id', $id)->get();
        $items = ItemEntry::where('is_active', 1)->where('is_deleted', 0)->get();
        $menucategores = MenuCategory::where('is_active', 1)->where('is_deleted', 0)->get();
        $supliers = Supplier::where('is_active', 1)->where('is_deleted', 0)->get();

        return view('hotelbooking.checking.services.ajax.edit', compact('services', 'items', 'menucategores','supliers'));
    }

    public function serviceUpdate(Request $request)
    {



        $request->validate([
            'service_date' => 'required',
            'service_time' => 'required',
            'service_category' => 'required',
            'services' => 'required',
            'rate' => 'required',
            'qty' => 'required',
        ]);
        $item_name = ItemEntry::where('id', $request->services)->select(['item_name', 'id'])->first();

        $services = CheckinService::findOrFail($request->service_id);
        $services->service_no = $request->service_no;
        $services->service_date = $request->service_date;
        $services->service_time = $request->service_time;
        $services->service_category = $request->service_category;
        $services->item_name = $item_name->item_name;
        $services->services = $request->services;
        $services->remarks = $request->remarks;
        $services->rate = $request->rate;
        $services->qty = $request->qty;
        $services->amount = $request->qty * $request->rate;
        $services->updated_by = auth()->user()->id;
        $services->updated_date = Carbon::now()->toDateTimeString();

        if (isset($request->is_third) && $request->is_third == 1) {
            $services->is_third = $request->is_third;
            $services->third_party = $request->third_party;
        } else {
            $services->is_third = 0;
            $services->third_party = null;
        }


        if (isset($request->is_return) && $request->is_return == 1) {

            $services->is_return = $request->is_return;
            $services->return_date = $request->return_date;
            $services->return_time = $request->return_time;
        } else {
            $services->is_return = 0;
            $services->return_date = null;
            $services->return_time = null;
        }




        $services->save();

        $notification = array(
            'messege' => 'Services Updated Successffully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteService($id)
    {
        $services = CheckinService::with('checkin')->where('checkin_id', $id)->get();
        return view('hotelbooking.checking.services.ajax.delete', compact('services'));
    }

    public function deletedService($id)
    {
        $service = CheckinService::findOrFail($id)->delete();
        $notification = array(
            'messege' => 'Services Deleted Successffully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function viewService($id)
    {
        $services = CheckinService::with('checkin')->where('checkin_id', $id)->get();
        return view('hotelbooking.checking.services.ajax.view', compact('services'));
    }

    public function printService($id)
    {
        $checkin = Checkin::findOrFail($id);
        $services = CheckinService::with('checkin')->where('checkin_id', $id)->get();
        $pdf = PDF::loadView('hotelbooking.checking.services.printServices', compact('checkin', 'services'));
        $serialno = rand(9999999, 999999989);
        return $pdf->download($serialno . '.pdf');
    }

    public function ServiceCategores($id)
    {
        $itemscategore = ItemEntry::findOrFail($id);
        return response()->json($itemscategore);
    }

    public function bookingCheckout($id)
    {

        
        $checkindata = Checkin::where('room_id', $id)->where('is_occupy', 1)->with('checkin', 'foodandbeverage', 'restaurant', 'vouchers')->first();

       

        $addi_checkins = Checkin::where('booking_no', $checkindata->booking_no)->get();
      



        return view('hotelbooking.home.checkout', compact('checkindata', 'addi_checkins'));
    }

    public function bookingAtAGlance($id)
    {



        $checkindata = Checkin::where('room_id', $id)->where('is_occupy', 1)->with('checkin', 'foodandbeverage', 'restaurant', 'vouchers')->first();

        $addi_checkins = Checkin::where('booking_no', $checkindata->booking_no)->get();

        return view('hotelbooking.home.ajax.checkin_atglance_ajax', compact('checkindata', 'addi_checkins'));
    }


    public function bookingCheckoutGetData(Request $request)
    {

        $checkindata = Checkin::where('room_id', $request->room_id)->where('is_occupy', 1)->with('checkin', 'foodandbeverage', 'restaurant', 'vouchers')->first();

        $addi_checkins = Checkin::where('booking_no', $checkindata->booking_no)->get();

        $current = $request->date;
        return view('hotelbooking.home.ajax.checkout_ajax', compact('checkindata', 'current', 'addi_checkins'));
    }


    public function bookingCheckoutStore(Request $request)
    {
        
        

        $request->validate([
            'checkoutDate' => 'required',
            'checkout_time' => 'required',
            'grace_time' => 'required',
        ]);

        

        $invoice_no = date('M') . '-' . rand(111, 999);

        $nonCheckoutCount = count($request->non_checkout_room);

        if ($nonCheckoutCount > 0) {
            foreach ($request->non_checkout_room as $row) {
                // make room dirty


                // $room = Room::findOrFail($row);
                // $room->room_status = 2;
                // $room->save();

                // house keeping entyr

                // $housekeeping = new HouseKeeping();
                // $housekeeping->room_id = $row;
                // $housekeeping->save();

              


                // remove from housekeeping guest entry

                // $guestEntry = HouseKeepingGuestEntry::where('room_id', $request->room_id)->where('is_active', 1)->first();
                // if($guestEntry){
                    
                // $guestEntry->is_active = 0;
                // $guestEntry->save();
                // }

                // add amount and day in checkin

                $checkin = Checkin::where('room_id', $row)->where('booking_no', $request->booking_no)->first();
                $checkin->additional_room_day = $request->non_checkout_room_day;
                $checkin->additional_room_amount = $checkin->tarif * $request->non_checkout_room_day;
                $checkin->add_room_checkout_date = $request->checkoutDate;
                $checkin->add_room_checkout_time = $request->checkout_time;
                // $checkin->is_occupy = 0;
                $checkin->save();
            }
        }

        $check = Checkout::where('booking_no', $request->booking_no)->first();

        if (!$check) {

            $checkout = new Checkout();
            $checkout->prime_room = $request->room_id;
            $checkout->booking_no = $request->booking_no;
            $checkout->invoice_no = $invoice_no;

            $checkout->checkout_date = $request->checkoutDate;
            $checkout->checkout_time = $request->checkout_time;
            $checkout->grace_time = $request->grace_time;

            $checkout->room_amount = $request->room_total_amount;
            $checkout->extra_service_amount = $request->extra_service;
            $checkout->fb_amount = $request->fb_bservice;
            $checkout->restaurant_amount = $request->restaurant;

            $checkout->voucher_amount = $request->advance_amount;

            $checkout->net_amount = $request->net_amount;

            $checkout->gross_amount = $request->net_amount;
            
            $checkout->outstanding_amount = $request->outstanding_amount;


            $checkout->additional_room = $request->safsda;


            $checkout->entry_by = Auth::user()->id;
            $checkout->entry_date = Carbon::now();
            $checkout->save();

        } else {
            $check->prime_room = $request->room_id;
            $check->booking_no = $request->booking_no;
            $check->invoice_no = $invoice_no;

            $check->checkout_date = $request->checkoutDate;
            $check->checkout_time = $request->checkout_time;
            $check->grace_time = $request->grace_time;

            $check->room_amount = $request->room_total_amount;
            $check->extra_service_amount = $request->extra_service;
            $check->fb_amount = $request->fb_bservice;
            $check->restaurant_amount = $request->restaurant;

            $check->voucher_amount = $request->advance_amount;

            $check->net_amount = $request->net_amount;

            $check->gross_amount = $request->net_amount;
            
            $check->outstanding_amount = $request->outstanding_amount;


            $check->additional_room = $request->safsda;


            $check->entry_by = Auth::user()->id;
            $check->entry_date = Carbon::now();
            $check->save();
        }

        return redirect()->route('admin.checkout.invoice.page', [\Crypt::encrypt($request->booking_no)]);
    }

    public function getTaxValue(Request $request)
    {

        $tax = TaxSetting::findOrFail($request->tax_details);
        return response()->json($tax);
    }


    public function checkOutInvoice($booking_no)
    {
        


       $booking_no = \Crypt::decrypt($booking_no);


        $checkindata = Checkin::where('booking_no', $booking_no)->where('is_occupy', 1)->with('checkin', 'foodandbeverage', 'restaurant', 'vouchers')->first();

        $roomdata = Checkin::where('booking_no', $booking_no)->get();

        $checkout = Checkout::where('booking_no', $booking_no)->first();

        $taxs = TaxSetting::where('is_active', 1)->where('is_deleted', 0)->get();

        $tax_details = CheckOut_Tax_Details::where('booking_no', $checkout->booking_no)->where('invoice_no', $checkout->invoice_no)->get();

        return view('hotelbooking.home.checkout_invoice', compact('checkindata', 'taxs', 'checkout', 'tax_details','roomdata'));
    }

    public function calculateTaxAmount(Request $request)
    {



        $request->validate([
            'base_on' => 'required',
            'calculation_on' => 'required',
            'rate' => 'required',
            'tax_details' => 'required',
        ]);

        $base_on = $request->base_on;
        $calculation_on = $request->calculation_on;
        $rate = $request->rate;
        $tax_details = $request->tax_details;
        $checkout_id = $request->checkout_id;

        $element = new CalculationTax($base_on, $calculation_on, $rate, $tax_details, $checkout_id);

        $getTax = $element->calCulateTaxAmount()->getTax();
        return response()->json($getTax);
    }


    public function calculateGrossAmount(Request $request)
    {

        $request->validate([
            'base_on' => 'required',
            'calculation_on' => 'required',
            'rate' => 'required',
            'tax_details' => 'required',
        ]);

        $base_on = $request->base_on;
        $calculation_on = $request->calculation_on;
        $rate = $request->rate;
        $tax_details = $request->tax_details;
        $checkout_id = $request->checkout_id;
        $amount = $request->amount;

        $element = new CalculationTax($base_on, $calculation_on, $rate, $tax_details, $checkout_id, $amount);


        $element->storeTax($request);

        $checkout = Checkout::where('booking_no', $request->booking_no)->where('invoice_no', $request->invoice_no)->first();

        $taxs = CheckOut_Tax_Details::where('booking_no', $request->booking_no)->where('invoice_no', $request->invoice_no)->get();
        return view('hotelbooking.home.ajax.checkout_tax_ajax', compact('taxs', 'checkout'));
    }


    public function editTaxData(Request $request)
    {


        $request->validate([
            'base_on' => 'required',
            'calculation_on' => 'required',
            'rate' => 'required',
            'tax_details' => 'required',
        ]);

        $taxupdate = CheckOut_Tax_Details::where('id', $request->tax_id)->first();

        $checkout = Checkout::where('booking_no', $taxupdate->booking_no)->where('invoice_no', $taxupdate->invoice_no)->first();

        $this->taxEditDelete($taxupdate, $checkout);
        $taxupdate->delete();


        $base_on = $request->base_on;
        $calculation_on = $request->calculation_on;
        $rate = $request->rate;
        $tax_details = $request->tax_details;
        $checkout_id = $request->checkout_id;
        $amount = $request->amount;

        $element = new CalculationTax($base_on, $calculation_on, $rate, $tax_details, $checkout_id, $amount);


        $element->storeTax($request);






        $checkout = Checkout::where('booking_no', $request->booking_no)->where('invoice_no', $request->invoice_no)->first();

        $taxs = CheckOut_Tax_Details::where('booking_no', $request->booking_no)->where('invoice_no', $request->invoice_no)->get();
        return view('hotelbooking.home.ajax.checkout_tax_ajax', compact('taxs', 'checkout'));
    }


    public function deleteTaxData($id)
    {
        $taxupdate = CheckOut_Tax_Details::where('id', $id)->first();

        $checkout = Checkout::where('booking_no', $taxupdate->booking_no)->where('invoice_no', $taxupdate->invoice_no)->first();

        $this->taxEditDelete($taxupdate, $checkout);

        if ($taxupdate) {
            $taxupdate->delete();

            $checkout = Checkout::where('booking_no', $taxupdate->booking_no)->where('invoice_no', $taxupdate->invoice_no)->first();

            $taxs = CheckOut_Tax_Details::where('booking_no', $taxupdate->booking_no)->where('invoice_no', $taxupdate->invoice_no)->get();
            return view('hotelbooking.home.ajax.checkout_tax_ajax', compact('taxs', 'checkout'));
        }
    }


    // checkout edit delete

    public function taxEditDelete($taxupdate, $checkout)
    {
        if ($taxupdate->effect == 'Deduct') {



            if ($taxupdate->calculation_on == 1) {

                // $checkout->increment('room_amount', $taxupdate->amount);
                $checkout->increment('outstanding_amount',$taxupdate->amount);  
                $checkout->increment('gross_amount', $taxupdate->amount);
                $checkout->decrement('discount_amount', $taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 2) {
                // $checkout->increment('fb_amount', $taxupdate->amount);
                $checkout->increment('gross_amount', $taxupdate->amount);
                $checkout->increment('outstanding_amount',$taxupdate->amount);
                $checkout->decrement('discount_amount', $taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 3) {

                // $checkout->increment('discount_amount', $taxupdate->amount);
                $checkout->increment('gross_amount', $taxupdate->amount);
                $checkout->increment('outstanding_amount',$taxupdate->amount);
                $checkout->decrement('discount_amount', $taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 4) {
                // $checkout->increment('net_amount', $taxupdate->amount);
                $checkout->increment('gross_amount', $taxupdate->amount);
                $checkout->increment('outstanding_amount',$taxupdate->amount);
                $checkout->decrement('discount_amount', $taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 5) {

                $checkout->increment('gross_amount', $taxupdate->amount);
                $checkout->increment('outstanding_amount',$taxupdate->amount);
                $checkout->decrement('discount_amount', $taxupdate->amount);
            }
        } elseif ($taxupdate->effect == 'Add') {

            if ($taxupdate->calculation_on == 1) {

                // $checkout->decrement('room_amount', $taxupdate->amount);
                $checkout->decrement('gross_amount', $taxupdate->amount);
                $checkout->decrement('outstanding_amount',$taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 2) {
                // $checkout->decrement('fb_amount', $taxupdate->amount);
                $checkout->decrement('gross_amount', $taxupdate->amount);
                $checkout->decrement('outstanding_amount',$taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 3) {

                $checkout->decrement('discount_amount', $taxupdate->amount);
                $checkout->decrement('gross_amount', $taxupdate->amount);
                $checkout->decrement('outstanding_amount',$taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 4) {
                // $checkout->decrement('net_amount', $taxupdate->amount);
                $checkout->decrement('gross_amount', $taxupdate->amount);
                $checkout->decrement('outstanding_amount',$taxupdate->amount);
            } elseif ($taxupdate->calculation_on == 5) {

                $checkout->decrement('gross_amount', $taxupdate->amount);
                $checkout->decrement('outstanding_amount',$taxupdate->amount);
            }
        }
    }
    // checkinf history
    public function checkinhistory($id)
    {

        $checkins = Checkin::where('room_id', $id)->where('is_occupy', 0)->get();

        return view('hotelbooking.home.ajax.checkin_history_ajax', compact('checkins'));
    }


    public function checkoutInvoiceStore(Request $request)
    {

       


        $checkout = Checkout::where('booking_no', $request->booking_no)->first();
        if ($checkout) {
            $checkout->invoice_date = $request->invoicedate;
            $checkout->is_active = 0;
            $checkout->updated_by = Auth::user()->id;
            $checkout->updated_date = Carbon::now();
            $checkout->save();
        }


        if (isset($request->withoutFoodBill) and isset($request->withoutExtraService) and isset($request->withoutHealthClub)) {

            $amount = $checkout->gross_amount - ($checkout->fb_amount + $checkout->extra_service_amount);
            $data = [
                'identifier' => 'except_all_item',
                'amount' => $amount,
            ];
        } elseif (isset($request->withoutFoodBill) and isset($request->withoutExtraService)) {
            $amount = $checkout->gross_amount - ($checkout->fb_amount + $checkout->extra_service_amount);
            $data = [
                'identifier' => 'food_and_extra',
                'amount' => $amount,
            ];
        } elseif (isset($request->withoutFoodBill)) {
            $amount = $checkout->gross_amount - $checkout->fb_amount;

            $data = [
                'identifier' => 'is_food',
                'amount' => $amount,
            ];
        } elseif (isset($request->withoutExtraService)) {
            $amount = $checkout->gross_amount - $checkout->extra_service_amount;
            $data = [
                'identifier' => 'is_extra',
                'amount' => $amount,
            ];
        } elseif (isset($request->othercurrency)) {
            $data = [
                'identifier' => 'other_currency',
            ];
        } else {
            $data = [
                'identifier' => 'all_item',
                'amount' => $checkout->gross_amount,
            ];
        }



        $checkindata = Checkin::where('booking_no', $request->booking_no)->with('checkin', 'foodandbeverage', 'restaurant', 'vouchers')->first();





        $addi_checkins = Checkin::where('booking_no', $request->booking_no)->get();
        $roomdata = Checkin::where('booking_no', $request->booking_no)->get();

        // make room dirty

        foreach ($addi_checkins as $row) {
         
            $room = Room::findOrFail($row->room_id);
            if($room){
                    $room->room_status = 2;
                    $room->save();   
                }
        
                //  house keeping entyr

                $housekeeping = new HouseKeeping();
                $housekeeping->room_id = $row->room_id;
                $housekeeping->save();

                
                // remove from housekeeping guest entry

                $guestEntry = HouseKeepingGuestEntry::where('room_id', $row->room_id)->where('is_active', 1)->first();
                if($guestEntry){
                    
                    $guestEntry->is_active = 0;
                    $guestEntry->save();
                }

                $checkin = Checkin::where('room_id', $row->room_id)->where('booking_no', $row->booking_no)->first();
                $checkin->is_occupy = 0;
                $checkin->save();
        }


        $checkout = Checkout::findOrFail($request->checkout_id);

        $taxs = TaxSetting::where('is_active', 1)->where('is_deleted', 0)->get();

        $tax_details = CheckOut_Tax_Details::where('booking_no', $request->booking_no)->where('invoice_no', $request->invoice_no)->get();

        $checkins = Checkin::where('booking_no', $request->booking_no)->get();
        $checkingservices = CheckinService::where('booking_no',$request->booking_no)->get();

        return view('hotelbooking.home.checkout_invoice', compact('checkindata', 'taxs', 'checkout', 'tax_details', 'roomdata', 'data', 'checkins','checkingservices'));
    }


    public function historySearch(Request $request)
    {


        $checkins = Checkin::whereBetween('checkin_date', [$request->form_date, $request->to_date])->where('room_id', $request->room_id)->get();
        return view('hotelbooking.home.ajax.checkin_history_ajax', compact('checkins'));
    }


    public function guestInfo($guestname)
    {
        $guest = Guest::where('guest_name', $guestname)->where('is_active', 1)->where('is_deleted', 0)->first();

        return response()->json($guest);
    }

    public function serviceList($id)
    {
        return $items = ItemEntry::where('category_name',$id)->where('is_active',1)->where('is_deleted',0)->get();

    }


    public function guestNameList()
    {
        $guests = Guest::where('is_active',1)->orderBy('id', 'desc')->where('is_deleted',0)->get();
        return view('hotelbooking.checking.ajax.guest_list',compact('guests'));
    }

    public function guestCheckinDetails($id)
    {
        
        $checkinInfo = Checkin::with('checkout')->where('guest_id',$id)->where('is_occupy',0)->get();

        if(count($checkinInfo) >0){
            return view('hotelbooking.checking.ajax.guest_checkin_details',compact('checkinInfo'));
        }
        
    }

    public function checkoutVoucerCreate(Request $request,$booking_no)
    {
        
        $check=AccountTransectionDetails::where('voucher_no',$request->invoice)->first();
        if($check){
              
                $data = new AccountTransectionHead;
                $data->voucher_type=$request->voucher_name;
                $data->voucher_no=$request->invoice;
                $data->date=$request->date;
                $data->reference=$request->reference;
                $data->cheque_reference=$check->check_reference;
                $data->narration=$request->narration;
                $data->advice=$request->advice;
                $data->main_invoice=$request->hiddeninvoice;
                $data->created_at=Carbon::now()->toDateTimeString();
                $data->entry_by=Auth::user()->id;
                if($check->dr_amount == NULL){
                    // return "dr faka";

                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->cr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);
    
                }elseif($check->cr_amount == NULL){
                     //return "cr faka";
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->dr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);

                }
                $detailsdata=AccountTransectionDetails::where('voucher_no',$request->invoice)->get();
                foreach($detailsdata as $updata){
                    AccountTransectionDetails::where('id',$updata->id)->update([
                        'is_active'=>1,
                    ]);
                }

                if($data->save()){
                    $notification = array(
                        'messege' => 'Insert Success',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'messege' => 'Insert Faild',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

        }else{
            $notification = array(
                'messege' => 'Please add Transection',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
