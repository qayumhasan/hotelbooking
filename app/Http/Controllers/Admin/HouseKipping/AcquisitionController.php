<?php

namespace App\Http\Controllers\Admin\Housekipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\OrderHead;
use App\Models\OrderHeadDetails;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AcquisitionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $alldata=OrderHead::where('is_deleted',0)->latest()->get();
        return view('housekipping.acquisition.index',compact('alldata'));
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
       
        return view('housekipping.acquisition.create',compact('allitem','invoice_id'));
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
        return view('housekipping.acquisition.ajaxview.allitem',compact('invoice'));
    }
    // order recuinser
    public function iteminsert(Request $request){
        //return $request;
       if($request->i_id == ''){
           $validated = $request->validate([
            'item_name' => 'required',
        ]);
        $item=ItemEntry::where('item_name',$request->item_name)->first();

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
       }else{

            $validated = $request->validate([
                'item_name' => 'required',
            ]);
            $item=ItemEntry::where('item_name',$request->item_name)->first();
            $update=OrderHeadDetails::where('id',$request->i_id)->update([
                'item_name'=>$request->item_name,
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
        
        if($request->num_of_qty > 0){
                $insert=OrderHead::insert([
                    'invoice_no'=>$request->invoice_no,
                    'remarks'=>$request->remarks,
                    'num_of_qty'=>$request->num_of_qty,
                    'num_of_item'=>$request->num_of_item,
                    'date'=>Carbon::now()->toDateTimeString(),
                    'entry_by'=>auth()->user()->id,
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
        return view('housekipping.acquisition.update',compact('edit','allitem'));
    }

    // update
    public function orderupdate(Request $request){
        $update=OrderHead::where('id',$request->id)->update([
            'num_of_qty'=>$request->num_of_qty,
            'date'=>$request->date,
            'num_of_item'=>$request->num_of_item,
            'remarks'=>$request->remarks,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
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

    public function acquistionStatus($id)
    {
        $status = OrderHead::findOrFail($id);
        if($status->is_active == 0){
            $status->is_active =1;
            $status->save();
            $notification=array(
                'messege'=>'Order Pending Success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $status->is_active =0;
            $status->save();
            $notification=array(
                'messege'=>'Order Close Success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }
    }


    public function pendingOrderList()
    {
        $alldata=OrderHead::with(['items','user'])->where('is_active',1)->where('is_deleted',0)->latest()->get();
        return view('housekipping.acquisition.pending',compact('alldata'));
    }
    public function closeOrderList()
    {
        $alldata=OrderHead::with(['items','user'])->where('is_active',0)->where('is_deleted',0)->latest()->get();
        return view('housekipping.acquisition.close_order',compact('alldata'));
    }
}
