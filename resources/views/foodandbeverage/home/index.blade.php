@extends('foodandbeverage.master')
@section('content')
<style>
   .card-item {
      transform-style: preserve-3d;
      border-radius: 5px;
      box-shadow: 0 20px 20px rgba(0, 0, 0, 0.2), 0px 0px 50px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
   }

   .status-heading {
      font-size: 24px;
      font-weight: bold;
      color: black;
   }
   .list-group-item{
      font-size: 12px;
      padding: 8px 0 0 10px;

   }
   .list-group{
      border-radius: 0px;
   }
   .service{
      padding-top: 8px;
   }
   .service ul li{
      list-style-type: none;
      font-size: 12px;
      padding: 3px 0;
   }


   .bg-navyblue {
      background-color: #66CCFF;
      color: #ffffff;
   }

   .bg-yellow {
      background: #FFFF66;
   }

   .bg-green {
      background-color: #99CC00;
   }
   .bg-menu{
      background: #E7E9E6;
      color: #1D627E;
      font-weight: bold;
   }
   .text-color-service{
      color: #1D627E;
      font-weight: bold;
   }
   .row.asif {
    border: 1px solid #cecece;
}
.form-control {
    height: 30px;
   
}
.card {
    padding: 9px 0px;
}
</style>

@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
$time = date("h:i");
@endphp

<div class="content-page">
   <div class="container-fluid">
  
      <div class="row">
         @foreach($rooms as $row)
         <div class="col-md-6 col-lg-4">
            <div class="cardoverflow-hidden card-min-height">
               <div class="card-item">
                  <div class="status text-center bg-red">
                     <span class="status-heading">{{$row->room_no}}</span>
                  </div>
                   @if($row->room_status == 3)
                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">{{$row->checkin['guestname'] ?? ''}}</li>
                              <li>{{$row->checkin['mobile'] ?? ''}}</li>
                              <li>{{$row->checkin['company_name'] ?? ''}}</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">
                        <ul class="list-group pt-1 bg-menu">
                        <li class="list-group-item bg-menu">
                              <a class="bg-menu kitchen" type="button" data-toggle="modal" data-target=".bd-example-modal-xl" data-id="{{$row->checkin->id}}"><i class="fa fa-history" aria-hidden="true"></i> Kot</a>
                              <input type="hidden" class="booking_no" value="{{$row->checkin['booking_no'] ?? ''}}">
                           </li>
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu kitchen billing" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" data-id="{{$row->checkin->id}}"><i class="fa fa-globe" aria-hidden="true"></i> Billing</a>
                           </li>
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu kitchen allhistory" type="button" data-toggle="modal" data-target="#newmodal" data-id="{{$row->checkin->id}}" ><i class="fa fa-calendar-check" aria-hidden="true"></i> History</a> 
                           </li>
                        </ul>
                     </div>
                  </div>
                  @endif
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>

<!-- history -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
               <h5 class="modal-title">Kot Billing</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
         </div>
         <div class="modal-body">
         <div class="row">
                  <div class="col-md-6">
                     <table>
                        <tr>
                           <td>Booking No: <span class="booking_no"></span></td>
                        </tr>
                        <tr>
                           <td> Room No: <span class="room_no"></span></td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-md-6">
                     <table>
                        <tr>
                           <td>Chaking Date/Time: <span class="check_date"></span></td>
                        </tr>
                        <tr>
                           <td>Guest Name: <span class="guest_name"></span></td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row asif">
                                    <div class="col-md-12">
                                     <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                
                                                   <form  method="post" id="option-choice-form">
                                                   @csrf
                                                   <table class="table table-striped table-bordered" >
                                                      <thead class="text-center">
                                                            <tr>
                                                               <th><input type="checkbox" id="check_all" checked> <span class="checkmark">Status</span></th>
                                                               <th>Invoice No</th>
                                                               <th>Item Name</th>
                                                               <th>Qty</th>
                                                               <th>Billed</th>
                                                               <th>Action</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody class="text-center billingdata">
                                                   
                                                   
                                                      </tbody>
                                                   </table>
                                                   <button type="button" class="bt btn-success-sm" id="save" value="save" name="submit">Save</button>
                                                   <button type="button" class="bt btn-success-sm " id="save_print" value="saveandprint" name="submit">Save & Print</button>
                                                   </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="modal-footer">
           
         </div>
      </div>
   </div>
