<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){

    }
    // 
    public function index(){
    	return "customer account";
    }
}
