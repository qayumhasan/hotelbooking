<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhysicalStockController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function create(){
        return "ok";
    }
}
