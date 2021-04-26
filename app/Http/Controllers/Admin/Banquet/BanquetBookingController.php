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
use App\Models\MenuCategory;
use App\Models\BanquetCategoryItem;
use App\Models\Banquet;
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
    public function index(){
        $allbanquet=Banquet::where('is_deleted',0)->latest()->get();
        return view('banquet.booking.index',compact('allbanquet'));
    }
    // 
    public function create(){
        $allvanue=Venue::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $bookingfor=BookingFor::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allmenutype=MenuType::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltax=TaxSetting::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allcategory=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $ban_id=Banquet::select(['id'])->orderBy('id','DESC')->first();
        if($ban_id){
            $booking_no='Banquet-'.$ban_id->id;
        }else{
            $booking_no='Banquet-0';
        }

        return view('banquet.booking.create',compact('allvanue','bookingfor','allmenutype','allitem','booking_no','alltax','allcategory'));
    }

     // active
     public function active($id){
        $active=Banquet::where('id',$id)->update([
            'is_active'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($active){
            $notification=array(
                'messege'=>'Banquet Active success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Banquet Active Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }


    }
    // deactive
    public function deactive($id){
        $deactive=Banquet::where('id',$id)->update([
            'is_active'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($deactive){
            $notification=array(
                'messege'=>'Banquet DeActive success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Banquet DeActive Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
    // soft delete
    public function delete($id){
        $delete=Banquet::where('id',$id)->update([
            'is_deleted'=>1,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($delete){
            $notification=array(
                'messege'=>'Banquet Delete success',
                'alert-type'=>'success'
                );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Banquet Delete Faild',
                'alert-type'=>'error'
                );
            return redirect()->back()->with($notification);
        }

    }
     // edit
    public function edit($id){
        // return $id;
        $edit=Banquet::where('id',$id)->first();
        $allvanue=Venue::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $bookingfor=BookingFor::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allmenutype=MenuType::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $alltax=TaxSetting::where('is_deleted',0)->where('is_active',1)->latest()->get();
        $allcategory=MenuCategory::where('is_deleted',0)->where('is_active',1)->latest()->get();

        return view('banquet.booking.update',compact('edit','allvanue','bookingfor','allmenutype','allitem','alltax','allcategory'));
    }
    
    // update
    public function update(Request $request,$id){
       // return $request;
        $validated = $request->validate([
            'guest_name' => 'required',
            'print_name' => 'required',
            'mobile' => 'required',
            'veneue_id' => 'required',
            'booking_for' => 'required',
            'menu_type' => 'required',
            'price_per_pax' => 'required',
        ]);
        $data = Banquet::findOrFail($id);
        $data->title = $request->title;
        $data->guest_name = $request->guest_name;
        $data->print_name = $request->print_name;
        $data->company_name = $request->company_name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
       
        $data->venue_id = $request->veneue_id;
        $data->booking_for = $request->booking_for;
        $data->booking_date = $request->booking_date;
        $data->date_of_function_form = $request->date_of_function_form;
        $data->date_of_function_to = $request->date_of_function_to;
        $data->type_of_function = $request->type_of_function;
        $data->remarks = $request->remarks;
        $data->menutype = $request->menu_type;
        $data->guest_type = $request->guest_type;
        $data->price_per_pax = $request->price_per_pax;
        $data->guarantee_pax = $request->guarantee_pax;
        $data->welcome_board = $request->welcome_board;
        $data->no_of_rooms = $request->no_of_rooms;
        $data->total_pax_amount = $request->total_pax_amount;
        $data->total_other_item_amount = $request->total_other_item_amount;
        $data->total_net_amount = $request->total_net_amount;
        $data->is_active = $request->is_active;

        if ($request->hasFile('pdf')) {
            $data->banquet_file = $request->file('pdf')->store('public/uploads/banquet/file/');
        }

        if($data->save()){
            $notification = array(
                'messege' => 'Banquet Update Success!',
                'alert-type' =>'success'
                );
          return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Banquet Update Success!',
                'alert-type' =>'error'
                );
          return redirect()->back()->with($notification);
        }
        
       


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
        if($request->btax_id==''){
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
        }else{
            $tax_des=TaxSetting::where('id',$request->tax_description)->first();
            $update=BanquetTax::where('id',$request->btax_id)->update([
                'tax_id'=>$request->tax_description,
                'tax_description'=>$tax_des->tax_description,
                'calculation_on'=>$request->tax_calculation,
                'based_on'=>$request->based_on,
                'tax_rate'=>$request->taxrate,
                'tax_amount'=>$request->tax_amount,
                'tax_effect'=>$request->tax_effect,
                'updated_by'=>Auth::user()->id,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);
            if($update){
                return response()->json($update);
            }else{

            }

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

    // tax edit
    public function gettaxbanquetedit(Request $request){
        
        $data=BanquetTax::where('id',$request->item_id)->first();
        return response()->json($data);
    }
    // 
    public function getcategoryitem(Request $request){
       // return $request->cate_id;
        $allcategoryitem=ItemEntry::where('is_deleted',0)->where('is_active',1)->where('category_name',$request->cate_id)->latest()->get();
        return view('banquet.booking.ajaxview.categoryitem',compact('allcategoryitem'));
    
    }
    // 
    public function cateiteminsert(Request $request){
        //return $request;
        foreach($request->item_id as $val){
           // echo $val;
            $cate_name=MenuCategory::where('id',$request->category_id)->select(['name'])->first();
            $item_name=ItemEntry::where('id',$val)->select(['item_name'])->first();
            $insert=BanquetCategoryItem::insert([
                'booking_no'=>$request->booking_no,
                'category_name'=>$cate_name->name,
                'item_id'=>$val,
                'item_name'=>$item_name->item_name,
                'entry_by'=>Auth::user()->id,
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);
          
        }
    }
    // 
    public function getallcateitembanquet($booking_no){
        $allitem=BanquetCategoryItem::where('booking_no',$booking_no)->latest()->get();
        return view('banquet.booking.ajaxview.allcategorycreateitem',compact('allitem'));
    }

    public function getallcateitemdelete(Request $request){
        //return $request->item_id;
        $delete=BanquetCategoryItem::where('id',$request->item_id)->delete();
        return response()->json($delete);
    }
    // get all amount section
    public function getallamountsection(Request $request){
        $pax_amount=$request->total_pax_amount;
        $other_item_amount=BanquetItem::where('booking_no',$request->booking_no)->sum('amount');
        $taxamount=BanquetTax::where('booking_no',$request->booking_no)->get();
        // dd($taxamount);
        return view('banquet.booking.ajaxview.allamountsection',compact('other_item_amount','taxamount','pax_amount'));
    }



    // final banquet insert controller

    public function banquetinsert(Request $request){

        //return $request;
        $validated = $request->validate([
            'guest_name' => 'required',
            'print_name' => 'required',
            'mobile' => 'required',
            'veneue_id' => 'required',
            'booking_for' => 'required',
            'menu_type' => 'required',
            'price_per_pax' => 'required',
        ]);
        $data = new Banquet;
        $data->title = $request->title;
        $data->guest_name = $request->guest_name;
        $data->print_name = $request->print_name;
        $data->company_name = $request->company_name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->booking_no = $request->booking_no;
        $data->venue_id = $request->veneue_id;
        $data->booking_for = $request->booking_for;
        $data->booking_date = $request->booking_date;
        $data->date_of_function_form = $request->date_of_function_form;
        $data->date_of_function_to = $request->date_of_function_to;
        $data->type_of_function = $request->type_of_function;
        $data->remarks = $request->remarks;
        $data->menutype = $request->menu_type;
        $data->guest_type = $request->guest_type;
        $data->price_per_pax = $request->price_per_pax;
        $data->guarantee_pax = $request->guarantee_pax;
        $data->welcome_board = $request->welcome_board;
        $data->no_of_rooms = $request->no_of_rooms;
        $data->total_pax_amount = $request->total_pax_amount;
        $data->total_other_item_amount = $request->total_other_item_amount;
        $data->total_net_amount = $request->total_net_amount;
        $data->is_active = $request->is_active;

        $data->account_head_code = '18-16-0024-20132';
        $data->account_head_name = 'Accounts Receivable-Clients';

        $data->bunquet_guest_id='Banquet'.'-'.$request->guest_name.'-'.$request->booking_no;

        if ($request->hasFile('pdf')) {
            $data->banquet_file = $request->file('pdf')->store('public/uploads/banquet/file/');
        }

        if($data->save()){
            $notification = array(
                'messege' => 'Banquet Insert Success!',
                'alert-type' =>'success'
                );
          return redirect()->route('admin.banquet.payment',$request->booking_no)->with($notification);
        }else{
            $notification = array(
                'messege' => 'Banquet Insert Success!',
                'alert-type' =>'error'
                );
          return redirect()->back()->with($notification);
        }
    }
    //

    public function banquetpayment($bunquet_id){
        $booking_number=$bunquet_id;
        return view('banquet.booking.payment',compact('booking_number'));
    }

   

}
