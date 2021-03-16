<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationAnalysisReportControler extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function roomwiseReport()
    {
        return view('hotelbooking.reservation_analysis.room_wise_report');    
    }
}
