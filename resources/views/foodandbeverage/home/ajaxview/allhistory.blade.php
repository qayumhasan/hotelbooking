      <style>
      .text-center {
            text-align: center !important;
            font-size: 11px;
        }
      </style>
                        <div class="col-md-6">
                           <div class="card shadow-sm shadow-showcase">
                              <div class="card-body">
                                 <div class="row asif">
                                    <div class="col-md-12">
                                       <div class="card">
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                   <table class="table table-striped table-bordered" >
                                                   <thead class="text-center">
                                                      <tr>
                                                         
                                                         <th>Kot Invoice</th>
                                                         <th>Item Name</th>
                                                         <th>Qty</th>
                                                         <th>Amount</th>
                                                         <th>Billing</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody class="text-center">
                                                    @foreach($alldatadetails as $key => $aldata)
                                                            <tr class="remove_data">
                                                                <td>{{$aldata->invoice_id}}</td>
                                                                <td>{{$aldata->item_name}}</td>
                                                                <td>{{$aldata->qty}}</td>
                                                                <td>{{$aldata->amount}}</td>
                                                                <td>
                                                                @if($aldata->billing_status ==0)
                                                                No
                                                                @else
                                                                Yes
                                                                @endif
                                                                </td>
                                                                <td>
                                                                    <a type="button"  class="btn-sm singleinvoiceprint" data-id="{{$aldata->id}}"><i class="la la-print"></i></a>
                                                                </td>
                                                            </tr>
                                                     @endforeach
                                                   </tbody>
                                                   </table>
                                             </div>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                           <div class="card shadow-sm shadow-showcase">
                              <div class="card-body">
                                 <div class="row asif">
                                    <div class="col-md-12">
                                       <div class="card">
                                          <div class="card-body">
                                             <div class="table-responsive">
                                                   <table class="table table-striped table-bordered" >
                                                   <thead class="text-center">
                                                      <tr>
                                                         <th>Booking No</th>
                                                         <th>date</th>
                                                         <th>Item</th>
                                                         <th>Qty</th>
                                                         <th>Amount</th>
                                                         <th>Action</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody class="text-center">
                                                   @foreach($alldata as $key => $aldata)
                                                        @php
                                                            $numberofqty=App\Models\KitchenOrderDetails::where('invoice_id',$aldata->invoice_id)->sum('qty');
                                                            $numberofitem=App\Models\KitchenOrderDetails::where('invoice_id',$aldata->invoice_id)->count();
                                                            $amount=App\Models\KitchenOrderDetails::where('invoice_id',$aldata->invoice_id)->sum('amount');
                                                        @endphp
                                                            <tr class="remove_data">
                                                                <td>{{$aldata->booking_no}}</td>
                                                                <td>{{$aldata->date}}</td>
                                                                <td>{{$numberofitem}}</td>
                                                                <td>{{$numberofqty}}</td>
                                                                <td>{{$amount}}</td>
                                                                <td>
                                                                <a type="button"  class="btn-sm doubleprint" data-id="{{$aldata->id}}"><i class="la la-print"></i></a>
                                                                <button type="button" onclick="deleteitemhistory(this)" data-toggle="tooltip" title="" class="btn" value="{{$aldata->id}}" data-original-title="Remove"><i class="la la-trash" style="color:red"></i></button>
                                                                </td>
                                                            </tr>
                                                     @endforeach
                                                   </tbody>
                                                   </table>
                                             </div>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
    


<script>
$(document).ready(function() {
    $('.singleinvoiceprint').on('click', function() {
      var checkin_id = $(this).data('id');
     
      if(checkin_id) {
             $.ajax({
                 url: "{{  url('/get/singlehistory/invoice/') }}/"+checkin_id,
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

<script>
$(document).ready(function() {
    $('.doubleprint').on('click', function() {
      var kot_id = $(this).data('id');
        //alert(kot_id);
        if(kot_id) {
             $.ajax({
                 url: "{{  url('/get/doublehistory/invoice/') }}/"+kot_id,
                 type:"GET",
                 success:function(data) {

                    $('#doubleprintsection').html(data);
                    $('#allprintsectionprint').modal('toggle');
                    
                  } 
             });
        } 

    });
});
</script>

<!-- ATA SINGLE PRINT  -->
<div id="singleprint" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content printableArea">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Single Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="container" id="singleprintsection">
                                           
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary print">Print</button>
            </div>
        </div>
    </div>
</div>
<!-- Double print section -->
<div id="allprintsectionprint" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content printableAreadouble">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="container" id="doubleprintsection">
                                           
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary doubleprintbtn">Print</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/backend')}}/assets/jquery.PrintArea.js"></script>
        <script>
        $(function () {
            $(".print").on('click', function () {
                //alert("ok");
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
        </script>
          <script>
        $(function () {
            $(".doubleprintbtn").on('click', function () {
                //alert("ok");
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableAreadouble").printArea(options);
            });
        });
        </script>