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
                        <h4 class="card-title">Voucher List</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <form action="{{route('admin.account.reports.voucherlist')}}" method="POST">
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
                                 <label for="fname">Voucher Type: *</label>
                                 <select name="voucher" id="vouchersearch" class="form-control noradious">
                                    <option value="">--select--</option>
                                    <option value="Cash Payment Voucher" @if(isset($searchdata)) @if($searchdata=='Cash Payment Voucher')  selected @endif @endif>Cash Payment Voucher</option>
                                    <option value="Bank Payment Voucher" @if(isset($searchdata)) @if($searchdata=='Bank Payment Voucher')  selected @endif @endif>Bank Payment Voucher</option>
                                    <option value="Fund Transfer Voucher" @if(isset($searchdata)) @if($searchdata=='Fund Transfer Voucher"')  selected @endif @endif>Fund Transfer Voucher</option>
                                    <option value="Cash Receipt Voucher" @if(isset($searchdata)) @if($searchdata=='Cash Receipt Voucher')  selected @endif @endif>Cash Receipt Voucher</option>
                                    <option value="Bank Receipt Voucher" @if(isset($searchdata)) @if($searchdata=='Bank Receipt Voucher')  selected @endif @endif>Bank Receipt Voucher</option>
                                    <option value="AorC Receivable Journal Voucher" @if(isset($searchdata)) @if($searchdata=='AorC Receivable Journal Voucher')  selected @endif @endif>A/C Receivable Journal Voucher</option>
                                    <option value="AorC Payble Journal Voucher" @if(isset($searchdata)) @if($searchdata=='AorC Payble Journal Voucher')  selected @endif @endif>A/C Payble Journal Voucher</option>
                                    <option value="Adjustment Journal Voucher" @if(isset($searchdata)) @if($searchdata=='Adjustment Journal Voucher')  selected @endif @endif>Adjustment Journal Voucher</option>
                                    <option value="Account Opening Voucher" @if(isset($searchdata)) @if($searchdata=='Account Opening Voucher')  selected @endif @endif>Account Opening Voucher</option>
                                  
                                 </select>
                              
                           </div>
                     </div>
                     <div class="col-md-2">
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
                                       <th>Voucher Type</th>
                                       <th>Voucher NO</th>
                                       <th>Voucher Reference</th>
                                       <th>Check Reference</th>
                                       <th>Advice</th>
                                       <th>Remarks</th>
                                      
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                                
                                 @foreach($searchdata as $key => $sdata)
                                 <tr>
                                         <td>{{++$key}}</td>
                                       <td>{{$sdata->voucher_type}}</td>
                                       <td>{{$sdata->voucher_no}}</td>
                                       <td>{{$sdata->reference}}</td>
                                       <td>{{$sdata->cheque_reference}}</td>
                                       <td>{{$sdata->advice}}</td>
                                       <td>{{$sdata->narration}}</td>
                                 
                                 </tr>
                                
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
                                       <td></td>
                                    </tr>
                                 </tfoot>
                               </table>
                              @else
                              <table id="datatable" class="table data-table table-striped table-bordered" >
                                 <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                       <th>Voucher Type</th>
                                       <th>Voucher NO</th>
                                       <th>Voucher Reference</th>
                                       <th>Check Reference</th>
                                       <th>Advice</th>
                                       <th>Remarks</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                                    @foreach($alldata as $key => $data)
                                    <tr>
                                       <td>{{++$key}}</td>
                                       <td>{{$data->voucher_type}}</td>
                                       <td>{{$data->voucher_no}}</td>
                                       <td>{{$data->reference}}</td>
                                       <td>{{$data->cheque_reference}}</td>
                                       <td>{{$data->advice}}</td>
                                       <td>{{$data->narration}}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                               </table>

                              @endif
                          
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



<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
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
