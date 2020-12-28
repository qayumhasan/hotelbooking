@extends('layouts.admin')
@section('title', 'All User | '.$seo->meta_title)
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
                                <th>Profile</th>
                                 <th>Name</th>
                                 <th>UserName</th>
                                 <th>Designation</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($alluser as $data)
                              <tr>
                                <td>
                                   <img src="{{asset('public/uploads/admin/'.$data->profile_photo_path)}}" height="35px">
                                </td>
                                 <td>{{$data->name}}</td>
                                 <td>{{$data->username}}</td>
                                 <td>{{$data->designation}}</td>
                                 <td>{{$data->phone}}</td>
                                 <td>{{$data->email}}</td>

                                 <td>
                                   @if($data->status==1)
                                   <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/user/deactive/'.$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                   @else
                                    <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/user/active/'.$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                   @endif
                                   <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/user/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                   <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/user/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                   <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="{{url('admin/user/view/'.$data->id)}}"><i class="lar la-eye"></i></a>
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
