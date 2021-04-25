<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\OrderHead;
use App\Models\OrderHeadDetails;
use Carbon\Carbon;
use DB;
use Auth;
use Session;

class OrderRequisitionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $alldata=OrderHead::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.orderrecusition.index',compact('alldata'));
    }
    // create
    public function create(){
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=OrderHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice_id='HT'.$year.'-'.$date.'-A-'.$orderhed->id;
        }else{
            $invoice_id='HT'.$year.'-'.$date.'-A-'.'0';
        }
       
        return view('hotelbooking.orderrecusition.create',compact('allitem','invoice_id'));
    }
    // get item
    public function getitemnew($item_name){
 
        $data = DB::table('item_entries')
            ->where('item_entries.id',$item_name)
            ->join('unit_masters', 'item_entries.unit_name', '=', 'unit_masters.id')
            ->select('item_entries.*', 'unit_masters.name')
            ->first();
          
        return response()->json($data);
    }

    public function allrecuitem($invoice){
        //return $invoice;
        return view('hotelbooking.orderrecusition.ajaxview.allitem',compact('invoice'));
    }
    // order recuinser
    public function iteminsert(Request $request){
   
       if($request->i_id == ''){
     
        $validated = $request->validate([
            'item_name' => 'required',
        ]);
        $item=ItemEntry::where('id',$request->item_name)->first();

        $itemorder=OrderHeadDetails::where('invoice_no',$request->invoice_no)->where('item_id',$item->id)->first();

        if($itemorder){
          
            $update=OrderHeadDetails::where('item_id',$itemorder->item_id)->update([
                'qty'=> $itemorder->qty + $request->qty,
               
            ]);
            if($update){
                return response()->json($update);
            }else{
                return response()->json($update);
            }

        }else{
        
            $insert=OrderHeadDetails::insert([
                'item_name'=>$item->item_name,
                'item_id'=>$item->id,
                'unit'=>$item->unit_name,
                'qty'=>$request->qty,
                'invoice_no'=>$request->invoice_no, 
                'date'=>$request->date,
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($insert){
                return response()->json($insert);
            }else{
                return response()->json($insert);
            }
        }
       }else{
     
            $validated = $request->validate([
                'item_name' => 'required',
            ]);
            $item=ItemEntry::where('id',$request->item_name)->first();
            $update=OrderHeadDetails::where('id',$request->i_id)->update([
                'item_name'=>$item->item_name,
                'item_id'=>$item->id,
                'unit'=>$request->unit,
                'qty'=>$request->qty,
                'invoice_no'=>$request->invoice_no, 
                'date'=>$request->date,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($update){
                return response()->json($update);
            }else{
                return response()->json($update);
            }
       
       }
       
       
    }

    // 
    public function ordersubmit(Request $request){
       // return $request;

        if($request->num_of_qty > 0){
                $insert=OrderHead::insert([
                    'invoice_no'=>$request->invoice_no,
                    'remarks'=>$request->remarks,
                    'num_of_qty'=>$request->num_of_qty,
                    'num_of_item'=>$request->num_of_item,
                    'date'=>$request->date,
                ]);
                if($insert){
                    
                $kotdata=OrderHeadDetails::where('invoice_no',$request->invoice_no)->get();
               
                $data = [
                    'kotdata'=>$kotdata,
                ];
                Session::put('kotdata',$data);

                    $notification=array(
                        'messege'=>'Insert Success',
                        'alert-type'=>'success'
                        );
                    return redirect()->route('admin.ordercusition.create')->with($notification);
                }else{
                    $notification=array(
                        'messege'=>'SomeThing Is Wrong',
                        'alert-type'=>'error'
                        );
                    return redirect()->back()->with($notification);
                }
        }else{
            $notification=array(
                'messege'=>'There Is no Item Found',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // item delete
    public function itemdelete(Request $request){

        $delete=OrderHeadDetails::where('id',$request->item_id)->delete();
        if($delete){
            return response($delete);
        }else{
            return response($delete);
        }

    }

    // edit order recusition
    public function orderedit(Request $request){
       $data = DB::table('order_head_details')
       ->where('order_head_details.id',$request->item_id)
       ->join('unit_masters', 'order_head_details.unit', '=', 'unit_masters.id')
       ->select('order_head_details.*', 'unit_masters.name')
       ->first();
      // dd($data);
       return response()->json($data);
    }

    public function edit($id){
        $edit=OrderHead::where('id',$id)->first();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.orderrecusition.update',compact('edit','allitem'));
    }

    // update
    public function orderupdate(Request $request){
        
        $numberofitem=OrderHeadDetails::where('invoice_no',$request->invoice_no)->count();
        $numberofqty=OrderHeadDetails::where('invoice_no',$request->invoice_no)->sum('qty');
        $update=OrderHead::where('id',$request->id)->update([

            'num_of_qty'=>$numberofqty,
            'date'=>$request->date,
            'num_of_item'=> $numberofitem,
            'remarks'=>$request->remarks,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
            
        ]);
        if($update){
            $kotnewdata=OrderHeadDetails::where('invoice_no',$request->invoice_no)->get();
               
                $data = [
                    'kotnewdata'=>$kotnewdata,
                ];
                Session::put('kotnewdata',$data);
            $notification=array(
                'messege'=>'update Success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    // delete
    public function orderdelete($id){
        $delete=OrderHead::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Delete Success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }


    // 
    public function allqtyorrequ($invoice){
        $number_of_qty=OrderHeadDetails::where('invoice_no',$invoice)->sum('qty');
        $number_of_item=OrderHeadDetails::where('invoice_no',$invoice)->count();

        return response()->json([
            'number_qty'=>$number_of_qty,
            'number_item'=>$number_of_item,
        ]);
    }


    

}
