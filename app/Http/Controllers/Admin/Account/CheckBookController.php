<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChartOfAccount;
use App\Models\CheckBookEntry;
use App\Models\CheckBookTransection;

class CheckBookController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function create(){
        $allbankaccount=ChartOfAccount::where('subcategoryone_id',18)->get();
        return view('accounts.checkbook.create',compact('allbankaccount'));
    }
    // 
    public function getallcheckentry($bank_code){
        $bookig_id=CheckBookTransection::select(['id'])->first();
        return view('accounts.checkbook.ajax.allchequeentry',compact('bank_code'));
    }

    // 
    public function chekcbooktransectioninsert(Request $request){

        $account_id=$request->account_code;
        $check_data=ChartOfAccount::where('id',$account_id)->select(['code','code_int'])->first();


        $validated = $request->validate([
            'start_id' => 'required',
            'check_qty' => 'required',
        ]);
        $insert=CheckBookEntry::insert([
            'remarks'=>$request->remarks,
            'check_qty'=>$request->check_qty,
            'start_id'=>$request->start_id,
            'reg_date'=>$request->reg_date,
            'book_id'=>$request->book_id,
            'account_code'=>$check_data->code,
        ]);
        if($insert){
            return response()->json("ok");
        }else{
            return response()->json("faild");
        }
    }

    
    public function chekcbooktransectionshow(Request $request){
        return $request;
    }

}
