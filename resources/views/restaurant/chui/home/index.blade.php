@extends('restaurant.chui.master')
@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
$time = date("h:i");
@endphp
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

   .list-group-item {
      font-size: 12px;
      padding: 8px 0 0 10px;

   }

   .list-group {
      border-radius: 0px;
   }

   .service {
      padding-top: 8px;
   }

   .service ul li {
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

   .bg-menu {
      background: #E7E9E6;
      color: #1D627E;
      font-weight: bold;
      cursor: pointer;
   }

   .text-color-service {
      color: #1D627E;
      font-weight: bold;
   }


   .datepicker {
      padding: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      border-radius: 0px;

   }


   /* preloader css start from here */
</style>


<div class="content-page">

   <div class="container-fluid">
      <div class="row">
         <!-- <div class="col-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">sadfsdafsd</h4>
                  </div>
                  <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm bg-primary"><span class="pl-1">dsafdsafsda</span>
                  </button>

               </div>
            </div>
         </div> -->
      </div>
      <div class="row">

         @if(count($tables) >0)
         @foreach($tables as $row)
         <div class="col-md-6 col-lg-4">
            <div class="cardoverflow-hidden card-min-height">


               <div class="card-item">
                  <div class="status text-center 
                 {{$row->is_booked == 1 ?'bg-red':'bg-green'}}
                  ">
                     <span class="status-heading">{{ $row->table_no}}</span>
                  </div>


                  <!-- room status booked -->

                  @if($row->is_booked == 1)
                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">{{$row->waiter->employee_name ?? ''}}</li>
                              <li><b>BDT</b> {{round($row->total_amounnt,2)}}</li>
                              <li>{{ \Carbon\Carbon::parse($row->data)->diffForHumans()}}</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">

                        <ul class="list-group pt-1 bg-menu">
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu getkotitem" data-toggle="modal" data-target=".addkotitems" data-whatever="{{{$row->id}}}"><i class="fa fa-history" aria-hidden="true"></i> KOT</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu getkothistory" class="btn btn-primary" data-toggle="modal" data-target=".historymodal" data-whatever="{{$row->id}}"><i class="fa fa-globe" aria-hidden="true"></i> Billing</a>
                           </li>

                           <li class="list-group-item bg-menu">


                              <a class="bg-menu getkothistory" class="btn btn-primary" data-toggle="modal" data-target=".historymodal" data-whatever="{{$row->id}}"><i class="fa fa-globe" aria-hidden="true"></i> At a Glance</a>
                           </li>

                        </ul>

                     </div>
                  </div>

                  <!-- room status booked end-->
                  @else

                  <!-- room status available -->

                  <div class="row p-0">
                     <div class="col-6 p-0">
                        <div class="service">
                           <ul>
                              <li class="text-color-service">Available</li>
                              <li> Available</li>
                              <li>Available</li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-6">

                        <ul class="list-group pt-1 bg-menu">
                           <li class="list-group-item bg-menu">
                              <a class="bg-menu getkotitem" data-toggle="modal" data-target=".addkotitems" data-whatever="{{{$row->id}}}"><i class="fa fa-history" aria-hidden="true"></i> KOT</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a class="bg-menu getkothistory_onlyhistory" class="btn btn-primary" data-id="{{$row->id}}"><i class="fa fa-globe" aria-hidden="true"></i> History</a>
                           </li>

                           <li class="list-group-item bg-menu">
                              <a data-toggle="modal " class="bg-menu ataglance_update" data-id="{{$row->id}}"><i class="fa fa-calendar-check" aria-hidden="true"></i> At a Glance
                              </a>
                           </li>

                        </ul>

                     </div>
                  </div>



                  <!-- room status available end -->
                  @endif




               </div>

            </div>
         </div>
         @endforeach
         @endif




      </div>
   </div>



</div>



<!-- Kot area start -->
<form action="{{route('admin.restaurant.chui.menu.kot.store')}}" method="post">
   @csrf
   <div class="modal fade addkotitems" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">

         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Restaurant Order Table</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body p-0">
               <div class="row">
                  <div class="col-md-4">
                     <div class="card pl-5 pr-5 m-0 border">
                        <form>
                           <div class="form-group row">

                              <div class="col-sm-6">
                                 <label for="recipient-name" class="col-form-label">Date:</label>
                                 <input type="text" class="form-control form-control-sm datepicker" id="res_date" value="{{$current}}">
                                 <small class="text-danger" id="datealt"></small>
                                 <input type="hidden" name="tbl_no" id="tbl_no">
                                 <input type="hidden" name="book_no" id="book_no">

                              </div>


                              <div class="col-sm-6">
                                 <label for="recipient-name" class="col-form-label">Hour:</label>
                                 <input type="time" id="res_hour" class="form-control form-control-sm" value="{{$time}}">
                                 <small class="text-danger" id="timealt"></small>
                              </div>
                           </div>


                           <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Waiter Name:</label>
                              <select class="form-control form-control-sm" id="Waiter_name" name="waiter">
                                 <option disabled selected>-------Select Waiter-------</option>
                                 @foreach($allwaiter as $waiter)
                                 <option value="{{$waiter->id}}">{{$waiter->employee_name}}</option>
                                 @endforeach
                              </select>
                              <small class="text-danger" id="waiteralt"></small>
                           </div>

                           <div class="form-group">
                              <label for="message-text" class="col-form-label">Item Name: *</label>
                              <select class="form-control form-control-sm" name="items" id="items">

                                 <option disabled selected>-------Select Items-------</option>
                                 @foreach($allitem as $item)

                                 <option value="{{$item->id}}">{{$item->item_name}}</option>
                                 @endforeach

                              </select>
                              <small class="text-danger" id="itemsalt"></small>
                           </div>

                           <div class="form-group">
                              <label for="message-text" class="col-form-label">Free Side Menu: *</label>
                              <select class="form-control form-control-sm" name="free_items" id="free_side_menu">

                                 <option disabled selected>-------Select Side Menu-------</option>


                              </select>
                              <small class="text-danger" id="freeitemalt"></small>
                           </div>
                           <div class="form-group">
                              <label for="message-text" class="col-form-label">Quantity:</label>
                              <input type="number" class="form-control form-control-sm" id="quantity" name="qty" />
                              <small class="text-danger" id="quantityalt"></small>
                           </div>
                           <div class="form-group">
                              <label for="message-text" class="col-form-label">KOT Remarks:</label>
                              <textarea class="form-control form-control-sm" id="remarks" name="remarks"></textarea>
                              <small class="text-danger" id="remarksalt"></small>
                           </div>
                           <div class="form-group text-center p-2">
                              <button type="button" id="addtogrid" class="btn btn-sm btn-primary mr-auto">Add To Grid</button>
                              <button type="button" class="btn btn-sm btn-primary mr-auto update">Update</button>
                           </div>
                        </form>
                     </div>
                  </div>



                  <div class="col-md-8">
                     <div>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th scope="col">Item Name</th>
                                 <th scope="col">Quantity</th>
                                 <th scope="col">Rate</th>
                                 <th scope="col">Amount</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody id="kot_materails">




                           </tbody>
                        </table>
                     </div>

                  </div>




               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>

         </div>

      </div>
   </div>
</form>


<div class="modal fade historymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" id="kothistorytable" role="document">

   </div>
</div>


<div class="modal fade ataglance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl" id="kotatglancedetails" role="document">

   </div>
</div>


<!-- at a glance -->

<div class="modal fade ataglance_updatemodal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">At a Glance</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row" id="mainataglance">

            </div>
         </div>
         <div class="modal-footer">

         </div>
      </div>
   </div>
</div>
</div>


<!-- main history -->
<div class="modal fade history_updatemodal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Kot History</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">

               <div class="col-md-1"></div>
               <div class="col-md-4"> Form Date: <input type="text" name="formdate" class="datepicker formdate" value="{{$current}}"> </div>
               <div class="col-md-4">To Date: <input type="text" name="todate" class="datepicker todate" value="{{$current}}"></div>
               <div class="col-md-2 mt-3"><button class="btn-sm btn-success" id="kothistorysearch">search</button></div>


               <div class="col-md-12">
                  <div class="card shadow-sm shadow-showcase">
                     <div class="card-body">
                        <div class="dots text-center" id="searchPreloader" style="display:none">
                           <img src="{{asset('public/uploads/preloader/spinnervlll.gif')}}" width="25%" height="100px" alt="preloader" />


                        </div>
                        <div class="row asif allhistorydata">

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

@isset($orderhead)
@if($orderhead && count($orderdetails) > 0)

<div class="modal fade" id="printmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content printableAreasaveprint">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="container printableAreasaveprintsection" id="billinginvoice">

               <div class="row">
                  <div class="col-md-12 text-center">
                     <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="logo" height="25px">
                  </div>
                  <div class="col-md-12 text-center">
                     <h4>{{$companyinformation->company_name}}</h4>
                     <p>{{$companyinformation->address}}</p>
                  </div>
                  <div class="col-md-6 text-center">
                     <p style="padding:5px 0px; background:#000;color:#fff">Invoice</p>
                  </div>
                  <div class="col-md-6 text-center">
                     <p style="padding:5px 0px; background:#f7f7f7;color:#000">{{$orderhead->invoice_no}}</p>
                  </div>
                  <div class="col-md-12 text-left">
                     <h4 style="font-size:12px">Waiter Name: {{$orderdetails->first()->waiter->employee_name?? ''}}</h4>
                     <p style="font-size:11px">Table No: {{$orderdetails->first()->tableName->table_no?? ''}}</p>
                  </div>
                  <div class="col-md-6 text-left">
                     <!-- <p style="font-size:11px">Booking No: 209876</p> -->
                  </div>
                  <div class="col-md-6 text-right">
                     <p style="font-size:11px">Billing Date: {{$orderhead->payment_date}}</p>
                  </div>
                  <div class="col-md-12">
                     <table class="table table-bordered mt-4">
                        <thead>
                           <tr class="bg-secondary">
                              <th scope="col">Item Name</th>
                              <th scope="col">QTY</th>
                              <th scope="col">Rate</th>
                              <th scope="col">Amount</th>

                           </tr>
                        </thead>
                        <tbody>
                           @if(count($orderdetails) > 0)
                           @foreach($orderdetails as $row)

                           <tr class="deletehistory">
                              <td>{{$row->item->item_name?? ''}}</td>
                              <td>{{$row->qty}}</td>
                              <td>{{$row->rate}}</td>
                              <td>{{$row->amount}}</td>
                           <tr>

                              @endforeach
                              @else
                           <tr>
                              <th colspan="6" class="text-center">No Data Found!</th>
                           </tr>
                           @endif




                        </tbody>

                     </table>
                  </div>
                  <div class="col-md-12 text-right mb=-2">
                     <hr>
                     <p style="font-size:11px">Net Amount: {{$orderhead->total_amount}}</p>
                     <hr>
                     <p style="font-size:11px">Gross Amount:{{$orderhead->gross_amount}} </p>
                  </div>

                  <div class="col-md-6 text-left">
                     <p style="font-size:11px">Signature: </p>
                  </div>
                  <div class="col-md-6 text-right">
                     <p style="font-size:11px">Demo User: </p>
                  </div>
               </div>







            </div>
         </div>
         <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-primary mx-auto savepritbtnarea">Print</button>
         </div>
      </div>
   </div>
</div>

@endif
@endisset



@if(session()->has('kotdata'))

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

                    <?php $kotdata =session('kotdata');
                           $kotdetails = $kotdata['kotdata'];
                           $invoice = $kotdata['kotdetails'];
                    ?>

                    @endif

                    <div class="invoice-title">
                        <div id="main-title">
                            <h4>INVOICE</h4>
                            <span># {{$invoice->invoice_id}}</span>
                        </div>

                        <span id="date">{{$invoice->waiter->employee_name}}</span>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <td>PRODUCT</td>
                                    <td>UNIT</td>
                                </tr>
                            </thead>
                           
                            <tbody>
                            @php
                              $totalqty = 0;
                            @endphp
                          @foreach($kotdetails as $row)
                              <tr>
                                 <td>{{$row->item->item_name ?? ''}}</td>
                                 <td class="text-center">{{$row->qty}}</td>
                                 @php
                                 $totalqty = $totalqty + $row->qty;
                                 @endphp
                              </tr>
                           @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <h4 class="pr-4">Quentity : {{$totalqty}}</h4>
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

@isset($orderhead)
@if($orderhead && count($orderdetails) > 0)
<script>
   $(document).ready(function() {
      $('#printmodal').modal('show');
      $('#showkotdata').modal('show');
   });
</script>
@endif
@endisset

@if(session()->has('kotdata'))
<script>
   $(document).ready(function() {
      $('#kotinvoice').modal('show');
   });
</script>

@endif



<script>
    $(function() {
        $(".savepritbtnarea").on('click', function() {

            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreasaveprintsection").printArea(options);
        });
    });
</script>

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




<!--  ata a glance start-->
<script>
   $(document).ready(function() {
      $('#kothistorysearch').on('click', function() {
         var todate = $(".todate").val();
         var formdate = $(".formdate").val();
         var table_id = $(".table_id").val();
         //alert(table_id);
         $(".allhistorydata").empty();
         $('#searchPreloader').show();

         if (table_id) {
            $.ajax({
               url: "{{  url('/admin/restaurant/chui/getsearch/history/') }}",
               type: "GET",
               data: {
                  todate: todate,
                  formdate: formdate,
                  table_id: table_id,
               },
               success: function(data) {

                  $(".allhistorydata").append(data);
                  $('#searchPreloader').hide();

               }


            });
         }


      });
   });
</script>





<script>
   $(document).ready(function() {
      $('.ataglance_update').on('click', function() {

         var t_id = $(this).data('id');
         $("#mainataglance").empty();
         if (t_id) {
            $.ajax({
               url: "{{  url('/admin/restaurant/chui/getataglance/') }}/" + t_id,
               type: "GET",
               success: function(data) {
                  $("#mainataglance").append(data);
                  $('.ataglance_updatemodal').modal('toggle');

               }


            });
         }

      });
   });
</script>
<!-- at a glance end-->
<!-- main history -->
<script>
   $(document).ready(function() {
      $('.getkothistory_onlyhistory').on('click', function() {
         var t_id = $(this).data('id');
         //alert(ch_id);

         //$('.historydata').empty();
         $(".allhistorydata").empty();
         if (t_id) {
            $.ajax({
               url: "{{  url('/admin/restaurant/chui/gethistory/') }}/" + t_id,
               type: "GET",
               success: function(data) {
                  $(".allhistorydata").append(data);
                  $('.history_updatemodal').modal('toggle');

               }


            });
         }

      });
   });
</script>


<!-- foysal script end -->
<script>
   $(document).ready(function() {
      $('.update').hide();
      $('#items').change(function(params) {
         var val = params.target.value;
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/get/free/item') }}/" + val,
            success: function(data) {
               $('#free_side_menu').empty();
               if (data.length > 0) {

                  $.each(data, function(index, items) {
                     $('#free_side_menu').append('<option value="' + items.item_id + '">' + items.item_name + '</option>');
                  });
               } else {

                  $('#free_side_menu').append('<option selected disabled>No Data Found !</option>');
               }

            }
         });
      });
   });
