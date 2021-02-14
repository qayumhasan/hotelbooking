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
                        <h4 class="card-title">Stock Center Wise Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stock.stockcentersreport')}}" method="post">
                     @csrf
                    <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Stock Center:</label>
                             <select name="stock_center" id="" class="form-control">
                                <option value="">--select--</option>
                                @foreach($allstockcenter as $scenter)
                                <option value="{{$scenter->id}}">{{$scenter->name}}</option>
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
                                 <th></th>
                                
                                 
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($alldata))

                                 @foreach($alldata as $key => $rdata)
                                   
                                     
                                       <tr>
                                          <td>{{++$key}}</td>
                                          <td>{{$rdata->name}}</td>
                                          <td>{{ $rdata->date}}</td>
                                          <td></td>
                                          
                                       </tr>
                                       @php
                                            $detailsdata=App\Models\PhysicalStockDetails::where('invoice_no',$rdata->invoice_no)->get();
                                       @endphp
                                       <tr style="font-size:14px">
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                            <th>Unit Name</th>
                                            
                                        </tr>
                                       @foreach($detailsdata as $newdata)
                                       
                                       <tr style="font-size:12px">
                                           
                                            <td>{{$newdata->item_name}}</td>
                                            <td>{{$newdata->qty}}</td>
                                            <td>{{$newdata->unit_name}}</td>
                                           
                                       </tr>
                                       @endforeach
                                      
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