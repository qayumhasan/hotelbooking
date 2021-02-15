@extends('restaurant.chui.master')
@section('title', 'Daily Stock Report | '.$seo->meta_title)
@section('content')
<style>
.form-control{
   height:30px;
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
                        <h4 class="card-title">Item Wise Sales Report</h4>
                     </div>
                     <span class="float-right mr-2">
                        
                     </span>
                  </div>
                  <div class="card-body">
                  <form action="{{route('admin.restaurant.itemwisesell.report')}}" method="post">
                     @csrf
                    <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="fname">Table Category:</label>
                              <select name="table_id" class="form-control" id="">
                                 <option value="">--select--</option>
                                 @foreach($alltable as $table)
                                 <option value="{{$table->id}}">{{$table->table_no}}</option>
                                 @endforeach
                              </select>
                              @error('table_id')
                                 <div style="color:red">{{ $message }}</div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fname">Form Date:</label>
                              <input type="text" class="form-control datepicker"  name="formdate" value="{{$current}}"/>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fname">To Date:</label>
                              <input type="text" class="form-control datepicker"  name="todate" value="{{$current}}"/>
                           </div>
                        </div>
                        <div class="col-md-2 mt-4">
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
                                 <th>#</th>
                                 <th>Item Name</th>
                                 <th>Qty</th>
                                 <th>Amount</th>
                                 <th>Manage</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                           @if(isset($allreports))
                              @foreach($allreports as $key => $item)
                                 @php
                                    $item_name=App\Models\ItemEntry::where('id',$item->item_id)->select(['item_name','rate'])->firstorFail()->item_name;
                                 @endphp
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$item_name}}</td>
                                 <td>{{ $item->qty }}</td>
                                 <td>{{ $item->amount }}</td>
                                 <td>
                                 <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="{{url('admin/restaurant/item/view/'.$item->item_id)}}"><i class="lar la-eye"></i></a>
                                 </td>
                              </tr>
                              @endforeach
                           @else
                              @php
                                 $allitem=DB::table('restaurant_order_details')
                                 ->select(DB::Raw('sum(qty) as qty'))
                                 ->addselect(DB::Raw('sum(amount) as amount'))
                                 ->addselect('item_id')
                                 ->groupBy('item_id')
                                 ->where('kot_status',1)
                                 ->where('is_active',1)
                                 ->get();
                              @endphp
                              @foreach($allitem as $key => $item)
                                 @php
                                    $item_name=App\Models\ItemEntry::where('id',$item->item_id)->select(['item_name','rate'])->firstorFail()->item_name;
                                 @endphp
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$item_name}}</td>
                                 <td>{{ $item->qty }}</td>
                                 <td>{{ $item->amount }}</td>
                                 <td>
                                 <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="{{url('admin/restaurant/item/view/'.$item->item_id)}}"><i class="lar la-eye"></i></a>
                                 </td>
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