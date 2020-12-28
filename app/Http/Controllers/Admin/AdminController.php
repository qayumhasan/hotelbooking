<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminRole;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Models\Admin;
use App\Models\Employee;
use Auth;

class AdminController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
    	return view('backend.home.index');
    }
    // create register
    public function create(){

    	$allrole=AdminRole::select(['id','role_name'])->orderBy('id','DESC')->get();
    	$allemployee=Employee::orderBy('id','DESC')->get();
    	$designation=Admin::select(['designation'])->pluck('designation')->unique();
    	return view('backend.user.create',compact('allrole','allemployee','designation'));
    }
    // register
    public function register(Request $request){
    		//return $request;
		  $validatedData = $request->validate([
		        'name' => 'required|max:50',
		        'phone' => 'required|unique:admins|max:25',
		        'email' => 'required|unique:admins',
		        'password' => 'required|min:8',
		        'password_confirmation' => 'required_with:password|same:password|min:8',
		        'username' => 'required|unique:admins',
		        'user_role' => 'required',
		    ]);
		  $insert=Admin::insertGetId([
		  	'name'=>$request->name,
		  	'employee_id'=>$request->employee_id,
		  	'designation'=>$request->designation,
		  	'phone'=>$request->phone,
		  	'username'=>$request->username,
		  	'email'=>$request->email,
		  	'password' => Hash::make($request['password']),
		  	'address'=>$request->address,
		  	'user_role'=>$request->user_role,
		  	'profile_photo_path'=>'',
		  ]);
		  	if($request->hasFile('profile_photo_path')){
	            $image=$request->file('profile_photo_path');
	            $ImageName='admin_'.'_'.time().'.'.$image->getClientOriginalExtension();
	        	Image::make($image)->resize(350,350)->save('public/uploads/admin/' . $ImageName);
	            Admin::where('id',$insert)->update([
	                'profile_photo_path'=>$ImageName,
	            ]);
	        }
	        if($insert){
	        	$notification = array(
	              'messege' => 'User Insert Success!',
	              'alert-type' =>'success'
	          	);
	          	return redirect()->back()->with($notification);
	        }else{
	        	$notification = array(
	              'messege' => 'User Insert Faild!',
	              'alert-type' =>'error'
	          	);
	          	return redirect()->back()->with($notification);
	        }


    }
    // all-user
    public function alluser(){
    	$alluser=Admin::latest()->get();
    	return view('backend.user.index',compact('alluser'));
    }
    // edit
    public function edit($id){
    	$data=Admin::where('id',$id)->first();
    	$allrole=AdminRole::select(['id','role_name'])->orderBy('id','DESC')->get();
    	$allemployee=Employee::orderBy('id','DESC')->get();
    	$designation=Admin::select(['designation'])->pluck('designation')->unique();
    	return view('backend.user.edit',compact('data','allrole','allemployee','designation'));
    }
    // update
    public function update(Request $request){
    	$validatedData = $request->validate([
		        'name' => 'required|max:50',
		        'phone' => 'required|unique:admins,phone,'.$request->id,
		        'email' => 'required|unique:admins,email,'.$request->id,
		        'username' => 'required|unique:admins,username,'.$request->id,
		        'user_role' => 'required',
		    ]);
		  $update=Admin::where('id',$request->id)->update([
		  	'name'=>$request->name,
		  	'employee_id'=>$request->employee_id,
		  	'designation'=>$request->designation,
		  	'phone'=>$request->phone,
		  	'username'=>$request->username,
		  	'email'=>$request->email,
		  	'address'=>$request->address,
		  	'user_role'=>$request->user_role,
		  
		  ]);
		  	if($request->hasFile('profile_photo_path')){
	            $image=$request->file('profile_photo_path');
	            $ImageName='admin_'.'_'.time().'.'.$image->getClientOriginalExtension();
	        	Image::make($image)->resize(350,350)->save('public/uploads/admin/' . $ImageName);
	            Admin::where('id',$request->id)->update([
	                'profile_photo_path'=>$ImageName,
	            ]);
	        }
	        if($update){
	        	$notification = array(
	              'messege' => 'User update Success!',
	              'alert-type' =>'success'
	          	);
	          	return redirect()->back()->with($notification);
	        }else{
	        	$notification = array(
	              'messege' => 'User update Faild!',
	              'alert-type' =>'error'
	          	);
	          	return redirect()->back()->with($notification);
	        }
    }
    // password change
    public function passwordchange(){
    	return view('backend.user.passwordchange');
    }
    // submit
    public function passwordchangesubmit(Request $request){
    	$validatedData = $request->validate([
            'password' => 'required|min:6|max:12',
       ]);
         $password=Auth::user()->password;
         $oldpass=$request->oldpass;
         $newpass=$request->password;
         $confirm=$request->password_confirmation;
         if (Hash::check($oldpass,$password)) {
              if ($newpass === $confirm) {
                   $user=Admin::find(Auth::id());
                   $user->password=Hash::make($request->password);
                   $user->save();
                   Auth::logout();
                   $notification=array(
                     'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                     'alert-type'=>'success'
                      );
                    return Redirect()->route('admin.login')->with($notification);
              }else{
                  $notification=array(
                     'messege'=>'New password and Confirm Password not matched!',
                     'alert-type'=>'error'
                      );
                    return Redirect()->back()->with($notification);
              }
         }else{
           $notification=array(
                   'messege'=>'Old Password not matched!',
                   'alert-type'=>'error'
                    );
                  return Redirect()->back()->with($notification);
         }
    }
    // deactive
    public function deactive($id){
      $update=Admin::where('id',$id)->update([
          'status'=>0,
      ]);
      if($update){
        $notification = array(
            'messege' => 'DeAcitve Success!',
            'alert-type' =>'success'
          );
          return redirect()->back()->with($notification);
      }else{
        $notification = array(
            'messege' => 'DeAcitve Faild!',
            'alert-type' =>'error'
          );
          return redirect()->back()->with($notification);
      }
    }

    public function active($id){
      $update=Admin::where('id',$id)->update([
          'status'=>1,
      ]);
      if($update){
        $notification = array(
            'messege' => 'Acitve Success!',
            'alert-type' =>'success'
          );
          return redirect()->back()->with($notification);
      }else{
        $notification = array(
            'messege' => 'Acitve Faild!',
            'alert-type' =>'error'
          );
          return redirect()->back()->with($notification);
      }
    }




    // view
    public function view($id){
    	$data=Admin::where('id',$id)->first();
    	return view('backend.user.profile',compact('data'));
    }
    // delete
    public function delete($id){
    	//return "ok";
    	$userid=Auth::user()->id;
    	if($id==$userid){
    		$notification = array(
		          'messege' => 'You Canot Delete Of You!',
		          'alert-type' =>'info'
		      	);
		      	return redirect()->back()->with($notification);
    	}else{
    		$delete=Admin::where('id',$id)->delete();
		    if($delete){
		    	$notification = array(
		          'messege' => 'User delete Success!',
		          'alert-type' =>'success'
		      	);
		      	return redirect()->back()->with($notification);
		    }else{
		    	$notification = array(
		          'messege' => 'User Delete Faild!',
		          'alert-type' =>'error'
		      	);
		      	return redirect()->back()->with($notification);
		    }
    	}

    }

    // logout

    public function AdminLogOut()
    {
          Auth::logout();
         $notification=array(
           'messege'=>'Logout success',
           'alert-type'=>'success'
            );
          return Redirect()->route('admin.login')->with($notification);
    }
   // profile
   public function profile($id){
   		$data=Admin::where('id',$id)->first();
   		return view('backend.user.profile');
   }
   // all employee
   public function employee($employee_id){
   		//return $employee_id;
   		$data=Employee::where('id',$employee_id)->select(['id','employee_id','employee_name','email','mobile_number','present_address','present_designation','district'])->first();
   		return response()->json($data);
   }
//    select from 
   public function Select(){
	   return view('layouts.mainfile');
   }

}
