<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Checkout;
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

    public function showCheckoutvoucher($booking_no)
    {
        $guestname = Checkin::where('booking_no',$booking_no)->first(); 
        $voucher_no = date("M").'/'.rand(111,999);
        return view('hotelbooking.home.ajax.voucher_ajax',compact('booking_no','guestname','voucher_no'));
    }

    public function submitVoucher(Request $request , $booking_no)
    {
     
        $guestname = Checkin::where('booking_no',$booking_no)->where('is_occupy',1)->first(); 
        if(Voucher::where('voucher_no',$request->voucher_no)->doesntExist()){
            
        $voucher = new Voucher();
        $voucher->debit = $request->debit;
        $voucher->credit = $request->credit;
        $voucher->amount = $request->amount;
        $voucher->voucher_no = $request->voucher_no;
        $voucher->booking_no = $booking_no;
        $voucher->date = $request->date;
        $voucher->type = 1;
        $voucher->remarks = $request->remarks;

        $voucher->entry_by = Auth::user()->id;
        $voucher->entry_date = Carbon::now();

       

        if($voucher->save()){

            
            $voucher_no = $request->voucher_no;
            $voucherdetails = Voucher::where('booking_no',$booking_no)->get();
            return view('hotelbooking.checking.voucher.create',compact('booking_no','guestname','voucher_no','voucher','voucherdetails'));
        }
        }else{
            $notification=array(
                'messege'=>'Create New Voucher From Here!!',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.checkin.edit',$guestname->id)->with($notification);

        };
        
        
    }


    public function submitCheckoutVoucher(Request $request , $booking_no)
    {
     
     $guestname = Checkin::where('booking_no',$booking_no)->first(); 
     
        if(Voucher::where('voucher_no',$request->voucher_no)->doesntExist()){
            
        $voucher = new Voucher();
        $voucher->debit = $request->debit;
        $voucher->credit = $request->credit;
        $voucher->amount = $request->amount;
        $voucher->type = 1;
        $voucher->voucher_no = $request->voucher_no;
        $voucher->booking_no = $booking_no;
        $voucher->date = $request->date;
        $voucher->remarks = $request->remarks;

        $voucher->entry_by = Auth::user()->id;
        $voucher->entry_date = Carbon::now();

        // change in checkout table

        $checkout = Checkout::where('booking_no',$booking_no)->increment('voucher_amount',$request->amount);

        if($voucher->save()){
            
            $notification=array(
                'messege'=>'Voucher Added!!',
                'alert-type'=>'success'
                );
            
            return back()->with($notification);
        }
        }else{
            $notification=array(
                'messege'=>'Create New Voucher From Here!!',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.checkin.edit',$guestname->id)->with($notification);

        };
        
        
    }


    public function submitCheckoutRefund(Request $request ,$booking_no)

    {
        

        $guestname = Checkin::where('booking_no',$booking_no)->first(); 
     
        if(Voucher::where('voucher_no',$request->voucher_no)->doesntExist()){
            
        $voucher = new Voucher();
        $voucher->debit = $request->debit;
        $voucher->credit = $request->credit;
        $voucher->amount = $request->amount;
        $voucher->type = 0;
        $voucher->voucher_no = $request->voucher_no;
        $voucher->booking_no = $booking_no;
        $voucher->date = $request->date;
        $voucher->remarks = $request->remarks;

        $voucher->entry_by = Auth::user()->id;
        $voucher->entry_date = Carbon::now();

        // change in checkout table

        $checkout = Checkout::where('booking_no',$booking_no)->decrement('voucher_amount',$request->amount);

        if($voucher->save()){
            
            $notification=array(
                'messege'=>'Refund Success!!',
                'alert-type'=>'success'
                );
            
            return back()->with($notification);
        }
        }else{
            $notification=array(
                'messege'=>'Create New Voucher From Here!!',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.checkin.edit',$guestname->id)->with($notification);

        };
    }


    public function refundCheckoutVoucher($booking_no)
    {
        $guestname = Checkin::where('booking_no',$booking_no)->first(); 
        $voucher_no = date("M").'/'.rand(111,999);
        return view('hotelbooking.home.ajax.refund_ajax',compact('booking_no','guestname','voucher_no'));
    }


    public function listVoucher($booking_no)
    {
        $voucherdetails = Voucher::where('booking_no',$booking_no)->where('is_deleted',0)->get();
        return view('hotelbooking.checking.voucher.list',compact('voucherdetails'));
    }

    public function editVoucherPage($id)
    {
        $singlevoucher= Voucher::findOrFail($id);
        $voucher_no = $singlevoucher->voucher_no; 
        $booking_no = $singlevoucher->booking_no; 
        $guestname = Checkin::where('booking_no',$booking_no)->where('is_occupy',1)->first(); 
        return view('hotelbooking.checking.voucher.edit',compact('voucher_no','booking_no','guestname','singlevoucher'));
    }

    public function updateVoucher(Request $request,$id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->debit = $request->debit;
        $voucher->credit = $request->credit;
        $voucher->amount = $request->amount;
        $voucher->voucher_no = $request->voucher_no;
        $voucher->booking_no = $voucher->booking_no;
        $voucher->date = $request->date;
        $voucher->remarks = $request->remarks;

        $voucher->updated_by = Auth::user()->id;
        $voucher->updated_date = Carbon::now();

        if($voucher->save()){
            $notification=array(
                'messege'=>'Voucer Updated Succesfully!!',
                'alert-type'=>'success'
                );
            return redirect()->route('admin.checkin.list.voucher',$voucher->booking_no)->with($notification);
        }
    }


    public function editVoucher($id)
    {
        
        $editvoucher=Voucher::findOrFail($id);

        if($editvoucher->type == 1){
            return view('hotelbooking.home.ajax.edit_voucher',compact('editvoucher'));
        }elseif($editvoucher->type == 0){

            return view('hotelbooking.home.ajax.edit_refund_voucher',compact('editvoucher'));
        }
        
        
        
    }

    public function updateCheckoutVoucher(Request $request ,$id)
    {
        
        $voucher = Voucher::findOrFail($id);

        if($voucher->type == 1){
            $checkout = Checkout::where('booking_no',$voucher->booking_no)->decrement('voucher_amount', $voucher->amount);

            $checkout = Checkout::where('booking_no',$voucher->booking_no)->increment('voucher_amount', $request->amount);
        }elseif($voucher->type == 0){

            $checkout = Checkout::where('booking_no',$voucher->booking_no)->increment('voucher_amount', $voucher->amount);

            $checkout = Checkout::where('booking_no',$voucher->booking_no)->decrement('voucher_amount', $request->amount);
        }

     

        $voucher->debit = $request->debit;
        $voucher->credit = $request->credit;
        $voucher->amount = $request->amount;
        $voucher->date = $request->date;
        $voucher->remarks = $request->remarks;

        $voucher->updated_by = Auth::user()->id;
        $voucher->updated_date = Carbon::now();

        if($voucher->save()){
            $notification=array(
                'messege'=>'Voucer Updated Succesfully!!',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }
    }


    public function deleteVoucherList($booking_no)
    {
        $voucherdetails = Voucher::where('booking_no',$booking_no)->where('is_deleted',0)->get();
        return view('hotelbooking.checking.voucher.delete_list',compact('voucherdetails'));
    }

    public function deleteVoucher($id)
    {
        Voucher::findOrFail($id)->update([
            'is_deleted'=>1,
        ]);

        $notification=array(
            'messege'=>'Voucer Deleted Succesfully!!',
            'alert-type'=>'success'
            );

        return redirect()->back()->with($notification);
    }


    public function listVoucherView($booking_no)
    {
        $voucherdetails = Voucher::where('booking_no',$booking_no)->where('is_deleted',0)->get();
        return view('hotelbooking.checking.voucher.view_list',compact('voucherdetails'));
        
    }


    public function printVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);

        return view('hotelbooking.home.ajax.voucher_print_ajax',compact('voucher'));

    }
}
