<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountMainCategory;
use App\Models\AccountSubCategoryOne;
use App\Models\AccountSubCategoryTwo;
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
        $allsubcategory=AccountSubCategoryOne::where('is_deleted',0)->orderBy('id','ASC')->get();
        return view('accounts.subcategory1.create',compact('allmaincategory','allsubcategory'));
    }
    // 
    public function storeone(Request $request){
        $validated = $request->validate([
            'maincategory' => 'required',
            'subcategory_nameone' => 'required',
        ]);
        $maincate_id=AccountMainCategory::where('id',$request->maincategory)->select(['maincategory_code','maincategory_name'])->first();
        $insert=AccountSubCategoryOne::insertGetId([
            'maincategory_name'=>$maincate_id->maincategory_name,
            'maincategory_code'=>$maincate_id->maincategory_code,
            'maincategory_id'=>$request->maincategory,
            'subcategory_nameone'=>$request->subcategory_nameone,

            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateString(),
            'entry_by'=>Auth::user()->id,
        ]);
        $resturl =str_pad($insert, 2, '0', STR_PAD_LEFT);
        //return $resturl;
        AccountSubCategoryOne::where('id',$insert)->update([
            'subcategory_codeone'=> $resturl,
        ]);
         

        

        if($insert) {
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
        }
    }


    public function active($id){
        //return "ok";
        $active=AccountSubCategoryOne::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'AccountSubCategoryOne Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountSubCategoryOne Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // deactive
    public function deactive($id){
        //return "ok";
        $deactive=AccountSubCategoryOne::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'AccountMainCategory DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountCategory DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete

     // edit
    public function edit($id){
        // return $id;
        $edit=AccountSubCategoryOne::where('id',$id)->first();
        $allmaincategory=AccountMainCategory::where('is_deleted',0)->get();
        $allsubcategory=AccountSubCategoryOne::where('is_deleted',0)->orderBy('id','ASC')->get();
        return view('accounts.subcategory1.update',compact('edit','allmaincategory','allsubcategory'));
    }
    // updaate
    public function updateone(Request $request){

        $validated = $request->validate([
            'maincategory' => 'required',
            'subcategory_nameone' => 'required',
        ]);
        $maincate_id=AccountMainCategory::where('id',$request->maincategory)->select(['maincategory_code','maincategory_name'])->first();
        $updated=AccountSubCategoryOne::where('id',$request->id)->update([
            'maincategory_name'=>$maincate_id->maincategory_name,
            'maincategory_code'=>$maincate_id->maincategory_code,
            'maincategory_id'=>$request->maincategory,
            'subcategory_nameone'=>$request->subcategory_nameone,
            'is_active'=>$request->is_active,
            'updated_at'=>Carbon::now()->toDateString(),
            'updated_by'=>Auth::user()->id,
        ]);
        if($updated){
            $notification = array(
                'messege' => 'Updated Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Updated Faild',
                'alert-type' => 'error'
            );
        }
     
        
    }
    // 
    public function delete($id){
        $delete=AccountSubCategoryOne::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'AccountMainCategory Delete success',
                'alert-type'=>'success'
                );
                return redirect()->route('admin.account.subcategoryone.create')->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountMainCategory Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->route('admin.account.subcategoryone.create')->with($notification);
        }
    }

    // subcategory two
    public function createtwo(){

        $allmaincategory=AccountMainCategory::where('is_deleted',0)->get();
        $allsubcategory=AccountSubCategoryOne::where('is_deleted',0)->orderBy('id','ASC')->get();
        $allsubcategoryTwo=AccountSubCategoryTwo::where('is_deleted',0)->orderBy('id','ASC')->get();
        return view('accounts.subcategory2.create',compact('allmaincategory','allsubcategory','allsubcategoryTwo'));
    }

    // store
    public function storetwo(Request $request){

        $validated = $request->validate([
            'subcategory_nametwo' => 'required',
            'subcategoryone' => 'required',
        ]);
   
        $subcate_id=AccountSubCategoryOne::where('id',$request->subcategoryone)->select(['subcategory_codeone','subcategory_nameone'])->first();
        $insert=AccountSubCategoryTwo::insertGetId([
            'subcategory_nametwo'=>$request->subcategory_nametwo,

            'subcategory_nameone'=>$subcate_id->subcategory_nameone,
            'subcategory_codeone'=>$subcate_id->subcategory_codeone,
            'subcategoryone_id'=>$request->subcategoryone,

            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateString(),
            'entry_by'=>Auth::user()->id,
        ]);
        $resturl =str_pad($insert, 4, '0', STR_PAD_LEFT);
        //return $resturl;
        AccountSubCategoryTwo::where('id',$insert)->update([
            'subcategory_codetwo'=> $resturl,
        ]);
         
        if($insert) {
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
        }

    }
    // 
    public function activetwo($id){
        //return "ok";
        $active=AccountSubCategoryTwo::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'AccountSubCategoryOne Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountSubCategoryOne Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // deactive
    public function deactivetwo($id){
        //return "ok";
        $deactive=AccountSubCategoryTwo::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'AccountMainCategory DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountCategory DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete

     // edit
    public function edittwo($id){
        // return $id;
        $edit=AccountSubCategoryTwo::where('id',$id)->first();
        $allsubcategoryTwo=AccountSubCategoryTwo::where('is_deleted',0)->orderBy('id','ASC')->get();
        $allsubcategory=AccountSubCategoryOne::where('is_deleted',0)->orderBy('id','ASC')->get();
        return view('accounts.subcategory2.update',compact('edit','allsubcategory','allsubcategoryTwo'));
    }
    // updaate
    public function updatetwo(Request $request){

        $validated = $request->validate([
            'subcategory_nametwo' => 'required',
            'subcategoryone' => 'required',
        ]);
   
        $subcate_id=AccountSubCategoryOne::where('id',$request->subcategoryone)->select(['subcategory_codeone','subcategory_nameone'])->first();
        $insert=AccountSubCategoryTwo::where('id',$request->id)->update([

            'subcategory_nametwo'=>$request->subcategory_nametwo,
            'subcategory_nameone'=>$subcate_id->subcategory_nameone,
            'subcategory_codeone'=>$subcate_id->subcategory_codeone,
            'subcategoryone_id'=>$request->subcategoryone,
            'is_active'=>$request->is_active,
            'updated_at'=>Carbon::now()->toDateString(),
            'updated_by'=>Auth::user()->id,

        ]);
         
        if($insert) {
            $notification = array(
                'messege' => 'update Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'update Faild',
                'alert-type' => 'error'
            );
        }
     
        
    }
    // 
    public function deletetwo($id){
        $delete=AccountSubCategoryTwo::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'AccountMainCategory Delete success',
                'alert-type'=>'success'
                );
                return redirect()->route('admin.account.subcategorytwo.create')->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountMainCategory Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->route('admin.account.subcategorytwo.create')->with($notification);
        }
    }



}