</script>







<script>
   randomnumber = Math.random();
   var getkotitem = document.querySelectorAll('.getkotitem');

   getkotitem.forEach(function(e) {
      e.addEventListener('click', function() {

         $('#kot_materails').empty();
         document.querySelectorAll('.deleteddata').forEach(function(e) {
            e.remove();
         });

         var modal = $(this);
         var data = modal.data('whatever');

         $('#tbl_no').val(data)


         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/get/kot/item') }}/" + data,
            success: function(data) {

               $('#kot_materails').empty();
               $('#kot_materails').append(data);

               // if (data.length > 0) {
               //    document.querySelectorAll('.deleteddata').forEach(function(e) {
               //       e.remove();
               //    });


               //    data.forEach(function(item, index) {



               //       var html = '<tr class="deleteddata"><th scope="row">' + item.item.item_name + '</th><td>' + item.qty + '</td><td>' + item.rate + '</td><td>' + item.amount + '</td><td><a data-whatever="' + item.id + '" onclick="edititem(this)" class="badge bg-primary-light mr-2"><i class="la la-edit"></i></a><a data-whatever="' + item.id + '"  class="badge bg-danger-light mr-2" onclick="deletitem(this)"><i class="la la-trash"></i></a></td></tr>'
               //       document.querySelector('#kot_materails').insertAdjacentHTML('afterend', html);
               //       document.querySelector('#book_no').value = item.booking_no;

               //    });
               // }

            }
         });


      })
   });
