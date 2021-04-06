<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('accounts.reports.employeereports',compact('alldata'));
    }

    public function employeereportsearch(Request $request){
        
        $formdate=$request->formdate;
        $to_date=$request->todate;
        $searchdata=DB::table('vEmployeeLedger')->whereBetween('Date', [$formdate, $to_date])->get();
        dd($searchdata);
    } 


    public function employeenamewise(){
        $alldata= DB::table('vEmployeeLedger')->get();
        return view('accounts.reports.employeereportsnamewise',compact('alldata'));
    }
}
