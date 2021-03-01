@extends('stock.master')
@section('title', 'Consumption Report| '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:30px;
}
.table thead th {
 
    background: darkgray;
    border-bottom: 2px solid #2f2929;
    color: #fff;
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
                        <h4 class="card-title">Consumption Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stock.ConsumptionReport')}}" method="post">
                     @csrf
                    <div class="row">
                     <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Form Date:</label>
                              <input type="text" class="form-control datepicker" name="formdate" value="{{$current}}">
                             @error('formdate')
                                <div style="color:red">{{ $message }}</div>
                             @enderror
                           </div>
                        </div>
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
                              <label for="fname">Item Name:</label>
                             <select name="item_name" class="form-control">
                                <option value="">--select--</option>
                                @foreach($allitem as $item)
                                <option value="{{$item->id}}" @if(isset($itema)) @if($itema==$item->id) selected  @endif @endif>{{$item->item_name}} </option>
                                @endforeach
                           
                             </select>
                              @error('item_name')
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
                                 <th>Center</th>
                                 <th>ItemName</th>
                                 <th>Unit</th>
                                 <th>Sale Qty</th>
                                 <th>Consumption</th>
                                 <th>Net Qty</th>
                              </tr>
                           </thead>
                        
                           <tbody class="text-center">
                              @if(isset($newdata))
                                 @foreach($newdata as $rdata)
                                 <tr>
                                    <td style="background:#f7f7f7">{{$rdata->first()->Status}}</td>
                                 </tr>
                                   <tr>
                                       <td></td>
                                       <td>{{$rdata->first()->ItemName}}</td>
                                       <td>{{$rdata->first()->Unit}}</td>
                                       <td>{{$rdata->sum('outqty')}}</td>
                                       <td>{{$rdata->sum('StockQty')}}</td>
                                       <td>{{$rdata->sum('outqty')}}</td>
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
                                 <td></td>
                                 <td>Report Created By: Demo User</td>
                              </tr>
                           </tfoot>
                        </table>
                        
                     </div>
                  </div>
                  <div class="text-center">
                     <!-- <button class="btn-sm btn-primary">Print</button> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
@endsection