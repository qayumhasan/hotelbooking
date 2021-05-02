<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Mail;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\adminsendmail;

class LoginController extends Controller
{
    public function index(){
    	return view('backend.auth.login');
    }
    // login
      public function login(Request $request)
    {
          // Validate the form data
          $this->validate($request, [
              'email'   => 'required',
              'password' => 'required|min:6'
          ]);
                 // Attempt to log the user in
          if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            $notification = array(
              'messege' => 'Login success!',
              'alert-type' =>'success'
          	);
            return redirect()->intended(route('admin.dashboard'))->with($notification);
          }elseif(Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password],$request->remember)){
		      	 $notification = array(
		          'messege' => 'Login success!',
		          'alert-type' =>'success'
		      	);
		        return redirect()->intended(route('admin.dashboard'));
          }else{

             $notification = array(
              'messege' => 'Email/password Doesnot Match!',
              'alert-type' =>'error'
          	);
          return redirect()->back()->with($notification);
          }

     }
     public function forget(){
       return view('backend.auth.forget');
     }
     // email emailsubmit
     public function emailsubmit(Request $request){
       $check=Admin::where('email',$request->email)->first();
        if($check){
          $code=rand(2222,10000);
          Admin::where('email',$request->email)->update([
            'verification_code'=>$code,
          ]);
          Mail::to($request->email)->send(new adminsendmail($code));
          $notification=array(
               'messege'=>'Verification Code Send Your Email!!! ',
               'alert-type'=>'Success'
                );
          return redirect()->route('admin.auth.adminverification',$request->email);


        }else{
          $notification=array(
               'messege'=>'This Email DoesNot Exit !!! ',
               'alert-type'=>'error'
                );
          return redirect()->back()->with($notification);
        }
     }
     public function forgetemail($email){
       return view('backend.auth.code',compact('email'));
     }

     public function checkverification(Request $request)
   {
     //return $request;
             $email= $request->email;
              $code= $request->code;
              $check=Admin::where('email',$email)->where('verification_code',$code)->first();
              if($check){
                $notification=array(
                     'messege'=>'Your Code  Match !!! ',
                     'alert-type'=>'success'
                      );
                return redirect()->route('admin.forget.resetpass',$email)->with($notification);
              }else{
                $notification=array(
                     'messege'=>'Your Code DoesNot Match !!! ',
                     'alert-type'=>'error'
                      );
                return redirect()->back()->with($notification);
              }
   }
   public function forgetresetpassword($email){

     return view('backend.auth.resetpass',compact('email'));
   }
   // password submit
   public function forgetresetpasswordsubmit(Request $request){
            $email=$request->email;
            $this->validate($request, [
                'password' => 'min:8',
                'password_confirmation' => 'required_with:password|same:password|min:8'
            ]);
            $update=Admin::where('email',$email)->update([
              'password'=>Hash::make($request->password),
            ]);
            if($update){
              $notification=array(
                   'messege'=>' Your Password Successfully Change! ',
                   'alert-type'=>'success'
                    );
              return redirect()->route('admin.login')->with($notification);
            }else{
              $notification=array(
                   'messege'=>'Password Change Faild! ',
                   'alert-type'=>'error'
                    );
              return redirect()->back()->with($notification);
            }
   }

}
