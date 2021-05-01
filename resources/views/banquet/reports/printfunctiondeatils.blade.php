@extends('banquet.master')
@section('title', 'All Banquet | '.$seo->meta_title)
@section('content')
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
                        <h4 class="card-title">All print Banquet</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.hall.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add Banquet</span></i>
                        </a>
                     </span>
                  </div>
                  <form action="{{route('admin.banquet.printdetais')}}" method="POST">
                  <div class="card-header d-flex justify-content-center row">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">From Date: *</label>
                                <input type="text" class="form-control datepicker" name="fromdate" @if(isset($fromdate)) value="{{$fromdate}}"  @else value="{{$current}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">To Date: *</label>
                                <input type="text" class="form-control datepicker" name="todate" @if(isset($todate)) value="{{$todate}}"  @else value="{{$current}}" @endif>
                            </div>
                        </div>
       
                     <div class="col-md-3">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>Function Start Date</th>
                                 <th>Function End Date</th>
                                 <th>Vanue</th>
                                 <th>Name</th>
                                 <th>Mobile</th>
                                 <th>Entry Date</th>
                               
                                 <th>Print</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                            @if(isset($searchdata))

                                @foreach($searchdata as $data)
                                <tr>
                                    <td>{{$data->date_of_function_form}}</td>
                                    <td>{{$data->date_of_function_to}}</td>
                                    <td>{{$data->venue->venue_name}}</td>
                                    <td>{{$data->guest_name}}</td>
                                    <td>{{$data->mobile}}</td>
                                    <td>{{$data->booking_date}}</td>
                                   <td><a class="banquetdata" type="button" data-toggle="modal" data-target="#exampleModal" data-id="{{$data->id}}" ><i class="fa fa-print"></i></a> </td>
                                     
                                </tr>
                                @endforeach
                            @else

                              @foreach($allbanquet as $data)
                              <tr>
                               
                                    <td>{{$data->date_of_function_form}}</td>
                                    <td>{{$data->date_of_function_to}}</td>
                                    <td>{{$data->venue->venue_name}}</td>
                                    <td>{{$data->guest_name}}</td>
                                    <td>{{$data->mobile}}</td>
                                    <td>{{$data->booking_date}}</td>
                                   
                                    <td>
                                    <a class="banquetdata" type="button" data-toggle="modal" data-target="#exampleModal" data-id="{{$data->id}}" ><i class="fa fa-print"></i></a> 
                                       
                                    </td>
                              </tr>
                              @endforeach
                            @endif
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>











<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 printableAreasaveprint">
                        <style>
                            table.items {
                                border: 0.1mm solid #e7e7e7;
                            }

                            td {
                                vertical-align: top;
                            }

                            .items td {
                                border-left: 0.1mm solid #e7e7e7;
                                border-right: 0.1mm solid #e7e7e7;
                            }

                            table thead td {
                                text-align: center;
                                border: 0.1mm solid #e7e7e7;
                            }

                            .items td.blanktotal {
                                background-color: #EEEEEE;
                                border: 0.1mm solid #e7e7e7;
                                background-color: #FFFFFF;
                                border: 0mm none #e7e7e7;
                                border-top: 0.1mm solid #e7e7e7;
                                border-right: 0.1mm solid #e7e7e7;
                            }

                            .items td.totals {
                                text-align: right;
                                border: 0.1mm solid #e7e7e7;
                            }

                            .items td.cost {
                                text-align: "."center;
                            }
                        </style>
                       

                        <div id="printfunctionajaxdata">
                          
                        </div>

                    </div>
                    <br>
                    <button type="button" class="btn btn-primary mx-auto mt-5 savepritbtn">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
   $(document).ready(function() {
      $('.banquetdata').on('click', function() {
         var chid = $(this).data('id');
        // alert("ok");
         $('#printfunctionajaxdata').empty();
         if(chid) {
               $.ajax({
                  url: "{{  url('/get/banquet/alldata/data/') }}/"+chid,
                  type:"GET",
                  success:function(data) {

                        $('#printfunctionajaxdata').append(data);
                        
                     }

                     
               });
            } 
      });
   });
</script>

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
@endsection