@extends('payroll.master')
@section('content')
   <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All Employee</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.employee.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a> -->
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>Profile</th>
                                 <th>Employee Id</th>
                                 <th>Name</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Department</th>
                                 <th>Salary</th>
                                 <th>Manage</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($allemployee as $data)
                              <tr>
                                <td>
                                   <img src="{{asset('public/uploads/employee/'.$data->image)}}" height="35px">
                                </td>
                                 <td>{{$data->employee_id}}</td>
                                 <td>{{$data->employee_name}}</td>
                                 <td>{{$data->mobile_number}}</td>
                                 <td>{{$data->email}}</td>
                                 <td></td>
                                 <td>{{$data->present_salary}} TK</td>
                                 <td>
                                   <!-- <a class="badge bg-primary-light mr-2" href="{{url('admin/employee/edit/'.$data->id)}}"> <i class="lar la-edit"></i></a>
                                   <a id="delete" class="badge bg-danger-light mr-2" href="{{url('admin/employee/delete/'.$data->id)}}"> <i class="la la-trash"></i></a> -->
                                   <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="{{url('admin/employee/view/'.$data->id)}}"><i class="lar la-eye"></i></a>
                                    <!-- <span class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action"
                                          href="#">
                                          <div class="dropdown">
                                             <span class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" href="#">

                                             </span>
                                             <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                                <a class="dropdown-item" href="#">View Cv</a>
                                                <a class="dropdown-item" href="#">Joining Letter</a>
                                             </div>
                                          </div>
                                    </span> -->
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