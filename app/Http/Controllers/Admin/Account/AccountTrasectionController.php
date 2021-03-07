<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Models\AccountMainCategory;
use App\Models\AccountSubCategoryOne;
use App\Models\AccountSubCategoryTwo;
use App\Models\ChartOfAccount;
use Carbon\Carbon;
use Session;





class AccountTrasectionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function create(){
        $invoice=0;
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
       
        $validated = $request->validate([
            'account_head' => 'required',
        ]);

        $insert=AccountTransectionDetails::insert([
            'account_head'=>$request->account_head,
            'invoice'=>$request->invoice,
            'account_head'=>$request->account_head,
            'account_head'=>$request->account_head,
            'account_head'=>$request->account_head,
            'account_head'=>$request->account_head,
            'account_head'=>$request->account_head,
        ]);
    }
}
