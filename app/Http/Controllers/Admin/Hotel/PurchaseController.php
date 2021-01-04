<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseHead;
use App\Models\Purchase;
use App\Models\StockCenter;
use App\Models\Supplier;
use App\Models\OrderHead;
use App\Models\ItemEntry;
use App\Models\TaxSetting;
use Carbon\Carbon;
use Session;

class PurchaseController extends Controller
{
     // construct
     public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $room=Room::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.roomsetup.index',compact('room'));
    }
    // create
    public function create(){
       
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $purchasehead=Purchase::orderBy('id','DESC')->first();
        if($purchasehead){
            $invoice_id='PI-'.$year.'-'.$date.'-B-'.$purchasehead->id;
        }else{
            $invoice_id='PI-'.$year.'-'.$date.'-B-'.'0';
        }
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allorderhead=OrderHead::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltax=TaxSetting::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.purchase.create',compact('invoice_id','allstock','allsupplier','allorderhead','alltax'));
    }

    //
    public function itempurchase(Request $request){
        //return $request;
        if($request->i_id == ''){
            $validated = $request->validate([
                'item_name' => 'required',
            ]);
            $item=ItemEntry::where('item_name',$request->item_name)->select('id','item_name')->first();
            $itemorder=PurchaseHead::where('invoice_no',$request->invoice_no)->where('item_id',$item->id)->first();
            if($itemorder){
                $update=PurchaseHead::where('item_id',$itemorder->item_id)->update([
                    'qty'=> $itemorder->qty + $request->qty,
                    'amount'=>$request->amount,
                ]);
                if($update){
                    return response()->json($update);
                }else{
                    return response()->json($update);
                }
            }else{
                $insert=PurchaseHead::insert([
                    'item_name'=>$request->item_name,
                    'item_id'=>$item->id,
                    'unit'=>$request->unit_name,
                    'qty'=>$request->qty,
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
            $update=PurchaseHead::where('id',$request->i_id)->update([
                'item_name'=>$request->item_name,
                'item_id'=>$item->id,
                'unit'=>$request->unit_name,
                'qty'=>$request->qty,
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

    public function allitemdata($invoice){
        return view('hotelbooking.purchase.ajaxview.allitem',compact('invoice'));
    }

    // item purchese delete
    public function itempurchasedelete(Request $request){
       // return $request;
       $delete=PurchaseHead::where('id',$request->item_id)->delete();
       return response($delete);
    }

    public function purchaseedit(Request $request){
        $data =PurchaseHead::where('id',$request->item_id)->first();
       // dd($data);
        return response()->json($data);
     }

    //  get tax 
    public function gettax($tax){

        $data=TaxSetting::where('id',$tax)->first();
        $purchasehead=Purchase::orderBy('id','DESC')->first();
        if($purchasehead){
            $year= Carbon::now()->format('Y');
            $date= Carbon::now()->format('d');
            $invoice_id='PI-'.$year.'-'.$date.'-B-'.$purchasehead->id;
        }else{
            $year= Carbon::now()->format('Y');
            $date= Carbon::now()->format('d');
            $invoice_id='PI-'.$year.'-'.$date.'-B-'.'0';
        }
        $allamount=PurchaseHead::where('invoice_no',$invoice_id)->sum('amount');
        if($data->base_on == "amount"){
            $tax_amount= $data->amount;

        }elseif($data->base_on == "percentage"){

            $tax_amount= $allamount * $data->rate/100;
        }
        

        return response()->json([
            'data'=>$data,
            'amount'=>$tax_amount,
        ]);
    }



    // insert
    public function taxinsert(Request $request){
        return $request;
    }
}
