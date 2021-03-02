<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkin;
use App\Models\Room;
use Session;
use Auth;
use Carbon\Carbon;



class HotelServiceController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function SingleCheckoutGroupbooking($id){

        $checkin = Checkin::findOrFail($id);
        return view('hotelbooking.checking.services.checkoutgroupbooking.singlecheckout',compact('checkin'));

    }
    public function SingleCheckoutRequest(Request $request){
       
        $validated = $request->validate([
            'room_id' => 'required',
        ]);
        $check=Checkin::where('booking_no',$request->booking_no)->where('room_id',$request->room_id)->first();
        $update=Checkin::where('id',$check->id)->update([
            'is_active'=>1,
            'is_occupy'=>0,
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
}
