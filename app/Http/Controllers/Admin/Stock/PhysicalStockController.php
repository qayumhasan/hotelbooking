<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItemEntry;
use App\Models\StockCenter;
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
            $invoice_id='Py-'.$year.'-'.$date.'-S-'.$physicalstock->id;
        }else{
            $invoice_id='Py-'.$year.'-'.$date.'-S-'.'0';
        }
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        return view('stock.physicalstock.create',compact('allitem','invoice_id','allstock'));
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
       //return $request;
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
            $item=ItemEntry::where('item_name',$request->itemname)->first();
            $update=PhysicalStockDetails::where('id',$request->i_id)->update([
         
                    'item_name'=>$request->itemname,
                    'item_id'=>$item->id,
                    'unit_id'=>$request->unit_id,
                    'unit_name'=>$request->unit_name,
                    'qty'=>$request->qty,
                    'invoice_no'=>$request->invoice_no, 
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                    'updated_by'=>auth::user()->id,
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
    // edit
    public function getallphysicalitemedit(Request $request){
        //return $request->item_id;
        $data=PhysicalStockDetails::where('id',$request->item_id)->first();
        return response()->json($data);
    }
    //physical item qty
    public function getallphysicalitemeqty($invoice_no) {
        $total_qty=PhysicalStockDetails::where('invoice_no',$invoice_no)->sum('qty');
        $total_item=PhysicalStockDetails::where('invoice_no',$invoice_no)->count('item_id');
        //dd($total_qty);
        return response()->json([
            'total_qty'=>$total_qty,
            'total_item'=>$total_item,
        ]);
    }

    // physical store 
    public function physicalstore(Request $request){
       // return $request;
        $validated = $request->validate([
            'stock_center' => 'required',
        ]);
        $invoice_no=$request->invoice_no;
        $check=PhysicalStockDetails::where('invoice_no',$invoice_no)->first();
        if( $check){
            $insert=PhysicalStockHead::insert([
                'stock_center'=>$request->stock_center,
                'date'=>$request->date,
                'invoice_no'=>$request->invoice_no,
                'num_of_qty'=>$request->num_of_qty,
                'num_of_item'=>$request->num_of_item,
                'narration'=>$request->narration,
                'is_active'=>$request->is_active,
                'entry_date'=>Carbon::now()->toDateTimeString(),
                'entry_by'=>Auth::user()->id,
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($insert){
                $notification = array(
                    'messege' => 'Inserted Success!',
                    'alert-type' =>'success'
                    );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'messege' => 'SomeThing Wrong! please try Again',
                    'alert-type' =>'error'
                    );
                return redirect()->back()->with($notification);
            }


        }else{
            $notification = array(
                'messege' => 'There Is No Item Inserted!',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    // all data
    public function allphysicalstore(){
       // $alldata=PhysicalStockHead::where('is_deleted',0)->orderBy('id','DESC')->get();
        $alldata = DB::table('physical_stock_heads')
            ->join('stock_centers', 'physical_stock_heads.stock_center', '=', 'stock_centers.id')
            ->select('physical_stock_heads.*', 'stock_centers.name')
            ->where('physical_stock_heads.is_deleted',0)
            ->get();
        return view('stock.physicalstock.index',compact('alldata'));
    }

     // active
     public function active($id){
        $active=PhysicalStockHead::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'PhysicalStockHead Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'PhysicalStockHead Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=PhysicalStockHead::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'PhysicalStockHead DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'PhysicalStockHead DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=PhysicalStockHead::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'PhysicalStockHead Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'PhysicalStockHead Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        // return $id;
        $edit=PhysicalStockHead::where('id',$id)->first();
       
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->orderBy('id','DESC')->get();
        return view('stock.physicalstock.update',compact('edit','allitem','allstock'));
    }
    //update
    public function update(Request $request){
        $validated = $request->validate([
            'stock_center' => 'required',
        ]);
        $invoice_no=$request->invoice_no;
        $check=PhysicalStockDetails::where('invoice_no',$invoice_no)->first();
        if( $check){
            $insert=PhysicalStockHead::where('id',$request->id)->update([
                'stock_center'=>$request->stock_center,
                'date'=>$request->date,
                'num_of_qty'=>$request->num_of_qty,
                'num_of_item'=>$request->num_of_item,
                'narration'=>$request->narration,
                'is_active'=>$request->is_active,
                'updated_date'=>Carbon::now()->toDateTimeString(),
                'updated_by'=>Auth::user()->id,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($insert){
                $notification = array(
                    'messege' => 'Updated Success!',
                    'alert-type' =>'success'
                    );
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'messege' => 'SomeThing Wrong! please try Again',
                    'alert-type' =>'error'
                    );
                return redirect()->back()->with($notification);
            }


        }else{
            $notification = array(
                'messege' => 'There Is No Item Inserted!',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
