<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuType;
use Auth;
use Carbon\Carbon;

class MenuTypeController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // index
  
    // create
    public function create(){
        $alldata=MenuType::where('is_deleted',0)->latest()->get();
        return view('banquet.menutype.create',compact('alldata'));
    }
    // store
    public function store(Request $request){
        //return $request;
        $validated = $request->validate([
            'menutype_name' => 'required',
            'corporate_price' => 'required',
            'individual_price' => 'required',
            'ngo_price' => 'required',
        ]);
        $insert=MenuType::insert([
            'menutype_name'=>$request->menutype_name,
            'corporate_price'=>$request->corporate_price,
            'individual_price'=>$request->individual_price,
            'ngo_price'=>$request->ngo_price,
            'is_active'=>$request->is_active,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
        ]);
        if($insert){
            $notification = array(
                'messege' => 'MenyType Insert Success!',
                'alert-type' =>'success'
                );
          return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'MenyType Insert Faild!',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    // 
      // active
      public function active($id){
        $active=MenuType::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'MenuType Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuType Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=MenuType::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'MenuType DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuType DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=MenuType::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'MenuType Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuType Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        //return $id;
        $edit=MenuType::where('id',$id)->first();
        $alldata=MenuType::where('is_deleted',0)->latest()->get();
        return view('banquet.menutype.update',compact('edit','alldata'));
    }

    //update
    public function update(Request $request){
        $validated = $request->validate([
            'menutype_name' => 'required',
            'corporate_price' => 'required',
            'individual_price' => 'required',
            'ngo_price' => 'required',
        ]);
        $insert=MenuType::where('id',$request->id)->update([
            'menutype_name'=>$request->menutype_name,
            'corporate_price'=>$request->corporate_price,
            'individual_price'=>$request->individual_price,
            'ngo_price'=>$request->ngo_price,
            'is_active'=>$request->is_active,
            'updated_at'=>Carbon::now()->toDateTimeString(),
            'updated_by'=>Auth::user()->id,
        ]);
        if($insert){
            $notification = array(
                'messege' => 'MenyType Update Success!',
                'alert-type' =>'success'
                );
          return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'MenyType Update Faild!',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

}
