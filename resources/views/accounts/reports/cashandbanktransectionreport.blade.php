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
$current = date("Y/m/d");
@endphp
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Cash And Bank Transection Reports</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.cashbank')}}" method="POST">
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
                                 <label for="fname">Chart Of Account: *</label>
                                 <select name="employee_name" id="employee_report" class="form-control noradious">
                                    <option value="">--select--</option>
                                    @foreach($allledger as $ledger)
                                    <option value="{{$ledger->code}}" @if(isset($employee_id)) @if($employee_id==$ledger->code) selected @endif @endif>{{$ledger->desription_of_account}}</option>
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
                  <div class="card-body printableAreasaveprin">
                     <div class="table-responsive">
                              @if(isset($searchdata))
                              <table  class="table table-striped table-bordered" >
                                 <thead class="text-center">
                                    <tr>
                                    <th>#</th>
                                       <th>Code</th>
                                       <th>Head Name</th>
                                       <th>Category</th>
                                       <th>MainCategory</th>
                                      
                                       <th>Date</th>
                                       <th>Credit Amount</th>
                                       <th>Davit Amount</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                                 @php
                                 
                                    $cr_amont=0;
                                    $dr_amount=0;
                                   
                                   
                                 @endphp
                                 @foreach($searchdata as $key => $sdata)
                                 <tr>

                                    <td>{{++$key}}</td>
                                    <td>{{$sdata->AccountHeadCode}}</td>
                                    <td>{{$sdata->AccountTransection}}</td>
                                    <td>{{$sdata->CategoryName}}</td>
                                    <td>{{$sdata->MainCategoryName}}</td>
                                   
                                    <td>{{$sdata->date}}</td>
                                    <td>{{$sdata->CreditAmount}}</td>
                                    <td>{{$sdata->DavitAmount }}</td>
                                 
                                 </tr>
                                 @php
                                 $cr_amont= $cr_amont +$sdata->CreditAmount;
                                 $dr_amount= $dr_amount +$sdata->DavitAmount;
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
                                       <td>Cr-Total: {{$cr_amont}}</td>
                                       <td>Dr-Total: {{$dr_amount}}</td>
                                    </tr>
                                 </tfoot>
                               </table>
                              @else
                                 <table id="datatable" class="table data-table table-striped table-bordered" >
                                    <thead class="text-center">
                                       <tr>
                                          <th>#</th>
                                          <th>Code</th>
                                          <th>Head Name</th>
                                          <th>Category</th>
                                          <th>MainCategory</th>
                                         
                                          <th>Date</th>
                                          <th>Credit Amount</th>
                                          <th>Davit Amount</th>
                                          
                                       
                                       </tr>
                                    </thead>
                                    <tbody class="text-center">
                                 @foreach($alldata as $key => $data)
                                 <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$data->AccountHeadCode}}</td>
                                    <td>{{$data->AccountTransection}}</td>
                                    <td>{{$data->CategoryName}}</td>
                                    <td>{{$data->MainCategoryName}}</td>
                                   
                                    <td>{{$data->date}}</td>
                                    <td>{{$data->CreditAmount}}</td>
                                    <td>{{$data->DavitAmount }}</td>
                                 </tr>
                                 @endforeach
                                    </tbody>
                                 </table>

                              @endif
                          
                     </div>
                  </div>
                  <div class="card-body text-center">
                     @if(isset($searchdata))
                     <a href="#" class="btn btn-success savepritbtn">Print</a>
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
                $("div.printableAreasaveprin").printArea(options);
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
