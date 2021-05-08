@extends('stock.master')
@section('title', 'Stock-Center Wise Report | '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:30px;
}

</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("Y/m/d");

@endphp
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Stock Availabilty ItemWise</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stockavailability.itemwise')}}" method="post">
                     @csrf
                    <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Item Name:</label>
                             <select name="item_name" class="form-control">
                                <option value="">--select--</option>
                                @foreach($allitem as $item)
                                <option value="{{$item->id}}" @if(isset($item_id)) @if($item_id==$item->id) selected @endif @endif>{{$item->item_name}}</option>
                                @endforeach
                           
                             </select>
                             @error('stock_center')
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                           </div>
                        </div>
                      
                        <div class="col-md-3 mt-4">
                           <div class="form-group">
                              <button class="btn-sm btn-success">Search</button>
                           </div>
                        </div>
                    </div>
                    </form>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                               
                                 <th>Stock Center</th>
                                 <th>Item Name</th>
                                 <th>Rate</th>
                                 <th>In Qty</th>
                                 <th>Out Qty</th>
                                 <th>Stock Qty</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($grouped))

                                 @foreach($grouped as $rdata)
                                   <tr>
                                       <td>{{$rdata->first()->Status}}</td>
                                       <td>{{$rdata->first()->ItemName}}</td>
                                       <td>{{$rdata->first()->Rate}}</td>
                                       <td>{{$rdata->sum('inqty')}}</td>
                                       <td>{{$rdata->sum('outqty')}}</td>
                                       <td>{{$rdata->sum('StockQty')}}</td>
                                   
                                   </tr>
                                 @endforeach

                              @endif
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td>Report Created at: {{$current}}</td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
@endsection