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
                        <h4 class="card-title">Account Transaction Receipt and Payment</h4>
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
                                 <input type="text"  id="formdate"  name="formdate" class="formdate form-control noradious datepicker" @if(isset($formdate))  value="{{$formdate}}"   @else value="{{$current}}" @endif >
                           </div>
                     </div>
                     <div class="col-md-2">
                           <div class="form-group">
                                 <label for="fname">To Date:</label>
                                 <input type="text"  id="todate"   name="todate" class="todate form-control noradious datepicker"  @if(isset($to_date))  value="{{$to_date}}"  @else value="{{$current}}" @endif>
                                 
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
                                       <th>Date</th>
                                       <th>Head Of Account(Receipt)</th>
                                       <th>Amount</th>
                                       <th>Head Of Account(Payment)</th>
                                       <th>Amount</th>
                                      
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
                                       <th>Date</th>
                                       <th>Head Of Account(Receipt)</th>
                                       <th>Amount</th>
                                       <th>Head Of Account(Payment)</th>
                                       <th>Amount</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody class="text-center">
                                    @foreach($alldatareceipt as $key => $rdata)
                                       <tr>
                                             <td>{{ ++$key }}</td>
                                             <td>{{ $rdata->date }}</td>
                                             <td></td>
                                             <td></td>
                                       <tr>
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

</script>

@endsection