</div>
</div>
<!-- history end -->

<!-- learge -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"   aria-hidden="true">
   <form action="{{route('kot.final.insert')}}" method="post" id=" ">
      @csrf
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Kot Entry</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
             

            <div class="row">
            <div class="col-md-6">
               <table>
                  <tr>
                     <td>Booking No: <span class="booking_no"></span></td>
                  </tr>
                  <tr>
                     <td> Room No: <span class="room_no"></span></td>
                  </tr>
               </table>
            </div>
            <div class="col-md-6">
               <table>
                  <tr>
                     <td>Chaking Date/Time: <span class="check_date"></span></td>
                  </tr>
                  <tr>
                     <td>Guest Name: <span class="guest_name"></span></td>
                  </tr>
               </table>
            </div>
            <div class="col-md-12 mt-4">
               <h5>Kitchen Kot</h5>
            </div>
            <div class="col-md-12 mt-5">
            <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                    <div class="row asif">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Date: *</label>
                                                <input type="text" class="form-control datepicker date" name="date" placeholder="Date" id="date" value="{{$current}}"/>
                                                <input type="hidden" class="room_no" name="room_no">
                                                <input type="hidden" class="booking_no" name="booking_no">
                                                <input type="hidden" class="check_date" name="check_date">
                                                <input type="hidden" class="guest_name" name="guest_name">
                                                <input type="hidden" class="invoice_id" name="invoice_id" value="{{$invoice_id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Hour:</label>
                                                <input type="time" class="form-control timehour" name="timehour" value="{{$time}}"/>
                                             </div>
                                          </div>
                                          
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Waiter Name: *</label>
                                                <select class="form-control waiter_name" name="waiter_name">
                                                    <option value="">--select--</option>
                                                    @foreach($allwaiter as $waiter)
                                                    <option value="{{$waiter->id}}">{{$waiter->employee_name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                <div style="color:red" id="waiter_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Item Name: *</label>
                                                <input type="text" name="item_name" class="form-control itemname" list="ref_in" placeholder="Item" />
                                                <input type="hidden" name="i_id" class="i_id"/>
                                                   <datalist id="ref_in">
                                                         @foreach($allitem as $item)
                                                         <option value="{{$item->item_name}}"></option>
                                                         @endforeach
                                                   </datalist>
                                                <div style="color:red" id="item_err"></div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Qty: *</label>
                                                <input type="number" class="form-control qty" name="qty" placeholder="qty" value="1"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8 text-center mb-2">
                                            <div id="file-upload-form" class="uploader-file">
                                                <button type="button" id="additem" class="btn-sm btn-success">Add to Grid</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
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
                                                        <th>#</th>
                                                        <th>Item Name</th>
                                                        <th>Qty</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center alldataitem">

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

            </div>
           </div>
            </div>
            <div class="modal-footer">
               <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
               <button type="submit" class="btn btn-primary">Save And Print</button>
            </div>
         </div>
      </div>
   </form>
</div>
</div>

<!-- history modal -->

<div class="modal fade" id="newmodal" tabindex="-1" role="dialog"   aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Kot History</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6">
                  <table>
                     <tr>
                        <td>Booking No: <span class="booking_no"></span></td>
                     </tr>
                     <tr>
                        <td> Room No: <span class="room_no"></span></td>
                     </tr>
                  </table>
               </div>
               <div class="col-md-6">
                  <table>
                     <tr>
                        <td>Chaking Date/Time: <span class="check_date"></span></td>
                     </tr>
                     <tr>
                        <td>Guest Name: <span class="guest_name"></span></td>
                     </tr>
                  </table>
               </div>
            </div>
            <div class="row historydata">
                     
            </div>
         </div>
         <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
         </div>
      </div>
   </div>
</div>

<!-- history modal end -->


<!-- invoice modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content printableAreasaveprint">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               <div class="container" id="billinginvoice">
                                         
               </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary savepritbtn">Print</button>
      </div>
    </div>
  </div>
</div>



<script src="{{asset('public/backend')}}/assets/jquery.PrintArea.js"></script>
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
    function getPaxdata(el) {
       
      var qty = el.value;
      var id = el.id;
      //console.log(qty);
      
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'get',
            url: "{{ route('billing.quantity.update') }}",
            data: {
                qty:qty,
                id:id,
          
            },
            success: function(data) {
               
               
            },
           
        });
    }
