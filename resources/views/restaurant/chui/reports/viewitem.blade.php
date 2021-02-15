@extends('restaurant.chui.master')
@section('title', 'Category Wise Sell Report | '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:30px;
}
</style>
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
                        <h4 class="card-title">Item Result</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">

                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table  class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>#</th>
                                 <th>Booking No</th>
                                 <th>Booking Date</th>
                                 <th>Item name</th>
                                 <th>Qty</th>
                                 <th>Amount</th>
                               
                              </tr>
                           </thead>
                           <tbody class="text-center">
                                @foreach($alldata as $key => $data)
                                    <tr>
                                       <td>{{++$key}}</td>
                                       <td>{{ $data->booking_no }}</td>
                                       <td>{{ $data->kot_date }}</td>
                                       <td>{{$data->item_name}}</td>
                                       <td>{{ $data->qty }}</td>
                                       <td>{{ $data->amount }}</td>
                                      
                                      
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