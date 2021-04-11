<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\HouseKeepingGuestEntry;
use App\Models\ItemEntry;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HousekeepingGuestEntryController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function guestEntryPage()
    {
        
        $rooms=Room::where('is_active',1)->where('room_status',3)->where('is_deleted',0)->get();
        return view('housekipping.guest_entry.person_entry',compact('rooms'));  
    }

    public function getEntrypaxStore(Request $request)
    {
     
        
        date_default_timezone_set("Asia/Dhaka");
        $current =date("d/m/Y");
      

        $checkentry =HouseKeepingGuestEntry::where('room_id',$request->room_id)->where('is_active',1)->first();

        if($checkentry){

            if($request->no_of_pax == null){
                $checkentry->room_id=$request->room_id;
                $checkentry->no_of_pax=0;
                $checkentry->entry_date=Carbon::now();
                $checkentry->varified_by=Auth::user()->id;
                $checkentry->varified_date=$current;
                $checkentry->save();
            }else{
                $checkentry->room_id=$request->room_id;
                $checkentry->no_of_pax=$request->no_of_pax;
                $checkentry->entry_date=Carbon::now();
                $checkentry->varified_by=Auth::user()->id;
                $checkentry->varified_date=$current;
                $checkentry->save();
            }
            return response()->json([
                'message'=>'Housekeeping Guest Entry Updated Successfully!'
            ]);
        }else{
            if($request->no_of_pax == null){
                HouseKeepingGuestEntry::insert([
                    'room_id'=>$request->room_id,
                    'no_of_pax'=>null,
                    'entry_date'=>Carbon::now(),
                    'varified_by'=>Auth::user()->id,
                    'varified_date'=>$current,
                ]);
            }else{
                HouseKeepingGuestEntry::insert([
                    'room_id'=>$request->room_id,
                    'no_of_pax'=>$request->no_of_pax,
                    'entry_date'=>Carbon::now(),
                    'varified_by'=>Auth::user()->id,
                    'varified_date'=>$current,
                ]);
            }
            

            return response()->json([
                'message'=>'Housekeeping Guest Entry Created Successfully!'
            ]);
        }
        
    }

    public function guestEntryReportPage()
    {
        $rooms=Room::with('guestentry')->where('room_status',3)->where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.guest_entry.guest_entry_report',compact('rooms')); 
    }

    public function guestEntryReportAjaxData(Request $request)
    {
        
        $guestentres=HouseKeepingGuestEntry::where('room_id',$request->room_no)->where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.guest_entry.ajax.guest_entry_report_ajax',compact('guestentres'));
    }

    public function guestEntryCrossCheck()
    {

        $guestentresChecks=Room::with(['guestentrycrosscheck','checkin'])->where('room_status',3)->where('is_active',1)->where('is_deleted',0)->get();


        // $guestentresChecks=HouseKeepingGuestEntry::where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.guest_entry.cross_check',compact('guestentresChecks'));
    }

    public function guestEntryReportCheckAjaxData(Request $request)
    {
        

        $search = $request->from_date;


        // $guestentresChecks=Room::with(['guestentrycrosscheck','checkin'])->where('room_status',3)->where('is_active',1)->where('is_deleted',0)->get();

       $guestentresChecks=Room::whereHas('guestentrycrosscheck',function($q) use ($search){
            $q->where('varified_date', 'like', '%'.$search.'%');

        })->with(['guestentrycrosscheck'=>function($q) use($search){

            $q->where('varified_date', 'like', '%'.$search.'%');
        },'checkin'])->where('room_status',3)->where('is_active',1)->where('is_deleted',0)->get();
       
        return view('housekipping.guest_entry.ajax.guest_entry_report_check_ajax',compact('guestentresChecks'));
    }
}
