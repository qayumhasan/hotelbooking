@extends('foodandbeverage.master')
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card printableAreasaveprint">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Kot History</h4>
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
                                 <th>Room No</th>
                                 <th>Date</th>
                                 <th>Guest Name</th>
                                 <th>Number OF Item</th>
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
                                 <td>{{$data->room_no}}</td>
                                 <td>{{$data->date}}</td>
                                 <td>{{$data->guest_name}}</td>
                                 @php
                                    $num_of_item=App\Models\KitchenOrderDetails::where('invoice_id',$data->invoice_id)->count();
                                    $num_of_qty=App\Models\KitchenOrderDetails::where('invoice_id',$data->invoice_id)->sum('qty');
                                 @endphp
                                 <td>{{$num_of_item}}</td>
                                 <td>{{$num_of_qty}}</td>
                                 <td>{{$data->remarks}}</td>
                                 <td>
                              
                                 <span class=" btn-success btn-sm">Complate</span>
                                

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