<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Employee;
use Carbon\Carbon;
use Image;
use Session;

class EmployeeController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    // index
    public function index(){
    	$allemployee=Employee::OrderBy('id','DESC')->get();
    	return view('backend.employee.index',compact('allemployee'));
    }
    // create
    public function create(){
    	$district = DB::table('District_tbl')->get();
    	$employeeid='DurbarIt-'.rand(11,666);
        $designation=Employee::select(['present_designation'])->pluck('present_designation')->unique();

    	return view('backend.employee.create',compact('district','employeeid','designation'));
    }
    // ajax get police station
    public function getpolicestation($district){
        $data = DB::table('Thana_tbl')->where('District',$district)->get();
        dd($data);
    	//return response()->json($data);

    }
    // store
    public function store(Request $request){
         //return $request;
         if($request->checkvalue==1){
             $validated = $request->validate([
             'employee_id' => 'required|unique:employees|max:25',
             'date' => 'required',
     	        'employee_name' => 'required',
     	        'employee_type' => 'required',
     	        'mobile_number' => 'required',
     	        'email' => 'required',
     	        'present_designation' => 'required',
     	        'working_hour' => 'required',
     	        'present_salary' => 'required',
     	        'image' => 'required',
             ]);
         }else{
             $validated = $request->validate([
            
             'date' => 'required',
   	        'employee_name' => 'required',
   	        'employee_type' => 'required',
   	        'mobile_number' => 'required',
   	        'email' => 'required',
   	        'present_designation' => 'required',
   	        'working_hour' => 'required',
   	        'present_salary' => 'required',
   	        'image' => 'required',
             ]);
         }
	    // $validated = $request->validate([
      //
	    //     'date' => 'required',
	    //     'employee_name' => 'required',
	    //     'employee_type' => 'required',
	    //     'mobile_number' => 'required',
	    //     'email' => 'required',
	    //     'present_designation' => 'required',
	    //     'working_hour' => 'required',
	    //     'present_salary' => 'required',
	    //     'image' => 'required',
	    // ]);
	    $data = new Employee;
        if($request->checkvalue==1){
        $data->employee_id = $request->employee_id;
        }else{
        $data->employee_id = $request->employee_newid;
        }
        $data->date = $request->date;
        $data->employee_name = $request->employee_name;
        $data->employee_type = $request->employee_type;
        $data->district = $request->district;
        $data->police_station = $request->police_station;

        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->maritial_status = $request->maritial_status;
        $data->gender = $request->gender;
        $data->blood_group = $request->blood_group;
        $data->religion = $request->religion;
        $data->mobile_number = $request->mobile_number;
        $data->family_mobile_number = $request->family_mobile_number;
        $data->email = $request->email;
        $data->date_of_birth = $request->date_of_birth;
        $data->date_of_birth = $request->date_of_birth;
        $data->nationality = $request->nationality;
        $data->national_id = $request->national_id;
        $data->present_address = $request->present_address;
        $data->permanent_address = $request->permanent_address;


        $data->present_designation = $request->present_designation;
        $data->working_hour = $request->working_hour;
        $data->present_salary = $request->present_salary;
        $data->previous_company = $request->previous_company;
        $data->previous_company_address = $request->previous_company_address;
        $data->previous_salary = $request->previous_salary;
        $data->previous_join_date = $request->previous_join_date;
        $data->previous_end_date = $request->previous_end_date;
        $data->opening_balance = $request->opening_balance;
        $data->balance = $request->balance;
        $data->brance_id = $request->brance_id;

        if ($request->hasFile('cv')) {
            $data->cv = $request->file('cv')->store('public/uploads/file');
        }
        if ($request->hasFile('joining_letter')) {
            $data->joining_letter = $request->file('joining_letter')->store('public/uploads/file');
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(400, 350)->save('public/uploads/employee/' . $ImageName);
            $data->image = $ImageName;

        }
        if($data->save()) {
            Session::flash('success');
            $notification = array(
                'messege' => 'Employee Insert Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Employee Insert Faild',
                'alert-type' => 'error'
            );
        }

    }
    // view
    public function view($id){
        $data=Employee::where('id',$id)->first();
    	return view('backend.employee.profile',compact('data'));
    }
    // edit
    public function edit($id){
        $data=Employee::where('id',$id)->first();
        $district = DB::table('District_tbl')->get();
        $designation=Employee::select(['present_designation'])->pluck('present_designation')->unique();
        return view('backend.employee.edit',compact('data','district','designation'));
    }
    //update
    public function update(Request $request){

          $validated = $request->validate([
            'employee_id'=>'required',
            'date' => 'required',
            'employee_name' => 'required',
            'employee_type' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'present_designation' => 'required',
            'working_hour' => 'required',
            'present_salary' => 'required',

        ]);
        $data = Employee::where('id',$request->id)->first();
        $data->employee_id = $request->employee_id;
        $data->date = $request->date;
        $data->employee_name = $request->employee_name;
        $data->employee_type = $request->employee_type;
        $data->district = $request->district;
        $data->police_station = $request->police_station;

        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->maritial_status = $request->maritial_status;
        $data->gender = $request->gender;
        $data->blood_group = $request->blood_group;
        $data->religion = $request->religion;
        $data->mobile_number = $request->mobile_number;
        $data->family_mobile_number = $request->family_mobile_number;
        $data->email = $request->email;
        $data->date_of_birth = $request->date_of_birth;
        $data->date_of_birth = $request->date_of_birth;
        $data->nationality = $request->nationality;
        $data->national_id = $request->national_id;
        $data->present_address = $request->present_address;
        $data->permanent_address = $request->permanent_address;


        $data->present_designation = $request->present_designation;
        $data->working_hour = $request->working_hour;
        $data->present_salary = $request->present_salary;
        $data->previous_company = $request->previous_company;
        $data->previous_company_address = $request->previous_company_address;
        $data->previous_salary = $request->previous_salary;
        $data->previous_join_date = $request->previous_join_date;
        $data->previous_end_date = $request->previous_end_date;
        $data->opening_balance = $request->opening_balance;
        $data->balance = $request->balance;
        $data->brance_id = $request->brance_id;

        if ($request->hasFile('cv')) {
            $data->cv = $request->file('cv')->store('public/uploads/file');
        }
        if ($request->hasFile('joining_letter')) {
            $data->joining_letter = $request->file('joining_letter')->store('public/uploads/file');
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ImageName = 'th' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(400, 350)->save('public/uploads/employee/' . $ImageName);
            $data->image = $ImageName;

        }
        if($data->save()) {
            Session::flash('success');
            $notification = array(
                'messege' => 'Employee Update Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Employee Update Faild',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
    // delete
    public function delete($id){
        $delete=Employee::where('id',$id)->delete();
        if($delete){
            $notification = array(
                'messege' => 'Employee Delete Success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Employee Delete Faild',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
