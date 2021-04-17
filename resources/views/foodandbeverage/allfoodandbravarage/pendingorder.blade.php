@extends('foodandbeverage.master')
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card printableAreasaveprint">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Pending Order</h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>#</th>
                                 <th>Invoice No</th>
                                 <th>Booking No</th>
                                 <th>Date</th>
                                 <th>Item Name</th>
                                 <th>Number OF Qty</th>
                                 <th>Remarks</th>
                                 <th>status</th>
                                
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($alldata as $key => $data)
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$data->invoice_id}}</td>
                                 <td>{{$data->booking_no}}</td>
                                 <td>{{$data->date}}</td>
                                 <td>{{$data->item_name}}</td>
                                 <td>{{$data->qty}}</td>
                                 <td>{{$data->remarks}}</td>
                                 <td>
                                 @if($data->kot_status==1)
                                 <span class=" btn-info btn-sm">Pending</span>
                                 @endif

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
@endsection