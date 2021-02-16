<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Models\AccountMainCategory;
use Carbon\Carbon;
use Auth;

class AccountMainCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // 
    public function create(){
        $allcategory=AccountCategory::get();
        $allmaincategory=AccountMainCategory::where('is_deleted',0)->get();
        return view('accounts.maincategory.create',compact('allcategory','allmaincategory'));
    }
    // 
    public function store(Request $request){
        $validated = $request->validate([
            'maincategory_name' => 'required',
            'category' => 'required',
        ]);
        $cate_id=AccountCategory::where('id',$request->category)->select(['category_code','category_name'])->first();
        $insert=AccountMainCategory::insertGetId([
            'maincategory_name'=>$request->maincategory_name,
            'category_id'=>$request->category,
            'category_code'=>$cate_id->category_code,
            'category_name'=>$cate_id->category_name,
            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateString(),
            'entry_by'=>Auth::user()->id,
        ]);
        AccountMainCategory::where('id',$insert)->update([
            'maincategory_code'=>$cate_id->category_code.$insert,
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
        // active
        public function active($id){
            $active=AccountMainCategory::where('id',$id)->update([
                'is_active'=>1,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($active){
                $notification=array(
                    'messege'=>'AccountMainCategory Active success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }else{
                $notification=array(
                    'messege'=>'AccountMainCategory Active Faild',
                    'alert-type'=>'error'
                    );
                return redirect()->back()->with($notification);
            }
    
    
        }
        // deactive
        public function deactive($id){
            $deactive=AccountMainCategory::where('id',$id)->update([
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
            $edit=AccountMainCategory::where('id',$id)->first();
            $allcategory=AccountCategory::where('is_deleted',0)->get();
            $allmaincategory=AccountMainCategory::where('is_deleted',0)->get();
            return view('accounts.maincategory.update',compact('edit','allcategory','allmaincategory'));
        }
        // updaate
        public function update(Request $request){

            $validated = $request->validate([
                'maincategory_name' => 'required',
                'category' => 'required',
            ]);
            $cate_id=AccountCategory::where('id',$request->category)->select(['category_code','category_name'])->first();
            $insert=AccountMainCategory::where('id',$request->id)->update([
                'maincategory_name'=>$request->maincategory_name,
                'category_id'=>$request->category,
                'category_code'=>$cate_id->category_code,
                'category_name'=>$cate_id->category_name,
                'is_active'=>$request->is_active,
                'updated_at'=>Carbon::now()->toDateString(),
                'updated_by'=>Auth::user()->id,
            ]);
            AccountMainCategory::where('id',$request->id)->update([
                'maincategory_code'=>$cate_id->category_code.$request->id,
            ]);
    
            if($insert) {
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
        // 
        public function delete($id){
            $delete=AccountMainCategory::where('id',$id)->update([
                'is_deleted'=>1,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($delete){
                $notification=array(
                    'messege'=>'AccountMainCategory Delete success',
                    'alert-type'=>'success'
                    );
                    return redirect()->route('admin.account.maincategory.create')->with($notification);
            }else{
                $notification=array(
                    'messege'=>'AccountMainCategory Delete Faild',
                    'alert-type'=>'error'
                    );
                return redirect()->route('admin.account.maincategory.create')->with($notification);
            }
        }
}
