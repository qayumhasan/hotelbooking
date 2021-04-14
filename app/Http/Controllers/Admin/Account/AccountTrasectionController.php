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
use App\Models\CheckBookTransection;
use App\Models\CheckBookEntry;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Guest;
use Carbon\Carbon;
use Session;
use Auth;
use DB;





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
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
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
        // return $request;


       if($request->accounttransecti_id == ''){
           //return "faka";
        $validated = $request->validate([
            
            'amount' => 'required',
        ]);
        $rand_id=rand(666,1999);
        $data = new AccountTransectionDetails;
        $account_hedcode=DB::table('vchart_of_accounts')->where('code',$request->account_head)->first();
       
        $data->account_head_details = $account_hedcode->desription_of_account;
        $data->account_head_code = $account_hedcode->code;
        $data->voucher_no = $request->invoice;
        $data->date = $request->date;
        $data->rand_id = $rand_id;
        $data->location = $request->location;
        $data->price = $request->price;
        $data->qty = $request->qty;
        $data->remarks = $request->remarks;
        $data->main_invoice = $request->hiddeninvoice;
        $data->check_reference = $request->cheque_reference;
        $data->is_active = 0;
        $data->entry_by = Auth::user()->id;

        if($request->subcategory_codeone==''){
            $data->subcategory_codeone =$account_hedcode->subcategoryone_code;
        }else{
            $data->subcategory_codeone = $request->subcategory_codeone;
        }
        if($request->subcategory_codetwo==''){
            $data->subcategory_codetwo = $account_hedcode->subcategorytwo_code;
        }else{
            $data->subcategory_codetwo = $request->subcategory_codetwo;
        }
        $data->category_code = $account_hedcode->category_code;
        $data->Accountcategory_code = $account_hedcode->maincategory_code;
        
        
        
        if($request->amount_cate == "Debit"){
            $data->dr_amount = $request->amount;
            $data->cr_amount = NULL;
        }elseif($request->amount_cate == "Cradit"){
            $data->cr_amount = $request->amount;
            $data->dr_amount = NULL;
        }
        $data->save();

        $newdata = new AccountTransectionDetails;

        $acccode=DB::table('vchart_of_accounts')->where('code',$request->account_head_main)->first();

       

        $newdata->account_head_details = $acccode->desription_of_account;
        $newdata->account_head_code = $acccode->code;

        
        $newdata->voucher_no = $request->invoice;
        $newdata->date = $request->date;
        $newdata->rand_id = $rand_id;
        $newdata->price = $request->price;
        $newdata->qty = $request->qty;
        $newdata->remarks = $request->remarks;
        $newdata->main_invoice = $request->hiddeninvoice;
        $data->is_active = 0;
        
        $newdata->category_code = $acccode->category_code;
        $newdata->Accountcategory_code = $acccode->maincategory_code;

        $newdata->subcategory_codeone = $acccode->subcategoryone_code;
        $newdata->subcategory_codetwo = $acccode->subcategorytwo_code;
        $newdata->entry_by = Auth::user()->id;
        
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
    }

}
//
    public function gettransectiondetails($invoice){
       // return $invoice;
        $alldata=AccountTransectionDetails::where('voucher_no', $invoice)->where('is_deleted',0)->orderBy('id','DESC')->get();
        return view('accounts.accounttransection.ajax.alldata',compact('alldata'));

    }
    // 
    public function transectiondetailsedit(Request $request){
        $data=AccountTransectionDetails::where('id',$request->item_id)->first();
        return response()->json($data);
    }

    // delete
    public function transectiondelete(Request $request){
      
        $check=AccountTransectionDetails::where('id',$request->tran_id)->first();
        
        $fioo=AccountTransectionDetails::where('rand_id',$check->rand_id)->get();
       
        foreach($fioo as $del){
            AccountTransectionDetails::where('id',$del->id)->delete();
        }
        return response("ok");

    }


    // final account transection 
    public function insertfinal(Request $request){
      
        $check=AccountTransectionDetails::where('voucher_no',$request->invoice)->first();
        if($check){
              
                $data = new AccountTransectionHead;
                $data->voucher_type=$request->voucher_name;
                $data->voucher_no=$request->invoice;
                $data->date=$request->date;
                $data->reference=$request->reference;
                $data->cheque_reference=$check->check_reference;
                $data->narration=$request->narration;
                $data->advice=$request->advice;
                $data->main_invoice=$request->hiddeninvoice;
                $data->created_at=Carbon::now()->toDateTimeString();
                $data->entry_by=Auth::user()->id;
                if($check->dr_amount == NULL){
                    // return "dr faka";
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->cr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);
    
                }elseif($check->cr_amount == NULL){
                     //return "cr faka";
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->dr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);

                }
                $detailsdata=AccountTransectionDetails::where('voucher_no',$request->invoice)->get();
                foreach($detailsdata as $updata){
                    AccountTransectionDetails::where('id',$updata->id)->update([
                        'is_active'=>1,
                    ]);
                }

                if($data->save()){
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
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");

        $delete=AccountTransectionHead::where('id',$id)->update([
            'is_deleted'=>1,
            'deleted_by'=>Auth::user()->id,
            'deleted_date'=>$current,
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
    public function update(Request $request,$id){

        $check=AccountTransectionDetails::where('voucher_no',$request->invoice)->first();
        if($check){
                $data = AccountTransectionHead::findOrFail($id);
                $data->voucher_type=$request->voucher_name;
                $data->voucher_no=$request->invoice;
                $data->date=$request->date;
                $data->reference=$request->reference;
                $data->cheque_reference=$check->check_reference;
                $data->narration=$request->narration;
                $data->advice=$request->advice;
                $data->main_invoice=$request->hiddeninvoice;
                $data->updated_at=Carbon::now()->toDateTimeString();
                $data->updated_by=Auth::user()->id;
                $data->updated_date=$request->date;
                $checkbookcheck=CheckBookTransection::where('voucher_number',$request->invoice)->first();
                if($checkbookcheck){
                    CheckBookTransection::where('voucher_number',$request->invoice)->update([
                        'status'=>'B',
                        'voucher_number'=>'NULL',
                        'check_date'=>'NULL',
                        'updated_at'=>'NULL',
                    ]);
                }
                if($check->dr_amount == 'NULL'){
                    // return "dr faka";
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->cr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);
    
                }elseif($check->cr_amount == 'NULL'){
                    // return "cr faka";
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->dr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);

                }
            


                $detailsdata=AccountTransectionDetails::where('voucher_no',$request->invoice)->get();
                foreach($detailsdata as $updata){
                    AccountTransectionDetails::where('id',$updata->id)->update([
                        'is_active'=>1,
                    ]);
                }

                if($data->save()){
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
                'alert-type' => 'Info'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function getsourchaccount($account_head){

        $data = DB::table('vchart_of_accounts')->where('code',$account_head)->first();
       
        return response()->json($data);
    }

    // 
    public function getsaccheadaccount($account_head){
        
        $data=DB::table('vchart_of_accounts')->where('code',$account_head)->first();
  
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

        }elseif($voucher_type=='Account Opening Voucher'){

            if($orderhed){
                $invoice='AOV'.$year.'-'.$date.'-H-'.$orderhed->id;
            }else{
                $invoice='AOV'.$year.'-'.$date.'-H-'.'0';
            }
            return response()->json($invoice);

        }
    }

    public function openvoichertype($invoice){
        $foioo=AccountTransectionDetails::where('voucher_no',$invoice)->get();
        foreach($foioo as $del){
            AccountTransectionDetails::where('id',$del->id)->delete();
        }
        return response()->json("ok");
    }


    // main load invoice
    public function getcheckbookall($account_head){
       //return $account_head;
        DB::table('vchart_of_accounts');
        $data=ChartOfAccount::where('code',$account_head)->select(['id'])->first();
        $newdata=CheckBookTransection::where('account_code',$data->id)->get();
        return response()->json($newdata);
       
    }


    // 
    public function getvoucherassourchacc($voucher_type){
        if($voucher_type=='Cash Payment Voucher'){
            
            $data=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',17)->get();

             return response()->json($data);

        }elseif($voucher_type=='Bank Payment Voucher'){
         
            $data=ChartOfAccount::where('category_id',1)->where('subcategoryone_id',18)->get();
            return response()->json($data);
        }
        elseif($voucher_type=='Fund Transfer Voucher'){

           
            $data=ChartOfAccount::get();
            return response()->json($data);

        }
        elseif($voucher_type=='Cash Receipt Voucher'){

       
            $data=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',17)->get();

             return response()->json($data);

        }
        elseif($voucher_type=='Bank Receipt Voucher'){
            $data=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',18)->get();
            return response()->json($data);
        }
        elseif($voucher_type=='AorC Receivable Journal Voucher'){

            $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);

        }
        elseif($voucher_type=='AorC Payble Journal Voucher'){

            $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);
        }
        elseif($voucher_type=='Adjustment Journal Voucher'){

            $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);


        }elseif($voucher_type=='Account Opening Voucher'){

            $data=ChartOfAccount::get();
             return response()->json($data);


        }
    }

    // 
    public function getvoucheraccounthead($voucher_type){

        if($voucher_type=='Cash Payment Voucher'){

            $data=ChartOfAccount::where('subcategoryone_id','!=',17)->get();
             return response()->json($data);

        }elseif($voucher_type=='Bank Payment Voucher'){

            $data=ChartOfAccount::where('subcategoryone_id','!=',18)->get();
            return response()->json($data);

        }
        elseif($voucher_type=='Fund Transfer Voucher'){
            $data=ChartOfAccount::get();
            return response()->json($data);
           
           
        }
        elseif($voucher_type=='Cash Receipt Voucher'){
            $data=ChartOfAccount::where('subcategoryone_id','!=',17)->get();
            return response()->json($data);

        }
        elseif($voucher_type=='Bank Receipt Voucher'){
            $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);
        }
        elseif($voucher_type=='AorC Receivable Journal Voucher'){

            $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);

        }
        elseif($voucher_type=='AorC Payble Journal Voucher'){


            $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);

        }
        elseif($voucher_type=='Adjustment Journal Voucher'){
          $data=ChartOfAccount::where('maincategory_id','!=',9)->get();
            return response()->json($data);

        }elseif($voucher_type=='Account Opening Voucher'){

           
            $data=ChartOfAccount::get();
            return response()->json($data);

        }

    }

    public function cashpaymentvoucher(){

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }

        if($orderhed){
            $vno='CPV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='CPV'.$year.'-'.$date.'-H-'.'0';
        }


        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',17)->get();
        $account_head=ChartOfAccount::where('subcategoryone_id','!=',17)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        $allsuplier=Supplier::where('is_deleted',0)->orderBy('id','DESC')->get();

        return view('accounts.accounttransection.vouchertypewise.cashpaymentvoucher',compact('allsuplier','allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }

    // bank payment
    public function bankpaymentvoucher(){

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }

        if($orderhed){
            $vno='BPV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='BPV'.$year.'-'.$date.'-H-'.'0';
        }


        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('category_id',1)->where('subcategoryone_id',18)->get();
        $account_head=ChartOfAccount::where('subcategoryone_id','!=',18)->get();

        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        $allsuplier=Supplier::where('is_deleted',0)->orderBy('id','DESC')->get();

        return view('accounts.accounttransection.vouchertypewise.bankpaymentvoucher',compact('allsuplier','allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }

       // found transfer
       public function foundtransfervoucher(){

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }

        if($orderhed){
            $vno='FTV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='FTV'.$year.'-'.$date.'-H-'.'0';
        }


        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('category_id',1)->where('subcategoryone_id',18)->get();
        $account_head=ChartOfAccount::where('subcategoryone_id','!=',18)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        $allsuplier=Supplier::where('is_deleted',0)->orderBy('id','DESC')->get();

        return view('accounts.accounttransection.vouchertypewise.fundtransfervoucher',compact('allsuplier','allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }

     // cash receipt voucher
     public function cashreceiptvoucher(){

        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }
        if($orderhed){
            $vno='CRV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='CRV'.$year.'-'.$date.'-H-'.'0';
        }


        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',17)->get();
        $account_head=ChartOfAccount::where('subcategoryone_id','!=',17)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        $allsuplier=Supplier::where('is_deleted',0)->orderBy('id','DESC')->get();
        $allguest=Guest::where('is_deleted',0)->orderBy('id','DESC')->get();


        return view('accounts.accounttransection.vouchertypewise.cashreceiptvoucher',compact('allguest','allsuplier','allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }
    
    // 
    public function bankreceiptvoucher(){

        
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }
        if($orderhed){
            $vno='BRV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='BRV'.$year.'-'.$date.'-H-'.'0';
        }


        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();
        $datasourche=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',18)->get();
        $account_head=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        $allsuplier=Supplier::where('is_deleted',0)->orderBy('id','DESC')->get();

        return view('accounts.accounttransection.vouchertypewise.bankreceiptvoucher',compact('allsuplier','allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }
    
    public function aorcreceablevoucher(){

        
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }
        if($orderhed){
            $vno='ACRJV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='ACRJV'.$year.'-'.$date.'-H-'.'0';
        }


        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $account_head=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        return view('accounts.accounttransection.vouchertypewise.aorcreceablevoucher',compact('allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }
    


    public function aorcpayblevoucher(){

        
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }

        if($orderhed){
            $vno='ACPJV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='ACPJV'.$year.'-'.$date.'-H-'.'0';
        }
     

        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $account_head=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        return view('accounts.accounttransection.vouchertypewise.aorcpayblevoucher',compact('allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }



    public function adjustmentpayblevoucher(){

        
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }

        if($orderhed){
                $vno='AJV'.$year.'-'.$date.'-H-'.$orderhed->id;
         }else{
                $vno='AJV'.$year.'-'.$date.'-H-'.'0';
        }
     

        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $account_head=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();
        return view('accounts.accounttransection.vouchertypewise.adjustmentpayblevoucher',compact('allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }

    public function accountopeningvoucher(){

        
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $orderhed=AccountTransectionHead::orderBy('id','DESC')->first();
        if($orderhed){
            $invoice='invoice-'.$year.'-'.$date.'-H-'.$orderhed->id.rand(5555,10000);
        }else{
            $invoice='invoice-'.$year.'-'.$date.'-H-'.'0'.rand(5555,10000);
        }

        if($orderhed){
            $vno='AOV'.$year.'-'.$date.'-H-'.$orderhed->id;
        }else{
            $vno='AOV'.$year.'-'.$date.'-H-'.'0';
        }
     

        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $datasourche=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $account_head=ChartOfAccount::where('maincategory_id','!=',9)->get();
        $allemployee=Employee::where('status',1)->orderBy('id','DESC')->get();

        return view('accounts.accounttransection.vouchertypewise.accountopeningvoucher',compact('allemployee','account_head','datasourche','allchartofaccount','allsubcategoryone','allsubcategorytwo','invoice','vno'));
    }


    // search date wise
    public function searchdatewise(Request $request){
        $todate=$request->todate;
        $formdate=$request->formdate;
        $searchdata=AccountTransectionHead::whereBetween('date', [$request->formdate,$request->todate])->get();
        return view('accounts.accounttransection.index',compact('searchdata','todate','formdate'));
    }

    // 
    public function printvalueaccount(Request $request){
      
        $data=AccountTransectionHead::where('id',$request->id)->first();
        $alldata=AccountTransectionDetails::where('voucher_no',$data->voucher_no)->get();
        
        return view('accounts.accounttransection.ajax.allprintdata',compact('data','alldata'));

    }
    public function getsourchaccountBalance($source_account){
        //return $source_account;
        $sourchAmount=0;
        $allledger=DB::table('vAccountsHeadsLeadgerTbl')->where('Code',$source_account)->select(['Balance'])->get();
        foreach($allledger as $ledger){
            $sourchAmount=$sourchAmount + $ledger->Balance ;
        }
        return response()->json($sourchAmount);
        
    }

    // 
    public function getheadaccountBalance($head_account){
        $headaccount=0;
        $allledger=DB::table('vAccountsHeadsLeadgerTbl')->where('Code',$head_account)->select(['Balance'])->get();
        foreach($allledger as $ledger){
            $headaccount=$headaccount + $ledger->Balance ;
        }
        return response()->json($headaccount);
    }
    

}
