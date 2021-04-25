<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\StockCenter;
use App\Models\StockTransferDetails;
use App\Models\StockTransferHead;
use Carbon\Carbon;
use Session;
use Auth;

class StockTransferController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // create
    public function create(){
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $purchasehead=StockTransferHead::orderBy('id','DESC')->first();
        if($purchasehead){
            $invoice_id='ST-'.$year.'-'.$date.'-I-'.$purchasehead->id;
        }else{
            $invoice_id='ST-'.$year.'-'.$date.'-I-'.'0';
        }

        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.stocktransfer.create',compact('invoice_id','allitem','allstock'));
    }
    // stock insert
    public function stockinsert(Request $request){
        if($request->i_id == ''){
            $validated = $request->validate([
                'item_name' => 'required',
            ]);
            $item=ItemEntry::where('item_name',$request->item_name)->select('id','item_name')->first();
            $itemorder=StockTransferDetails::where('invoice_no',$request->invoice_no)->where('item_id',$item->id)->first();
            if($itemorder){
                $update=StockTransferDetails::where('item_id',$itemorder->item_id)->update([
                    'qty'=> $itemorder->qty + $request->Qty,
                    'amount'=>$request->amount,
                ]);
                if($update){
                    return response()->json($update);
                }else{
                    return response()->json($update);
                }
            }else{
                $insert=StockTransferDetails::insert([
                    'item_name'=>$request->item_name,
                    'item_id'=>$item->id,
                    'unit'=>$request->unit_name,
                    'qty'=>$request->Qty,
                    'invoice_no'=>$request->invoice_no, 
                    'rate'=>$request->rate, 
                    'amount'=>$request->amount, 
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
            $update=StockTransferDetails::where('id',$request->i_id)->update([
                'item_name'=>$request->item_name,
                'item_id'=>$item->id,
                'unit'=>$request->unit_name,
                'qty'=>$request->Qty,
                'invoice_no'=>$request->invoice_no, 
                'rate'=>$request->rate, 
                'amount'=>$request->amount, 
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($update){
                return response()->json($update);
            }else{
                return response()->json($update);
            }
        }
    }

    // get stock item
    public function getstocktitem($invoice){
       return view('hotelbooking.stocktransfer.ajaxview.allitem',compact('invoice'));
    }

    // count 
    public function getstockitem($invoce){
        $numberofqty=StockTransferDetails::where('invoice_no',$invoce)->sum('qty');
        $numberofitem=StockTransferDetails::where('invoice_no',$invoce)->count();
        return response()->json([
            'numberofqty'=> $numberofqty,
            'numberofitem'=> $numberofitem,
        ]);
    }
    // 
    public function getstocktransdelete(Request $request){
        
        $delete=StockTransferDetails::where('id',$request->item_id)->delete();
        return response()->json($delete);
    }

    // edit
    public function getstocktransedit(Request $request){
        $data=StockTransferDetails::where('id',$request->item_id)->first();
        return response()->json($data);
    }
    // insert
    public function insert(Request $request){
        //return $request;
        $validated = $request->validate([
            'from_center' => 'required',
            'to_center' => 'required',
        ]);
        $check=StockTransferDetails::where('invoice_no',$request->invoice_no)->first();
        if($check){
            







            $insert=StockTransferHead::insert([
                'invoice_no'=>$request->invoice_no,
                'from_center'=>$request->from_center,
                'to_center'=>$request->to_center,
                'date'=>$request->date,
                'num_of_item'=>$request->num_of_item,
                'num_of_qty'=>$request->num_of_qty,
                'narration'=>$request->narration,
                'entry_by'=>Auth::user()->id,
                'entry_date'=>Carbon::now()->toDateTimeString(),
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($insert){
                $notification=array(
                    'messege'=>'Insert success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'messege'=>'Insert Faild',
                    'alert-type'=>'error'
                    );
                return redirect()->back()->with($notification);
            }



        }else{
            $notification=array(
                'messege'=>'Please Item Insert First',
                'alert-type'=>'info'
                );
            return redirect()->back()->with($notification);
        }
    }

    // index
    public function index(){
        $allstocktranfer=StockTransferHead::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.stocktransfer.index',compact('allstocktranfer'));
    }

    // edit
    public function edit($id){
        $edit=StockTransferHead::where('id',$id)->first();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.stocktransfer.update',compact('edit','allitem','allstock'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'from_center' => 'required',
            'to_center' => 'required',
        ]);
        $check=StockTransferDetails::where('invoice_no',$request->invoice_no)->first();
        if($check){

            $insert=StockTransferHead::where('id',$request->id)->update([
                'from_center'=>$request->from_center,
                'to_center'=>$request->to_center,
                'date'=>$request->date,
                'num_of_item'=>$request->num_of_item,
                'num_of_qty'=>$request->num_of_qty,
                'narration'=>$request->narration,
                'updated_at'=>Auth::user()->id,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($insert){
                $notification=array(
                    'messege'=>'Update success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'messege'=>'Update Faild',
                    'alert-type'=>'error'
                    );
                return redirect()->back()->with($notification);
            }



        }else{
            $notification=array(
                'messege'=>'Please Item Insert First',
                'alert-type'=>'info'
                );
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id){
        $delete=StockTransferHead::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($delete){
            $notification=array(
                'messege'=>'Delete success',
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
    public function getfromstockName($fromstock_name){
        $id=$fromstock_name;
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->where('id','!=',$id)->get();
        return response()->json($allstock);
    }
}
