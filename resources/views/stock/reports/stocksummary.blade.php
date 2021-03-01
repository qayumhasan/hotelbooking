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
                        <h4 class="card-title">Stock Summary</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stock.summary')}}" method="post">
                     @csrf
                    <div class="row">
                     <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Qty:</label>
                              <input type="number" class="form-control" name="qty" value="">
                            
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Oparation:</label>
                              <select name="oparation" class="form-control">
                                <option value="equal_to">Equal To</option>
                                <option value="greater_then">Greater Then</option>
                                <option value="greater_then_quel">Greater Then Equal</option>
                                <option value="less_then">Less Then</option>
                                <option value="less_then_equel">Less Then Equal</option>
                             </select>
                           
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Stock Center:</label>
                             <select name="Stock_center" class="form-control">
                                <option value="">--select--</option>
                                @foreach($allstockcenter->unique('Status') as $center)
                                <option value="{{$center->Status}}" @if(isset($sstock)) @if($sstock== $center->Status) selected @endif @endif>{{$center->Status}}</option>
                                @endforeach
                             </select>
                              @error('Stock_center')
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
                                 
                                 <th>ItemName</th>
                                 <th>Unit</th>
                                 <th>Stock</th>
                               
                              </tr>
                           </thead>
                        
                           <tbody class="text-center">
                              @if(isset($newdata))
                                 @foreach($newdata as $rdata)

                                 
                                  
                                    
                                       <tr>
                                             <td>{{$rdata->first()->ItemName}}</td>
                                             <td>{{$rdata->first()->Unit}}</td>
                                             <td>{{$rdata->sum('StockQty')}}</td>
                                       
                                       </tr>
                                        
                                 
                                 @endforeach
                              @endif
                           </tbody>

                           <tfoot>
                              <tr>
                                 <td>Report Created at: {{$current}}</td>
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