</script>
<script>
$(document).ready(function() {
    $('#save').on('click', function() {
        //$('.bd-example-modal-lg').modal('hide');
       //$('#exampleModal').modal('toggle');
        $.ajax({
            type: 'GET',
            url: "{{ route('billing.status.update') }}",
            data: $('#option-choice-form').serializeArray(),

            success: function(data) {
                $('.billingdata').empty();
               $('.billingdata').append(data);
               
            }
        });

    });
});
</script>
<!-- save and print -->
<script>
$(document).ready(function() {
    $('#save_print').on('click', function() {
       //alert("ok");
        $('.bd-example-modal-lg').modal('hide');
        $('#exampleModal').modal('toggle');
        $.ajax({
            type: 'GET',
            url: "{{ route('billingprint.status.update') }}",
            data: $('#option-choice-form').serializeArray(),

            success: function(data) {
                //$('.billingdata').empty();
                $('#billinginvoice').append(data);
               
            }
        });

    });
});
</script>

<!-- invoice modal end -->
<script>
$(document).ready(function() {
    $('.kitchen').on('click', function() {
      var checkin_id = $(this).data('id');
      
      if(checkin_id) {
             $.ajax({
                 url: "{{  url('/get/checkin/data/') }}/"+checkin_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                    // console.log(data.booking_no)
                        $('.booking_no').html(data.booking_no);
                        $('.booking_no').val(data.booking_no);
                        $('.room_no').html(data.room_no);
                        $('.room_no').val(data.room_no);
                        $('.check_date').html(data.checkin_date);
                        $('.guest_name').html(data.guest_name);
                        $('.guest_name').val(data.guest_name);
                    }
                  
             });
         } 

    });
});
</script>
<script>
$(document).ready(function() {
    $('.billing').on('click', function() {
      var checkin_id = $(this).data('id');
      $('.billingdata').empty();
      if(checkin_id) {
             $.ajax({
                 url: "{{  url('/get/kotall/data/') }}/"+checkin_id,
                 type:"GET",
                 success:function(data) {

                     $('.billingdata').append(data);
                       
                    }

                  
             });
         } 
    });
});
</script>
<script>
$(document).ready(function() {
    $('.allhistory').on('click', function() {
      var checkin_id = $(this).data('id');
      //alert("ok");
      $('.historydata').empty();
      if(checkin_id) {
             $.ajax({
                 url: "{{  url('/get/kothistory/data/') }}/"+checkin_id,
                 type:"GET",
                 success:function(data) {

                     $('.historydata').append(data);
                       
                    }

                  
             });
         } 
    });
});
</script>



<script>
$(document).ready(function() {
    $('.kitchen').on('click', function() {
      var checkin_id = $(this).data('id');
      //alert("ok");
      if(checkin_id) {
             $.ajax({
                 url: "{{  url('/get/allkotdetails/data/') }}/"+checkin_id,
                 type:"GET",
                 success:function(data) {
                     $('.alldataitem').html(data);
                  } 
             });
         } 

    });
});
</script>


