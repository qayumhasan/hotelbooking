@extends('stock.master')
@section('title', 'Daily Stock Report | '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:27px;
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
                        <h4 class="card-title">Daily Stock Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stock.daillytransfer.reportresult')}}" method="get">
                     @csrf
                    <div class="row">
                      <div class="col-md-4">
                           <div class="form-group">
                              <label for="fname">Form Date:</label>
                              <input type="text" class="form-control datepicker"  name="formdate" value="{{$current}}"/>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="fname">To Date:</label>
                              <input type="text" class="form-control datepicker"  name="todate" value="{{$current}}"/>
                           </div>
                        </div>
                        <div class="col-md-4 mt-4">
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
                                 <th>date</th>
                                 <th>invoice</th>
                                 <th>Stock</th>
                                 <th>Number Of Item</th>
                                 <th>number of Qty</th>
                                 <th>Created By</th>
                                 
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($alldata))
                                 @foreach($alldata as $key => $data)
                                       <tr>
                                          <td>{{++$key}}</td>
                                          <td>{{$data->date}}</td>
                                          <td>{{$data->invoice_no}}</td>
                                          <td>{{$data->name}}</td>
                                          <td>{{$data->num_of_item}}</td>
                                          <td>{{$data->num_of_qty}}</td>
                                          <td>{{$data->entry_by}}</td>
                                       </tr>
                                       @php
                                          $reldata=DB::table('physical_stock_details')->where('invoice_no',$data->invoice_no)->orderBy('id','DESC')->get();
                                       @endphp
                                       @foreach($reldata as $rdata)
                                       <tr style="font-size:12px">
                                          <td></td>
                                          <td>{{$rdata->item_name}}</td>
                                          <td></td>
                                          <td>{{$rdata->unit_name}}</td>
                                          <td>{{$rdata->qty}}</td>
                                          <td></td>
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