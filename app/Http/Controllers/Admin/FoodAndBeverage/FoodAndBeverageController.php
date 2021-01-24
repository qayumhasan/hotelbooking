<?php

namespace App\Http\Controllers\Admin\FoodAndBeverage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Employee;
use App\Models\ItemEntry;
use App\Models\Checkin;
use App\Models\KitchenOrderDetails;
use App\Models\KitchenOrderHead;
use DB;
use Carbon\Carbon;
use Auth;

class FoodAndBeverageController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // food
    public function index(){
        $rooms = Room::where('room_status',3)->orderby('id','DESC')->get();
        $allwaiter=Employee::get();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get(); 

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $purchasehead=KitchenOrderHead::orderBy('id','DESC')->first();
        if($purchasehead){
            $invoice_id='KOT-'.$year.'-'.$date.'-B-'.$purchasehead->id;
        }else{
            $invoice_id='KOT-'.$year.'-'.$date.'-B-'.'0';
        }
       
        
        return view('foodandbeverage.home.index',compact('rooms','allwaiter','allitem','invoice_id'));
    }
    // 
    public function getcheckindata($checkin_id){

        $data=Checkin::where('room_id',$checkin_id)->first();

        return response()->json($data);
    }

    // kot insert
    public function kotinsert(Request $request){
       // return $request;
        if($request->i_id == ''){
            $validated = $request->validate([
                'waitername' => 'required',
                'itemname' => 'required',
            
            ]);
            $waiter_name=Employee::where('id',$request->waitername)->select(['employee_name'])->first();
            $item=ItemEntry::where('item_name',$request->itemname)->select(['id','rate'])->first();

            $check=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('item_id',$item->id)->where('kot_status',0)->first();
            if($check){
                $update=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('item_id',$item->id)->where('kot_status',0)->update([
                    'qty'=>$request->qty + $check->qty,
                    'waiter_id'=>$request->waitername,
                    'waiter_name'=>$waiter_name->employee_name,
                    'amount'=> $item->rate * ($request->qty + $check->qty),
                ]);
                if($update){
                    $alldata=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->latest()->get();
                    return view('foodandbeverage.home.ajaxview.alldata',compact('alldata'));
                }

            }else{
            $data = new KitchenOrderDetails;
            $data->booking_no=$request->booking_no;
            $data->kot_date=$request->date;
            $data->guest_name=$request->guest_name;
            $data->room_no=$request->room_no;
            $data->kot_timehour=$request->timehour;
            $data->kot_timemin=$request->timemin;
            $data->waiter_id=$request->waitername;
            $data->qty=$request->qty;
            $data->waiter_name=$waiter_name->employee_name;
            $data->item_id=$item->id;
            $data->item_name=$request->itemname;
            $data->rate=$item->rate;
            $data->amount = $request->qty * $item->rate ;
            $data->created_at=Carbon::now()->todateTimeString();
        
        
            if($data->save()){
                $alldata=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->latest()->get();
                return view('foodandbeverage.home.ajaxview.alldata',compact('alldata'));
            }
        
            }
        }else{
            $waiter_name=Employee::where('id',$request->waitername)->select(['employee_name'])->first();
            $item=ItemEntry::where('item_name',$request->itemname)->select(['id','rate'])->first();

            $update=KitchenOrderDetails::where('id',$request->i_id)->update([
                    'kot_date'=>$request->date,
                    'kot_timehour'=>$request->timehour,
                    'kot_timemin'=>$request->timemin,
                    'item_id'=>$item->id,
                    'item_name'=>$request->itemname,
                    'qty'=>$request->qty,
                    'amount'=>$request->qty * $item->rate,
                ]);
            if($update){
                $alldata=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->latest()->get();
                return view('foodandbeverage.home.ajaxview.alldata',compact('alldata'));
            }


        }
            

    }

    // get all kot
    

    // 
    public function getkotdetails($checkin_id){
        //return $checkin_id;
        $data=Checkin::where('room_id',$checkin_id)->first();
       //dd($data->booking_no);
        $alldata=KitchenOrderDetails::where('booking_no',$data->booking_no)->where('kot_status',0)->latest()->get();
       // dd($alldata);
        return view('foodandbeverage.home.ajaxview.alldata',compact('alldata'));
    }

    public function getkotinsertdata($booking_no){
        
        $alldata=KitchenOrderDetails::where('booking_no',$booking_no)->where('kot_status',0)->latest()->get();
         return view('foodandbeverage.home.ajaxview.alldata',compact('alldata'));
    }

    public function getkotedit(Request $request){
       // return $request;
        $data=KitchenOrderDetails::where('id',$request->item_id)->first();
        return response()->json($data);
    }


    // 
    public function getkotdelete(Request $request){
        $check=KitchenOrderDetails::where('id',$request->item_id)->first();
        $delete=KitchenOrderDetails::where('id',$request->item_id)->delete();
        $alldata=KitchenOrderDetails::where('booking_no', $check->booking_no)->where('kot_status',0)->latest()->get();
        return view('foodandbeverage.home.ajaxview.alldata',compact('alldata'));
    }

    // final insert
    public function finalinsert(Request $request){

        $check=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->first();
        if($check){
            $numberofitem=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->count();
            $numberofqty=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->sum('qty');
            $totalamount=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->sum('amount');

            $insert=KitchenOrderHead::insert([
                'room_no'=>$request->room_no,
                'booking_no'=>$request->booking_no,
                'guest_name'=>$request->guest_name,
                'invoice_id'=>$request->invoice_id,
                'num_of_item'=>$numberofitem,
                'num_of_qty'=>$numberofqty,
                'date'=>$request->date,
                'total_amount'=>$totalamount,
                'entry_by'=>Auth::user()->id,
                'created_at'=>Carbon::now()->todateTimeString(),
            ]);
            $update=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',0)->get();
            foreach($update as $data){
                $val=KitchenOrderDetails::where('id',$data->id)->update([
                    'kot_status'=>1,
                    'invoice_id'=>$request->invoice_id,
                ]);
            }
            if($insert){
                $notification = array(
                    'messege' => 'success!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
            
                $notification = array(
                    'messege' => 'faild!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

        }else{
            
            $notification = array(
                'messege' => 'No Item Selected!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
       

    }


    // billing get data
    public function getkotdataall($checkin_id){
        $data=Checkin::where('room_id',$checkin_id)->first();
        $alldata=KitchenOrderDetails::where('booking_no',$data->booking_no)->where('kot_status',1)->latest()->get();
        return view('foodandbeverage.home.ajaxview.allbilling',compact('alldata'));
       
    }

    //billing section delete
    public function kotsubdelete(Request $request){
        $check=KitchenOrderDetails::where('id',$request->item_id)->first();
        $kotall=KitchenOrderHead::where('invoice_id',$check->invoice_id)->first();
        $update=KitchenOrderHead::where('invoice_id',$check->invoice_id)->update([
            'num_of_item'=>$kotall->num_of_item - 1,
            'num_of_qty'=>$kotall->num_of_qty - $check->qty,
        ]);
        $delete=KitchenOrderDetails::where('id',$request->item_id)->delete();

        $alldata=KitchenOrderDetails::where('booking_no', $check->booking_no)->where('kot_status',1)->latest()->get();
        return view('foodandbeverage.home.ajaxview.allbilling',compact('alldata'));

    } 

}
