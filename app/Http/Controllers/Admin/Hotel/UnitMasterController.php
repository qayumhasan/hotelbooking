<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitMaster;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class UnitMasterController extends Controller
{
      // construct
    public function __construct(){
        $this->middleware('admin');
    }
    public function create(){
        $allunit=UnitMaster::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.unitmaster.create',compact('allunit'));
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:unit_masters|max:50',
        ]);
        $insert=UnitMaster::insertGetId([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'date'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'Unit Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Unit Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    //  // active
     public function active($id){
        $active=UnitMaster::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'UnitMaster Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'UnitMaster Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=UnitMaster::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'UnitMaster DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'UnitMaster DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=UnitMaster::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'UnitMaster Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'UnitMaster Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
     public function edit($id){
        // return $id;
        $edit=UnitMaster::where('id',$id)->first();
        $allunit=UnitMaster::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.unitmaster.update',compact('edit','allunit'));
    }
    // update
    public function update(Request $request){
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('unit_masters')->ignore($request->id),
            ],
        ]);
        $update=UnitMaster::where('id',$request->id)->update([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'UnitMaster update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'UnitMaster update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
