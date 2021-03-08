@extends('accounts.master')
@section('title', 'All Account Transection | '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All User</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.user.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a>
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                <th>#</th>
                                 <th>Voucher Type</th>
                                 <th>Voucher No</th>
                                 <th>Date</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($alldata as $key => $data)
                              <tr>
                                <td>{{++$key}}</td>
                                 <td>{{$data->voucher_type}}</td>
                                 <td>{{$data->voucher_no}}</td>
                                 <td>{{$data->date}}</td>
                                 <td> 
                                 @if($data->is_active==1)
                                    <span class="btn-sm btn-success">Active</span>
                                 @else
                                    <span class="btn-sm btn-danger">Deactive</span>
                                 @endif
                                 
                                 </td>
                                 <td>
                                   @if($data->is_active==1)
                                   <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/account/transectionhead/deactive/'.$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                   @else
                                    <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/account/transectionhead/active/'.$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                   @endif
                                   <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/account/transectionhead/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                   <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/account/transectionhead/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                  
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