</script>


<script>
   document.querySelector('#book_no').value = randomnumber;
   document.querySelector('#addtogrid').addEventListener('click', function(e) {
      var elements = (function() {

         function getElement() {
            return {
               res_date: $('#res_date').val(),
               res_hour: $('#res_hour').val(),
               Waiter_name: $('#Waiter_name').val(),
               items: $('#items').val(),
               free_items: $('#free_side_menu').val(),
               quantity: $('#quantity').val(),
               remarks: $('#remarks').val(),
               table_no: $('#tbl_no').val(),
               book_no: $('#book_no').val() ? $('#book_no').val() : randomnumber,
            }
         }

         return {
            items: getElement(),
         }
      })();


      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         type: 'post',
         data: elements.items,
         url: "{{ route('admin.restaurant.chui.menu.kot.details.store') }}",
         success: function(data) {
            $('#kot_materails').empty();
            $('#kot_materails').append(data);



            // document.querySelectorAll('.deleteddata').forEach(function(e) {
            //    e.remove();
            // });
            // data.forEach(function(item, index) {

            //    var html = '<tr class="deleteddata"><th scope="row">' + item.item.item_name + '</th><td>' + item.qty + '</td><td>' + item.rate + '</td><td>' + item.amount + '</td><td><a data-whatever="' + item.id + '" onclick="edititem(this)" class="badge bg-primary-light mr-2"><i class="la la-edit"></i></a><a data-whatever="' + item.id + '"  class="badge bg-danger-light mr-2" onclick="deletitem(this)"><i class="la la-trash"></i></a></td></tr>'
            //    document.querySelector('#kot_materails').insertAdjacentHTML('afterend', html);
            //    document.querySelector('#book_no').value = item.booking_no;

            // });

            $('#items').val('');
            $('#free_side_menu').val('');
            $('#quantity').val('');
            $('#remarks').val('');

         },
         error: function(err) {
            if (err.responseJSON.errors.Waiter_name) {

               $('#waiteralt').html(err.responseJSON.errors.Waiter_name[0]);
            }

            if (err.responseJSON.errors.free_items) {
               $('#freeitemalt').html(err.responseJSON.errors.free_items[0]);
            }
            if (err.responseJSON.errors.items) {
               $('#itemsalt').html(err.responseJSON.errors.items[0]);
            }
            if (err.responseJSON.errors.quantity) {
               $('#quantityalt').html(err.responseJSON.errors.quantity[0]);
            }
            if (err.responseJSON.errors.remarks) {
               $('#remarksalt').html(err.responseJSON.errors.remarks[0]);
            }
            if (err.responseJSON.errors.res_date) {
               $('#datealt').html(err.responseJSON.errors.res_date[0]);
            }
            if (err.responseJSON.errors.res_hour) {
               $('#timealt').html(err.responseJSON.errors.res_hour[0]);
            }
         }
      });


   })
