<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\OrderHead;
use App\Models\OrderHeadDetails;
use Carbon\Carbon;
use DB;

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
    public function getitem($item_name){
       // $data=ItemEntry::where('item_name',$item_name)->first();

        $data = DB::table('item_entries')
            ->where('item_name',$item_name)
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
        //return $request;
        $validated = $request->validate([
            'item_name' => 'required',
        ]);
        $item=ItemEntry::where('item_name',$request->item_name)->first();

        $itemorder=OrderHeadDetails::where('invoice_no',$request->invoice_no)->where('item_id',$item->id)->first();

        if($itemorder){
          // return "ok ase";
            $update=OrderHeadDetails::where('item_id',$itemorder->item_id)->update([
                'qty'=> $itemorder->qty + $request->qty,
            ]);
            if($update){
                return response()->json($update);
            }else{
                return response()->json($update);
            }

        }else{
          // return "nai";
            $insert=OrderHeadDetails::insert([
                'item_name'=>$request->item_name,
                'item_id'=>$item->id,
                'unit'=>$request->unit,
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
       
    }

    // 
    public function ordersubmit(Request $request){
        
        if($request->num_of_qty > 0){
                $insert=OrderHead::insert([
                    'invoice_no'=>$request->invoice_no,
                    'remarks'=>$request->remarks,
                    'num_of_qty'=>$request->num_of_qty,
                    'num_of_item'=>$request->num_of_item,
                    'date'=>Carbon::now()->toDateTimeString(),
                ]);
                if($insert){
                    $notification=array(
                        'messege'=>'Insert Success',
                        'alert-type'=>'success'
                        );
                    return redirect()->back()->with($notification);
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
      
        // $orderhed=OrderHead::orderBy('id','DESC')->first();
        // if($orderhed){
        //     $year= Carbon::now()->format('Y');
        //     $date= Carbon::now()->format('d');
        //     $invoice_id='HT'.$year.'-'.$date.'-A-'.$orderhed->id;
        // }else{
        //     $year= Carbon::now()->format('Y');
        //     $date= Carbon::now()->format('d');
        //     $invoice_id='HT'.$year.'-'.$date.'-A-'.'0';
        // }

        $delete=OrderHeadDetails::where('id',$request->item_id)->delete();
        if($delete){
            return response($delete);
        }else{
            return response($delete);
        }

    }
    

}
