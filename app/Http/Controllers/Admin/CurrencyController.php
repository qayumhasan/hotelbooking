<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function index()
    {
        $currencs = Currency::where('is_active',1)->where('is_deleted',0)->get();
        return view('backend.currency.index',compact('currencs'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:currencies|max:255',
            'symbol' => 'required|unique:currencies|max:255',
        ]);
        if($request->is_default == 1){
            $inactive = Currency::where('is_default','1')->update(
                [
                    'is_default'=>'NULL',
                ]
            );
        }
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->is_default = $request->is_default;
        $currency->save();

        $notification = array(
            'messege' => 'Currency Added Successfully!',
            'alert-type' =>'success'
            );

      return redirect()->back()->with($notification);
    }


    public function status($id)
    {

       $status = Currency::findOrFail($id);
        if($status->is_default == '1'){    

            $status->is_default = 'NULL';
            $status->save();
                $notification = array(
                    'messege' => 'Currency Status In Active Successfully!',
                    'alert-type' =>'success'
                    );
                return redirect()->back()->with($notification);
        }else{
            $inactive = Currency::where('is_default','1')->update(
                [
                    'is_default'=>'NULL',
                ]
            );
            $status->is_default = '1';
            $status->save();
                $notification = array(
                    'messege' => 'Currency Status Active Successfully!',
                    'alert-type' =>'success'
                    );
                return redirect()->back()->with($notification);
        }
    }


    public function update(Request $request)
    {

      

    $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('currencies')->ignore($request->id),
            ],
            'symbol' => [
                'required',
                'max:255',
                Rule::unique('currencies')->ignore($request->id),
            ],
            
        ]);

        if($request->is_default == 1){
            $inactive = Currency::where('is_default','1')->update(
                [
                    'is_default'=>'NULL',
                ]
            );
        }


        

        $currency = Currency::findOrFail($request->id);
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->is_default = $request->is_default;
        $currency->save();

        $notification = array(
            'messege' => 'Currency Updated Successfully!',
            'alert-type' =>'success'
            );

      return redirect()->back()->with($notification);
        
    }


    public function delete($id)
    {
        $currency = Currency::findOrFail($id);
        if($currency){
            $currency->delete();
            $notification = array(
                'messege' => 'Currency Deleted Successfully!',
                'alert-type' =>'success'
                );

                return redirect()->back()->with($notification);
        }
    }
}
