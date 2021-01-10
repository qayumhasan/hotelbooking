<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\StockCenter;
use App\Models\Supplier;
use App\Models\PurchaseOrderDetails;
use App\Models\PurchaseOrderHead;
use Carbon\Carbon;
use Auth;


class PurchaseOrderController extends Controller
{
      // construct
      public function __construct(){
        $this->middleware('admin');
    }
    // create
    public function create(){
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $purchasehead=PurchaseOrderHead::orderBy('id','DESC')->first();
        if($purchasehead){
            $invoice_id='PO-'.$year.'-'.$date.'-IT-'.$purchasehead->id;
        }else{
            $invoice_id='PO-'.$year.'-'.$date.'-IT-'.'0';
        }
        

        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.purchaseorder.create',compact('invoice_id','allitem','allsupplier'));
    }
    // 
    public function purchaseorderinsert(Request $request){
        if($request->i_id == ''){
            $validated = $request->validate([
                'item_name' => 'required',
            ]);
            $item=ItemEntry::where('item_name',$request->item_name)->select('id','item_name')->first();
            $itemorder=PurchaseOrderDetails::where('invoice_no',$request->invoice_no)->where('item_id',$item->id)->first();
            if($itemorder){
                $update=PurchaseOrderDetails::where('item_id',$itemorder->item_id)->update([
                    'qty'=> $itemorder->qty + $request->Qty,
                    'amount'=>$request->amount,
                ]);
                if($update){
                    return response()->json($update);
                }else{
                    return response()->json($update);
                }
            }else{
                $insert=PurchaseOrderDetails::insert([
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
            $update=PurchaseOrderDetails::where('id',$request->i_id)->update([
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


    // get all purchase order
    public function getpurchaseorder($invoice){
        return view('hotelbooking.purchaseorder.ajaxview.allitem',compact('invoice'));
    }

    // get purchase order edit
    public function getpurchaseorderedit(Request $request){
        $data=PurchaseOrderDetails::where('id',$request->item_id)->first();
        return response()->json($data);
    }

    // delete
    public function getpurchaseorderdelete(Request $request){
        $delete=PurchaseOrderDetails::where('id',$request->item_id)->delete();
        return response()->json($delete);
    }
    // purchase order count
    public function getpurchaseordercount($invoice){
        $numberofqty=PurchaseOrderDetails::where('invoice_no',$invoice)->sum('qty');
        $numberofitem=PurchaseOrderDetails::where('invoice_no',$invoice)->count();
        return response()->json([
            'numberofqty'=> $numberofqty,
            'numberofitem'=> $numberofitem,
        ]);
    }

    // insert
    public function insert(Request $request){
        $invoice = $request->invoice_no;
        $checkpurchahead=PurchaseOrderDetails::where('invoice_no',$invoice)->first();
        if($checkpurchahead){
            $supplier_name=Supplier::where('id',$request->supplier)->select(['id','name'])->first();
            $netamount=PurchaseOrderDetails::where('invoice_no',$invoice)->sum('amount');

            $data = new PurchaseOrderHead;
            $data->invoice_no =  $invoice;
            $data->supplier_id = $request->supplier;
            if($supplier_name){
                $data->supplier_name = $supplier_name->name;
            }
          
            $data->total_amount =  $netamount;
            $data->narration =  $request->narration;
            $data->date = $request->date;
            $data->number_of_item = $request->num_of_item;
            $data->number_of_qty = $request->num_of_qty;

            $data->entry_by= Auth::user()->id;
            $data->entry_date= Carbon::now()->toDateTimeString();
            $data->created_at= Carbon::now()->toDateTimeString();

           if($data->save()){
                $notification=array(
                    'messege'=>'Purchase Order Insert Success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
           }else{
            $notification=array(
                'messege'=>'Purchase Order Insert Faild',
                'alert-type'=>'info'
                );
            return redirect()->back()->with($notification);
           }

          
        }else{
            $notification=array(
                'messege'=>'Please Add Item First',
                'alert-type'=>'info'
                );
            return redirect()->back()->with($notification);
        }
    }
    //all data
    public function index(){
        $allpurcaseorder=PurchaseOrderHead::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.purchaseorder.index',compact('allpurcaseorder'));
    }

    // purchase delete
    public function delete($id){
        $delete=PurchaseOrderHead::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_by'=>Auth::user()->id,
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Purchase Order Delete Success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
       }else{
        $notification=array(
            'messege'=>'Purchase Order Delete Faild',
            'alert-type'=>'info'
            );
        return redirect()->back()->with($notification);
       }
    }
    //edit
    public function edit($id){
        $edit=PurchaseOrderHead::where('id',$id)->first();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.purchaseorder.update',compact('edit','allitem','allsupplier'));
    }

    //update
    public function update(Request $request,$id){

        $invoice = $request->invoice_no;
        $checkpurchahead=PurchaseOrderDetails::where('invoice_no',$invoice)->first();
        if($checkpurchahead){
            $supplier_name=Supplier::where('id',$request->supplier)->select(['id','name'])->first();
            $netamount=PurchaseOrderDetails::where('invoice_no',$invoice)->sum('amount');

            $data = PurchaseOrderHead::findOrFail($id);
            $data->supplier_id = $request->supplier;
            if($supplier_name){
                $data->supplier_name = $supplier_name->name;
            }
          
            $data->total_amount =  $netamount;
            $data->narration =  $request->narration;
            $data->date = $request->date;
            $data->number_of_item = $request->num_of_item;
            $data->number_of_qty = $request->num_of_qty;

            $data->entry_by= Auth::user()->id;
            $data->entry_date= Carbon::now()->toDateTimeString();
            $data->created_at= Carbon::now()->toDateTimeString();

           if($data->save()){
                $notification=array(
                    'messege'=>'Purchase Order Update Success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
           }else{
            $notification=array(
                'messege'=>'Purchase Order Update Faild',
                'alert-type'=>'info'
                );
            return redirect()->back()->with($notification);
           }

          
        }else{
            $notification=array(
                'messege'=>'Please Add Item First',
                'alert-type'=>'info'
                );
            return redirect()->back()->with($notification);
        }
    } 

}
