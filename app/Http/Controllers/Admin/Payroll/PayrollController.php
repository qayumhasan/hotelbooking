<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class PayrollController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }
    public function index(){
        $allemployee=Employee::where('status',1)->latest()->get();
    	return view('payroll.home.index',compact('allemployee'));
    }
    // allemployee
    public function allemployee(){
        $allemployee=Employee::where('status',1)->latest()->get();
        return view('payroll.employee.allemployee',compact('allemployee'));
    }
}