</script>


<script>
   function deletitem(em) {
      var id = $(em).data('whatever');
      $(em).closest('.deleteddata').remove();
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         type: 'get',
         url: "{{ url('/admin/restaurant/chui/menu/delete/kot/item') }}/" + id,
         success: function(data) {
            console.log(data);

         }
      });
   }
</script>

<script>
   function edititem(em) {
      document.querySelector('#addtogrid').innerHTML = 'Update';
      var id = $(em).data('whatever');

      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $.ajax({
         type: 'get',
         url: "{{ url('/admin/restaurant/chui/menu/edit/kot/item') }}/" + id,
         success: function(data) {


            console.log(data);

            $('#free_side_menu').empty();
            $('#Waiter_name').val(data[0].waiter_id).selected;
            $('#items').val(data[0].item_id).selected;
            if (data[1] != null) {

               data[1].forEach(function(item) {

                  if (data[0].complement == item.item_id) {
                     $('#free_side_menu').append('<option selected value="' + item.item_id + '">' + item.item_name + '</option>');
                  } else {
                     $('#free_side_menu').append('<option value="' + item.item_id + '">' + item.item_name + '</option>');
                  }



               });

            } else {
               $('#free_side_menu').append('<option disabled selected>No item found!</option>')
            }


            $('#quantity').val(data[0].qty);
            $('#remarks').val(data[0].kot_remarks);

         }
      });


   }
