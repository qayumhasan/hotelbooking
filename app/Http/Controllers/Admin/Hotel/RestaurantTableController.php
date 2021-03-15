<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\RestaurantTable;
use App\Models\RestaurantTableType;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RestaurantTableController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function create(){
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltableype=RestaurantTableType::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.table_type.create',compact('allbranch','alltableype'));
    }

     // store
     public function store(Request $request){

        
        $validated = $request->validate([
            'table_type' => 'required|unique:restaurant_table_types',
        ]);

        $type = new RestaurantTableType();
        $type->table_type =$request->table_type;
        $type->block =$request->block;
        $type->is_active =$request->is_active; 
        $type->branch_id =$request->branch_id; 
        $type->entry_by =Auth::user()->id; 
        $type->entry_date =Carbon::now()->toDateTimeString(); 
        $type->date =Carbon::now()->toDateTimeString(); 

        if($type->save()){
            $notification=array(
                'messege'=>'Table Type Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Table Type Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }


    public function statusChange($id)
    {
        $status = RestaurantTableType::findOrFail($id);
        if($status->is_active == 1){
            $status->is_active = 0;
            if($status->save()){
                $notification=array(
                    'messege'=>'Table Type Status Change success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }

        }else{

            $status->is_active = 1;
            if($status->save()){
                $notification=array(
                    'messege'=>'Table Type Status Change success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }

        }
    }


    public function tableTypeDelete($id)
    {
        RestaurantTableType::findOrFail($id)->update([
            'is_deleted'=> 1,
        ]);

        $notification=array(
            'messege'=>'Table Type Deleted success',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }


    public function tableTypeEdit($id)
    {
        $edit = RestaurantTableType::findOrFail($id);
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltableype=RestaurantTableType::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.table_type.update',compact('allbranch','alltableype','edit'));

    }

    public function tableTypeUpdate(Request $request ,$id)
    {
       

        $validated = $request->validate([
            'table_type' => [
                'required',
                Rule::unique('restaurant_table_types')->ignore($id),
            ],
        ]);

        $type =RestaurantTableType::findOrFail($id);
        $type->table_type =$request->table_type;
        $type->block =$request->block;
        $type->is_active =$request->is_active; 
        $type->branch_id =$request->branch_id; 
        $type->updated_by =Auth::user()->id; 
        $type->updated_date =Carbon::now()->toDateTimeString(); 
        $type->date =Carbon::now()->toDateTimeString(); 

        if($type->save()){
            $notification=array(
                'messege'=>'Table Type Updated success',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.restaurnat.table.type.create')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Table Type Updated Faild',
                'alert-type'=>'error'
                );
            return redirect()->route('admin.restaurnat.table.type.create')->with($notification);
        }
    }


    // restaurent table area start

    public function tableCreate()
    {
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        
        $types = RestaurantTableType::where('is_deleted',0)->where('is_active',1)->get();
        
        return view('hotelbooking.restaurant_table.create',compact('allbranch','types'));
    }


    public function tableStore(Request $request)
    {
        
        $request->validate([
            'table_no' => 'required|unique:restaurant_tables',
            'branch_id'=>'required',
            'table_type'=>'required',
        ]);
        
        $table = new RestaurantTable();
        $table->table_no =$request->table_no;
        $table->branch_id =$request->branch_id;
        $table->table_type_id =$request->table_type;
        $table->details =$request->table_details;

        $table->is_active =$request->is_active; 
        $table->entry_by =Auth::user()->id; 
        $table->entry_date =Carbon::now()->toDateTimeString();  

        if($table->save()){
            $notification=array(
                'messege'=>'Table Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Table Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }


    public function tableList()
    {
        $tables=RestaurantTable::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.restaurant_table.index',compact('tables'));
    }

    public function tableStatusChange($id)
    {
        $status = RestaurantTable::findOrFail($id);
        if($status->is_active == 1){
            $status->is_active = 0;
            if($status->save()){
                $notification=array(
                    'messege'=>'Table Status Change success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }

        }else{

            $status->is_active = 1;
            if($status->save()){
                $notification=array(
                    'messege'=>'Table Status Change success',
                    'alert-type'=>'success'
                    );
                return redirect()->back()->with($notification);
            }

        }
    }


    public function tableEdit($id)
    {
        $allbranch=Branch::where('is_deleted',0)->where('is_active',1)->select(['branch_name','id'])->latest()->get();
        
        $types = RestaurantTableType::where('is_deleted',0)->where('is_active',1)->get();
        $edit = RestaurantTable::findOrFail($id);
        return view('hotelbooking.restaurant_table.update',compact('allbranch','types','edit'));
    }


    public function tableUpdate(Request $request,$id)
    {
        
        
        $request->validate([
            'table_no' => [
                'required',
                Rule::unique('restaurant_tables')->ignore($id),
            ],
            'branch_id'=>'required',
            'table_type'=>'required',
        ]);
        
        $table = RestaurantTable::findOrFail($id);
        $table->table_no =$request->table_no;
        $table->branch_id =$request->branch_id;
        $table->table_type_id =$request->table_type;
        $table->details =$request->table_details;

        $table->is_active =$request->is_active; 
        $table->updated_by =Auth::user()->id; 
        $table->updated_date =Carbon::now()->toDateTimeString();  

        if($table->save()){
            $notification=array(
                'messege'=>'Table Updated success',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.restaurnat.table')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Table Updated Faild',
                'alert-type'=>'error'
                );
            return redirect()->route('admin.restaurnat.table')->with($notification);
        }
    }


    public function tableDelete($id)
    {
        RestaurantTable::findOrFail($id)->update([
            'is_deleted'=> 1,
        ]);

        $notification=array(
            'messege'=>'Restaurant Table Deleted success',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }
}
