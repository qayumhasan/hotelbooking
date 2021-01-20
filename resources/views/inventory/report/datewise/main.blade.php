@extends('inventory.master')
@section('title', 'Supplier Wise Report|'.$seo->meta_title)
@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/backend')}}/printThis.js"></script>
<style>
.form-control{
   height:31px;
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
                        <h4 class="card-title">Date Wise Product Purchase Report:<span style="font-size:12px">  {{$maindate}}</span></h4>
                     </div>
                     <span class="float-right mr-2">
                      
                     </span>
                  </div>
                 
                  <div class="card-body" id="selector">
                         <form action="{{route('admin.supplierwise.report')}}" method="post">
                              @csrf
                        <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group row">
                                       <label for="" class="col-md-3">All Item</label>
                                       <select name="supplier_id" class="form-control col-md-5" style="font-size:12px">
                                            <option value="">--All-</option>
                                            @foreach($allitem as $item)
                                            <option value="{{ $item->id }}">{{$item->item_name}}</option>
                                            @endforeach
                                           
                                       </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group row">
                                       <label for="" class="col-md-3">Form Date</label>
                                       <input type="text" name="formdate"  class="form-control col-md-5 datepicker" value="{{$current}}">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group row">
                                       <label for="" class="col-md-3">To Date</label>
                                       <input type="text" name="todate"  class="form-control col-md-5 datepicker" value="{{$current}}">
                                 </div>
                              </div>
                              <div class="col-md-1">
                                 <div class="form-group">
                                    <button class="btn-sm btn-success">Search</button>
                                 </div>
                              </div>
                       </div>
                       </form>
                      <br>
                     <div class="table-responsive" id="printarea">
                        <table class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>SNo.</th>
                                 <th>Item Name</th>
                                 <th>Unit</th>
                                 <th>Qty</th>
                                 <th>Rate</th>
                                 <th>Amount</th>
                               
                              </tr>
                           </thead>
                           <tbody class="text-center">
                                 @php
                                    $total_amount=0;
                                @endphp
                              @foreach($allpurchase as $purchase)
                                 <tr>
                                    <th>{{$purchase->date}}</th>
                                       @php
                                       $allinvoice=App\Models\Purchase::where('date',$purchase->date)->select(['invoice_no'])->get();
                                       @endphp
                                       @foreach($allinvoice as $invoice)
                                          @php
                                             $allitem=App\Models\PurchaseHead::where('invoice_no',$invoice->invoice_no)->select(['id','item_name'])->get();
                                          @endphp
                                          @foreach($allitem as $item)
                                          <tr>
                                             <td>{{$item->id}}</td>
                                             <td>{{$item->item_name}}</td>
                                             <td>{{$item->id}}</td>
                                             <td>{{$item->id}}</td>
                                          </tr>
                                          @endforeach
                                       @endforeach
                                 </tr>
                              @endforeach
                           
                          
                                    <tr>
                                       <th colspan="6">Total:{{$total_amount}} Tk</th>
                                    </tr>
                           </tbody>
                        </table>
                        
                        <br>
                        <br>
                        
                     </div>
                     <div class="row ">
                           <div class="col-md-6 text-left">
                           <p>Report Created On: {{$maindate}}</p>
                           </div>
                           <div class="col-md-6 text-right">
                           <p>Created By: {{Auth::user()->name}}</p>
                           </div>
                        </div>
                     <div class="row text-center">
                        <div class="col-md-12">
                           <button type="button" class="btn-sm btn-info printPage">Print</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>

      
@endsection