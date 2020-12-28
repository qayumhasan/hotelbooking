<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscrive;
use App\Models\ContactMessage;
use App\Models\MailSend;
use Mail;
use App\Mail\SendMail;
use Carbon\Carbon;
use Session;

class EmailController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    //
    public function index(){
    	$subscrivemail = Subscrive::get();
    	$allmail = ContactMessage::where('is_deleted',0)->OrderBy('id','DESC')->get();
    	$newmessage=ContactMessage::where('is_deleted',0)->where('is_seen',0)->count();
    	$alldeleted = ContactMessage::where('is_deleted',1)->OrderBy('id','DESC')->get();
    	$allstarted = ContactMessage::where('starred',1)->where('is_deleted',0)->OrderBy('id','DESC')->get();

    	$allsendmail = MailSend::OrderBy('id','DESC')->get();
    	return view('backend.email.allmail',compact('allsendmail','subscrivemail','allmail','newmessage','alldeleted','allstarted'));
    }
    // compose mail
    public function composemail(){
    	$subscrivemail=Subscrive::latest()->get();
    	return view('backend.email.compose',compact('subscrivemail'));
    }
    // emailsend
    public function composemailsend(Request $request){

    	$validated = $request->validate([
	        'email' => 'required',
	        'subject' => 'required',
	        'send_message' => 'required',
   		]);

   		 $insert=MailSend::insertGetId([
   		 	'mail_id'=>json_encode($request->email),
   		 	'subject'=>$request->subject,
   		 	'message'=>$request->send_message,
   		 	'created_at'=>Carbon::now()->toDateTimeString(),
   		 ]);

   		 $maildata=MailSend::where('id',$insert)->first();

        $subject =$maildata->subject;
        $mail_text = $maildata->message;

        foreach(json_decode($maildata->mail_id)  as  $emaill){
            Mail::to(trim($emaill))->queue(new SendMail($subject, $mail_text));
        }
        $notification = array(
              'messege' => 'Mail Send Success!',
              'alert-type' =>'success'
          	);
        return redirect()->back()->with($notification);


    }
    // delete
    public function mailsoftdelete($id){
    	//return $id;
    	$delete=ContactMessage::where('id',$id)->update([
    		'is_deleted'=>1,
    	]);
    	if($delete){
        	$notification = array(
              'messege' => 'Mail delete Success!',
              'alert-type' =>'success'
          	);
          	return redirect()->back()->with($notification);
        }else{
        	$notification = array(
              'messege' => 'Mail delete Faild!',
              'alert-type' =>'error'
          	);
          	return redirect()->back()->with($notification);
        }

    }
    // started
    public function started($dataid,$val){
    	if($val==0){
    		$update=ContactMessage::where('id',$dataid)->update([
    		'starred'=>1,
    		]);
    		return response("1");
    	}else{
    		$update=ContactMessage::where('id',$dataid)->update([
    		'starred'=>0,
    		]);
    		return response("o");
   		}

    }

    public function view($val){
    	//return "ok";
    	$update=ContactMessage::where('id',$val)->update([
    		'is_seen'=>1,
    		]);
    	return response("");
    }

    public function delete($id){
    	$delete=ContactMessage::where('id',$id)->delete();
    	if($delete){
          Session::flash('trashsuccess');
        	$notification = array(
              'messege' => 'Mail delete Success!',
              'alert-type' =>'success'
          	);
          	return redirect()->back()->with($notification);
        }else{
        	$notification = array(
              'messege' => 'Mail delete Faild!',
              'alert-type' =>'error'
          	);
          	return redirect()->back()->with($notification);
        }
    }
    // individual
    public function individualemail($val){
    	//return $val;
    	$data=ContactMessage::where('id',$val)->select(['email'])->first();
    	return json_encode($data);

    }
    //
    public function sendmaildelete($id){
    	$delete=MailSend::where('id',$id)->delete();
    	if($delete){
          Session::flash('sendmailsuccess');
        	$notification = array(
              'messege' => 'Mail delete Success!',
              'alert-type' =>'success'
          	);
          	return redirect()->back()->with($notification);
        }else{
        	$notification = array(
              'messege' => 'Mail delete Faild!',
              'alert-type' =>'error'
          	);
          	return redirect()->back()->with($notification);
        }
    }
}
