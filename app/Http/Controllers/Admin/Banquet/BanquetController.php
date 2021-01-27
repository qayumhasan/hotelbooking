<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanquetController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
        return view('banquet.home.index');
    }
}
