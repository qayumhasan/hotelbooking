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
use Session;

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

        $data=Checkin::where('id',$checkin_id)->first();

        return response()->json($data);
    }

    // kot insert
    public function kotinsert(Request $request){
        //return $request;
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
        $data=Checkin::where('id',$checkin_id)->first();
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
                'num_of_item'=>0,
                'num_of_qty'=>0,
                'date'=>$request->date,
                'total_amount'=>0,
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
               
                $kotdata=KitchenOrderDetails::where('booking_no',$request->booking_no)->where('kot_status',1)->where('billing_status',0)->get();
                
               
                $data = [
                    'kotdata'=>$kotdata,
                ];
                Session::put('kotdata',$data);
             
                $notification = array(
                    'messege' => 'success!',
                    'alert-type' => 'success'
                );
                return redirect()->route('admin.foodandbeverage.create')->with($notification);
              
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
        $data=Checkin::where('id',$checkin_id)->first();
        $alldata=KitchenOrderDetails::where('booking_no',$data->booking_no)->where('kot_status',1)->where('billing_status',0)->latest()->get();
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

    public function getkothistory($checkin_id){
        //return $checkin_id;
        $data=Checkin::where('id',$checkin_id)->first();
        $alldatadetails=KitchenOrderDetails::where('booking_no',$data->booking_no)->where('kot_status',1)->where('is_deleted',0)->latest()->get();
        $alldata=KitchenOrderHead::where('booking_no',$data->booking_no)->where('is_deleted',0)->latest()->get();
        return view('foodandbeverage.home.ajaxview.allhistory',compact('alldatadetails','alldata'));

    }

    // 
    public function billingqtyupdate(Request $request){
        $check=KitchenOrderDetails::where('id',$request->id)->first();
        $update=KitchenOrderDetails::where('id',$request->id)->update([
            'qty'=>$request->qty,
            'amount'=>$check->rate * $request->qty,
        ]);
        if($update){
            return response()->json("ok");
        }else{
            return response()->json("notok");
        }
    }


    // billing status update
    public function billingstatusupdate(Request $request){
        //return $request;
        $deleteid = $request['delid'];
        if ($deleteid) {
                $commentdelete=KitchenOrderDetails::whereIn('id',$deleteid)->get();
                foreach ($commentdelete as $key => $value) {
                    $update=KitchenOrderDetails::where('id',$value->id)->update([
                        'billing_status'=>1,
                    ]);
                }
            $alldata=KitchenOrderDetails::where('kot_status',1)->where('billing_status',0)->get();
            return view('foodandbeverage.home.ajaxview.allbilling',compact('alldata'));
            
        } else {
            $notification = array(
                'messege' => 'Nothing To Delete',
                'alert-type' => 'info'
            );
            return response()->json($notification);
        }
       
    }
    // save and print data
    public function billingstatussaveandprint(Request $request){
        //return $request;
        $deleteid = $request['delid'];
        if ($deleteid) {
                $commentdelete=KitchenOrderDetails::whereIn('id',$deleteid)->get();
                foreach ($commentdelete as $key => $value) {
                    $update=KitchenOrderDetails::where('id',$value->id)->update([
                        'billing_status'=>1,
                    ]);
                }
            //$alldata=KitchenOrderDetails::where('kot_status',1)->where('billing_status',0)->get();
            $allprint=KitchenOrderDetails::whereIn('id',$deleteid)->get();
            $booki=KitchenOrderDetails::whereIn('id',$deleteid)->first();
            $invo=uniqid().'KOT';
            return view('foodandbeverage.home.ajaxview.billinginvoice',compact('allprint','booki','invo'));
            
        } else {
            $notification = array(
                'messege' => 'Nothing To Delete',
                'alert-type' => 'info'
            );
            return response()->json($notification);
        }
       
    }
    // hitory
    public function kotsubhitorydelete(Request $request){
        $check=KitchenOrderHead::where('id',$request->item_id)->first();

        $delete=KitchenOrderHead::where('id',$request->item_id)->update([
                    'is_deleted'=>1,
                    'updated_by'=>Auth::user()->id,
                    'updated_at'=>Carbon::now()->todateTimeString(),
        ]);
        $deleteitem=KitchenOrderDetails::where('invoice_id',$check->invoice_id)->get();
            foreach($deleteitem as $val){
                KitchenOrderDetails::where('id',$val->id)->update([
                    'is_deleted'=>1,
                    'updated_by'=>Auth::user()->id,
                    'updated_at'=>Carbon::now()->todateTimeString(),
                ]);
            }

        $alldata=KitchenOrderHead::where('booking_no',$check->booking_no)->where('is_deleted',0)->latest()->get();
        $alldatadetails=KitchenOrderDetails::where('booking_no',$check->booking_no)->where('kot_status',1)->where('is_deleted',0)->latest()->get();
        return view('foodandbeverage.home.ajaxview.allhistory',compact('alldatadetails','alldata'));

    }


    // single history prrint
    public function getsinglehistoryprint($checkin_id){
        $alldata=KitchenOrderDetails::where('id',$checkin_id)->first();
        return view('foodandbeverage.home.ajaxview.singlehistoryinvoice',compact('alldata'));
    }
    public function getdoublehistoryprint($kot_id){
        // return $kot_id;
        $alldata=KitchenOrderHead::where('id',$kot_id)->first();
        $alldatadetails=KitchenOrderDetails::where('invoice_id',$alldata->invoice_id)->where('kot_status',1)->where('is_deleted',0)->latest()->get();
        return view('foodandbeverage.home.ajaxview.doublehistoryprintinvoice',compact('alldata','alldatadetails'));
    }



    public function pendingorder(){
        $alldata=KitchenOrderDetails::where('kot_status',1)->where('billing_status',0)->get();
        return view('foodandbeverage.allfoodandbravarage.pendingorder',compact('alldata'));
    }

    public function compareOrder(){
        $alldata=KitchenOrderDetails::where('kot_status',1)->where('billing_status',1)->get();
        return view('foodandbeverage.allfoodandbravarage.complate',compact('alldata'));
    }

    public function kothistoryordercom(){
        $alldata=KitchenOrderHead::where('is_deleted',0)->orderBy('id','DESC')->get();
        return view('foodandbeverage.allfoodandbravarage.kothistory',compact('alldata'));

    }
}
