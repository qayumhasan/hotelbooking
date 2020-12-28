<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\RoomType;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class RoomTypeController extends Controller
{
    // construct
    public function __construct(){
    	$this->middleware('admin');
    }
    // create
    public function create(){
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allroomtype=RoomType::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.roomtype.create',compact('allbranch','allroomtype'));
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'room_type' => 'required|unique:room_types|max:30',
        ]);
        $insert=RoomType::insert([
            'room_type'=>$request->room_type,
            'block'=>$request->block,
            'price'=>$request->price,
            'is_active'=>$request->is_active,
            'date'=>Carbon::now()->toDateTimeString(),
            'branch_id'=>$request->branch_id,
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'Room Type Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Room Type Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
      // active
    public function active($id){
        $active=RoomType::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'RoomType Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'RoomType Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=RoomType::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'RoomType DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'RoomType DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=RoomType::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'RoomType Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'RoomType Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        // return $id;
        $edit=RoomType::where('id',$id)->first();
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        $allroomtype=RoomType::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.roomtype.update',compact('edit','allbranch','allroomtype'));
    }

    // update
    public function update(Request $request){
        
        $validatedData = $request->validate([
            'room_type' =>  [
                'required',
                Rule::unique('room_types')->ignore($request->id),
            ],
           
        ]);
        $update=RoomType::where('id',$request->id)->update([
            'room_type'=>$request->room_type,
            'block'=>$request->block,
            'price'=>$request->price,
            'is_active'=>$request->is_active,
            'branch_id'=>$request->branch_id,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'RoomType update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'RoomType update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
