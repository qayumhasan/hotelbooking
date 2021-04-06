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

<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between asif">
                     <div class="header-title">
                        <h4 class="card-title">Month Wise Attendence Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.employee.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a> -->
                     </span>
                  </div>
                  <form action="{{route('payroll.monthly.attendence')}}" method="post">
                    @csrf
                  <div class="card-header">
                        <div class="row">
                           <div class="col-md-3">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Year:</label>
                                 <select name="year" class="form-control">
                                    @foreach(range(date('Y')-5, date('Y')) as $y)
                                       <option value="{{$y}}" @if($year==$y)selected @endif > {{$y}} </option>     
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
                                 <th>Employee</th>
                                 <th>Jan</th>
                                 <th>Feb</th>
                                 <th>March</th>
                                 <th>Apr</th>
                                 <th>May</th>
                                 <th>Jun</th>
                                 <th>Jul</th>
                                 <th>Aug</th>
                                 <th>Sep</th>
                                 <th>Oct</th>
                                 <th>Nov</th>
                                 <th>Dec</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                           @foreach($allemployee as $employee)
                              @php
                                 $jan=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','January')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $feb=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','February')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $mar=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','March')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $apr=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','April')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $may=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','May')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $jun=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','June')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $jul=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','July')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $aug=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','August')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $sep=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','September')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $oct=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','October')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $nov=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','November')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                                 $dec=App\Models\EmployeeSelaryGenerate::where('employee_id',$employee->id)->where('year',$year)->where('month','December')->select(['number_of_working_days','guaranteed_leave','overtime'])->first();
                              @endphp
                              <tr>
                                 <td>{{$employee->employee_name}}</td>
                                 <td>@if($jan){{$jan->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($feb){{$feb->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($mar){{$mar->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($apr){{$apr->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($may){{$may->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($jun){{$jun->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($jul){{$jul->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($aug){{$aug->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($sep){{$sep->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($oct){{$oct->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($nov){{$nov->number_of_working_days}} @else 0 @endif</td>
                                 <td>@if($dec){{$dec->number_of_working_days}} @else 0 @endif</td>
                               
                               
                              </tr>
                           @endforeach
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