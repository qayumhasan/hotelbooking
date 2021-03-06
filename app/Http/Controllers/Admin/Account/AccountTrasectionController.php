<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Models\AccountMainCategory;
use App\Models\AccountSubCategoryOne;
use App\Models\AccountSubCategoryTwo;
use Carbon\Carbon;
use Session;





class AccountTrasectionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function create(){
        $allcategory=AccountCategory::get();
        return view('accounts.accounttransection.create',compact('allcategory'));
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
}
