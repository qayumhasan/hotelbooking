<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class SupplierController extends Controller
{
     // construct
     public function __construct(){
    	$this->middleware('admin');
    }
    //index
    public function index(){
        $allsupplier=Supplier::where('is_deleted',0)->orderBy('id','DESC')->get();
        return view('hotelbooking.supplier.index',compact('allsupplier'));
    } 

    // create
    public function create(){
        return view('hotelbooking.supplier.create');
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $insert=Supplier::insertGetId([
            'title'=>$request->title,
            'name'=>$request->name,
            'print_name'=>$request->print_name,
            'designation'=>$request->designation,
            'tin_vat_no'=>$request->tin_vat_no,
            'addressline_one'=>$request->addressline_one,
            'addressline_two'=>$request->addressline_two,
            'city'=>$request->city,
            'zip_code'=>$request->zip_code,
            'telephone'=>$request->telephone,
            'contact_persion'=>$request->contact_persion,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'gender'=>$request->gender,

            'account_head'=>$request->account_head,
            'account_code'=>$request->account_head_code,

            'is_active'=>$request->is_active,
            'date'=>$request->date,
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $update=Supplier::where('id',$insert)->update([
            'supplier_id'=>'supplier-'.$insert,
        ]);

        if($insert){
            $notification=array(
                'messege'=>'Supplier Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Supplier Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }
     // active
     public function active($id){
        $active=Supplier::where('id',$id)->update([
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
        $deactive=Supplier::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Supplier DeActive success',
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
        $delete=Supplier::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Supplier Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Supplier Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // edit
    public function edit($id){
        $edit=Supplier::where('id',$id)->first();
        return view('hotelbooking.supplier.update',compact('edit'));
    }

    public function update(Request $request){
        $validated = $request->validate([
            'title' => 'required',
            'name' => 'required',
            'mobile' => 'required',
        ]);
        $update=Supplier::where('id',$request->id)->update([
            'title'=>$request->title,
            'name'=>$request->name,
            'print_name'=>$request->print_name,
            'designation'=>$request->designation,
            'tin_vat_no'=>$request->tin_vat_no,
            'addressline_one'=>$request->addressline_one,
            'addressline_two'=>$request->addressline_two,
            'city'=>$request->city,
            'zip_code'=>$request->zip_code,
            'telephone'=>$request->telephone,
            'contact_persion'=>$request->contact_persion,
            'mobile'=>$request->mobile,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'is_active'=>$request->is_active,
            'date'=>$request->date,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($update){
            $notification=array(
                'messege'=>'Supplier Updated success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Supplier Updated Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

}
