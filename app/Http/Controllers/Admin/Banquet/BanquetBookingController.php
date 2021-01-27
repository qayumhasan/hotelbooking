<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanquetBookingController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // 
    public function create(){
        return "ok";
    }

}
