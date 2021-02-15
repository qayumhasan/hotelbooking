<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class OtherInfoController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function OtherInfo()
    {
        $tables = RestaurantTable::where('is_deleted',0)->where('is_active',1)->get();
        return view('restaurant.chui.otherinfo.kot_history',compact('tables'));
    }
}
