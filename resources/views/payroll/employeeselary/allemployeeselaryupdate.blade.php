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
                        <h4 class="card-title">All Employee</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.employee.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a> -->
                     </span>
                  </div>
                  <form action="{{route('payroll.employee.selary.update')}}" method="post">
                  @csrf
                  <div class="card-header">
            
                        <div class="row">
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Month:</label>
                                 {{date('F')}}
                                 <select name="month" class="form-control">
                                    <option value="January" @if($month=='January') selected @endif>January</option>
                                    <option value="February" @if($month=='February') selected @endif>February</option>
                                    <option value="March" @if($month=='March') selected @endif>March</option>
                                    <option value="April" @if($month=='April') selected @endif>April</option>
                                    <option value="May" @if($month=='May') selected @endif>May</option>
                                    <option value="June" @if($month=='June') selected @endif>June</option>
                                    <option value="July" @if($month=='July') selected @endif>July</option>
                                    <option value="August" @if($month=='August') selected @endif>August</option>
                                    <option value="September" @if($month=='September') selected @endif>September</option>
                                    <option value="Octobar" @if($month=='Octobar') selected @endif>Octobar</option>
                                    <option value="November" @if($month=='November') selected @endif>November</option>
                                    <option value="December" @if($month=='December') selected @endif>December</option>
                                 
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Year:</label>
                                 <select name="year" class="form-control">
                                    @foreach(range(date('Y')-5, date('Y')) as $y)
                                       <option value="{{$y}}" @if($year==$y)selected @endif > {{$y}} </option>     
                                    @endforeach
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Update Date:</label>
                                 <input type="text" name="date" class="form-control datepicker" id="exampleInputEmail1" value="{{$current}}">
                                 
                               </div>
                           </div>
                        </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" style="font-size:11px;" >
                           <thead class="text-center">
                              <tr>
                                 
                            
                                 <th>Employee Id</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Mode Of Payment</th>
                                 <th>Total Days</th>
                                 <th>No.of Working Days</th>
                                 <th>Guaranteed Leave</th>
                                 <th>Over-Time(Days)</th>
                                 <th>Leave</th>
                               
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($alldata as $key => $data)
                              <tr>
                                <input type="hidden" name="id[]" value="{{$data->id}}">
                               
                                 <td>{{$data->employee_id}}
                                    <input type="hidden" name="employee_user_id[]" value="{{$data->employee_id}}">
                                    <input type="hidden" name="name[]" value="{{$data->employee_name}}">
                                    <input type="hidden" name="designation[]" value="{{$data->present_designation}}">
                                 </td>
                                 <td>{{$data->name}}</td>
                                
                                 <td>{{$data->designation}}</td>
                                 <td>
                                    <select class="form-control" name="mode_of_payment[]" style="margin:0 auto;">
                                       <option value="Bank" @if($data->mode_of_payment=='Bank') selected @endif>Bank</option>
                                       <option value="kash" @if($data->mode_of_payment=='kash') selected @endif>kash</option>
                                       <option value="NGo" @if($data->mode_of_payment=='NGo') selected @endif>NGo</option>
                                    </select>
                                 </td>
                                 <td><input type="hidden" id="totaldays{{$data->id}}" value="30">
                                 30
                                 </td>
                                    <input type="hidden" name="salary[]" value="{{$data->present_salary}}">
                                 <td><input type="text" name="working_days[]" class="form-control wdays working_days{{$data->id}}" id="{{$data->id}}" style="margin:0 auto;" value="{{$data->number_of_working_days}}"></td>
                                 <td><input type="text" name="guaranteed_leave[]" class="form-control guaranteed guaranteed_leave{{$data->id}}" id="{{$data->id}}" style="margin:0 auto;" value="{{$data->guaranteed_leave}}"></td>
                                 <td><input type="text" name="overtime[]" class="form-control overtime over_time{{$data->id}}" id="{{$data->id}}" style="margin:0 auto;" value="{{$data->overtime}}"></td>
                                 <td>
                                    <span id="leave{{$data->id}}" class="leave">{{$data->leave}}</span>
                                    <input type="hidden" name="leave_days[]" class="leavval{{$data->id}}" id="leavval{{$data->id}}" value="{{$data->leave}}">
                                 </td>
                                 
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card-header">
                  <div class="row">
                           <div class="col-md-12">
                               <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                               </div>
                           </div>
                        </div>

                  </div>
                  </form>
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