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
                        <h4 class="card-title">Account Transection Final Reports</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.finalreport')}}" method="POST">
                  <div class="card-header d-flex justify-content-center row">
                     
                        @csrf
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">From Date:</label>
                                 <input type="text"  id="formdate"  name="formdate" class="formdate form-control noradious datepicker" @if(isset($formdate))  value="{{$formdate}}" style="color:#000"  @else value="{{$current}}" @endif >
                           </div>
                     </div>
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">To Date:</label>
                                 <input type="text"  id="todate"  name="todate" class="todate form-control noradious datepicker"  @if(isset($to_date))  value="{{$to_date}}" style="color:#000" @else value="{{$current}}" @endif>
                                 
                           </div>
                     </div>
                     <!-- <div class="col-md-1">
                         <div class="form-group mt-4">
                           <input type="checkbox" class="" id="no_date" name="no_date" value="1">
                         </div>
                     </div> -->
                    
                     
                     <div class="col-md-3">
                           <div class="form-group">
                                 <label for="fname">Chart Of Account: *</label>
                                 <select name="chart_of_account" id="chart_of_account" class="form-control noradious">
                                    <option value="">--select--</option>
                                    @foreach($allchart_of_acc as $account)
                                    <option value="{{$account->code}}" @if(isset($chartof_account)) @if($chartof_account == $account->code) selected @endif @endif>{{ $account->desription_of_account }}</option>
                                    @endforeach
                                 </select>
                               
                           </div>
                     </div>
                     <div class="col-md-3">
                           <div class="form-group">
                                 <label for="fname">Type*</label>
                                 <select name="Transection" id="Transection" class="form-control noradious">
                                    <option value="control_ledger">None</option>
                                    <option value="voucher_summary" @if(isset($vouchername)) @if($vouchername=='voucher_summary') selected @endif @endif>Voucher Summary</option>
                                    <option value="voucher_summary_narration" @if(isset($vouchername)) @if($vouchername=='voucher_summary_narration') selected @endif @endif> Voucher Summary Narration</option>
                                    <option value="transaction_summary">Transaction Summary</option>
                                   
                                 </select>
                               
                           </div>
                     </div>

                     <div class="col-md-2">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="table-responsive">
                                @if(isset($vsamary))
                                    <div class="row">
                                        <div class="col-md-10 text-center">
                                       
    
                                            <h3 style=" font-size: 30px; font-weight: 600;"> {{$companyinformation->company_name}} </h3>
                                            <h4>CashBook</h4>
                                            @php
                                                $chart_name= DB::table('vchart_of_accounts')->where('code',$chartof_account)->select(['desription_of_account'])->first();
                                            @endphp
                                            <h5>{{$chartof_account}} - {{$chart_name->desription_of_account}}</h5>
                                            <p>( For the Period Of {{$formdate}} to {{$todate}} )</p>
                                        </div>
                                    </div>


                                 <table class="table-striped table-bordered" width="100%" >
                                    <thead class="text-center">
                                       <tr>
                                          <th>#</th>
                                          <th>A/C Code</th>
                                          <th>Head Of Account</th>
                                          <th>Debit</th>
                                          <th>Credit</th>
                                          <th>Balance</th>
                                       </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr style="background-color:#d4d4d4">
                                            <td></td>
                                            <td>{{ $formdate }}</td>
                                            <td>Balance Before:</td>
                                            <td>@if($totalbalance > 0) {{ $totalbalance }} @endif</td>
                                            <td>@if($totalbalance < 0) {{ $totalbalance }} @endif</td>
                                            <td>{{$totalbalance}}</td>
                                        </tr>
                                        @php
                                            $cuimalativebalance=$totalbalance;
                                        @endphp
                                        @foreach($vsamary as $vsum)

                                            @php
                                                if($vsum->DabitAmount==0){
                                                    $cuimalativebalance=$cuimalativebalance - $vsum->CreditAmount ;
                                                }
                                                elseif($vsum->CreditAmount=='0'){
                                                    $cuimalativebalance=$cuimalativebalance + $vsum->DabitAmount ;
                                                }
                                               
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ $vsum->date }}</td>
                                                <td>{{ $vsum->VoucherNo }}</td>
                                                <td>@if($vsum->DabitAmount==0) @else{{ $vsum->DabitAmount }} @endif</td>
                                                <td>@if($vsum->CreditAmount==0) @else {{ $vsum->CreditAmount }} @endif</td>
                                                <td> {{ $cuimalativebalance }}</td>
                                            </tr>

                                        @endforeach
                                        <tr style="background-color:#d4d4d4">
                                            <td></td>
                                            <td></td>
                                            <td>Closing Balance:</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$cuimalativebalance}}</td>
                                        </tr>
                                    </tbody>
                                 </table>
                                 @elseif(isset($voucherwithnarration))
                                 <div class="row">
                                        <div class="col-md-10 text-center">
                                       
    
                                            <h3 style=" font-size: 30px; font-weight: 600;"> {{$companyinformation->company_name}} </h3>
                                            <h4>CashBook</h4>
                                            @php
                                                $chart_name= DB::table('vchart_of_accounts')->where('code',$chartof_account)->select(['desription_of_account'])->first();
                                            @endphp
                                            <h5>{{$chartof_account}} - {{$chart_name->desription_of_account}}</h5>
                                            <p>( For the Period Of {{$formdate}} to {{$todate}} )</p>
                                        </div>
                                    </div>


                                 <table class="table-striped table-bordered" width="100%" >
                                    <thead class="text-center">
                                       <tr>
                                          <th>#</th>
                                          <th>A/C Code</th>
                                          <th>Head Of Account</th>
                                          <th>Dabit</th>
                                          <th>Credit</th>
                                          <th>Balance</th>
                                       </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr style="background-color:#d4d4d4">
                                            <td></td>
                                            <td>{{ $formdate }}</td>
                                            <td>Balance Before:</td>
                                            <td>@if($totalbalance > 0) {{ $totalbalance }} @endif</td>
                                            <td>@if($totalbalance < 0) {{ $totalbalance }} @endif</td>
                                            <td>{{$totalbalance}}</td>
                                        </tr>
                                        @php
                                            $cuimalativebalance=$totalbalance;
                                        @endphp
                                        @foreach($voucherwithnarration as $vsum)

                                            @php
                                                if($vsum->DabitAmount==0){
                                                    $cuimalativebalance=$cuimalativebalance - $vsum->CreditAmount ;
                                                }
                                                elseif($vsum->CreditAmount=='0'){
                                                    $cuimalativebalance=$cuimalativebalance + $vsum->DabitAmount ;
                                                }
                                               
                                            @endphp
                                            <tr>
                                                <td></td>
                                                <td>{{ $vsum->date }} @if($vsum->narration==NULL) @else <br><span style="background-color: #d3d6ec; font-size:12px">Narration:{{  $vsum->narration }}</span> @endif </td>
                                               
                                                <td>{{ $vsum->VoucherNo }}</td>
                                                <td>@if($vsum->DabitAmount==0) @else{{ $vsum->DabitAmount }} @endif</td>
                                                <td>@if($vsum->CreditAmount==0) @else {{ $vsum->CreditAmount }} @endif</td>
                                                <td> {{ $cuimalativebalance }}</td>
                                            </tr>

                                        @endforeach
                                        <tr style="background-color:#d4d4d4">
                                            <td></td>
                                            <td></td>
                                            <td>Closing Balance:</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$cuimalativebalance}}</td>
                                        </tr>
                                    </tbody>
                                 </table>
                                 @endif

                             
                          
                     </div>
                  </div>
                  <div class="card-body text-center">
                     <a href="" class="btn btn-success">Print</a>
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
