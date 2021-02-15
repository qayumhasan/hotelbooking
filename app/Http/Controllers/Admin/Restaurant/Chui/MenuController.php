<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\ItemEntry;
use App\Models\MenuCategory;
use App\Models\MenuInventory;
use App\Models\SideMenu;
use App\Models\UnitMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function menuCategory()
    {
        $categores = MenuCategory::where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        return view('restaurant.chui.menu.menu_category', compact('categores'));
    }

    public function menuCategoryUpdate(Request $request)
    {
        $data = $request->validate([
            'category' => 'required',
            'under_category' => 'required',
        ]);

        MenuCategory::where('id', $request->id)->update([
            'name' => $request->category,
            'under_category' => $request->under_category,
        ]);
        $notification = array(
            'messege' => 'Menu Category Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function menuCategoryStore(Request $request)
    {
        $data = $request->validate([
            'category' => 'required',
            'under_category' => 'required',
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
        $allitem = ItemEntry::with(['category', 'unit'])->where('is_deleted', 0)->latest()->get();
        return view('restaurant.chui.menu.menu_config.index', compact('allitem'));
    }



    /**
     * Show the menu config page.
     *
     * @return \Illuminate\View\View
     */

    public function menuConfigCreate()
    {
        $category = MenuCategory::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        $unit = UnitMaster::where('is_deleted', 0)->where('is_active', 1)->latest()->get();

        return view('restaurant.chui.menu.menu_config.create', compact('category', 'unit'));
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
        $insert = ItemEntry::insertGetId([
            'item_name' => $request->item_name,
            'short_name' => $request->short_name,
            'category_name' => $request->category_name,
            'unit_name' => $request->unit_name,
            'rate' => $request->rate,
            'min_level' => $request->min_level,
            'menu_item' => $request->menu_type,
            'is_active' => $request->is_active,
            'is_stock' => $request->direct_stock,
            'is_vat' => $request->add_vat,
            'date' => Carbon::now()->toDateTimeString(),
            'entry_by' => Auth::user()->id,
            'entry_date' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);


        if ($insert) {
            $notification = array(
                'messege' => 'MenuCategory Created success',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.restaurant.chui.menu.config')->with($notification);
        } else {
            $notification = array(
                'messege' => 'MenuCategory Created Faild',
                'alert-type' => 'error'
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
        $items = ItemEntry::findOrFail($id);

        if ($items->is_active == 0) {
            $items->is_active = 1;
            $items->save();
            $notification = array(
                'messege' => 'MenuCategory status change success',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } else {

            $items->is_active = 0;
            $items->save();

            $notification = array(
                'messege' => 'MenuCategory status change success',
                'alert-type' => 'error'
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
        $edit = ItemEntry::where('id', $id)->first();
        $category = MenuCategory::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        $unit = UnitMaster::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        return view('restaurant.chui.menu.menu_config.update', compact('edit', 'category', 'unit'));
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
        $update = ItemEntry::where('id', $request->id)->update([
            'item_name' => $request->item_name,
            'short_name' => $request->short_name,
            'category_name' => $request->category_name,
            'unit_name' => $request->unit_name,
            'rate' => $request->rate,
            'min_level' => $request->min_level,
            'menu_item' => $request->menu_type,
            'is_active' => $request->is_active,
            'is_stock' => $request->direct_stock,
            'is_vat' => $request->add_vat,
            'updated_by' => Auth::user()->id,
            'updated_date' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if (!isset($request->direct_stock)) {
            $update = ItemEntry::where('id', $request->id)->update([
                'is_stock' => 0,
            ]);
        }

        if (!isset($request->add_vat)) {
            $update = ItemEntry::where('id', $request->id)->update([
                'is_vat' => 0,
            ]);
        }


        if ($update) {
            $notification = array(
                'messege' => 'ItemEntry Update success',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.restaurant.chui.menu.config')->with($notification);
        } else {
            $notification = array(
                'messege' => 'ItemEntry Update Faild',
                'alert-type' => 'error'
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
        $delete = ItemEntry::where('id', $id)->update([
            'is_deleted' => 1,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
        if ($delete) {
            $notification = array(
                'messege' => 'ItemEntry Delete success',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Floor Delete Faild',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * 
     * Show menu inventory  .
     * 
     * @return view
     */

    public function menuInventory()
    {

        $items = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        $categores = MenuCategory::where('is_deleted', 0)->where('is_active', 1)->latest()->get();

        $inventores = MenuInventory::with(['fgoods_item' => function ($q) {
                $q->select('id', 'name');
            }, 'item' => function ($q) {
                $q->select('id', 'item_name');
            }, 'unit_item' => function ($q) {
                $q->select('id','name');
            }])
            ->select('unit', 'qty', 'id', 'fgoods', 'raw_material')->where('is_deleted', 0)->get();



        $inventores = $inventores->groupBy('fgoods');
        $inventores = $inventores->all();

        return view('restaurant.chui.menu.menu_inventory', compact('items', 'categores', 'inventores'));
    }

    /**
     * 
     * get menu items.
     * @param Request $request
     * @return $notification
     */

    public function menuInventoryGetItem($id)
    {
        return $item = ItemEntry::with('unit')->findOrFail($id);

        return response()->json($item);
    }

    /**
     * 
     * store menu Inventorry .
     * @param Request $request
     * @return $notification
     */

    public function menuInventoryStore(Request $request)
    {
       

        $validator = Validator::make($request->all(), [
            'finished_goods' => 'required',
        ]);
        if ($validator->fails()) {
            $notification = array(
                'messege' => 'Please Add Some Item',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


        $counts = count($request->finished_goods);

        for ($i = 0; $i < $counts; $i++) {

            $inventory = new MenuInventory();
            $inventory->order_id =$request->order_id[$i];
            $inventory->fgoods = $request->finished_goods[$i];
            $inventory->raw_material = $request->raw_metarials[$i];
            $inventory->unit = $request->units[$i];
            $inventory->qty = $request->qty[$i];
            $inventory->entry_by = Auth::user()->id;
            $inventory->entry_date = Carbon::now();
            $inventory->save();
        }

        $notification = array(
            'messege' => 'Menu Inventory Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function menuInventoryEdit($id)
    {
        $items = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        $categores = MenuCategory::where('is_deleted', 0)->where('is_active', 1)->latest()->get();

        $inventores = MenuInventory::where('fgoods',$id)->where('is_deleted', 0)->where('is_active', 1)->latest()->get();

        return view('restaurant.chui.menu.edit_menu_inventory', compact('items', 'categores', 'inventores'));
    }

    public function menuInventoryUpdate(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'finished_goods' => 'required',
        ]);
        if ($validator->fails()) {
            $notification = array(
                'messege' => 'Please Add Some Item',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


        $counts = count($request->finished_goods);

        for ($i = 0; $i < $counts; $i++) {
            $checkdata =MenuInventory::where('order_id',$request->order_id[$i])->first();

            if($checkdata){
                $checkdata->order_id =$request->order_id[$i];
                $checkdata->fgoods = $request->finished_goods[$i];
                $checkdata->raw_material = $request->raw_metarials[$i];
                $checkdata->unit = $request->units[$i];
                $checkdata->qty = $request->qty[$i];
                $checkdata->entry_by = Auth::user()->id;
                $checkdata->entry_date = Carbon::now();
                $checkdata->save();
            }else{
                $inventory = new MenuInventory();
                $inventory->order_id =$request->order_id[$i];
                $inventory->fgoods = $request->finished_goods[$i];
                $inventory->raw_material = $request->raw_metarials[$i];
                $inventory->unit = $request->units[$i];
                $inventory->qty = $request->qty[$i];
                $inventory->entry_by = Auth::user()->id;
                $inventory->entry_date = Carbon::now();
                $inventory->save();
            }  
        }

        $notification = array(
            'messege' => 'Menu Inventory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.restaurant.chui.menu.inventory')->with($notification);
    }


    public function menuInventoryDelete($id)
    {
        MenuInventory::where('fgoods',$id)->delete();
        $notification = array(
            'messege' => 'Menu Inventory Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.restaurant.chui.menu.inventory')->with($notification);
        
    }


    public function SideMenu()
    {
       
        $items = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        $sidemenus = [];
        return view('restaurant.chui.menu.side_menu',compact('items','sidemenus'));
    }


    public function SideMenuStore(Request $request)
    {

        $request->validate([
            'main_menu'=>'required',
            'side_menu'=>'required',
        ]);

        if($request->side_menu == $request->main_menu){
            $notification = array(
                'messege' => 'Can not store same item in side menu!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.restaurant.chui.menu.side')->with($notification);
        }
        
        $menus = SideMenu::where('main_id',$request->main_menu)->first();
        
        if($menus){

            $itemdata = [];
            $side_menu = array();
            $side_menu['item_id'] = $request->side_menu;
            $side_menu['item_name'] = $request->item_name;
            array_push($itemdata,$side_menu);

            foreach (json_decode($menus->items) as  $row) {
                if($row->item_id == $request->side_menu){
                    $notification = array(
                        'messege' => 'This Item already exist on list!',
                        'alert-type' => 'success'
                    );
        
                    return back()->with($notification);
                }
                $side_menu['item_id'] = $row->item_id;
                $side_menu['item_name'] = $row->item_name;
                array_push($itemdata,$side_menu);
            }

            $menus->items = json_encode($itemdata);
            $menus->updated_by = Auth::user()->id;
            $menus->updated_date = Carbon::now();
            $menus->save();

        }else{
            // array_push($side_menu,$request->side_menu);
            $itemdata = [];
            $side_menu = array();
            $side_menu['item_id'] = $request->side_menu;
            $side_menu['item_name'] = $request->item_name;
            array_push($itemdata,$side_menu);


            $sidemenu = new SideMenu();
            $sidemenu->main_id = $request->main_menu;
            $sidemenu->items = json_encode($itemdata);
            $sidemenu->entry_by = Auth::user()->id;
            $sidemenu->entry_date = Carbon::now();
            $sidemenu->save();

            
        }
        $items = ItemEntry::where('is_deleted', 0)->where('is_active', 1)->latest()->get();
        $sidemenus = SideMenu::where('main_id',$request->main_menu)->where('is_deleted', 0)->get();
        return view('restaurant.chui.menu.side_menu',compact('items','sidemenus'));
        // return back()->with(compact('items','sidemenus'));
    }



    public function menuSideMenuItem($id)
    {
        $sidemenus = SideMenu::where('main_id',$id)->where('is_deleted', 0)->get();
        return view('restaurant.chui.menu.ajax.side_menu_ajax',compact('sidemenus'));
    }


    public function SideMenuDelete($main,$side)
    {
        $side = SideMenu::where('id',$main)->first();

        // foreach (json_decode($side->items) as $row) {
        //     if($row->item_id != $side){
        //         $side->update([
        //             'items'=>json_encode($row),
        //         ]);
        //     }
        // }

        

        return back();

    }
}
