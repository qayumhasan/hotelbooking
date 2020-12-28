<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class MenuCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // create
    public function create(){
        $allmenu=MenuCategory::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.menucategory.create',compact('allmenu'));
    }
      // store
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:menu_categories|max:50',
        ]);
        $insert=MenuCategory::insertGetId([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'date'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'MenuCategory Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    // 
  // active
    public function active($id){
        $active=MenuCategory::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'MenuCategory Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=MenuCategory::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'MenuCategory DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=MenuCategory::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'MenuCategory Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        // return $id;
        $edit=MenuCategory::where('id',$id)->first();
        $allmenu=MenuCategory::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.menucategory.update',compact('edit','allmenu'));
    }
    // update

     public function update(Request $request){
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('menu_categories')->ignore($request->id),
            ],
        ]);
        $update=MenuCategory::where('id',$request->id)->update([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'MenuCategory update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
