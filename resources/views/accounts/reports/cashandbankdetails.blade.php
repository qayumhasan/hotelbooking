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
    wodth: 50%;
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
                        <h4 class="card-title">Cash And Bank(Deposite and Withdrow  )</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.cashandbankdetails')}}" method="POST">
                  <div class="card-header d-flex justify-content-center row">
                     
                        @csrf
            
                        <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">From Date:</label>
                                 <input type="text"  id="formdate"  name="form_date" class="formdate form-control noradious datepicker" @if(isset($formdate))  value="{{$formdate}}"   @else value="{{$current}}" @endif >
                           </div>
                     </div>
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">To Date:</label>
                                 <input type="text"  id="todate"   name="to_date" class="todate form-control noradious datepicker"  @if(isset($todate))  value="{{$todate}}"  @else value="{{$current}}" @endif>
                                 
                           </div>
                     </div>
                     <div class="col-md-2">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="table-responsive ">
                             <div class="row printableAreasaveprint" >
                              <div class="col-md-12">
                              <table class="table table-striped table-bordered" style="font-size:12px;" width="100%">
                                       <thead class="text-center">
                                          <tr>
                                           
                                             <th>Account Description</th>
                                             <th>Opening</th>
                                             <th>Deposit</th>
                                             <th>Withdrow</th>
                                           
                                             
                                             <th>Closing</th>
                                          </tr>
                                       </thead>
                                       @php

                                          $totalcashandbank=0;
                                           $totalopening=0;
                                           $totalwithdraw=0;
                                           $totaldeposite=0;
                                       @endphp
                                       @if(isset($searchdata))
                                          <tbody class="text-center">
                                          @foreach($searchdata as $key => $camount)
                                       
                                          @php
                                                $alldamount=0;
                                                $damountall=App\Models\AccountTransectionDetails::where('account_head_details',$key)->whereBetween('date', [$formdate, $todate])->where('cr_amount',NULL)->get();
                                                
                                                $damountall=$damountall->groupby('account_head_details');
                                                $damountall=$damountall->all();
                                                
                                                foreach($damountall as $key => $dam){
                                                foreach($dam as $did){
                                                   $alldamount= $alldamount + $did->dr_amount ;
                                                }
                                                }
                                                                              
                                                
                                             

                                                $camountall=App\Models\AccountTransectionDetails::where('account_head_details',$key)->whereBetween('date', [$formdate, $todate])->where('dr_amount',NULL)->get();
                                                $camountall=$camountall->groupby('account_head_details');
                                                $camountall=$camountall->all();
                                                $allcamount=0;

                                                foreach($camountall as $cam){
                                                   foreach($cam as $cid){
                                                   $allcamount= $allcamount + $cid->cr_amount ;
                                                }
                                                }
                                            
                                             $totalamount=  $alldamount - $allcamount + $camount->sum('dr_amount') - $camount->sum('cr_amount');
                                             @endphp 
                                             
                                             
                                                      <tr>
                                                         <td>{{++$key}}</td>
                                                         <td> {{ $alldamount - $allcamount }} </td>
                                                         <td>{{  $camount->sum('dr_amount') }} </td>
                                                         <td>{{  $camount->sum('cr_amount') }} </td>
                                                        
                                                         <td>{{$totalamount}} </td>
                                                      </tr>
                                                      @php
                                              $totalcashandbank=$totalcashandbank + $totalamount ;
                                              $totalopening=$totalopening + ($alldamount - $allcamount) ;
                                              $totalwithdraw=$totalwithdraw + $camount->sum('cr_amount')  ;
                                              $totaldeposite=$totaldeposite + $camount->sum('dr_amount')  ;
                                             @endphp

                                                      
                                             @endforeach
                                          
                                          </tbody>
                                             <tfoot>
                                             <tr>
                                                <td class="text-right">Total Cash And Bank Balance:</td>
                                                <td class="text-center">{{$totalopening}}</td>
                                                <td class="text-center">{{  $totaldeposite }}</td>
                                                <td class="text-center">{{$totalwithdraw}}</td>
                                                
                                                <td class="text-center">{{ $totalcashandbank }}</td>
                                             </tr>
                                          </tfoot>
                                       @else
                                       <tbody class="text-center">
                                       
                                       @foreach($creadit_amount as $key => $camount)
                                     
                                       @php
                                              $alldamount=0;
                                             $damountall=App\Models\AccountTransectionDetails::where('account_head_details',$key)->where('date','<',$current)->where('cr_amount',NULL)->get();
                                             
                                             $damountall=$damountall->groupby('account_head_details');
                                             $damountall=$damountall->all();
                                             
                                             foreach($damountall as $key => $dam){
                                               foreach($dam as $did){
                                                $alldamount= $alldamount + $did->dr_amount ;
                                               }
                                             }
                                                                           
                                             
                                            

                                             $camountall=App\Models\AccountTransectionDetails::where('account_head_details',$key)->where('date','<',$current)->where('dr_amount',NULL)->get();
                                             $camountall=$camountall->groupby('account_head_details');
                                             $camountall=$camountall->all();
                                             $allcamount=0;

                                             foreach($camountall as $cam){
                                                foreach($cam as $cid){
                                                $allcamount= $allcamount + $cid->cr_amount ;
                                               }
                                             }
                                         

                                          $totalamount=  $alldamount - $allcamount + $camount->sum('dr_amount') - $camount->sum('cr_amount');
                                           
                                          @endphp 
                                          
                                          
                                                   <tr>
                                                      <td>{{++$key}}</td>
                                                      <td> {{ $alldamount - $allcamount }} </td>
                                                      <td>{{  $camount->sum('dr_amount') }} </td>
                                                      <td>{{  $camount->sum('cr_amount') }} </td>
                                                     
                                                      <td>{{$totalamount}} </td>
                                                   </tr>
                                             @php
                                              $totalcashandbank=$totalcashandbank + $totalamount ;
                                              $totalopening=$totalopening + ($alldamount - $allcamount) ;
                                              $totalwithdraw=$totalwithdraw + $camount->sum('cr_amount')  ;
                                              $totaldeposite=$totaldeposite + $camount->sum('dr_amount')  ;
                                             @endphp
                                                   
                                          @endforeach
                                       
                                       </tbody>
                                    
                                       <tfoot>
                                          <tr>
                                             <td class="text-right">Total Cash And Bank Balance:</td>
                                             <td class="text-center">{{$totalopening}}</td>
                                             <td class="text-center">{{  $totaldeposite }}</td>
                                             <td class="text-center">{{$totalwithdraw}}</td>
                                            
                                             <td class="text-center">{{ $totalcashandbank }}</td>
                                          </tr>
                                       </tfoot>
                                     @endif
                                    </table>
                              </div>
                            
                              

                             
                             </div>
                           
                             
                          
                     </div>
                  </div>
                  @if(isset($searchdata))
                  <div class="card-body text-center">
                     <a class="btn btn-success savepritbtn">Print</a>
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

</script>

@endsection
