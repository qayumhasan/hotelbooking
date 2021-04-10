<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Supplier;
use DB;

class ReportsController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
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


  
}
