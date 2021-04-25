@extends('layouts.admin')
@section('title', 'All Order Recusition|'.$seo->meta_title)
@section('content')
<style>
.form-control {
    height: 32px;
}
</style>
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Order Recusition</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.ordercusition.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add Order</span></i>
                        </a> -->
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
                                 <th>Number OF Qty</th>
                                 <th>Remarks</th>
                                 <th>status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($alldata as $key => $data)
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>{{$data->invoice_no}}</td>
                                 <td>{{$data->date}}</td>
                                 <td>{{$data->num_of_qty}}</td>
                                 <td>{{$data->remarks}}</td>
                                 <td>
                                 @if($data->is_active==1)
                                 <span class=" btn-info btn-sm">pending</span>
                                 @elseif($data->is_active==2)
                                 <span class=" btn-danger btn-sm">OnProcessing</span>
                                 @elseif($data->is_active==3)
                                 <span class=" btn-success btn-sm">Approve</span>
                                 @endif

                                 </td>
                                 <td>
                                    @if($data->is_active==1)
                                   <a class="badge bg-info-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/orderrecusition/onprocessing/'.$data->id)}}" data-original-title="OnProcesing"><i class="la la-thumbs-down"></i></a>
                                    @elseif($data->is_active==2)
                                    <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/orderrecusition/onapprove/'.$data->id)}}" data-original-title="Approve"><i class="la la-thumbs-down"></i></a>
                                    @elseif($data->is_active==3)
                                    <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top" href="" data-original-title="Approve"><i class="la la-thumbs-up"></i></a>
                                    @endif
                                   <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/ordercusition/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                   <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/ordercusition/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
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