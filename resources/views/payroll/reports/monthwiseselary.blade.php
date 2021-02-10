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
                        <h4 class="card-title">Month Wise Employee Salary</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.employee.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a> -->
                     </span>
                  </div>
                  <form action="{{route('payroll.monthwiseselary.reports')}}" method="post">
                    @csrf
                  <div class="card-header">
                        <div class="row">
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
                                 <label for="exampleInputEmail1">Month:</label>
                                 <select name="month" class="form-control">
                                    <option value="January" @if(date('F')=='January') selected @endif>January</option>
                                    <option value="February" @if(date('F')=='February') selected @endif>February</option>
                                    <option value="March" @if(date('F')=='March') selected @endif>March</option>
                                    <option value="April" @if(date('F')=='April') selected @endif>April</option>
                                    <option value="May" @if(date('F')=='May') selected @endif>May</option>
                                    <option value="June" @if(date('F')=='June') selected @endif>June</option>
                                    <option value="July" @if(date('F')=='July') selected @endif>July</option>
                                    <option value="August" @if(date('F')=='August') selected @endif>August</option>
                                    <option value="September" @if(date('F')=='September') selected @endif>September</option>
                                    <option value="Octobar" @if(date('F')=='Octobar') selected @endif>Octobar</option>
                                    <option value="November" @if(date('F')=='November') selected @endif>November</option>
                                    <option value="December" @if(date('F')=='December') selected @endif>December</option>
                                 
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Year:</label>
                                 <select name="year" class="form-control">
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
                                 
                                 
                                 <th>Employee Id</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Mode Of Payment</th>
                                 <th>No.of Working Days</th>
                                 <th>Guaranteed Leave</th>
                                 <th>Over-Time(Days)</th>
                                 <th>Leave</th>
                                 <th>Deduct Leave Salary</th>
                                 <th>Net Salary</th>
                                 <th>Print</th>
                                 
                                
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

<script type="text/javascript">
  $(document).ready(function() {
     $('.wdays').on('keyup', function(e){


         var id = e.target.id;
         var totaldays=$('#totaldays'+id).val();
         var workingdays=$('.working_days'+id).val();
         var leave=totaldays - workingdays;
         var leavedata=$('#leave'+id).html(leave);
         $('#leavval'+id).val(leave);


     });
     $('.guaranteed').on('keyup', function(e){
         //alert("ok");
            var id = e.target.id;
            var granted_val=$(this).val();
            var leavval=$('#leavval'+id).val();
            var newleaveval= leavval - granted_val;
            $('#leave'+id).html(newleaveval);
            $('#leavval'+id).val(newleaveval);

         });

         $('.overtime').on('keyup', function(e){
        
            var id = e.target.id;
            var over_time=$(this).val();
            var leavval=$('#leavval'+id).val();
           
            var alu= leavval - over_time;
            $('#leave'+id).html(alu);
            $('#leavval'+id).val(alu);

         });
 });
</script>
@endsection