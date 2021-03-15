@extends('accounts.master')
@section('title', 'All Chart Of Item | '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Chart Of Item</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.chartofaccount.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add Chart Of Item</span></i>
                        </a>
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" style="font-size:12px">
                           <thead class="text-center">
                              <tr>
                                 <th>Description</th>
                                 <th>Code</th>
                                 <th>Category</th>
                                 <th>Main Category</th>
                                 <th>SubCategory One</th>
                                 <th>SubCategory Two</th>
                                 <th>status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($alldata as $data)
                              <tr>
                                 <td>{{$data->desription_of_account}}</td>
                                 <td>{{$data->code}}</td>
                                 <td>{{$data->category_name}}</td>
                                 <td>{{$data->maincategory_name}}</td>
                                 <td>{{$data->subcategoryone_name}}</td>
                                 <td>{{$data->subcategorytwo_name}}</td>
                                 <td>
                                 @if($data->is_active==1)
                                 <span class=" btn-success btn-sm">Active</span>
                                 @else
                                 <span class=" btn-danger btn-sm">Deactive</span>
                                 @endif

                                 </td>
                                 <td>
                                   @if($data->is_active==1)
                                   <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/chartofaccount/deactive/'.$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                   @else
                                    <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/chartofaccount/active/'.$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                   @endif
                                   <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/chartofaccount/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                   <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/chartofaccount/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
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