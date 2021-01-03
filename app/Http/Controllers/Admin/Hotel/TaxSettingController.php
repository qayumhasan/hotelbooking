<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Http\Controllers\Controller;
use App\Models\TaxSetting;
use Illuminate\Http\Request;

class TaxSettingController extends Controller
{
    public function index()
    {
        $taxes = TaxSetting::all();

        return view('hotelbooking.setting.tax.index',compact('taxes'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'tax_date'=>'required',
            'tax_description'=>'required',
            'calculation'=>'required',
            'base_on'=>'required',
            'effect'=>'required',
        ]);
        $tax = new TaxSetting;
        $tax->date = $request->tax_date;
        $tax->tax_description = $request->tax_description;
        $tax->calculation = $request->calculation;
        $tax->base_on = $request->base_on;
        $tax->amount = $request->amount;
        $tax->rate = $request->rate;
        $tax->effect = $request->effect;
        $tax->save();
        return back();
        $notification=array(
            'messege'=>'Tax Setting Created success',
            'alert-type'=>'success'
            );
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $data = TaxSetting::findOrFail($id);
        if($data){
            $data->delete();
            $notification=array(
                'messege'=>'Tax Setting deleted successfully',
                'alert-type'=>'success'
                );
        }
        return redirect()->route('admin.tax.index')->with($notification);
    }

    public function status($id)
    {
        $status = TaxSetting::findOrFail($id);
        if($status->is_active == 1){
            $status->is_active = 0;
            $status->save();
            $notification=array(
                'messege'=>'Tax Setting Deactive Successfully',
                'alert-type'=>'success'
                );
                return redirect()->route('admin.tax.index')->with($notification);
        }else{
            $status->is_active = 1;
            $status->save();
            $notification=array(
                'messege'=>'Tax Setting Active Successfully',
                'alert-type'=>'success'
                );
                return redirect()->route('admin.tax.index')->with($notification);
        }
    }

    public function edit($id)
    {
        $taxes = TaxSetting::all();
        $tax = TaxSetting::findOrFail($id);

        return view('hotelbooking.setting.tax.edit',compact('taxes','tax'));
    }

    public function update(Request $request ,$id)
    {
        
        $request->validate([
            'tax_date'=>'required',
            'tax_description'=>'required',
            'calculation'=>'required',
            'base_on'=>'required',
            'effect'=>'required',
        ]);
        $tax = TaxSetting::findOrFail($id);
        $tax->date = $request->tax_date;
        $tax->tax_description = $request->tax_description;
        $tax->calculation = $request->calculation;
        $tax->base_on = $request->base_on;
        $tax->amount = $request->amount;
        $tax->rate = $request->rate;
        $tax->effect = $request->effect;
        $tax->save();
        
        $notification=array(
            'messege'=>'Tax Setting Updated successfully',
            'alert-type'=>'success'
            );
        return redirect()->route('admin.tax.index')->with($notification);
    }


}
