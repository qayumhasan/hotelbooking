<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
     // construct
     public function __construct(){
    	$this->middleware('admin');
    }
    public function index()
    {
        
        return view('restaurant.index');
    }
}
