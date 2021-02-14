@extends('stock.master')
@section('title', 'Item Wise Report | '.$seo->meta_title)
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
                              <label for="fname">To Date:</label>
                              <input type="text" class="form-control datepicker" name="todate" value="{{$current}}"/>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="fname">All Item:</label>
                              <select name="item_id" class="form-control" id="">
                                 <option value="">--select--</option>
                                 @foreach($allitem as $item)
                                 <option value="{{$item->id}}">{{$item->item_name}}</option>
                                 @endforeach
                              </select>
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
                        <table class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>Date</th>
                                 <th>Invoice</th>
                                 <th>Created By</th>
                                 
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @if(isset($alldata))
                                 @if($item_id != '')
                                 @foreach($alldata as $key => $rdata)
                                       @php
                                          $allitem=App\Models\PhysicalStockDetails::where('invoice_no',$rdata->invoice_no)->OrderBy('id','DESC')->get();
                                       @endphp
                                     
                                       <tr style="font-size:12px">
                                          <td>{{$rdata->date}}</td>
                                          <td>{{$rdata->invoice_no}}</td>
                                          <td></td>
                                       </tr>
                                      
                                       <tr style="font-size:12px">
                                          <th></th>
                                          <th>Item Name</th>
                                          <th>Qty</th>
                                       </tr>
                                       @foreach($allitem as $datqqa)
                                          @if($item_id == $datqqa->item_id)
                                          <tr style="font-size:10px">
                                             <td></td>
                                             <td>{{$datqqa->item_name}}</td>
                                             <td>{{$datqqa->qty}}</td>
                                          </tr>
                                      
                                          @endif
                                       @endforeach
                                      
                                 @endforeach
                                 @else
                                          @foreach($alldata as $key => $rdata)
                                          <tr style="font-size:12px">
                                             <td>{{$rdata->date}}</td>
                                             <td></td>
                                             <td></td>
                                          </tr>
                                          @php
                                             $allitem=App\Models\PhysicalStockDetails::where('invoice_no',$rdata->invoice_no)->OrderBy('id','DESC')->get();
                                          @endphp
                                          <tr style="font-size:12px">
                                             <th></th>
                                             <th>Item Name</th>
                                             <th>Qty</th>
                                          </tr>
                                          @foreach($allitem as $datqqa)
                                          <tr style="font-size:10px">
                                             <td></td>
                                             <td>{{$datqqa->item_name}}</td>
                                             <td>{{$datqqa->qty}}</td>
                                          </tr>
                                          @endforeach
                                          
                                    @endforeach
                                 @endif
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