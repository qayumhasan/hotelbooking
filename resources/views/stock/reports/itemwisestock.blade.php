@extends('stock.master')
@section('title', 'Item Wise Report | '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:27px;
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
                        <h4 class="card-title">Item Wise Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.stock.itemwiseresult')}}" method="get">
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
                                 <th>Item Name</th>
                                 <th>Number of Qty</th>
                                 <th>Created By</th>
                                 
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($alldata))

                                 @foreach($alldata as $key => $data)
                                   
                                     
                                       <tr style="font-size:12px">
                                          <td></td>
                                          <td>{{$rdata->item_name}}</td>
                                         
                                          <td></td>
                                          <td></td>
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