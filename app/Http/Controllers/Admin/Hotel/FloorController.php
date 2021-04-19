<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Floor;
use Illuminate\Validation\Rule;
use App\Models\Branch;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

class FloorController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){

    }
    // create
    public function create(){
        $branch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        $allfloor=Floor::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.floor.create',compact('branch','allfloor'));
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $insert=Floor::insert([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'date'=>Carbon::now()->toDateTimeString(),
            'branch_id'=>$request->branch_id,
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'Floor Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Floor Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // active
    public function active($id){
        $active=Floor::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'Floor Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Floor Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=Floor::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Floor DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Floor DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=Floor::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Floor Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Floor Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
     public function edit($id){
        // return $id;
        $edit=Floor::where('id',$id)->first();
        $branch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        $allfloor=Floor::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.floor.update',compact('edit','branch','allfloor'));
    }
    // update
    public function update(Request $request){
          

        $validatedData = $request->validate([
            'name' =>  [
                'required',
            ],
           
        ]);
        $update=Floor::where('id',$request->id)->update([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'branch_id'=>$request->branch_id,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'Floor update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Floor update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
