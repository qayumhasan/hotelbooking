<?php

namespace App\Http\Controllers\Admin\Banquet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\BookingFor;
use App\Models\MenuType;
use App\Models\ItemEntry;
use App\Models\BanquetItem;
use App\Models\TaxSetting;
use App\Models\BanquetTax;
use Image;
use Session;
use Carbon\Carbon;
use Auth;

class BanquetBookingController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // 
    public function create(){
        $allvanue=Venue::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $bookingfor=BookingFor::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allmenutype=MenuType::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltax=TaxSetting::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $booking_no=222;
        return view('banquet.booking.create',compact('allvanue','bookingfor','allmenutype','allitem','booking_no','alltax'));
    }
    // get menu type price get
    public function getmenutypeprice(Request $request){
        //return $request;
        if($request->geust_type==1){
            $individual_price=MenuType::where('id',$request->menutype)->select(['individual_price'])->first();
            $price=$individual_price->individual_price;
            return response()->json($price);
        }elseif($request->geust_type==2){
            $individual_price=MenuType::where('id',$request->menutype)->select(['corporate_price'])->first();
            $price=$individual_price->corporate_price;
            return response()->json($price);
        }elseif($request->geust_type==3){
            $individual_price=MenuType::where('id',$request->menutype)->select(['ngo_price'])->first();
            $price=$individual_price->ngo_price;
            return response()->json($price);
        }
      
        
    }
    // get guest type
    public function getgeusttypeprice(Request $request){

        if($request->geust_type==1){
            $individual_price=MenuType::where('id',$request->menutype)->select(['individual_price'])->first();
            $price=$individual_price->individual_price;
            return response()->json($price);
        }elseif($request->geust_type==2){
            $individual_price=MenuType::where('id',$request->menutype)->select(['corporate_price'])->first();
            $price=$individual_price->corporate_price;
            return response()->json($price);
        }elseif($request->geust_type==3){
            $individual_price=MenuType::where('id',$request->menutype)->select(['ngo_price'])->first();
            $price=$individual_price->ngo_price;
            return response()->json($price);
        }
    }


    // bunquet
    public function bunquetinsert(Request $request){
         // return $request;
         if($request->bit_id==''){
            $validated = $request->validate([
                'itemname' => 'required',
                'itemqty' => 'required',
                'itemrate' => 'required',
            ]);
            $item_id=ItemEntry::where('item_name',$request->itemname)->first()->id;
            $check=BanquetItem::where('booking_no',$request->booking_no)->where('item_id',$item_id)->first();
    
            if($check){
                $update=BanquetItem::where('id',$check->id)->update([
                    'qty'=>$check->qty + $request->itemqty,
                    'amount'=>$check->amount + $request->itemamount,
                ]);
            }else{
                $insert=BanquetItem::insert([
                    'booking_no'=>$request->booking_no,
                    'item_name'=>$request->itemname,
                    'item_id'=>$item_id,
                    'qty'=>$request->itemqty,
                    'rate'=>$request->itemrate,
                    'amount'=>$request->itemamount,
                    'tax'=>$request->itemtax,
                    'entry_by'=>Auth::user()->id,
                    'created_at'=>Carbon::now()->toDateTimeString(),
                ]);
                if($insert){
                    return response()->json("ok");
                }else{
                    return response()->json("Unseccessful");
                }
            }
         }else{
            $item_id=ItemEntry::where('item_name',$request->itemname)->first()->id;
            $check=BanquetItem::where('booking_no',$request->booking_no)->where('item_id',$item_id)->first();
            $check=BanquetItem::where('id',$request->bit_id)->where('booking_no',$request->booking_no)->first();
            $update=BanquetItem::where('id',$request->bit_id)->where('booking_no',$request->booking_no)->update([
                    'item_name'=>$request->itemname,
                    'item_id'=>$item_id,
                    'qty'=>$request->itemqty,
                    'rate'=>$request->itemrate,
                    'amount'=>$request->itemamount,
                    'tax'=>$request->itemtax,
                    'updated_by'=>Auth::user()->id,
                    'updated_at'=>Carbon::now()->toDateTimeString(),

            ]);
            if($update){
                return response("ok");
            }else{
                return response("unsuccess");
            }

         }
         
       
    }
    // banquet item
    public function allbunquetitem($booking_no){
        //return $booking_no;
        $allitem=BanquetItem::where('booking_no',$booking_no)->latest()->get();
        return view('banquet.booking.ajaxview.allitem',compact('allitem'));
    }
    // banquet item delete
    public function bunquetitemdelete(Request $request){
        //return $request->item_id;
        $check=BanquetItem::where('id',$request->item_id)->first();
        $delete=BanquetItem::where('id',$request->item_id)->delete();

        $allitem=BanquetItem::where('booking_no',$check->booking_no)->latest()->get();
        return view('banquet.booking.ajaxview.allitem',compact('allitem'));

    }
    // banquet item edit
    public function bunquetitemedit(Request $request){
        $check=BanquetItem::where('id',$request->item_id)->first();
        return response()->json($check);
    }

    // tax all
    public function banquettaxall(Request $request){
        $data=TaxSetting::where('id',$request->tax_des)->first();
        return response()->json($data);
    }
    public function banquettaxinsert(Request $request){
        //return $request;
            $validated = $request->validate([
              
                'tax_description' => 'required',
                'taxrate' => 'required',
            ]);
            $tax_des=TaxSetting::where('id',$request->tax_description)->first();
            $insert=BanquetTax::insert([
                'booking_no'=>$request->booking_no,
                'tax_id'=>$request->tax_description,
                'tax_description'=>$tax_des->tax_description,
                'calculation_on'=>$request->tax_calculation,
                'based_on'=>$request->based_on,
                'tax_rate'=>$request->taxrate,
                'tax_amount'=>$request->tax_amount,
                'tax_effect'=>$request->tax_effect,
                'entry_by'=>Auth::user()->id,
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($insert){
                return response()->json($insert);
            }else{

            }

    }

    // 
    public function gettaxbanquet($booking_no){
        $alldata=BanquetTax::where('booking_no',$booking_no)->latest()->get();
        return view('banquet.booking.ajaxview.alltax',compact('alldata'));
    }
    // tax delete
    public function gettaxbanquetdelete(Request $request){
       $delete = BanquetTax::where('id',$request->item_id)->delete();
       return response($delete);
    }

}
