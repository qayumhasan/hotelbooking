<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeSelaryController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
        $allemployee=Employee::latest()->get();
    	return view('payroll.employeeselary.allemployee',compact('allemployee'));
    }
}
