<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\ItemEntry;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MovingReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function fastMovingItemPage ()
    {
        $menucategories = MenuCategory::where('is_active',1)->where('is_deleted',0)->get();

        $firstmovings = ItemEntry::where('is_active',1)->whereNotNull ('no_of_sale')->orderBy('no_of_sale','DESC')->get();
        return view('restaurant.chui.moving_report.fast_moving',compact('menucategories','firstmovings'));
    }


    public function fastMovingItemSearch(Request $request)
    {
        $firstmovings = ItemEntry::where('category_name',$request->category)->where('is_active',1)->whereNotNull ('no_of_sale')->orderBy('no_of_sale','DESC')->get();

        
        return view('restaurant.chui.moving_report.ajax.fast_moving_ajax',compact('firstmovings'));

    }



    public function slowMovingItemPage ()
    {
        $menucategories = MenuCategory::where('is_active',1)->where('is_deleted',0)->get();
        $firstmovings = ItemEntry::where('is_active',1)->whereNotNull ('no_of_sale')->orderBy('no_of_sale','ASC')->get();
        return view('restaurant.chui.moving_report.slow_moving',compact('menucategories','firstmovings'));
    }


    public function slowMovingItemSearch(Request $request)
    {
        $firstmovings = ItemEntry::where('category_name',$request->category)->where('is_active',1)->whereNotNull ('no_of_sale')->orderBy('no_of_sale','ASC')->get();

        
        return view('restaurant.chui.moving_report.ajax.slow_moving_ajax',compact('firstmovings'));

    }


    public function nonMovingItemPage ()
    {
        $menucategories = MenuCategory::where('is_active',1)->where('is_deleted',0)->get();
        $firstmovings = ItemEntry::where('is_active',1)->whereNull ('no_of_sale')->get();
        return view('restaurant.chui.moving_report.non_moving',compact('menucategories','firstmovings'));
    }


    public function nonMovingItemSearch(Request $request)
    {
        
        $firstmovings = ItemEntry::where('category_name',$request->category)->where('is_active',1)->whereNull ('no_of_sale')->get();

        return view('restaurant.chui.moving_report.ajax.non_moving_ajax',compact('firstmovings'));

    }
}