<script>
$(document).ready(function() {
    $('#additem').on('click', function() {
       var remove_data = document.querySelectorAll('.remove_data');
       remove_data.forEach(function(e){
         e.remove();
       });
       //console.log(remove_data);
      var room_no=$(".room_no").val();
      var guest_name=$(".guest_name").val();
      var date=$(".date").val();
      var timehour=$(".timehour").val();
      var timemin = $(".timemin").val();
      var waitername = $(".waiter_name").val();
      var itemname = $(".itemname").val();
      var qty = $(".qty").val();
      var invoice_id = $(".invoice_id").val();
      var booking_no=$(".booking_no").val();
      var i_id=$(".i_id").val();
     
      
        $.ajax({
            type: 'GET',
            url: "{{route('kot.insert.data')}}",
            //data: $('#tax_cal').serializeArray(),
            data: {
               room_no:room_no,
               booking_no:booking_no,
               guest_name:guest_name,
               date:date,
               timehour:timehour,
               timemin:timemin,
               waitername:waitername,
               itemname:itemname,
               qty:qty,
               invoice_id:invoice_id,
               i_id:i_id,
            },

            success: function(data) {
                  
                  $(".itemname").val("");
                  $(".qty").val(1);
                  $(".i_id").val("");
                  $('.alldataitem').append(data);
                
               
            },

            error: function (err) {
               //console.log(err.responseJSON.errors.itemname[0]);
               $('#waiter_err').html(err.responseJSON.errors.waitername[0]);
               $('#item_err').html(err.responseJSON.errors.itemname[0]);
            }
          
        });
       

    });
});
</script>
<script>
    function cartdata(el) {
        
       //alert(el.value)
        $.post('{{route('get.kotitem.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
               
                     $("#date").val(data.kot_date);
                     $(".timehour").val(data.kot_timehour).selected;
                     $(".timemin").val(data.kot_timemin).selected;
                     $(".itemname").val(data.item_name);
                     $(".i_id").val(data.id);
                     $(".qty").val(data.qty);
                     $(".waiter_name").val(data.waiter_id).selected;

            });
  
   
	}
	cartdata();

</script>

<script>
    function cartDatadelete(el) {
       $('.alldataitem').empty();
       
        $.post('{{route('get.kotitem.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {

               $('.alldataitem').append(data);

            });
   
	}
	cartheaderdelete();
</script>
<script>
function deleteitemkot(el){
         $('.billingdata').empty();
            $.post('{{route('get.subkot.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data){

               $('.billingdata').append(data);
            });
}
</script>

<script>
function deleteitemhistory(el){
      //alert("ok");
            $('.historydata').empty();
            $.post('{{route('get.subkothitory.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data){
               //$('.historydata').empty();
               $('.historydata').append(data);
            });
}
</script>

<!-- billing save -->


<script type="text/javascript">

    $(document).ready(function () {

        $('#check_all').on('click', function(e) {

         if($(this).is(':checked',true))  

         {
            $(".checkbox").prop('checked', true);  

         } else {  

            $(".checkbox").prop('checked',false);  

         }  

        });

    });

</script>

<script>
    $('body').on('keydown','input,select,textarea',function(e){
    var self=$(this)
    ,form=self.parents('form:eq(0)')
    ,focusable
    ,next
    ;
    if(e.keyCode==13){
    focusable=form.find('input,a,select,button,textarea').filter(':visible');
    next=focusable.eq(focusable.index(this)+1);
    if (next.length){
    next.focus();
    } else{
    form.submit();
    }
    return false;
    }
    });
</script>


<script>
   $('body').on('keydown', 'input,select,textarea', function(e) {
   
      var self = $(this),
         form = self.parents('form:eq(0)'),
         focusable, next;
      if (e.keyCode == 13) {
         
         focusable = form.find('input,a,select,button,textarea').filter(':visible');
         next = focusable.eq(focusable.index(this) + 1);
         if (next.length) {
            next.focus();
         } else {
            form.submit();
         }
         return false;
      }
   });
