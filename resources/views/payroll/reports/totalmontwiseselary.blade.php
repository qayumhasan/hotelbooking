@extends('payroll.master')
@section('content')

<style>
.form-control {
    height: 32px;
    background: #ececec;
    width:55%;
    /* margin:0 auto; */
  
}
select.form-control {
    width: 81%;
}
.card-header.d-flex.justify-content-between.asif {
    background: #9e9c9c;
}
</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");
@endphp
<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between asif">
                     <div class="header-title">
                        <h4 class="card-title"> Employee Wise Salary</h4>
                     </div>
                     <span class="float-right mr-2">
                   
                     </span>
                  </div>
                  <form action="{{route('payroll.emloyeemonthwiseselary.reports')}}" method="post">
                    @csrf
                  <div class="card-header">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Employee Name:</label>
                                 <select name="employee_id" class="form-control">
                                    <option value="">--select--</option>
                                    @foreach($allemployee as $employee)
                                       <option value="{{$employee->id}}"> {{ $employee->employee_name }} </option>     
                                    @endforeach
                                  
                                 </select>
                                 @error('employee_id')
                                    <div style="color:red">{{ $message }}</div>
                                 @enderror
                                 
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Year:</label>
                                 <select name="year" class="form-control">
                                    <option value="all">All</option>
                                    @foreach(range(date('Y')-5, date('Y')) as $y)
                                    <option value="{{$y}}" @if(date('Y')==$y)selected @endif > {{$y}} </option>     
                                    @endforeach
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group mt-4">
                                 <label for=""></label>
                                 <button class="btn btn-success" type="submit">view</button>
                               </div>
                           </div>
                        </div>
                  </div>
                  </form>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" style="font-size:11px;" >
                           <thead class="text-center">
                              <tr>
                                 
                                 
                                  <th>Month</th>
                                 <th>Year</th>
                                 <th>Employee Id</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Mode Of Payment</th>
                                 <th>No.of Working Days</th>
                                 <th>Guaranteed Leave</th>
                                 <th>Over-Time(Days)</th>
                                 <th>Leave</th>
                                 <th> Salary</th>
                                 <th>Deduct Leave Salary</th>
                                 <th>Gross Salary</th>
                                
                              </tr>
                           </thead>
                           <tbody class="text-center">

                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card-header">
                  <div class="row">
                          
                  </div>

                  </div>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection