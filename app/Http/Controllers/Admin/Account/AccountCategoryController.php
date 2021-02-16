<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use Carbon\Carbon;
use DB;
use Auth;


class AccountCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // 
    public function create(){
        $allcategory=AccountCategory::where('is_deleted',0)->get();
        return view('accounts.category.create',compact('allcategory'));
    }

    // 
    public function store(Request $request){

        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        $insert=AccountCategory::insertGetId([
            'category_name'=>$request->category_name,
            'category_code'=>'',
            'is_active'=>$request->is_active,
            'entry_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        AccountCategory::where('id',$insert)->update([
            'category_code'=>$insert,
        ]);


        if($insert) {
            $notification = array(
                'messege' => 'Insert Successful',
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

      // active
      public function active($id){
        $active=AccountCategory::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'AccountCategory Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'AccountCategory Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=AccountCategory::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'AccountCategory DeActive success',
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
        $edit=AccountCategory::where('id',$id)->first();
        $allcategory=AccountCategory::where('is_deleted',0)->get();
        return view('accounts.category.update',compact('edit','allcategory'));
    }
    // update
    public function update(Request $request){

        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        $update=AccountCategory::where('id',$request->id)->update([
            'category_name'=>$request->category_name,
            'is_active'=>$request->is_active,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
    
        if($update) {
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
        }
    }
}
