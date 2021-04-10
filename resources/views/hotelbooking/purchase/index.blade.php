@extends('inventory.master')
@section('title', 'All Purchase | '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Purchase</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.purchase.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add Purchase</span></i>
                        </a>
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>#</th>
                                 <th>Invoice No</th>
                                 <th>Date</th>
                                 <th>Order No</th>
                                 <th>Total Amount</th>
                                 <th>Payment</th>
                                 <th>Due</th>
                                 <th>status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($allpurchase as $key => $data)
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$data->invoice_no}}</td>
                                 <td>{{$data->date}}</td>
                                 <td>{{$data->order_no}}</td>
                                 <td>{{round($data->total_amount,2)}}</td>
                                 <td>{{round($data->payment,2)}}</td>
                                 <td>{{round($data->due,2)}}</td>
                                 <td>
                                 @if($data->is_active==1)
                                 <span class=" btn-info btn-sm">pending</span>
                                 @else
                                 <span class=" btn-danger btn-sm">Deactive</span>
                                 @endif

                                 </td>
                                 <td>
                                   @if($data->is_active==1)
                                   <a class="badge bg-info-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/purchase/deactive/'.$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                   @else
                                    <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/purchase/active/'.$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                   @endif
                                   <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/purchase/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                   <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/purchase/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                 </td>
                              </tr>
                              @endforeach
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