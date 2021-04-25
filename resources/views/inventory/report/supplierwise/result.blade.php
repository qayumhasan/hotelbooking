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
                        <h4 class="card-title">Supplier Wise Product Purchase Report Result:<span style="font-size:12px">  {{$maindate}}</span></h4>
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
                                       <label for="" class="col-md-3">Supplier</label>
                                       <select name="supplier_id" class="form-control col-md-5" style="font-size:12px">
                                        @if($supplierid == NULL)
                                            <option value="">--All-</option>
                                            @foreach($allsupplier as $supplier)
                                            <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">--All-</option>
                                            @foreach($allsupplier as $supplier)
                                            <option value="{{ $supplier->id }}" @if($supplierid == $supplier->id ) selected @endif>{{$supplier->name}}</option>
                                            @endforeach
                                        @endif
                                       </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group row">
                                       <label for="" class="col-md-3">Form Date</label>
                                       <input type="text" name="formdate"  class="form-control col-md-5 datepicker" value="{{$fdate}}">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group row">
                                       <label for="" class="col-md-3">To Date</label>
                                       <input type="text" name="todate"  class="form-control col-md-5 datepicker" value="{{$tdate}}">
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
                           <tbody class="text-center" style="font-size:12px">
                           @php
                           $total_amount=0;
                           @endphp
                           @if($supplierid == NULL)
                                @foreach($allsupplier as $supplier)
                                        @php
                                            $check=App\Models\Purchase::where('is_deleted',0)->where('supplier_id',$supplier->id)->whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->first();
                                        
                                        @endphp
                                        @if($check)
                                        <tr>
                                            <th>{{ $supplier->name}}</th>
                                        </tr>
                                        @php
                                            $itemall=App\Models\Purchase::where('is_deleted',0)->where('supplier_id',$supplier->id)->whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->get();
                                        
                                        @endphp
                                        @foreach($itemall as $item)
                                            @php
                                                $mainitem=App\Models\PurchaseHead::where('invoice_no',$item->invoice_no)->orderBy('id','DESC')->get();
                                            @endphp
                                            @foreach($mainitem as $val => $maini)
                                            <tr>
                                                <td></td>
                                                <td>{{ $maini->item_name }}</td>
                                                <td>{{ $maini->unit }}</td>
                                                <td>{{ $maini->qty }}</td>
                                                <td>{{ $maini->rate }}</td>
                                                <td>{{ $maini->amount }}</td>
                                            </tr>
                                            @php
                                            $total_amount = $total_amount + $maini->amount;
                                            @endphp
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            @else
                                    @php
                                        $check=App\Models\Purchase::where('is_deleted',0)->where('supplier_id',$supplierid)->whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->first();
                                    @endphp
                                        @if($check)
                                        <tr>
                                            <th>{{ $check->supplier_name}}</th>
                                        </tr>
                                        @php
                                            $itemall=App\Models\Purchase::where('is_deleted',0)->where('supplier_id',$supplierid)->whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->get();
                                        
                                        @endphp
                                        @foreach($itemall as $item)
                                            @php
                                                $mainitem=App\Models\PurchaseHead::where('invoice_no',$item->invoice_no)->orderBy('id','DESC')->get();
                                            @endphp
                                            @foreach($mainitem as $val => $maini)
                                            <tr>
                                                <td></td>
                                                <td>{{ $maini->item_name }}</td>
                                                <td>{{ $maini->unit }}</td>
                                                <td>{{ $maini->qty }}</td>
                                                <td>{{ $maini->rate }}</td>
                                                <td>{{ $maini->amount }}</td>
                                            </tr>
                                            @php
                                            $total_amount = $total_amount + $maini->amount;
                                            @endphp
                                            @endforeach
                                        @endforeach
                                    @endif

                            @endif
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