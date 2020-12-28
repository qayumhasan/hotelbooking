<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelManageController extends Controller
{
    // construct
    public function __construct(){
        $this->middleware('admin');
    }
    // home
    public function index(){
        return view('hotelbooking.home.index');
    }
}
