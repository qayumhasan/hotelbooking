<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Models\AccountMainCategory;
use App\Models\AccountSubCategoryOne;
use App\Models\AccountSubCategoryTwo;
use App\Models\ChartOfAccount;
use App\Models\AccountTransectionDetails;
use App\Models\AccountTransectionHead;
use Carbon\Carbon;
use Session;
use Auth;





class AccountTrasectionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // 
    public function index(){
        $alldata=AccountTransectionHead::where('is_deleted',0)->orderBy('id','DESC')->get();
        return view('accounts.accounttransection.index',compact('alldata'));
    }
    // 

    public function create(){
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0';
        }
        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();
        return view('accounts.accounttransection.create',compact('allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice'));
    }
    // get ajax account
    public function getaccount($cate_id){
        $data=AccountMainCategory::where('category_id',$cate_id)->orderBy('id','DESC')->get();
        return response()->json($data);
    }
    // 
    public function getsubcateone($accountid){
    
        $data=AccountSubCategoryOne::where('maincategory_id',$accountid)->get();
        return response()->json($data);

    }
    public function getsubcatetwo($subcateone_id){
        return $subcateone_id;
    }

    // transection details insert
    public function transectiondetailsinsert(Request $request){
         //return $request;


       if($request->accounttransecti_id == ''){
           //return "faka";
        $validated = $request->validate([
            'account_head' => 'required',
        ]);
        $rand_id=rand(666,1999);
        $data = new AccountTransectionDetails;
        $data->account_head_details = $request->account_head;
        $data->voucher_no = $request->invoice;
        $data->date = $request->date;
        $data->rand_id = $rand_id;
        $data->location = $request->location;
        $data->price = $request->price;
        $data->qty = $request->qty;
        $data->remarks = $request->remarks;
        $data->hiddeninvoice = $request->hiddeninvoice;

        if($request->subcategory_codeone=='NULL'){
            $data->subcategory_codeone = $request->acchead_subcate_codeone;
        }else{
            $data->subcategory_codeone = $request->subcategory_codeone;
        }
        if($request->subcategory_codetwo=='NULL'){
            $data->subcategory_codetwo = $request->acchead_subcate_codetwo;
        }else{
            $data->subcategory_codetwo = $request->subcategory_codetwo;
        }
        $data->category_code = $request->acchead_cate_code;
        $data->Accountcategory_code = $request->acchead_Accountcate_code;
        
        
        
        if($request->amount_cate == "Debit"){
            $data->dr_amount = $request->amount;
            $data->cr_amount = NULL;
        }elseif($request->amount_cate == "Cradit"){
            $data->cr_amount = $request->amount;
            $data->dr_amount = NULL;
        }
        $data->save();

        $newdata = new AccountTransectionDetails;
        $newdata->account_head_details = $request->account_head_main;
        $newdata->voucher_no = $request->invoice;
        $newdata->date = $request->date;
        $newdata->rand_id = $rand_id;

        $data->main_invoice = $request->main_invoice;
 
        $newdata->price = $request->price;
        $newdata->qty = $request->qty;
        $newdata->remarks = $request->remarks;
        
        $newdata->category_code = $request->sourch_cate_code;
        $newdata->Accountcategory_code = $request->sourch_Accountcate_code;

        $newdata->subcategory_codeone = $request->sourch_subcate_codeone;
        $newdata->subcategory_codetwo = $request->sourch_subcate_codetwo;
        
        if($request->amount_cate == "Debit"){
            $newdata->cr_amount = $request->amount;
        }elseif($request->amount_cate == "Cradit"){
            $newdata->dr_amount = $request->amount;
        }


        if($newdata->save()){
            return response('ok');
        }else{
            return response('no');
        }
    }else{
        
            $id=$request->accounttransecti_id;
            $validated = $request->validate([
                'account_head' => 'required',
            ]);

            $data = AccountTransectionDetails::findorFail($id);
            $data->account_head_details = $request->account_head;
            $data->voucher_no = $request->invoice;
            $data->date = $request->date;
            $data->location = $request->location;
            $data->price = $request->price;
            $data->qty = $request->qty;
            $data->remarks = $request->remarks;
            $data->category_code = $request->category_code;
            $data->Accountcategory_code = $request->Accountcategory_code;

            $data->subcategory_codeone = $request->subcategory_codeone;
            $data->subcategory_codetwo = $request->subcategory_codetwo;
            
            if($request->amount_cate == "Debit"){
                $data->dr_amount = $request->amount;
                $data->cr_amount = NULL;
            }elseif($request->amount_cate == "Cradit"){
                $data->cr_amount = $request->amount;
                $data->dr_amount = NULL;
            }
            if($data->save()){
            
            return response('ok');
            }else{
                return response('Faild');
            }
    }

}
//
    public function gettransectiondetails($invoice){
       // return $invoice;
        $alldata=AccountTransectionDetails::where('main_invoice', $invoice)->orderBy('id','DESC')->get();
        return view('accounts.accounttransection.ajax.alldata',compact('alldata'));

    }
    // 
    public function transectiondetailsedit(Request $request){
        $data=AccountTransectionDetails::where('id',$request->item_id)->first();
        return response()->json($data);
    }

    // delete
    public function transectiondelete(Request $request){
       // return $request->tran_id;
        $delete=AccountTransectionDetails::where('id',$request->tran_id)->delete();
        return response("ok");

    }


    // final account transection 
    public function insertfinal(Request $request){
        //return $request;
        $check=AccountTransectionDetails::where('voucher_no',$request->invoice)->first();
        if($check){
            $validated = $request->validate([
                'voucher' => 'required',
            ]);
                $insert=AccountTransectionHead::insert([
                    'voucher_type'=>$request->voucher,
                    'voucher_no'=>$request->invoice,
                    'date'=>$request->date,
                    'reference'=>$request->reference,
                    'cheque_reference'=>$request->cheque_reference,
                    'narration'=>$request->narration,
                    'advice'=>$request->advice,
                    'created_at'=>Carbon::now()->toDateTimeString(),
                    'entry_by'=>Auth::user()->id,


                ]);
                if($insert){
                    $notification = array(
                        'messege' => 'Insert Success',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'messege' => 'Insert Faild',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

        }else{
            $notification = array(
                'messege' => 'Please add Transection',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    } 

    // 
    
    public function active($id){
        //return "ok";
        $active=AccountTransectionHead::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'AccountTransectionHead Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountTransectionHead Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // deactive
    public function deactive($id){
        //return "ok";
        $deactive=AccountTransectionHead::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'AccountTransectionHead DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountTransectionHead DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete

     // edit
    public function edit($id){
        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $edit=AccountTransectionHead::where('id',$id)->first();
        return view('accounts.accounttransection.update',compact('edit','allcategory','allchartofaccount','allsubcategoryone','allsubcategorytwo'));
    }

    public function delete($id){
        $delete=AccountTransectionHead::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'AccountTransectionHead Delete success',
                'alert-type'=>'success'
                );
                return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountTransectionHead Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    // update
    public function update(Request $request){
        $check=AccountTransectionDetails::where('voucher_no',$request->invoice)->first();
        if($check){
            $validated = $request->validate([
                'voucher' => 'required',
            ]);

                $insert=AccountTransectionHead::where('id',$request->id)->update([
                    'voucher_type'=>$request->voucher,
                    'voucher_no'=>$request->invoice,
                    'date'=>$request->date,
                    'reference'=>$request->reference,
                    'cheque_reference'=>$request->cheque_reference,
                    'narration'=>$request->narration,
                    'advice'=>$request->advice,
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                    'entry_by'=>Auth::user()->id,
                ]);
                if($insert){
                    $notification = array(
                        'messege' => 'Update Success',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'messege' => 'Update Faild',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

        }else{
            $notification = array(
                'messege' => 'Please add Transection',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function getsourchaccount($account_head){
       
        $data=ChartOfAccount::where('desription_of_account',$account_head)->first();
        return response()->json($data);
    }

    // 
    public function getsaccheadaccount($account_head){
        $data=ChartOfAccount::where('desription_of_account',$account_head)->first();
        return response()->json($data);
    }

    // 
    public function getvouchertype($voucher_type){

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();


        if($voucher_type=='Cash Payment Voucher'){
          
            if($orderhed){
                $invoice='CPV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='CPV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }elseif($voucher_type=='Bank Payment Voucher'){

            if($orderhed){
                $invoice='BPV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='BPV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);
        }
        elseif($voucher_type=='Fund Transfer Voucher'){

            if($orderhed){
                $invoice='FTV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='FTV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }
        elseif($voucher_type=='Cash Receipt Voucher'){

            if($orderhed){
                $invoice='CRV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='CRV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }
        elseif($voucher_type=='Bank Receipt Voucher'){
            if($orderhed){
                $invoice='BRV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='BRV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);
        }
        elseif($voucher_type=='AorC Receivable Journal Voucher'){

            if($orderhed){
                $invoice='ACRJV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='ACRJV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }
        elseif($voucher_type=='AorC Payble Journal Voucher'){


            if($orderhed){
                $invoice='ACPJV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='ACPJV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }
        elseif($voucher_type=='Adjustment Journal Voucher'){
            if($orderhed){
                $invoice='AJV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='AJV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }elseif($voucher_type=='Acount Opening Voucher'){

            if($orderhed){
                $invoice='AOV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='AOV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }
    }



    // main load invoice
    


}
