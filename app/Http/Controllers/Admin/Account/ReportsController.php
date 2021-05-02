<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountTransectionDetails;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\AccountTransectionHead;
use App\Models\Guest;
use DB;
use Auth;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function demo(){
        return view('accounts.accounttransection.demo');
    }

    public function datewisereport(){
        
        $alldata = DB::table('vAccountsHeadsLeadgerTbl')->get();
        return view('accounts.reports.datewisetransection',compact('alldata'));
    }
    // date

    public function datewisereportsearch(Request $request){
       // return $request;
        $todate=$request->todate;
        $formdate=$request->formdate;
        $searchdata=DB::table('vAccountsHeadsLeadgerTbl')->whereBetween('date', [$request->formdate,$request->todate])->get();
        return view('accounts.reports.datewisetransection',compact('searchdata','todate','formdate'));
    }
    // 
    public function vouchertypewise(){
        $alldata = DB::table('vAccountsHeadsLeadgerTbl')->get();
        return view('accounts.reports.vouchertypewise',compact('alldata'));
    }
    // 
    public function vouchertypewisesearch(Request $request){
        $voucher=$request->voucher_type;
        $searchdata=DB::table('vAccountsHeadsLeadgerTbl')->where('VoucherType',$request->voucher_type)->get();
       
        return view('accounts.reports.vouchertypewise',compact('searchdata','voucher'));
    }

    public function onlydate(){
        $alldata = DB::table('vAccountsHeadsLeadgerTbl')->get();
        return view('accounts.reports.onlydate',compact('alldata'));
    }

    // 

    public function onlydatesearch(Request $request){
        $date=$request->formdate;
        $searchdata=DB::table('vAccountsHeadsLeadgerTbl')->where('date',$request->formdate)->get();
        return view('accounts.reports.onlydate',compact('searchdata','date'));
    }

    // employee all
    public function employeereports(){
        $alldata= DB::table('vEmployeeLedger')->get();
        $allemployee= Employee::where('status',1)->select(['employee_id','employee_name'])->get();
        return view('accounts.reports.employeereports',compact('alldata','allemployee'));
    }

    public function employeereportsearch(Request $request){
        if($request->no_date){
            $validated = $request->validate([
                'employee_name' => 'required',
            ]);
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vEmployeeLedger')->where('EmployeeID',$employee_id)->whereBetween('Date', [$formdate, $to_date])->get();
            $allemployee= Employee::where('status',1)->select(['employee_id','employee_name'])->get();
            
            return view('accounts.reports.employeereports',compact('searchdata','allemployee','formdate','to_date'));
        }else{
           
            $validated = $request->validate([
                'employee_name' => 'required',
              
            ]);
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vEmployeeLedger')->where('EmployeeID',$employee_id)->get();
            $allemployee= Employee::where('status',1)->select(['employee_id','employee_name'])->get();
            
            return view('accounts.reports.employeereports',compact('searchdata','allemployee'));
        }
       
       
    } 

    public function supllierreprt(){
        $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->select(['name','id'])->get();
        $alldata=DB::table('vSupplierLedger')->get();
       // dd($alldata);
        return view('accounts.reports.supplierreport',compact('alldata','allsupplier'));
    }

    public function supllierreprtsearch(Request $request){
        if($request->no_date){
            //return "ok";
            $validated = $request->validate([
                'supplier_name' => 'required',
            ]);
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $employee_id=$request->supplier_name;
            $searchdata=DB::table('vSupplierLedger')->where('SupplirID',$employee_id)->whereBetween('Date', [$formdate, $to_date])->get();
            $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->select(['name','id'])->get();
            
            return view('accounts.reports.supplierreport',compact('searchdata','allsupplier','formdate','to_date'));
        }else{
           
            $validated = $request->validate([
                'supplier_name' => 'required',
              
            ]);
            $employee_id=$request->supplier_name;
            $searchdata=DB::table('vSupplierLedger')->where('SupplirID',$employee_id)->get();
            $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->select(['name','id'])->get();
            
            return view('accounts.reports.supplierreport',compact('searchdata','allsupplier'));
        }
       
       
    } 



    //Guest Report
    public function guestreports(){

        $allguest=Guest::orderBy('id','DESC')->get();
        $alldata=DB::table('vGuestLedger')->get();

        return view('accounts.reports.guestsreports',compact('allguest','alldata'));
    } 

    //search
    public function guestreportssearch(Request $request){
        if($request->no_date){
            $validated = $request->validate([
                'employee_name' => 'required',
            ]);
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vGuestLedger')->where('GuestID',$employee_id)->whereBetween('Date', [$formdate, $to_date])->get();
            $allguest=Guest::orderBy('id','DESC')->get();
            
            return view('accounts.reports.supplierreport',compact('searchdata','allguest','formdate','to_date'));
        }else{
           
            $validated = $request->validate([
                'employee_name' => 'required',
              
            ]);
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vGuestLedger')->where('GuestID',$employee_id)->get();
           
            $allguest=Guest::orderBy('id','DESC')->get();
            
            return view('accounts.reports.guestsreports',compact('searchdata','allguest'));
        }
    }

    // 
    public function accounttrasectionledger(){
        $allledger=DB::table('vchart_of_accounts')->select(['code','desription_of_account'])->get();
        $alldata=DB::table('vAccountTransectionLedger')->get();
        return view('accounts.reports.accounttrasectionledger',compact('allledger','alldata'));
    }

    // search
    public function accounttrasectionledgersearch(Request $request){

        if($request->no_date){
            $validated = $request->validate([
                'employee_name' => 'required',
            ]);
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vAccountTransectionLedger')->where('AccountHeadCode',$employee_id)->whereBetween('Date', [$formdate, $to_date])->get();
            $allledger=DB::table('vchart_of_accounts')->select(['code','desription_of_account'])->get();
            
            return view('accounts.reports.accounttrasectionledger',compact('searchdata','allledger','formdate','to_date'));
        }else{
           
            $validated = $request->validate([
                'employee_name' => 'required',
              
            ]);
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vAccountTransectionLedger')->where('AccountHeadCode',$employee_id)->get();
           
            $allledger=DB::table('vchart_of_accounts')->select(['code','desription_of_account'])->get();
            
            return view('accounts.reports.accounttrasectionledger',compact('searchdata','allledger'));
        }

    }