</script>

<script>
   $(document).ready(function() {
      $('.getkothistory').click(function() {
         $('#kothistorytable').empty();

         var modal = $(this);
         var data = modal.data('whatever');
         $('#table_no').html(data);
         $('#history_table_no').val(data);

         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/history/kot/item') }}/" + data,
            success: function(data) {

               $('#kothistorytable').append(data);


            }
         });
      });
   })
</script>


<script>
   $(document).ready(function() {
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $(document).on('submit', '#billing_info_submit', function(e) {
         e.preventDefault();
         var url = $(this).attr('action');
         var type = $(this).attr('method');
         var request = $(this).serialize();
         $.ajax({
            url: url,
            type: type,
            data: request,
            success: function(data) {
               console.log(data);

               if (data.msg == 1) {


               }


            },
            error: function(err) {
               if (err.responseJSON.errors.card_number) {
                  iziToast.error({
                     message: err.responseJSON.errors.card_number[0],
                     position: 'topCenter',
                  });
               }

               if (err.responseJSON.errors.mobile_number) {
                  iziToast.error({
                     message: err.responseJSON.errors.mobile_number[0],
                     position: 'topCenter',
                  });
               }

               if (err.responseJSON.errors.trans_number) {
                  iziToast.error({
                     message: err.responseJSON.errors.trans_number[0],
                     position: 'topCenter',
                  });
               }

               if (err.responseJSON.errors.bank_name) {
                  iziToast.error({
                     message: err.responseJSON.errors.bank_name[0],
                     position: 'topCenter',
                  });
               }

               if (err.responseJSON.errors.bank_name) {
                  iziToast.error({
                     message: err.responseJSON.errors.bank_name[0],
                     position: 'topCenter',
                  });
               }
               if (err.responseJSON.errors.room_no) {
                  iziToast.error({
                     message: err.responseJSON.errors.room_no[0],
                     position: 'topCenter',
                  });
               }

               if (err.responseJSON.errors.customar_number) {
                  iziToast.error({
                     message: 'Customar Name Must Not be Empty!',
                     position: 'topCenter',
                  });
               }



            }
         });
      });
   });
</script>




<script>
   $(document).ready(function() {
      $('.ataglancebtn').click(function() {
         var modal = $(this);
         var table_no = modal.data('whatever');
         $('#kotatglancedetails').empty();

         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'get',
            url: "{{ url('/admin/restaurant/chui/menu/get/at/glance/item') }}/" + table_no,
            success: function(data) {

               $('.detete_at_aglance').remove();
               $('#kotatglancedetails').append(data);

            }
         });
      })
   })
</script>

@endsection