<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchaseHead;
use App\Models\StockCenter;
use App\Models\Supplier;
use App\Models\OrderHead;
use Carbon\Carbon;
use Session;

class PurchaseController extends Controller
{
     // construct
     public function __construct(){
        $this->middleware('admin');
    }
    // index
    public function index(){
        $room=Room::where('is_deleted',0)->latest()->get();
        return view('hotelbooking.roomsetup.index',compact('room'));
    }
    // create
    public function create(){
       
        $year= Carbon::now()->format('Y');
        $date= Carbon::now()->format('d');
        $purchasehead=PurchaseHead::orderBy('id','DESC')->first();
        if($purchasehead){
            $invoice_id='PI-'.$year.'-'.$date.'-B-'.$purchasehead->id;
        }else{
            $invoice_id='PI-'.$year.'-'.$date.'-B-'.'0';
        }
        $allstock=StockCenter::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allsupplier=Supplier::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allorderhead=OrderHead::where('is_deleted',0)->where('is_active',1)->latest()->get();
        return view('hotelbooking.purchase.create',compact('invoice_id','allstock','allsupplier','allorderhead'));
    }

    //
    public function itempurchase(Request $request){
        return $request;
    }
}
