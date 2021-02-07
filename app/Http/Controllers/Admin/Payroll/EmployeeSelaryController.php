<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;
use App\Models\EmployeeSelaryGenerate;

class EmployeeSelaryController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
        $allemployee=Employee::latest()->get();
    	return view('payroll.employeeselary.allemployee',compact('allemployee'));
    }
    public function store(Request $request){
        
        $check=EmployeeSelaryGenerate::where('month',$request->month)->where('year',$request->year)->first();
        if($check){
            $notification = array(
                'messege' => 'This Month Salary Allready Created ',
                'alert-type' => 'info'
            );
            return Redirect()->back()->with($notification);
        }else{
            foreach ($request->id as $key => $v) {

                $data3 = array(
                    'employee_id' => $v,
                    'month' => $request->month,
                    'generate_date' => $request->date,
                    'year' => $request->year,
                    'employee_user_id' => $request->employee_user_id[$key],
                    'name' => $request->name[$key],
                    'designation' => $request->designation[$key],
                    'salary' => $request->salary[$key],
                    'mode_of_payment' => $request->mode_of_payment[$key],
                    'number_of_working_days' => $request->working_days[$key],
                    'guaranteed_leave' => $request->guaranteed_leave[$key],
                    'overtime' => $request->overtime[$key],
                    'leave' => $request->leave_days[$key],
                    'created_at' => Carbon::now()->toDateTimeString(),
    
                );
                $insert=EmployeeSelaryGenerate::Insert($data3);
                
            }
            $notification = array(
                'messege' => 'success',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
            
        }
       
    }
    // all created selary 
    public function allcreateselary(){
        $allselary=EmployeeSelaryGenerate::select(['month','year'])->groupby('year','month')->get();
        //dd($allselary);
        return view('payroll.employeeselary.allselary',compact('allselary'));
    }
    // 
    public function allemplyesalaryedit($month,$year){
       $alldata=EmployeeSelaryGenerate::where('month',$month)->where('year',$year)->get();
       return view('payroll.employeeselary.allemployeeselaryupdate',compact('alldata','month','year'));
    }
    // update
    public function update(Request $request){
       // return $request;
        foreach ($request->id as $key => $v) {
            
            $data3 = array(
                'month' => $request->month,
                'generate_date' => $request->date,
                'year' => $request->year,
                'mode_of_payment' => $request->mode_of_payment[$key],
                'number_of_working_days' => $request->working_days[$key],
                'guaranteed_leave' => $request->guaranteed_leave[$key],
                'overtime' => $request->overtime[$key],
                'leave' => $request->leave_days[$key],
                'updated_at' => Carbon::now()->toDateTimeString(),
            );
            $insert=EmployeeSelaryGenerate::where('id',$v)->update($data3);
            
        }
        $notification = array(
            'messege' => 'success',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    // month wise selary report
    public function monthwiseselary(){
        $allemployee=Employee::where('status',1)->latest()->get();
        return view('payroll.reports.monthwiseselary',compact('allemployee'));
    }
    // generate
    public function monthwiseselarygenerate(Request $request){
        $validated = $request->validate([
            'employee_id' => 'required',
        ]);
        $month=$request->month;
        $year=$request->year;
        $employee_id=$request->employee_id;
        $allemployee=Employee::where('status',1)->latest()->get();
        $data=EmployeeSelaryGenerate::where('employee_id',$request->employee_id)->where('month',$request->month)->where('year',$request->year)->first();
        return view('payroll.reports.monthwiseselaryresult',compact('data','month','year','allemployee','employee_id'));
    }
}
