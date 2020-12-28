<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInformation;
use App\Models\Logo;
use App\Models\Social;
use App\Models\Seo;
use App\Models\SmsModel;
use Carbon\Carbon;
use Session;
use Image;

class SettingsController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    //general settings 
    public function Index(){
    	$companyinformation=CompanyInformation::first();
    	$logo=logo::first();
        $social=Social::first();
        $seo=Seo::first();
        $smsmodel=SmsModel::first();
    	return view('backend.settings.generalsettings',compact('companyinformation','logo','social','seo','smsmodel'));
    }
    // update 
    public function Update(Request $request){
    	$update=CompanyInformation::where('id',$request->id)->update([
    		'company_name'=>$request->company_name,
    		'mobile'=>$request->mobile,
    		'email'=>$request->email,
    		'fax'=>$request->fax,
    		'address'=>$request->address,
    		'google_map'=>$request->google_map,
    	]);
    	if($update){
	    	$notification = array(
	          'messege' => 'CompanyInformation Update Success!',
	          'alert-type' =>'success'
	      	);
	      	return redirect()->back()->with($notification);
	    }else{
	    	$notification = array(
	          'messege' => 'CompanyInformation Update Faild!',
	          'alert-type' =>'error'
	      	);
	      	return redirect()->back()->with($notification);
	    }
    }
    // logo setting
    public function LogoUpdate(Request $request){
    	$id=$request->id;
    	$old_logo=$request->old_logo;
    	$old_fav=$request->old_fav;
    	$old_lazy=$request->old_lazy;
    	$update=Logo::where('id',$id)->update([
    	   'updated_at'=>Carbon::now()->toDateTimeString(),
    	]);
    	if($request->hasFile('logo')){
            if($old_logo){
                // unlink('public/uploads/logo/' . $old_logo);
                $image = $request->file('logo');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(250,60)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'logo' => $ImageName,
                ]);
            }
        }
        elseif($request->hasFile('favicon')){
            if($old_fav){
                //unlink('public/uploads/logo/' . $old_fav);
                $image = $request->file('favicon');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(16,16)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'favicon' => $ImageName,
                ]);
            }
        }
	    elseif($request->hasFile('Lazy_loader')){
	        if($old_lazy){
	            //unlink('public/uploads/logo/' . $old_lazy);
	            $image = $request->file('Lazy_loader');
	            $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
	            Image::make($image)->resize(400,350)->save('public/uploads/logo/' . $ImageName);
	            Logo::where('id', $id)->update([
	                'Lazy_loader' => $ImageName,
	            ]);
	        }
	    }elseif($request->hasFile('Lazy_loader') && $request->hasFile('favicon')){
	        if($old_lazy){
	            //unlink('public/uploads/logo/' . $old_lazy);
	            $image = $request->file('Lazy_loader');
	            $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
	            Image::make($image)->resize(400,350)->save('public/uploads/logo/' . $ImageName);
	            Logo::where('id', $id)->update([
	                'Lazy_loader' => $ImageName,
	            ]);
	        }
	        if($old_fav){
                //unlink('public/uploads/logo/' . $old_fav);
                $image = $request->file('favicon');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(16,16)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'favicon' => $ImageName,
                ]);
            }
	    }elseif($request->hasFile('Lazy_loader') && $request->hasFile('logo')){
	    	if($old_lazy){
	            //unlink('public/uploads/logo/' . $old_lazy);
	            $image = $request->file('Lazy_loader');
	            $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
	            Image::make($image)->resize(400,350)->save('public/uploads/logo/' . $ImageName);
	            Logo::where('id', $id)->update([
	                'Lazy_loader' => $ImageName,
	            ]);
	        }
	         if($old_logo){
                //unlink('public/uploads/logo/' . $old_logo);
                $image = $request->file('logo');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(250,60)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'logo' => $ImageName,
                ]);
            }
	    }elseif($request->hasFile('logo') && $request->hasFile('favicon')){
	    	if($old_logo){
               // unlink('public/uploads/logo/' . $old_logo);
                $image = $request->file('logo');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(250,60)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'logo' => $ImageName,
                ]);
            }
            if($old_fav){
               // unlink('public/uploads/logo/' . $old_fav);
                $image = $request->file('favicon');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(16,16)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'favicon' => $ImageName,
                ]);
            }
	    }elseif($request->hasFile('logo') && $request->hasFile('favicon') && $request->hasFile('Lazy_loader')){
	    	if($old_logo){
                //unlink('public/uploads/logo/' . $old_logo);
                $image = $request->file('logo');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(250,60)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'logo' => $ImageName,
                ]);
            }
            if($old_fav){
                // unlink('public/uploads/logo/' . $old_fav);
                $image = $request->file('favicon');
                $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(16,16)->save('public/uploads/logo/' . $ImageName);
                Logo::where('id', $id)->update([
                    'favicon' => $ImageName,
                ]);
            }
            if($old_lazy){
	            // unlink('public/uploads/logo/' . $old_lazy);
	            $image = $request->file('Lazy_loader');
	            $ImageName = '_' . '_' . time() . '.' . $image->getClientOriginalExtension();
	            Image::make($image)->resize(400,350)->save('public/uploads/logo/' . $ImageName);
	            Logo::where('id', $id)->update([
	                'Lazy_loader' => $ImageName,
	            ]);
	        }
	    }
	    if($update){
            Session::flash('logo_success');
	    	$notification = array(
	          'messege' => 'Update Success!',
	          'alert-type' =>'success'
	      	);
	      	return redirect()->back()->with($notification);
	    }else{
             Session::flash('logo_faild');
	    	$notification = array(
	          'messege' => 'Update Faild!',
	          'alert-type' =>'error'
	      	);
	      	return redirect()->back()->with($notification);
	    }
    }
    // social update
    public function SocialMediaUpdate(Request $request){
       $update=Social::where('id',$request->id)->update([
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkend'=>$request->linkend,
            'youtube'=>$request->youtube,
            'feed'=>$request->feed,
            'google_plus'=>$request->google_plus,
       ]);
        if($update){
            Session::flash('social_success');
            $notification = array(
              'messege' => 'Update Success!',
              'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            Session::flash('social_faild');
            $notification = array(
              'messege' => 'Update Faild!',
              'alert-type' =>'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // seo update
    public function SeoUpdate(Request $request){
        $update=Seo::where('id',$request->id)->update([
            'meta_title'=>$request->meta_title,
            'meta_keyword'=>$request->meta_keyword,
            'meta_author'=>$request->meta_author,
            'meta_description'=>$request->meta_description,
            'google_verification'=>$request->google_verification,
            'bing_verification'=>$request->bing_verification,
            'google_analytics'=>$request->google_analytics,
            'alexa_analytics'=>$request->alexa_analytics,
            'facebook_pixel'=>$request->facebook_pixel,
            'updated_at'=>Carbon::now()->toDateTimeString(),

        ]);
        if($update){
            Session::flash('seo_success');
            $notification = array(
              'messege' => 'Update Success!',
              'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            Session::flash('seo_success');
            $notification = array(
              'messege' => 'Update Faild!',
              'alert-type' =>'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // sms settings
    public function SmsUpdate(Request $request){
        $update=SmsModel::where('id',$request->id)->update([
            'sms_url'=>$request->sms_url,
            'sms_username'=>$request->sms_username,
            'sms_password'=>$request->sms_password,
            'sms_type'=>$request->sms_type,
            'sms_type'=>$request->sms_type,
            'sms_masking'=>$request->sms_masking,
        ]);
        // if($update){
        //   Session::flash('soft_success');
        //   return redirect()->back();
        // }else{
        //   Session::flash('sms_error');
        //   return redirect()->back();
        // }
        if($update){
            Session::flash('soft_success');
            $notification = array(
              'messege' => 'Update Success!',
              'alert-type' =>'success'
            );
            return redirect()->back()->with($notification);
        }else{
            Session::flash('sms_error');
            $notification = array(
              'messege' => 'Update Faild!',
              'alert-type' =>'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    // smtp update
    public function SmtpUpdate(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }
        Session::flash('soft_success');
            $notification = array(
              'messege' => 'Update Success!',
              'alert-type' =>'success'
            );
        return back()->with($notification);
    }

    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';
            if (strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace(
                    $type . '="' . env($type) . '"',
                    $type . '=' . $val,
                    file_get_contents($path)
                ));
            }
            else {
                file_put_contents($path, file_get_contents($path) . $type . '=' . $val);
            }
        }
    }
    // file manager check
    public function CheckFilemana(){
        return view('backend.ckandfilemanager.create');
    }

}
