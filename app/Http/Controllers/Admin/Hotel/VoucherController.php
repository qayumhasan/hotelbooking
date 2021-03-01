<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function create()
    {
        return view('hotelbooking.checking.voucher.create');
    }

    public function showvoucher($booking_no)
    {
        $guestname = Checkin::where('booking_no',$booking_no)->where('is_occupy',1)->first(); 
        $voucher_no = date("M").'/'.rand(111,999);
        return view('hotelbooking.checking.voucher.create',compact('booking_no','guestname','voucher_no'));
    }

    public function submitVoucher(Request $request , $booking_no)
    {
     

        $voucher = new Voucher();
        $voucher->debit = $request->debit;
        $voucher->credit = $request->credit;
        $voucher->amount = $request->amount;
        $voucher->voucher_no = $request->voucher_no;
        $voucher->booking_no = $booking_no;
        $voucher->date = $request->date;
        $voucher->remarks = $request->remarks;

        $voucher->entry_by = Auth::user()->id;
        $voucher->entry_date = Carbon::now();

        if($voucher->save()){

            $guestname = Checkin::where('booking_no',$booking_no)->where('is_occupy',1)->first(); 
            $voucher_no = $request->voucher_no;
            return view('hotelbooking.checking.voucher.create',compact('booking_no','guestname','voucher_no','voucher'));
        }
        
    }
}
