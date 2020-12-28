<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Floor;
use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class RoomController extends Controller
{
    // construct
    public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $room=Room::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.roomsetup.index',compact('room'));
    }
     // create
    public function create(){
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        $category=Room::where('is_deleted',0)->where('is_active',1)->select(['category'])->get();
        return view('hotelbooking.roomsetup.create',compact('allbranch','category'));
    }
    // get branch data
    public function getbranchdata($branch){
        $b_id=$branch;
        $roomtype=RoomType::where('is_deleted',0)->where('is_active',1)->where('branch_id',$b_id)->latest()->get();
        return response()->json($roomtype);
    }
    // get Floor Data
    public function getfloordata($branch){
        $floor=Floor::where('is_deleted',0)->where('is_active',1)->where('branch_id',$branch)->latest()->get();
        return response()->json($floor);
    }
    // get price
    public function getpricedata($roomtype){
        $roomtype=RoomType::where('id',$roomtype)->select(['id','price'])->first();
        return response()->json($roomtype);
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'room_no' => 'required|unique:rooms|max:30',
            'branch_id' => 'required',
            'room_type'=>'required',
            'tariff'=>'required',
            'floor'=>'required',
        ]);
        $insert=Room::insertGetId([
            'room_no'=>$request->room_no,
            'branch_id'=>$request->branch_id,
            'room_type'=>$request->room_type,
            'tariff'=>$request->tariff,
            'toilet'=>$request->toilet,
            'floor'=>$request->floor,
            'category'=>$request->category,
            'room_details'=>$request->room_details,
            'is_active'=>$request->is_active,
            'date'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'Room Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Room Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }

    // 
     // active
     public function active($id){
        $active=Room::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'Room Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Room Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=Room::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Room DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Room DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=Room::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Room Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Room Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
     public function edit($id){
        // return $id;
        $edit=Room::where('id',$id)->first();
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        $category=Room::where('is_deleted',0)->where('is_active',1)->select(['category'])->get();
       
        return view('hotelbooking.roomsetup.update',compact('edit','allbranch','category'));
    }
    // update
    public function update(Request $request){
        $validated = $request->validate([
            'room_no' => [
                'required',
                Rule::unique('rooms')->ignore($request->id),
            ],
            'branch_id' => 'required',
            'room_type'=>'required',
            'tariff'=>'required',
            'floor'=>'required',
        ]);
        $update=Room::where('id',$request->id)->update([
            'room_no'=>$request->room_no,
            'branch_id'=>$request->branch_id,
            'room_type'=>$request->room_type,
            'tariff'=>$request->tariff,
            'toilet'=>$request->toilet,
            'floor'=>$request->floor,
            'category'=>$request->category,
            'room_details'=>$request->room_details,
            'is_active'=>$request->is_active,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'Room update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Room update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
