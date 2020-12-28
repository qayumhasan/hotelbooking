<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class BranchController extends Controller
{
    // construct
    public function __construct(){
    	$this->middleware('admin');
    }
    // 
    public function index(){
        $allbranch=Branch::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.branch.index',compact('allbranch'));
    }
    // create
    public function create(){
        return view('hotelbooking.branch.create');
    }
    // submit
    public function store(Request $request){
        $validated = $request->validate([
            'branch_id' => 'required|unique:branches|max:20',
            'branch_name' => 'required',
        ]);
        $insert=Branch::insert([
            'date'=>Carbon::now()->toDateTimeString(),
            'branch_id'=>$request->branch_id,
            'branch_name'=>$request->branch_name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'web_address'=>$request->web_address,
            'address'=>$request->address,
            'is_active'=>$request->is_active,
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'Branch Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Branch Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // branch active
    public function active($id){
        $active=Branch::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'Branch Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Branch Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=Branch::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Branch DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Branch DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=Branch::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Branch Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Branch Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // edit
    public function edit($id){
        $data=Branch::where('id',$id)->first();
        return view('hotelbooking.branch.update',compact('data'));
    }
    // update
    public function update(Request $request){
        $validatedData = $request->validate([
            'branch_id' =>  [
                'required',
                Rule::unique('branches')->ignore($request->id),
            ],
            'branch_name' => 'required',
        ]);
        $update=Branch::where('id',$request->id)->update([
            'branch_id'=>$request->branch_id,
            'branch_name'=>$request->branch_name,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'web_address'=>$request->web_address,
            'address'=>$request->address,
            'is_active'=>$request->is_active,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'Branch Update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Branch Update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
}
