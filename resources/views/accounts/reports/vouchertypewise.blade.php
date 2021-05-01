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
                        <h4 class="card-title">Voucher Transection Reports</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.vouchertypewise')}}" method="POST">
                  <div class="card-header d-flex justify-content-center">
                        @csrf
                     <div class="col-md-3">
                           <div class="form-group">
                                 <label for="fname">Voucher Type: *</label>
                                <select name="voucher_type" id="" class="form-control">
                                <option value="">--select--</option>
                                    <option value="Cash Payment Voucher" @if(isset($voucher)) @if($voucher == 'Cash Payment Voucher')  selected @endif  @endif>Cash Payment Voucher</option>
                                    <option value="Bank Payment Voucher" @if(isset($voucher)) @if($voucher == 'Bank Payment Voucher')  selected @endif  @endif>Bank Payment Voucher</option>
                                    <option value="Fund Transfer Voucher" @if(isset($voucher)) @if($voucher == 'Fund Transfer Voucher')  selected @endif  @endif>Fund Transfer Voucher</option>
                                    <option value="Cash Receipt Voucher" @if(isset($voucher)) @if($voucher == 'Cash Receipt Voucher')  selected @endif  @endif>Cash Receipt Voucher</option>
                                    <option value="Bank Receipt Voucher" @if(isset($voucher)) @if($voucher == 'Bank Receipt Voucher')  selected @endif  @endif>Bank Receipt Voucher</option>
                                    <option value="AorC Receivable Journal Voucher" @if(isset($voucher)) @if($voucher == 'AorC Receivable Journal Voucher')  selected @endif  @endif>A/C Receivable Journal Voucher</option>
                                    <option value="AorC Payble Journal Voucher" @if(isset($voucher)) @if($voucher == 'AorC Payble Journal Voucher')  selected @endif  @endif>A/C Payble Journal Voucher</option>
                                    <option value="Adjustment Journal Voucher" @if(isset($voucher)) @if($voucher == 'Adjustment Journal Voucher')  selected @endif  @endif>Adjustment Journal Voucher</option>
                                    <option value="Account Opening Voucher" @if(isset($voucher)) @if($voucher == 'Account Opening Voucher')  selected @endif  @endif>Account Opening Voucher</option>
        
                                </select>
                           </div>
                     </div>
       
                     <div class="col-md-3">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="table-responsive printableAreasaveprint">
                       
                              @if(isset($searchdata))
                              <table  class="table table-striped table-bordered" >
                                 <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                       <th>Voucher No</th>
                                       <th>Voucher Type</th>
                                       <th>Date</th>
                                       
                                       <th>Account Head</th>
                                       <th>Code</th>
                                       <th>Dabit Amount</th>
                                       <th>Cradit Amount</th>
                                       <th>Balance</th>
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                                 @php
                                    $totaldavitamount=0;
                                    $totalcreditamount=0;
                                    $totalbalance=0;
                                 @endphp
                                 @foreach($searchdata as $key => $sdata)
                                 <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$sdata->VoucherNo}}</td>
                                    <td>{{$sdata->VoucherType}}</td>
                                    <td>{{$sdata->date}}</td>
                                    <td>{{$sdata->Accounts}}</td>
                                    <td>{{$sdata->Code}}</td>
                                    <td>{{$sdata->DabitAmount}}</td>
                                    <td>{{$sdata->CreditAmount}}</td>
                                    <td>{{$sdata->Balance}}</td>
                                 </tr>
                                    @php
                                     $totaldavitamount=$totaldavitamount + $sdata->DabitAmount ;
                                     $totalcreditamount=$totalcreditamount + $sdata->CreditAmount ;
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
                                       <td>Total: {{ $totaldavitamount }}</td>
                                       <td>Total: {{ $totalcreditamount }}</td>
                                       <td>Total: {{ $totalbalance }}</td>
                                    </tr>
                                 </tfoot>
                               </table>
                              @else
                              <table id="datatable" class="table data-table table-striped table-bordered" >
                                 <thead class="text-center">
                                    <tr>
                                       <th>#</th>
                                       <th>Voucher No</th>
                                       <th>Voucher Type</th>
                                       <th>Date</th>
                                       
                                       <th>Account Head</th>
                                       <th>Code</th>
                                       <th>Dabit Amount</th>
                                       <th>Cradit Amount</th>
                                       <th>Balance</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                              @foreach($alldata as $key => $data)
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$data->VoucherNo}}</td>
                                 <td>{{$data->VoucherType}}</td>
                                 <td>{{$data->date}}</td>
                               
                                 <td>{{$data->Accounts}}</td>
                                 <td>{{$data->Code}}</td>
                                 <td>{{$data->DabitAmount}}</td>
                                 <td>{{$data->CreditAmount}}</td>
                                 <td>{{$data->Balance}}</td>
                                 
                              </tr>
                              @endforeach
                                 </tbody>
                               </table>

                              @endif
                          
                     </div>
                  </div>
                  <div class="card-body text-center">
                     <a href="#" class="btn btn-success savepritbtn">Print</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>



<!-- <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content text-center printableAreasaveprint">
         <div class="modal-header " >
               <h5 class="modal-title">INVOICE</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
         </div>
         <div class="modal-body" id="maindata">
            
         </div>
            <div class="modal-footer ">
               <div class="col-md-12 text-right">
                  <p>PrintDate:17/90/34</p><br>
               </div>
               <div class="col-md-12">
               <button type="button" class="btn btn-primary savepritbtn">Print</button>
               </div>
            </div>
           
         </div>
      </div>
   </div>
</div>  -->

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

@endsection