// reports
    public function cashandbankreports(){
        $allledger=DB::table('vchart_of_accounts')->where('maincategory_id',9)->get();
        $alldata=DB::table('vCashAndBankTransection')->get();
        return view('accounts.reports.cashandbanktransectionreport',compact('alldata','allledger'));
    }
    // 

    public function cashandbankreportssearch(Request $request){

       if($request->no_date){
            $validated = $request->validate([
                'employee_name' => 'required',
            ]);
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vCashAndBankTransection')->where('AccountHeadCode',$employee_id)->whereBetween('date', [$formdate, $to_date])->get();
            $allledger=DB::table('vchart_of_accounts')->where('maincategory_id',9)->get();
            
            return view('accounts.reports.cashandbanktransectionreport',compact('employee_id','searchdata','allledger','formdate','to_date'));
        }else{
            $validated = $request->validate([
                'employee_name' => 'required',
              
            ]);
            $employee_id=$request->employee_name;
            $searchdata=DB::table('vCashAndBankTransection')->where('AccountHeadCode',$employee_id)->get();
           
            $allledger=DB::table('vchart_of_accounts')->where('maincategory_id',9)->get();
            
            return view('accounts.reports.cashandbanktransectionreport',compact('searchdata','allledger','employee_id'));
        }

    }

    public function userTransection(){
        $userid=Auth::user()->id;
        $alluser=DB::table('admins')->get();

        $alldata=DB::table('vUserLogLedger')->where('UserID',$userid)->get();
        return view('accounts.reports.usertransectionreport',compact('alluser','alldata'));
    }

    public function userTransectionsearch(Request $request){
        if($request->no_date){
            $validated = $request->validate([
                'username_name' => 'required',
            ]);
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $username_id=$request->username_name;

            $searchdata=DB::table('vUserLogLedger')->where('UserID',$username_id)->whereBetween('date', [$formdate, $to_date])->get();

            $alluser=DB::table('admins')->get();
            
            return view('accounts.reports.usertransectionreport',compact('username_id','searchdata','alluser','formdate','to_date'));
        }else{
            $validated = $request->validate([
                'username_name' => 'required',
              
            ]);
            $username_id=$request->username_name;
            $searchdata=DB::table('vUserLogLedger')->where('UserID',$username_id)->get();
            
           
            $alluser=DB::table('admins')->get();
            
            return view('accounts.reports.usertransectionreport',compact('username_id','searchdata','alluser'));
        }
    }


    public function uservouchetypewise(){
       
        $allvoucher=DB::table('vUserLogLedger')->select(['VoucherType'])->get();
        $alldata=DB::table('vUserLogLedger')->get();
        $alluser=DB::table('admins')->get();
        return view('accounts.reports.uservouchertypewise',compact('allvoucher','alldata','alluser'));
    }

    // 
    public function uservouchetypewisesearch(Request $request){

        $validated = $request->validate([
            'username_name' => 'required',
        ]);
      
        if($request->no_date && $request->voucher){
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $voucher_name=$request->voucher;
            $usernamename=$request->username_name;
            $searchdata=DB::table('vUserLogLedger')->where('VoucherType',$voucher_name)->where('UserID',$usernamename)->whereBetween('Date', [$formdate, $to_date])->get();
            $allvoucher=DB::table('vUserLogLedger')->select(['VoucherType'])->get();
            $alluser=DB::table('admins')->get();
            return view('accounts.reports.uservouchertypewise',compact('voucher_name','searchdata','allvoucher','alluser','usernamename'));

        }elseif($request->no_date){
            $formdate=$request->formdate;
            $to_date=$request->todate;
            $usernamename=$request->username_name;
            $searchdata=DB::table('vUserLogLedger')->where('UserID',$usernamename)->whereBetween('Date', [$formdate, $to_date])->get();
            $allvoucher=DB::table('vUserLogLedger')->select(['VoucherType'])->get();
            $alluser=DB::table('admins')->get();
            return view('accounts.reports.uservouchertypewise',compact('searchdata','allvoucher','alluser','usernamename'));
        }elseif($request->voucher){
            $voucher_name=$request->voucher;
            $usernamename=$request->username_name;
            $searchdata=DB::table('vUserLogLedger')->where('UserID',$usernamename)->where('VoucherType',$voucher_name)->get();
            $allvoucher=DB::table('vUserLogLedger')->select(['VoucherType'])->get();
            $alluser=DB::table('admins')->get();
            return view('accounts.reports.uservouchertypewise',compact('usernamename','voucher_name','searchdata','allvoucher','alluser'));
        }else{
            $usernamename=$request->username_name;
            $searchdata=DB::table('vUserLogLedger')->where('UserID',$usernamename)->get();
            $allvoucher=DB::table('vUserLogLedger')->select(['VoucherType'])->get();
            $alluser=DB::table('admins')->get();
            return view('accounts.reports.uservouchertypewise',compact('usernamename','searchdata','allvoucher','alluser'));
        }

       

    }
    public function voucherlist(){
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
       $alldata=AccountTransectionHead::where('date',$current)->orderBy('id','DESC')->get();
        return view('accounts.reports.voucherlist',compact('alldata'));
    }
    public function voucherlistsearch(Request $request){
           
            if($request->no_date && $request->voucher){
                $formdate=$request->formdate;
                $to_date=$request->todate;
                $voucher_name=$request->voucher;
                $searchdata=AccountTransectionHead::where('voucher_type',$voucher_name)->whereBetween('date', [$formdate, $to_date])->get();
                return view('accounts.reports.voucherlist',compact('searchdata','voucher_name','formdate','to_date'));
            }elseif($request->no_date){
                $formdate=$request->formdate;
                $to_date=$request->todate;
                $searchdata=AccountTransectionHead::whereBetween('date', [$formdate, $to_date])->get();
                return view('accounts.reports.voucherlist',compact('searchdata','formdate','to_date'));
            }
            elseif($request->voucher){
                $voucher_name=$request->voucher;
                $searchdata=AccountTransectionHead::where('voucher_type',$voucher_name)->get();
                return view('accounts.reports.voucherlist',compact('searchdata','voucher_name'));
            }
    }


    // account recepipt and payment
    public function accountreceiptandpayment(){
         
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");

        $creadit_amount=AccountTransectionDetails::where('date',$current)->where('is_active',1)->where('cr_amount',NULL)->OrderBy('id','DESC')->get();
        $caamount=AccountTransectionDetails::where('date','<',$current)->where('is_active',1)->where('cr_amount',NULL)->sum('dr_amount');
       

        $creadit_amount=$creadit_amount->groupby('account_head_details');
        $creadit_amount=$creadit_amount->all();
        $davit_amount=AccountTransectionDetails::where('date',$current)->where('is_active',1)->where('dr_amount',NULL)->OrderBy('id','DESC')->get();
        $dvamount=AccountTransectionDetails::where('date','<',$current)->where('is_active',1)->where('dr_amount',NULL)->sum('cr_amount');
        $davit_amount=$davit_amount->groupby('account_head_details');
        $davit_amount=$davit_amount->all();


        return view('accounts.reports.accountreceiptandpayment',compact('caamount','creadit_amount','davit_amount','dvamount'));
    }

    public function accountreceiptandpaymentsearch(Request $request){
         
         $formdate=$request->formdate;
         $todate=$request->todate;


         $creadit_amount=AccountTransectionDetails::whereBetween('date', [$formdate, $todate])->where('is_active',1)->where('cr_amount',NULL)->OrderBy('id','DESC')->get();
         $caamount=AccountTransectionDetails::whereBetween('date', [$formdate, $todate])->where('is_active',1)->where('cr_amount',NULL)->sum('dr_amount');

         $creadit_amount=$creadit_amount->groupby('account_head_details');
         $creadit_amount=$creadit_amount->all();


         $davit_amount=AccountTransectionDetails::whereBetween('date', [$formdate, $todate])->where('is_active',1)->where('dr_amount',NULL)->OrderBy('id','DESC')->get();
         $dvamount=AccountTransectionDetails::whereBetween('date', [$formdate, $todate])->where('is_active',1)->where('dr_amount',NULL)->sum('cr_amount');

         $davit_amount=$davit_amount->groupby('account_head_details');
         $davit_amount=$davit_amount->all();

        

        
        return view('accounts.reports.accountreceiptandpayment',compact('creadit_amount','davit_amount','formdate','todate','caamount','dvamount'));
    }

    // cash and bank
    public function cashandbankdetails(){
        date_default_timezone_set("asia/dhaka");
        $current = date("m/d/Y");
        $creadit_amount=AccountTransectionDetails::where('date',$current)->where('Accountcategory_code',19)->orderBy('id','DESC')->get();
        $creadit_amount=$creadit_amount->groupby('account_head_details');
        $creadit_amount=$creadit_amount->all();
        
        return view('accounts.reports.cashandbankdetails',compact('creadit_amount'));
    }

    public function cashandbankdetailssearch(Request $request){
        $formdate=$request->form_date;
        $todate=$request->to_date;
        $searchdata=AccountTransectionDetails::whereBetween('date', [$formdate, $todate])->where('Accountcategory_code',19)->orderBy('id','DESC')->get();
        $searchdata=$searchdata->groupby('account_head_details');
        $searchdata=$searchdata->all();
      
        return view('accounts.reports.cashandbankdetails',compact('searchdata','formdate','todate'));
    }


    public function finalreport(){
        $allchart_of_acc= DB::table('vchart_of_accounts')->get();
        return view('accounts.reports.finalreport',compact('allchart_of_acc'));
    }
    public function finalreportsearch(Request $request){
       
        $formdate=$request->formdate;
        $todate=$request->todate;
        $allchart_of_acc= DB::table('vchart_of_accounts')->get();
        if($request->Transection=='voucher_summary'){
            $vouchername=$request->Transection;
            $chartof_account=$request->chart_of_account;
            $vsamary=DB::table('vAccountsHeadsLeadgerTbl')->whereBetween('date', [$formdate, $todate])->where('Code',$chartof_account)->get();
            $totalbalance=DB::table('vAccountsHeadsLeadgerTbl')->where('date', '<' ,$formdate)->where('Code',$chartof_account)->sum('Balance');
            return view('accounts.reports.finalreport',compact('chartof_account','totalbalance','vsamary','formdate','todate','allchart_of_acc','vouchername'));
        }elseif($request->Transection=='voucher_summary_narration'){
            $vouchername=$request->Transection;
            $chartof_account=$request->chart_of_account;
            $voucherwithnarration=DB::table('vAccountsHeadsLeadgerTbl')->whereBetween('date', [$formdate, $todate])->where('Code',$chartof_account)->get();
            $totalbalance=DB::table('vAccountsHeadsLeadgerTbl')->where('date', '<' ,$formdate)->where('Code',$chartof_account)->sum('Balance');
            return view('accounts.reports.finalreport',compact('chartof_account','totalbalance','voucherwithnarration','formdate','todate','allchart_of_acc','vouchername'));
            
        }elseif($request->Transection=='transaction_summary'){

            $vouchername=$request->Transection;
            $chartof_account=$request->chart_of_account;
            $voucherwithnarration=DB::table('vAccountsHeadsLeadgerTbl')->whereBetween('date', [$formdate, $todate])->where('Code',$chartof_account)->get();
            $totalbalance=DB::table('vAccountsHeadsLeadgerTbl')->where('date', '<' ,$formdate)->where('Code',$chartof_account)->sum('Balance');
            return view('accounts.reports.finalreport',compact('chartof_account','totalbalance','voucherwithnarration','formdate','todate','allchart_of_acc','vouchername'));

        }else{
            
            $vouchername=$request->Transection;
            $chartof_account=$request->chart_of_account;
            $voucherwithnarration=DB::table('vAccountsHeadsLeadgerTbl')->whereBetween('date', [$formdate, $todate])->where('Code',$chartof_account)->get();
            $totalbalance=DB::table('vAccountsHeadsLeadgerTbl')->where('date', '<' ,$formdate)->where('Code',$chartof_account)->sum('Balance');
            return view('accounts.reports.finalreport',compact('chartof_account','totalbalance','voucherwithnarration','formdate','todate','allchart_of_acc','vouchername'));
        }
    }
  
}


