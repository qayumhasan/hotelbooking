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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                                    @if($employee_id)
                                    @foreach($allemployee as $employee)
                                       <option value="{{$employee->id}}" @if($employee->id==$employee_id) selected @endif> {{ $employee->employee_name }} </option>     
                                    @endforeach
                                    @else
                                    @foreach($allemployee as $employee)
                                       <option value="{{$employee->id}}" @if($employee->id==$employee_id) selected @endif> {{ $employee->employee_name }} </option>     
                                    @endforeach
                                    @endif
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Month:</label>
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
                                 
                                 
                                 <th>Employee Id</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Mode Of Payment</th>
                                 <th>No.of Working Days</th>
                                 <th>Guaranteed Leave</th>
                                 <th>Over-Time(Days)</th>
                                 <th>Leave</th>
                                 <th>Deduct Leave Salary</th>
                                 <th>Gross Salary</th>
                                 <th>Net Salary</th>
                                 <th>print</th>
                                 
                                
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if($data)
                                 <tr>
                                    <td>{{$data->employee_id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->designation}}</td>
                                    <td>{{$data->mode_of_payment}}</td>
                                    <td>{{$data->number_of_working_days}}</td>
                                    <td>{{$data->guaranteed_leave}}</td>
                                    <td>{{$data->overtime}}</td>
                                    <td>{{$data->leave}}</td>
                                    <td>{{round($data->salary - $data->gross_salary ,2)}}</td>
                                    <td>{{round($data->gross_salary ,2)}}</td>
                                    <td>{{$data->salary}}</td>
                                    <td>
                                    <a type="button"  class="btn-sm singleinvoiceprint" data-id="{{$data->id}}"><i class="la la-print"></i></a>
                                    </td>
                                 </tr>
                              @else
                                  <p>No Data Found</p>
                              @endif
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
<!-- modal start-->
<!-- invoice modal -->
<div class="modal fade" id="singleprint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content printaprint">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               <div class="container" id="singleprintsection">
                                         
               </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" id="newmonthsel">Print</button>
      </div>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    $('.singleinvoiceprint').on('click', function() {
      var id = $(this).data('id');
      //$('#singleprintsection').html(data);
      if(id) {
             $.ajax({
                 url: "{{  url('/get/monthwise/salary/print') }}/"+id,
                 type:"GET",
                 success:function(data) {
                   $('#singleprintsection').html(data);
                    $('#singleprint').modal('toggle');
                    
                  } 
             });
         } 

    });
});
</script>


<!-- modal end -->
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