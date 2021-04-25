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
use App\Models\TaxCalculation;
use App\Models\MenuCategory;
use App\Models\UnitMaster;
use Carbon\Carbon;
use Session;
use Auth;

class PurchaseController extends Controller
{
     // construct
     public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $allpurchase=Purchase::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.purchase.index',compact('allpurchase'));
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
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $order_no=$year.'-'.rand(333,6669);
        $category=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $unit=UnitMaster::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.purchase.create',compact('invoice_id','allstock','allsupplier','allorderhead','alltax','order_no','allitem','category','unit'));
    }
    // purchase insert
    public function insert(Request $request){
        $validated = $request->validate([
            'supplier' => 'required',
            'stock_center' => 'required',
        ]);

        $invoice = $request->invoice_no;
        $checkpurchahead=PurchaseHead::where('invoice_no',$invoice)->first();
        if($checkpurchahead){
            $netamount=PurchaseHead::where('invoice_no',$invoice)->sum('amount');
            $data = new Purchase;
            $data->invoice_no =  $invoice;
            $data->order_no =  $request->order_no;
            $data->ref_invoice_no = $request->ref_invoice;
            $data->supplier_id = $request->supplier;
            $supplier_name=Supplier::where('id',$request->supplier)->select(['id','name'])->first();
            if($supplier_name){
                $data->supplier_name = $supplier_name->name;
            }
            $data->stock_center =  $request->stock_center;
            $data->total_amount =  $request->totalamount;
            $data->narration =  $request->narration;
            $data->payment =  $request->paidamount;
            $data->due =  $request->dueamount;
            $data->gross_amount =  $netamount;
            $data->net_amount =  $request->totalamount;
            $data->date = $request->tax_date;

            $data->entry_by= Auth::user()->id;
            $data->entry_date= Carbon::now()->toDateTimeString();
            $data->created_at= Carbon::now()->toDateTimeString();

           if($data->save()){

            $purchasedata=PurchaseHead::where('invoice_no',$request->invoice_no)->get();
           
               
            $datanew = [
                'purchasedata'=>$purchasedata,
            ];
            Session::put('purchasedata',$datanew);

                $notification=array(
                    'messege'=>'Purchase Insert Success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
           }else{
            $notification=array(
                'messege'=>'Purchase Insert Faild',
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
    // update
    public function update(Request $request,$id){
        $supplier_name=Supplier::where('id',$request->supplier)->select(['id','name'])->first();
        $netamount=PurchaseHead::where('invoice_no',$request->invoice_no)->sum('amount');
        $data = Purchase::findOrFail($id);
        $data->order_no =  $request->order_no;
        $data->ref_invoice_no = $request->ref_invoice;
        $data->supplier_id = $request->supplier;
        if($supplier_name){
            $data->supplier_name = $supplier_name->name;
        }
        $data->stock_center =  $request->stock_center;
        $data->total_amount =  $request->totalamount;
        $data->narration =  $request->narration;
        $data->payment =  $request->paidamount;
        $data->due =  $request->dueamount;
        $data->net_amount =  $netamount;
        $data->date = $request->tax_date;

        $data->updated_by= Auth::user()->id;
        $data->updated_date= Carbon::now()->toDateTimeString();
        $data->updated_at= Carbon::now()->toDateTimeString();

       if($data->save()){
            $notification=array(
                'messege'=>'Purchase update Success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
       }else{
        $notification=array(
            'messege'=>'Purchase update Faild',
            'alert-type'=>'info'
            );
        return redirect()->back()->with($notification);
       }

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
                    'qty'=> $itemorder->qty + $request->Qty,
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
            $update=PurchaseHead::where('id',$request->i_id)->update([
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
        //return $request;
        if($request->taxupdate_id == ''){
            $invoice = $request->invoice_no;
            $check =PurchaseHead::where('invoice_no',$invoice)->first();
            if($check){
                $validated = $request->validate([
                    'tax_id' => 'required',
                ]);
                $taxeffect=TaxSetting::where('id',$request->tax_id)->first();
            
                $insert=TaxCalculation::insert([
                    'ref_invoice'=>$invoice,
                    'tax_descripton'=>$request->tax_id,
                    'calculation'=>$request->calculation_on,
                    'based_on'=>$request->based_on,
                    'rate'=>$request->taxrate,
                    'amount'=>$request->tax_amount,
                    'effect'=>$taxeffect->effect,
                    'entry_by'=>Auth::user()->id,
                    'entry_date'=>Carbon::now()->toDateTimeString(),
                    'created_at'=>Carbon::now()->toDateTimeString(),
                ]);
                if($insert){
                    return response($insert);
                }

            }else{
                return "nae";
            }
        }else{

            $invoice = $request->invoice_no;
            $check =PurchaseHead::where('invoice_no',$invoice)->first();
            if($check){
                $validated = $request->validate([
                    'tax_id' => 'required',
                ]);
                $taxeffect=TaxSetting::where('id',$request->tax_id)->first();
            
                $insert=TaxCalculation::where('id',$request->taxupdate_id)->update([
                    'ref_invoice'=>$invoice,
                    'tax_descripton'=>$request->tax_id,
                    'calculation'=>$request->calculation_on,
                    'based_on'=>$request->based_on,
                    'rate'=>$request->taxrate,
                    'amount'=>$request->tax_amount,
                    'effect'=>$taxeffect->effect,
                    'updated_by'=>Auth::user()->id,
                    'updated_date'=>Carbon::now()->toDateTimeString(),
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                ]);
                if($insert){
                    return response($insert);
                }

            }else{
                return "nae";
            }
        }
            
        
    }

    // tax item new
    public function alltaxinclude($invoice){
        $alltax=TaxCalculation::where('ref_invoice',$invoice)->get();
        $amount=PurchaseHead::where('invoice_no',$invoice)->sum('amount');

        return view('hotelbooking.purchase.ajaxview.taxitem',compact('invoice','alltax','amount'));
    }

    // 
    public function taxdatadelete(Request $request){
        $alltax=TaxCalculation::where('id',$request->tax_id)->delete();
        return response($alltax);
    }
    // get total amount
    public function gettotalamount($invoice){
        $totalamount=PurchaseHead::where('invoice_no',$invoice)->sum('amount');
        $taxtamount=TaxCalculation::where('ref_invoice',$invoice)->get();
        $mainamount= $totalamount;
        foreach($taxtamount as $tax){
            if($tax->effect=='Add'){
                $mainamount=$mainamount + $tax->amount ;
            }elseif($tax->effect=='Deduct'){
                $mainamount=$mainamount - $tax->amount ;
            }
        }
        return response()->json([
            'data'=>$mainamount,
        ]);
       
        //return view('hotelbooking.purchase.ajaxview.totalamount',compact('totalamount','taxtamount','mainamount'));
    }
//edit
    public function edit($id){
       // return $id;
        $edit=Purchase::where('id',$id)->first();
        //dd($edit);
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allorderhead=OrderHead::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltax=TaxSetting::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        
        return view('hotelbooking.purchase.update',compact('edit','allstock','allsupplier','allorderhead','alltax','allitem'));
    }

    public function delete($id){
        $delete=Purchase::where('id',$id)->update([
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
    // tax edit
    public function taxedit(Request $request){
        $data=TaxCalculation::where('id',$request->item_id)->first();
        return response()->json($data);
    }

    // supllir
    public function supllymodalinsert(Request $request){
        
        $validated = $request->validate([
            'title' => 'required',
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $insert=Supplier::insertGetId([
            'title'=>$request->title,
            'name'=>$request->name,
            'print_name'=>$request->print_name,
            'designation'=>$request->designation,
            'tin_vat_no'=>$request->tin_vat_no,
            'addressline_one'=>$request->addressline_one,
            'addressline_two'=>$request->addressline_two,
            'city'=>$request->city,
            'zip_code'=>$request->zip_code,
            'telephone'=>$request->telephone,
            'contact_persion'=>$request->contact_persion,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'is_active'=>$request->is_active,

            'account_head'=>'Accounts Payable - Purchase',
            'account_code'=>'212-28-0040-10132',

            'date'=>$request->date,
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        $update=Supplier::where('id',$insert)->update([
            'supplier_id'=>'supplier-'.$insert,
        ]);

        if($insert){
            $data="success";
            return response()->json($data);
        }else{
            return response()->json(['query' => $validated->query()]);
        }
    }

// get all supplier
    public function getallsupplier(Request $request){
        //return "ok";
        $data=Supplier::where('is_active',1)->where('is_deleted',0)->select(['name','id'])->get();
       // dd($data);
        return response()->json($data);
    }

    // item insert data
    public function itemajxinsert(Request $request){
        //return $request;
        $validated = $request->validate([
            'item_name' => 'required|unique:item_entries|max:50',
        ]);
        $insert=ItemEntry::insertGetId([
            'item_name'=>$request->item_name,
            'short_name'=>$request->short_name,
            'category_name'=>$request->category_name,
            'unit_name'=>$request->unit_name,
            'rate'=>$request->rate,
            'min_level'=>$request->min_level,
            'menu_item'=>$request->menu_type,
            'is_active'=>$request->is_active,
            'is_stock' => $request->direct_stock,
            'is_vat' => $request->add_vat,
            'date'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $data="success";
            return response()->json($data);
        }else{
            $data="faild";
            return response()->json($data);
        }
    }

    // 
    public function getallpurchaseitem(Request $request){
        //return "ok";
        $data=ItemEntry::where('is_active',1)->where('is_deleted',0)->get();
        //dd($data);
         return response()->json($data);
    }

}
