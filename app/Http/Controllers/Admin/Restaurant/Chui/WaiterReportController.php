<?php

namespace App\Http\Controllers\Admin\Restaurant\Chui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaiterReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function qtrWaiterPerformance()
    {
        
    }
}
