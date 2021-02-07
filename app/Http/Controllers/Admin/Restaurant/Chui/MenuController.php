<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\ItemEntry;
use App\Models\MenuCategory;
use App\Models\UnitMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function menuCategory()
    {
        $categores = MenuCategory::where('is_deleted',0)->orderBy('id','DESC')->get();
        return view('restaurant.chui.menu.menu_category',compact('categores'));
    }

    public function menuCategoryUpdate (Request $request)
    {
        $data =$request->validate([
            'category'=>'required',
            'under_category'=>'required',
        ]);

        MenuCategory::where('id',$request->id)->update([
            'name'=>$request->category,
            'under_category'=>$request->under_category,
        ]);
        $notification = array(
            'messege' => 'Menu Category Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function menuCategoryStore(Request $request)
    {
        $data =$request->validate([
            'category'=>'required',
            'under_category'=>'required',
        ]);

        $cat = new MenuCategory();
        $cat->name = $request->category;
        $cat->under_category = $request->under_category;
        $cat->save();

        $notification = array(
            'messege' => 'Menu Category Created Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    // menu config area start

    /**
     * Show the menu config data.
     *
     * @return \Illuminate\View\View
     */

    public function menuConfig()
    {
        $allitem=ItemEntry::with(['category','unit'])->where('is_deleted',0)->latest()->get();
        return view('restaurant.chui.menu.menu_config.index',compact('allitem'));
    }

    

      /**
     * Show the menu config page.
     *
     * @return \Illuminate\View\View
     */

    public function menuConfigCreate()
    {
        $category=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $unit=UnitMaster::where('is_deleted',0)->where('is_active',1)->latest()->get();
        
        return view('restaurant.chui.menu.menu_config.create',compact('category','unit'));
    }

    
      /**
     * Store menu config Items.
     * @param Request $request
     * @return \Illuminate\View\View
     */

    public function menuConfigStore(Request $request)
    {
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
            'is_stock'=>$request->direct_stock,
            'is_vat'=>$request->add_vat,
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
            return redirect()->route('admin.restaurant.chui.menu.config')->with($notification);
        }else{
            $notification=array(
                'messege'=>'MenuCategory Created Faild',
                'alert-type'=>'error'
                );
            return redirect()->route('admin.restaurant.chui.menu.config')->with($notification);
        }
    }


       /**
     * Store menu config status change.
     * @param $id
     * @return notification
     */

    public function menuConfigStatus($id)
    {
        $items =ItemEntry::findOrFail($id);

        if($items->is_active == 0){
            $items->is_active =1;
            $items->save();
            $notification=array(
                'messege'=>'MenuCategory status change success',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }else{

            $items->is_active =0;
            $items->save();

            $notification=array(
                'messege'=>'MenuCategory status change success',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }
    }

    
       /**
     * Store menu config status change.
     * @param $id
     * @return \Illuminate\View\View
     */

    public function menuConfigEdit($id)
    {
        $edit=ItemEntry::where('id',$id)->first();
        $category=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $unit=UnitMaster::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('restaurant.chui.menu.menu_config.update',compact('edit','category','unit'));
    }

      /**
       * 
     * Update menu config .
     * @param Request $request
     * @return $notification
     */

    public function menuConfigUpdate(Request $request)
    {

        
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
            'is_stock'=>$request->direct_stock,
            'is_vat'=>$request->add_vat,
            'updated_by'=>Auth::user()->id,
            'updated_date'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if(!isset($request->direct_stock)){
            $update=ItemEntry::where('id',$request->id)->update([
                'is_stock'=>0,
            ]);
        }
        
        if(!isset($request->add_vat)){
            $update=ItemEntry::where('id',$request->id)->update([
                'is_vat'=>0,
            ]);
        }


        if($update){
            $notification=array(
                'messege'=>'ItemEntry Update success',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.restaurant.chui.menu.config')->with($notification);
        }else{
            $notification=array(
                'messege'=>'ItemEntry Update Faild',
                'alert-type'=>'error'
                );
            return redirect()->route('admin.restaurant.chui.menu.config')->with($notification);
        }
    }

     /**
       * 
     * Delete menu config .
     * @param $id
     * @return $notification
     */
    public function menuConfigDelete($id)
    {
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


    public function menuInventory()
    {
        return view('restaurant.chui.menu.menu_inventory');
    }
}
