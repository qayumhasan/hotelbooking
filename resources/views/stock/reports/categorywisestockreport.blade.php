@extends('stock.master')
@section('title', 'Stock ladger| '.$seo->meta_title)
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
                        <h4 class="card-title">Category Wise Stock Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stockledger.categorywise')}}" method="post">
                     @csrf
                    <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">To Date:</label>
                              <input type="text" class="form-control datepicker" name="todate" value="{{$current}}">
                             @error('todate')
                                <div style="color:red">{{ $message }}</div>
                             @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Select Category:</label>
                             <select name="Catgeory" class="form-control">
                                <option value="">--select--</option>
                                @foreach($allcategory->unique('Category') as $category)
                                <option value="{{$category->Category}}"> {{$category->Category}} </option>
                                @endforeach
                           
                             </select>
                             @error('Catgeory')
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Stock Center:</label>
                             <select name="stockcenter" class="form-control">
                                <option value="">--select--</option>
                                @foreach($allstockcenter->unique('Status') as $stockcenter)
                                <option value="{{$stockcenter->Status}}" @if(isset($ssscenter)) @if($ssscenter == $stockcenter->Status) selected @endif @endif>{{$stockcenter->Status}}</option>
                                @endforeach
                           
                             </select>
                             @error('stockcenter')
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
                        <table  class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>Item Name</th>
                                 <th>Rate</th>
                                 <th>In Qty</th>
                                 <th>Out Qty</th>
                                 <th>Stock Qty</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($newdata))

                                 @foreach($newdata as $rdata)
                                   <tr>
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
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td>Report Created By: Demo User</td>
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