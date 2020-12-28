<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockCenter;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class StockCenterController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // create
    public function create(){
        $allstock=StockCenter::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.stockcenter.create',compact('allstock'));
    }
    // 
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:stock_centers|max:50',
        ]);
        $insert=StockCenter::insertGetId([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'date'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'Stock Center Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Stock Center Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
    // active
    public function active($id){
        $active=StockCenter::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'Stock Center Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Stock Center Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=StockCenter::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Stock Center DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Stock Center DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=StockCenter::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Stock Center Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Stock Center Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        // return $id;
        $edit=StockCenter::where('id',$id)->first();
        $allstock=StockCenter::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.stockcenter.update',compact('edit','allstock'));
    }
// update
    
    public function update(Request $request){
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('stock_centers')->ignore($request->id),
            ],
        ]);
        $update=StockCenter::where('id',$request->id)->update([
            'name'=>$request->name,
            'is_active'=>$request->is_active,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'Stock Center update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Stock Center update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }


}
