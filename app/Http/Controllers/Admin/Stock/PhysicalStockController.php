<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\PhysicalStockHead;
use App\Models\PhysicalStockDetails;
use DB;
use Carbon\Carbon;
use Auth;

class PhysicalStockController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function dashboard(){
        return view('stock.home.index');
    }

    public function create(){
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $physicalstock=PhysicalStockHead::orderBy('id','DESC')->first();
        if($physicalstock){
            $invoice_id='Py-'.$year.'-'.$date.'-S-'.$purchasehead->id;
        }else{
            $invoice_id='Py-'.$year.'-'.$date.'-S-'.'0';
        }
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        return view('stock.physicalstock.create',compact('allitem','invoice_id'));
    }
    // get physical
    public function getphysicalitem($item_name){
        //return $item_name;
        $data = DB::table('item_entries')
        ->where('item_name',$item_name)
        ->join('unit_masters', 'item_entries.unit_name', '=', 'unit_masters.id')
        ->select('item_entries.*', 'unit_masters.name')
        ->first();
        return response()->json($data);
    }
// physical details insert
    public function physicaldetailsinsert(Request $request){
      // return $request;
        if($request->i_id == ''){
            $validated = $request->validate([
                'itemname' => 'required',
            ]);
            $item=ItemEntry::where('item_name',$request->itemname)->select('id','item_name')->first();
            $itemorder=PhysicalStockDetails::where('invoice_no',$request->invoice_no)->where('item_id',$item->id)->first();
            if($itemorder){
                $update=PhysicalStockDetails::where('item_id',$itemorder->item_id)->update([
                    'qty'=> $itemorder->qty + $request->qty,
                ]);
                if($update){
                    return response()->json($update);
                }else{
                    return response()->json($update);
                }
            }else{

                $insert=PhysicalStockDetails::insert([
                    'item_name'=>$request->itemname,
                    'item_id'=>$item->id,
                    'unit_id'=>$request->unit_id,
                    'unit_name'=>$request->unit_name,
                    'qty'=>$request->qty,
                    'invoice_no'=>$request->invoice_no, 
                    'created_at'=>Carbon::now()->toDateTimeString(),
                    'entry_by'=>auth::user()->id,
                ]);
                if($insert){
                    return response()->json($insert);
                }else{
                    return response()->json($insert);
                }
            }
        }else{
            $validated = $request->validate([
                'itemname' => 'required',
            ]);
            $item=ItemEntry::where('item_name',$request->item_name)->first();
            $update=PhysicalStockDetails::where('id',$request->i_id)->update([
         
                    'item_name'=>$request->itemname,
                    'item_id'=>$item->id,
                    'unit_id'=>$request->unit_id,
                    'unit_name'=>$request->unit_name,
                    'qty'=>$request->qty,
                    'invoice_no'=>$request->invoice_no, 
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                    'entry_by'=>auth::user()->id,
                ]);
            
            if($update){
                return response()->json($update);
            }else{
                return response()->json($update);
            }
        }
    }

    // get all physical stock item
    public function getallphysicalitem($invoice_no){
       $allitem=PhysicalStockDetails::where('invoice_no',$invoice_no)->orderBy('id','DESC')->get();
       return view("stock.physicalstock.ajaxview.allitem",compact('allitem'));
    }

    // 
    public function getallphysicalitemdelete(Request $request){
       // return $request;
        $delete=PhysicalStockDetails::where('id',$request->item_id)->delete();
        return response()->json($delete);
    }
}
