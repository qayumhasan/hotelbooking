<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banquet;
use App\Models\Venue;
use App\Models\AccountTransectionHead;
use Carbon\Carbon;
use Session;

class BanquetReportController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // banquet controller
    public function dailyreports(){
        $allbanquet=Banquet::where('is_deleted',0)->latest()->get();
        return view('banquet.reports.dailybooking',compact('allbanquet'));
    }
    public function dailyreportssearch(Request $request){
        $fromdate=$request->fromdate;
        $todate=$request->todate;
        $searchdata=Banquet::where('is_deleted',0)->whereBetween('booking_date',[$fromdate, $todate])->get();
        return view('banquet.reports.dailybooking',compact('searchdata','fromdate','todate'));
    }
    // banquet wise report
    public function banquetwise(){
        $allbanquet=Banquet::where('is_deleted',0)->latest()->get();
        $banquet=Venue::where('is_deleted',0)->latest()->get();
        return view('banquet.reports.banquetwise',compact('allbanquet','banquet'));
    }
    // 
    public function banquetwisesearch(Request $request)
    {
       $venue_id=$request->banquet_vanue;
       $banquet=Venue::where('is_deleted',0)->latest()->get();
        $searchdata=Banquet::where('is_deleted',0)->where('venue_id',$venue_id)->get();
        return view('banquet.reports.banquetwise',compact('searchdata','venue_id','banquet'));
    }

    // bookinfg
    public function printdetais()
    {
        $allbanquet=Banquet::where('is_deleted',0)->latest()->get();
        return view('banquet.reports.printfunctiondeatils',compact('allbanquet'));
    }

    public function printdetaisresult(Request $request){

        $fromdate=$request->fromdate;
        $todate=$request->todate;
        $searchdata=Banquet::where('is_deleted',0)->whereBetween('booking_date',[$fromdate, $todate])->get();
        return view('banquet.reports.printfunctiondeatils',compact('searchdata','fromdate','todate'));
    }

    //collection
    public function banquetcollection(){
        
    }
    public function alltransection(){
        $allbanquet=Banquet::where('is_deleted',0)->orderBy('id','DESC')->get();
        return view('banquet.transection.transection',compact('allbanquet'));
    }

    public function alltransectionsearch(Request $request){
        return $request;
        
    }

    public function getprintbanquet($chid){
        $banquet=Banquet::where('id',$chid)->first();
        return view('banquet.reports.ajaxview.printfunctionajax',compact('banquet'));
    }

}
