@extends('accounts.master')
@section('title', 'Trial Balance | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('public/backend')}}/assets/jquery.PrintArea.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
</script>
<script src="{{asset('public/backend/')}}/divjs/divjs.js"></script>
<style>
.form-control {
    height: 32px;
    wodth: 50%;
}


</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
@endphp
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Trial Balance</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.trialbalance')}}" method="POST">
                  <div class="card-header d-flex justify-content-center row">
                     
                        @csrf
            
                        <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">From Date:</label>
                                 <input type="text"  id="formdate" name="formdate" class="formdate form-control noradious datepicker" @if(isset($formdate))  value="{{$formdate}}" style="color:#000"  @else value="{{$current}}" @endif >
                           </div>
                     </div>
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">To Date:</label>
                                 <input type="text"  id="todate"  name="todate" class="todate form-control noradious datepicker"  @if(isset($to_date))  value="{{$to_date}}" style="color:#000" @else value="{{$current}}" @endif>
                                 
                           </div>
                     </div>
                     <div class="col-md-2">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="table-responsive printableAreasaveprint">
                              @if(isset($allledger))
                                    <div class="row ">
                                        <div class="col-md-10 text-center">
                                       
    
                                            <h3 style=" font-size: 30px; font-weight: 600;"> {{$companyinformation->company_name}} </h3>
                                            <h4>TRIAL BALANCE - (Level - 1, 2, 3, 4)</h4>
                                            
                                            <p>( For the Period Of {{$formdate}} to {{$todate}} )</p>
                                        </div>
                                    </div>
                              <table  class="table table-striped table-bordered" >
                                 <thead class="text-center">
                                    <tr>
                                       
                                       <th>Code</th>
                                       <th>Description</th>
                                       <th>Balance As ON ({{$formdate }})</th>
                                       <th>Debit</th>
                                       <th>Credit</th>
                                       <th>Net</th>
                                       <th>Balance As ON ({{ $todate }})</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center" style="font-size:12px">
                                @php
                                    $totaldavit=0;
                                    $totalcredit=0;
                                    $balancetotal=0;
                                    $beforetotalbalamce=0
                                @endphp
                                 @foreach($allledger as $key => $sdata)
                                    @php
                                       $check=DB::table('vAccountsHeadsLeadgerTbl')->where('Code',$sdata->code)->whereBetween('date', [$formdate, $todate])->first();

                                       $balance=DB::table('vAccountsHeadsLeadgerTbl')->where('Code',$sdata->code)->where('date', '<' ,$formdate)->sum('Balance');

                                       $dabitamount=DB::table('vAccountsHeadsLeadgerTbl')->where('Code',$sdata->code)->whereBetween('date', [$formdate, $todate])->sum('DabitAmount');
                                       $creditamount=DB::table('vAccountsHeadsLeadgerTbl')->where('Code',$sdata->code)->whereBetween('date', [$formdate, $todate])->sum('CreditAmount');
                                    @endphp
                                    @if($check)
                                    <tr>
                                          
                                          <td>{{$sdata->code}}</td>
                                          <td>{{$check->Accounts}}</td>
                                          <td>{{ $balance }}</td>
                                          <td>@if($dabitamount==0)  @else {{ $dabitamount}} @endif</td>
                                          <td>@if($creditamount==0) @else {{$creditamount}} @endif</td>
                                          <td> {{ $dabitamount - $creditamount}}   </td>
                                          <td> {{ $balance - $creditamount + $dabitamount }}</td>
                                          
                                    
                                    </tr>
                                          @php
                                             $totaldavit= $totaldavit + $dabitamount;
                                             $totalcredit= $totalcredit + $creditamount;
                                             $balancetotal=  $balancetotal + $balance - $creditamount + $dabitamount;
                                             $beforetotalbalamce= $beforetotalbalamce +  $balance;
                                          @endphp
                                    @endif

                                 @endforeach
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td></td>
                                       
                                       <td rowspan="2" class="text-center">Total:</td>
                                       <td>Dr:  {{$beforetotalbalamce}}</td>
                                       <td>{{$totaldavit}}</td>
                                       <td></td>
                                       <td> </td>
                                       <td>{{$balancetotal}}</td>
                                       
                                    </tr>
                                    <tr>
                                       
                                       <td></td> 
                                       <td>Cr: {{$beforetotalbalamce}}</td> 
                                       <td></td> 
                                       <td>{{$totalcredit}}</td>
                                       <td> </td>
                                       <td>{{$balancetotal}}</td>
                                     
                                     
                                    </tr>
                                 </tfoot>
                               </table>
                              @endif
                          
                     </div>
                  </div>
                  @if(isset($allledger))
                  <div class="card-body text-center">
                     <a class="btn btn-success savepritbtn"> <i class="fa fa-print"> </i></a>
                  </div>
                  @endif
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
