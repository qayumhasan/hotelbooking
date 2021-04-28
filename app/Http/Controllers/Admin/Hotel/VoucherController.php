<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\AccountCategory;
use App\Models\AccountSubCategoryOne;
use App\Models\AccountSubCategoryTwo;
use App\Models\AccountTransectionDetails;
use App\Models\AccountTransectionHead;
use App\Models\ChartOfAccount;
use App\Models\CheckBookTransection;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Guest;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

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

    public function submitVoucher(Request $request)
    {
  
        

         
        $check=AccountTransectionDetails::where('voucher_no',$request->invoice)->first();
        if($check){
              
                $data = new AccountTransectionHead;
                $data->voucher_type=$request->voucher_name;
                $data->voucher_no=$request->invoice;
                $data->date=$request->date;
                $data->reference=$request->reference;
                $data->cheque_reference=$check->check_reference;
                $data->narration=$request->narration;
                $data->advice=$request->advice;
                $data->main_invoice=$request->hiddeninvoice;
                $data->created_at=Carbon::now()->toDateTimeString();
                $data->entry_by=1;
                if($check->dr_amount == NULL){
                    // return "dr faka";
                    
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->cr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);

                    $data->price = $check->cr_amount;
    
                }elseif($check->cr_amount == NULL){
                     //return "cr faka";
                    CheckBookTransection::where('id',$check->check_reference)->update([
                        'status'=>'U',
                        'voucher_number'=>$request->invoice,
                        'check_date'=>$request->date,
                        'check_amount'=>$check->dr_amount,
                        'updated_at'=>Carbon::now()->toDateTimeString(),
                    ]);

                    $data->price = $check->cr_amount;

                }
                $detailsdata=AccountTransectionDetails::where('voucher_no',$request->invoice)->get();
                foreach($detailsdata as $updata){
                    AccountTransectionDetails::where('id',$updata->id)->update([
                        'is_active'=>1,
                    ]);
                }

                $checkout = Checkout::where('booking_no',$request->reference);
                $amount =  (float)$request->amount;
                $checkout->decrement('gross_amount',$amount);
                $checkout->increment('voucher_amount',$amount);
                $checkout->decrement('outstanding_amount',$amount);
                
                if($data->save()){
                    $notification = array(
                        'messege' => 'Insert Success',
                        'alert-type' => 'success'
                    );
                
                    return Redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'messege' => 'Insert Faild',
                        'alert-type' => 'error'
                    );
                    return Redirect()->back()->with($notification);
                }

        }else{
            $notification = array(
                'messege' => 'Please add Transection',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }


        
        
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
        $alldata=AccountTransectionHead::where('reference',$booking_no)->where('is_deleted',0)->orderBy('id','DESC')->get();
        
        // return view('accounts.accounttransection.index',compact('alldata'));
        return view('hotelbooking.checking.voucher.list',compact('alldata','booking_no'));
    }

    public function editVoucherPage($id,$booking_no)
    {
        
        
        $allcategory=AccountCategory::get();
        $allchartofaccount=ChartOfAccount::get();
        $allsubcategoryone=AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->get();
        $allsubcategorytwo=AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->get();

        $edit=AccountTransectionHead::where('id',$id)->first();
        $datasourche=ChartOfAccount::where('category_id',1)->where('maincategory_id',9)->where('subcategoryone_id',17)->get();

        $allguest=Guest::get();
        return view('hotelbooking.checking.voucher.edit',compact('booking_no','allguest','datasourche','edit','allcategory','allchartofaccount','allsubcategoryone','allsubcategorytwo'));
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
        $alldata=AccountTransectionHead::where('reference',$booking_no)->where('is_deleted',0)->orderBy('id','DESC')->get();
        // return view('accounts.accounttransection.index',compact('alldata'));
        return view('hotelbooking.checking.voucher.list',compact('alldata','booking_no'));
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
        $alldata=AccountTransectionHead::where('reference',$booking_no)->where('is_deleted',0)->orderBy('id','DESC')->get();
        // return view('accounts.accounttransection.index',compact('alldata'));
        return view('hotelbooking.checking.voucher.list',compact('alldata','booking_no'));
        
    }


    public function printVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);

        return view('hotelbooking.home.ajax.voucher_print_ajax',compact('voucher'));

    }
}
