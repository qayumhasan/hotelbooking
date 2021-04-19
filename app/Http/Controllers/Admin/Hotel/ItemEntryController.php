<?php
namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuCategory;
use App\Models\UnitMaster;
use App\Models\ItemEntry;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;
use Auth;

class ItemEntryController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $allitem=ItemEntry::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.itementry.index',compact('allitem'));
    }

    public function create(){
        $category=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $unit=UnitMaster::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.itementry.create',compact('category','unit'));
    }
    // store
    public function store(Request $request){
        $validated = $request->validate([
            'item_name' => 'required|unique:item_entries|max:50',
        ]);
        $insert=ItemEntry::insertGetId([
            'item_name'=>$request->item_name,
            'short_name'=>$request->short_name,
            'category_name'=>$request->category_name,
            'unit_name'=>$request->unit_name,
            'rate'=>$request->rate,
            'min_level'=>$request->min_level,
            'menu_item'=>$request->menu_type,
            'is_active'=>$request->is_active,
            'is_stock' => $request->direct_stock,
            'is_vat' => $request->add_vat,
            'date'=>Carbon::now()->toDateTimeString(),
            'entry_by'=>Auth::user()->id,
            'entry_date'=>Carbon::now()->toDateTimeString(),
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            $notification=array(
                'messege'=>'MenuCategory Created success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

     // active
     public function active($id){
        $active=ItemEntry::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'ItemEntry Active success',
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
        $deactive=ItemEntry::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'ItemEntry DeActive success',
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
        $delete=ItemEntry::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'ItemEntry Delete success',
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
        
        $edit=ItemEntry::where('id',$id)->first();
        $category=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $unit=UnitMaster::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.itementry.update',compact('edit','category','unit'));
    }

    // update
    public function update(Request $request){
        $validated = $request->validate([
            'item_name' => [
                'required',
                Rule::unique('item_entries')->ignore($request->id),
            ],
        ]);
        $update=ItemEntry::where('id',$request->id)->update([
            'item_name'=>$request->item_name,
            'short_name'=>$request->short_name,
            'category_name'=>$request->category_name,
            'unit_name'=>$request->unit_name,
            'rate'=>$request->rate,
            'min_level'=>$request->min_level,
            'menu_item'=>$request->menu_type,
            'is_active'=>$request->is_active,
            'is_stock' => $request->direct_stock,
            'is_vat' => $request->add_vat,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            $notification=array(
                'messege'=>'ItemEntry Update success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'ItemEntry Update Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

}
