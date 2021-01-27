<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use Auth;
use Carbon\Carbon;

class HallController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // index
    public function index(){
        $allvenue=Venue::where('is_deleted',0)->latest()->get();
        return view('banquet.hall.index',compact('allvenue'));
    }
    // create
    public function create(){
       
        return view('banquet.hall.create');
    }
    // store
    public function store(Request $request){
        //return $request;
        $validated = $request->validate([
            'venue_name' => 'required',
            'mobile' => 'required',
        ]);
        $insert=Venue::insert([
            'venue_name'=>$request->venue_name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'facebook_link'=>$request->facebook_link,
            'address'=>$request->address,
            'google_map'=>$request->google_map,
            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
           
        ]);
        if($insert){
            $notification = array(
                'messege' => 'Venue Insert Success!',
                'alert-type' =>'success'
                );
          return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Venue Insert Success!',
                'alert-type' =>'error'
                );
          return redirect()->back()->with($notification);
        }

    }
    //
     // active
     public function active($id){
        $active=Venue::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'Venue Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Venue Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=Venue::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Venue DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Venue DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=Venue::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Venue Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Venue Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        // return $id;
        $edit=Venue::where('id',$id)->first();
        $allvenue=Venue::where('is_deleted',0)->latest()->get();
        return view('banquet.hall.update',compact('edit','allvenue'));
    }

    // update
    public function update(Request $request){
        $validated = $request->validate([
            'venue_name' => 'required',
            'mobile' => 'required',
        ]);
        $insert=Venue::where('id',$request->id)->update([
            'venue_name'=>$request->venue_name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'facebook_link'=>$request->facebook_link,
            'address'=>$request->address,
            'google_map'=>$request->google_map,
            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
           
        ]);
        if($insert){
            $notification = array(
                'messege' => 'Venue Update Success!',
                'alert-type' =>'success'
                );
          return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Venue Update Success!',
                'alert-type' =>'error'
                );
          return redirect()->back()->with($notification);
        }
    }

}
