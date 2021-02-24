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
$current = date("m/d/Y");

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
                                <option value="{{$item->id}}">{{$item->item_name}}</option>
                                @endforeach
                           
                             </select>
                             @error('stock_center')
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Form Date:</label>
                              <input type="text" class="form-control datepicker"  name="formdate" value="{{$current}}"/>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">To Date:</label>
                              <input type="text" class="form-control datepicker"  name="todate" value="{{$current}}"/>
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
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>#</th>
                                 <th>Stock Center</th>
                                 <th>Date</th>
                                 <th>Item Name</th>
                                 <th>Rate</th>
                                 <th>Stock In</th>
                                 <th>Stock Out</th>
                                 <!-- <th></th> -->
                                
                                 
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($alldata))

                                 @foreach($alldata as $key => $rdata)
                                   <tr>
                                       <td>{{++$key}}</td>
                                       <td>{{++$key}}</td>
                                       <td>{{++$key}}</td>
                                       <td>{{++$key}}</td>
                                       <td>{{++$key}}</td>
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
@endsection