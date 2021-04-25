@extends('inventory.master')
@section('title', 'Daily Purchase| '.$seo->meta_title)
@section('content')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/backend')}}/printThis.js"></script>
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
                        <h4 class="card-title">Daily Purchase Report:<span style="font-size:12px">  {{$maindate}}</span></h4>
                     </div>
                     <span class="float-right mr-2">
                       
                     </span>
                  </div>
                 
                  <div class="card-body" id="selector">
                         <form action="{{route('admin.dailypurchase.create')}}" method="post">
                              @csrf
                        <div class="row mb-2">
                              <div class="col-md-5">
                                 <div class="form-group row">
                                       <label for="" class="col-md-3">Form Date</label>
                                       <input type="text" name="formdate"  class="form-control col-md-5 datepicker" value="{{$current}}">
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="form-group row">
                                       <label for="" class="col-md-2">To Date</label>
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
                     <div class="table-responsive" id="printarea">
                        <table class="table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>SNo.</th>
                                 <th>Bill No</th>
                                 <th>Bill Date</th>
                                 <th>Supplier</th>
                                 <th>Net Amount</th>
                                 <th>Stock Center</th>
                                 <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                           <!--  -->
                           @foreach($purchase as $key => $pdata)
                              <tr>
                                 <td >{{++$key}}</td>
                                 <td>{{$pdata->invoice_no}}</td>
                                 <td>{{ $pdata->date }}</td>
                                 <td>{{ $pdata->supplier_name }}</td>
                                 <td>{{round($pdata->total_amount,2)}}</td>
                                 <td>
                                 @if($pdata->stock_center == NULL)
                                   
                                 @else
                                    @php
                                       $stock=App\Models\StockCenter::where('id',$pdata->stock_center)->select(['name'])->first();
                                    @endphp
                                    @if($stock)
                                    {{$stock->name}}
                                    @endif

                                 @endif
                                 </td>
                                 <td>{{Str::limit($pdata->narration,25)}}</td>

                              </tr>
                              @php
                                 $allitem=App\Models\PurchaseHead::where('invoice_no',$pdata->invoice_no)->orderBy('id','DESC')->get();
                              @endphp
                              @foreach($allitem as $item)
                              <tr style="background:#f7f7f7;font-size:12px">
                                 <td></td>
                                 <td></td>
                                 <td>{{$item->item_name}}</td>
                                 <td>{{$item->rate}}</td>
                                 <td>{{$item->qty}}</td>
                                 <td>{{$item->amount}}</td>
                                 <td></td>
                                
                              </tr>
                              @endforeach
                           @endforeach
                           </tbody>
                           
                        </table>
                        <p class="text-right">Total Purchase Amount: {{round($total_amount)}} tk</p>
                        <br>
                        <br>
                        <table class="table table-striped table-bordered" >
                           <p>Summary Of Taxes & Discount</p>
                           <tbody class="text-center">
                           <!--  -->
                              @foreach($purchase as $vat)
                                 @php
                                    $taxcalculation=App\Models\TaxCalculation::where('ref_invoice',$vat->invoice_no)->latest()->get();
                                 @endphp
                                 @foreach($taxcalculation as $tax)
                                 <tr style="background:#f7f7f7;font-size:12px">
                                    @php
                                       $taxname=App\Models\TaxSetting::where('id',$tax->tax_descripton)->first();
                                    @endphp
                                    <td>{{$taxname->tax_description}}</td>
                                    <td>{{$tax->calculation}}</td>
                                    <td>{{$tax->effect}}</td>
                                    <td>{{round($tax->amount,2)}}</td>
                                    <td></td>
                                 </tr>
                                 @endforeach
                              @endforeach
                              
                           </tbody>
                        </table>
                        
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