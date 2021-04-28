@extends('accounts.master')
@section('title', 'All Account Transection | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('public/backend')}}/assets/jquery.PrintArea.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
</script>
<script src="{{asset('public/backend/')}}/divjs/divjs.js"></script>
<style>
.form-control {
    height: 32px;
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
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Employee Transection Reports</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.employee')}}" method="POST">
                  <div class="card-header d-flex justify-content-center row">
                     
                        @csrf
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">From Date:</label>
                                 <input type="text"  id="formdate" style="color:#f1dddd" name="formdate" class="formdate form-control noradious datepicker" @if(isset($formdate))  value="{{$formdate}}" style="color:#000"  @else value="{{$current}}" @endif >
                           </div>
                     </div>
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">To Date:</label>
                                 <input type="text"  id="todate"  style="color:#f1dddd" name="todate" class="todate form-control noradious datepicker"  @if(isset($to_date))  value="{{$to_date}}" style="color:#000" @else value="{{$current}}" @endif>
                                 
                           </div>
                     </div>
                     <div class="col-md-1">
                         <div class="form-group mt-4">
                           <input type="checkbox" class="" id="no_date" name="no_date" value="1">
                         </div>
                     </div>
                    
                     <div class="col-md-3">
                           <div class="form-group">
                                 <label for="fname">Name: *</label>
                                 <select name="employee_name" id="employee_report" class="form-control noradious">
                                    <option value="">--select--</option>
                                    @foreach($allemployee as $employee)
                                    <option value="{{$employee->employee_id}}" >{{$employee->employee_name}}</option>
                                    @endforeach
                                 </select>
                                 @error('employee_name')
                                    <div style="color:red">{{ $message }}</div>
                                 @enderror
                           </div>
                     </div>
                     <div class="col-md-3">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="printableAreasaveprint">
                              @if(isset($searchdata))
                              <table width="100%" border="1" style="font-size:12px;">
                                 <thead class="text-center">
                                    <tr>
                                       <th>#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>TransectionID</th>
                                       <th>TransectionType</th>
                                       <th>Date</th>
                                       <th>OpeningBalance</th>
                                       <th>TransectionAmount</th>
                                       <th>Balance</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                                 @php
                                 
                                    $totaltransectionamount=0;
                                    $totalbalance=0;
                                    $minibalance=0;
                                   
                                 @endphp
                                 @foreach($searchdata as $key => $sdata)
                                 <tr>
                                       <td>{{++$key}}</td>
                                       <td>{{$sdata->EmployeeID}}</td>
                                       <td>{{$sdata->EmployeeName}}</td>
                                       <td>{{$sdata->TransecrionID}}</td>
                                    
                                       <td>{{$sdata->TransectionType}}</td>
                                       <td>{{$sdata->Date}}</td>
                                       <td>{{$sdata->OpeningBalance}}</td>
                                       <td>{{$sdata->TransectionAmount}}</td>
                                       
                                       @php
                                       
                                          $minibalance = $minibalance + ($sdata->Balance);
                                       @endphp
                                       <td>{{ $minibalance }}</td>
                                 
                                 </tr>
                                  @php
                                    
                                     $totaltransectionamount=$totaltransectionamount + $sdata->TransectionAmount ;
                                     $totalbalance = $totalbalance +( $sdata->Balance) ;
                                    @endphp
                                 @endforeach
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td>Total: {{ $totaltransectionamount }}</td>
                                       <td>Total: {{ $totalbalance }}</td>
                                    </tr>
                                 </tfoot>
                               </table>
                              @else
                              <table id="datatable" class="table data-table table-striped table-bordered" >
                                 <thead class="text-center">
                                    <tr>
                                       <th>#</th>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>TransectionID</th>
                                       <th>TransectionType</th>
                                       <th>Date</th>
                                       <th>OpeningBalance</th>
                                       <th>TransectionAmount</th>
                                       <th>Balance</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                              @foreach($alldata as $key => $data)
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$data->EmployeeID}}</td>
                                 <td>{{$data->EmployeeName}}</td>
                                 <td>{{$data->TransecrionID}}</td>
                               
                                 <td>{{$data->TransectionType}}</td>
                                 <td>{{$data->Date}}</td>
                                 <td>{{$data->OpeningBalance}}</td>
                                 <td>{{$data->TransectionAmount}}</td>

                                 
                                 <td>{{$data->Balance }}</td>
                                 
                              </tr>
                              @endforeach
                                 </tbody>
                               </table>

                              @endif
                          
                     </div>
                  </div>
                  <div class="card-body text-center">
                  @if(isset($searchdata))
                     <a  class="btn btn-success savepritbtn"><i class="fa fa-print"></i></a>
                  @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script>
        $(function () {
            $(".savepritbtn").on('click', function () {
              //alert("ok");
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableAreasaveprint").printArea(options);
            });
        });
   </script>

<script>
$(document).ready(function() {
    $('.print_click').on('click', function() {
        var id= $(this).data("id");
        $("#maindata").empty();
        $.ajax({
            type: 'GET',
            url: "{{ route('adminaccount.print.voucheraccount') }}",
            data: {
               id:id,
            },

            success: function(data) {

                $("#maindata").append(data)


                $('#exampleModal').modal('toggle');
               
            }
        });

    });
});
</script>
<script>
   $(document).ready(function() {
    $('#no_date').on('click', function(e) {
       
       if(e.target.checked){
         document.getElementById("formdate").style.color = "#000";
      document.getElementById("todate").style.color = "#000";
       }else{
         document.getElementById("formdate").style.color = "#f1dddd";
         document.getElementById("todate").style.color = "#f1dddd";
       }
      

   });
});
</script>

@endsection