</script>


@if(Session::has('kotdata'))
<div class="modal fade" id="kotinvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kitchen Order List Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="invoice-card printableAreasaveprintsectioninvoice">
                    <style>
                        .invoice_item:hover {
                            background: gray;
                            color: white;
                            cursor: pointer;
                        }


                        .invoice-card {

                            padding: 10px 2em;
                            background-color: #fff;
                            border-radius: 5px;
                        }

                        .invoice-card>div {
                            margin: 5px 0;
                        }

                        .invoice-title {
                            flex: 3;
                        }

                        .invoice-title #date {
                            display: block;
                            margin: 8px 0;
                            font-size: 12px;
                        }

                        .invoice-title #main-title {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 2em;
                        }

                        .invoice-title #main-title h4 {
                            letter-spacing: 2.5px;
                        }

                        .invoice-title span {
                            color: rgba(0, 0, 0, 0.4);
                        }

                        .invoice-details {
                            flex: 1;
                            border-top: 0.5px dashed grey;
                            border-bottom: 0.5px dashed grey;
                            display: flex;
                            align-items: center;
                        }

                        .invoice-table {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        .invoice-table thead tr td {
                            font-size: 12px;
                            letter-spacing: 1px;
                            color: grey;
                            padding: 8px 0;
                        }

                        .invoice-table thead tr td:nth-last-child(1),
                        .row-data td:nth-last-child(1),
                        .calc-row td:nth-last-child(1) {
                            text-align: right;
                        }

                        .invoice-table tbody tr td {
                            padding: 8px 0;
                            letter-spacing: 0;
                        }

                        .invoice-table .row-data #unit {
                            text-align: center;
                        }

                        .invoice-table .row-data span {
                            font-size: 13px;
                            color: rgba(0, 0, 0, 0.6);
                        }

                        .invoice-footer {
                            flex: 1;
                            display: flex;
                            justify-content: flex-end;
                            align-items: center;
                        }

                        .invoice-footer #later {
                            margin-right: 5px;
                        }

                        .btn#later {
                            margin-right: 2em;
                        }

                        .company_info {
                            font-size: 10px;
                            font-weight: normal;
                        }
                    </style>
                         @if(Session::has('kotdata'))
                                @php
                                    $kotdata =session('kotdata');
                                    $totalamount=0;
                                @endphp
                            @endif
                    <div class="invoice-title">
                        <div id="main-title">
                            <h4>INVOICE</h4>
                            <span>#</span>
                        </div>

                        <span id="date">{{ $current }}</span>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <td>PRODUCT</td>
                                    <td>Price</td>
                                    <td>Qty</td>
                                    <td>Amount</td>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                          
                            @foreach($kotdata as $kdata)
                                @foreach($kdata as $row)
                                       <tr>
                                            <td>{{$row->item_name}}</td>
                                            <td>{{$row->rate}}</td>
                                            <td>{{$row->qty}}</td>
                                            <td>{{$row->amount}}</td>
                                       <tr>
                                       @php
                                       $totalamount=$totalamount+$row->amount;
                                       @endphp
                                @endforeach
                      
                            @endforeach
                            
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <h4 class="pr-4">Total Amount: {{ $totalamount }}</h4>
                    </div>
             

                </div>
            </div>
            <div class="modal-footer">
                <div class="invoice-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary savepritbtnareainvoice">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@if(Session::has('kotdata'))
<script>
   $(document).ready(function() {
      $('#kotinvoice').modal('show');
   });
</script>
{{session()->forget('kotdata')}}
@endif

<script>
    $(function() {
        $(".savepritbtnareainvoice").on('click', function() {

            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreasaveprintsectioninvoice").printArea(options);
            <?php session()->forget('kotdata'); ?>
        });
    });
</script>

@endsection