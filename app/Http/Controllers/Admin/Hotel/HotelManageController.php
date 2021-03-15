<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class HotelManageController extends Controller
{
    // construct
    public function __construct(){
        $this->middleware('admin');
    }
    // home
    public function index(){
        $rooms = RoomType::with('rooms')->where('is_active',1)->where('is_deleted',0)->get();
        return view('hotelbooking.home.index',compact('rooms'));
    }
}
