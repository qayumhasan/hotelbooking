<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingFor;
use Auth;
use Carbon\Carbon;


class BookingforController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    
   
    // create
    public function create(){
        $alldata=BookingFor::where('is_deleted',0)->latest()->get();
        return view('banquet.bookingfor.create',compact('alldata'));
    }
    // 
    public function store(Request $request){
        //return $request;
        $validated = $request->validate([
            'booking_for' => 'required',
        ]);
        $insert=BookingFor::insert([
            'booking_for'=>$request->booking_for,
            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
        ]);
        if($insert){
            $notification = array(
                'messege' => 'BookingFor Insert Success!',
                'alert-type' =>'success'
                );
          return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'BookingFor Insert Success!',
                'alert-type' =>'error'
                );
          return redirect()->back()->with($notification);
        };
    }
    // 
     // active
     public function active($id){
        $active=BookingFor::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'BookingFor Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'BookingFor Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=BookingFor::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'BookingFor DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'BookingFor DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=BookingFor::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'BookingFor Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'BookingFor Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        //return $id;
        $edit=BookingFor::where('id',$id)->first();
        $alldata=BookingFor::where('is_deleted',0)->latest()->get();
        return view('banquet.bookingfor.update',compact('edit','alldata'));
    }
}
