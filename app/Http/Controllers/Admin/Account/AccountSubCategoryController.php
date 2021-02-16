<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountMainCategory;
use Auth;
use DB;
use Carbon\Carbon;

class AccountSubCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // 
    public function createone(){
         //return "ok";
        $allmaincategory=AccountMainCategory::where('is_deleted',0)->get();
        return view('accounts.subcategory1.create',compact('allmaincategory'));
    }
}
