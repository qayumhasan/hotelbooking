<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmsModel;
use App\Models\BulkSms;
use Carbon\Carbon;
use Session;

class BulkSmsController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    //
    public function create(){
    	return view('backend.bulksms.bulksm');
    }
    //bulk sms send
    public function store(Request $request){

        $validated = $request->validate([
            'phone' => 'required',
            'message' => 'required|max:160',
        ]);
    		$insert=BulkSms::insertGetId([
    			'phone'=>$request->phone,
    			'message'=>$request->message,
    		]);
		  $sendSms=BulkSms::where('id',$insert)->first();
      $mobiles = explode(',', $sendSms);

	   foreach($mobiles as $key => $smsphone) {
	   	//dd($smsphone);
        // $sms_text = 'DurbarIt test SMS'. $sendSms->message;
        // $smsinfo =SmsModel::first();
        // $smsurl =$smsinfo->sms_url;
        // $smsname =$smsinfo->sms_username;
        // $smspassword =$smsinfo->sms_password;
        // $postData = array(
        //     'username'=>urlencode($smsname),
        //     'password'=>urlencode($smspassword),
        //     'sms_content'=>$sms_text,
        //     'number'=>urlencode($smsphone),
        //     'sms_type'=>1,
        //
        // );
        // 	$ch = curl_init();
        //     curl_setopt_array($ch, array(
        //     CURLOPT_URL => $smsurl,
        //     CURLOPT_URL => 'http://gosms.xyz/api/v1/sendSms',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_POST => true,
        //     CURLOPT_POSTFIELDS => $postData,
        //     CURLOPT_FOLLOWLOCATION => true
        //     ));
        //    $output = curl_exec($ch);


	    }
	    $notification = array(
              'messege' => 'Sms Send Success!',
              'alert-type' =>'success'
          	);
        return redirect()->back()->with($notification);

    }
}
