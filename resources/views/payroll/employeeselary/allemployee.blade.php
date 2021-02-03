@extends('payroll.master')
@section('content')

<style>
.form-control {
    height: 32px;
    background: #ececec;
    width:55%;
    /* margin:0 auto; */
  
}
.card-header.d-flex.justify-content-between.asif {
    background: #9e9c9c;
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
                  <div class="card-header d-flex justify-content-between asif">
                     <div class="header-title">
                        <h4 class="card-title">All Employee</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.employee.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a> -->
                     </span>
                  </div>
                  <div class="card-header">
            
                        <div class="row">
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Month:</label>
                                 <select name="" class="form-control">
                                    <option value="">January</option>
                                    <option value="">February</option>
                                    <option value="">March</option>
                                    <option value="">April</option>
                                    <option value="">May</option>
                                    <option value="">June</option>
                                    <option value="">July</option>
                                    <option value="">August</option>
                                    <option value="">September</option>
                                    <option value="">Octobar</option>
                                    <option value="">November</option>
                                    <option value="">December</option>
                                 
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Year:</label>
                                 <select name="" class="form-control">
                                    <option value="">2021</option>
                                    <option value="">2020</option>
                                    <option value="">2019</option>
                                    <option value="">2018</option>
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Generate Date:</label>
                                 <input type="text" class="form-control datepicker" id="exampleInputEmail1" value="{{$current}}">
                                 
                               </div>
                           </div>
                        </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" style="font-size:11px;" >
                           <thead class="text-center">
                              <tr>
                                 <th>Profile</th>
                                 <th>Employee Id</th>
                                 <th>Name</th>
                                 <th>Department</th>
                                 <th>Designation</th>
                                 <th>Mode Of Payment</th>
                                 <th>Total Days</th>
                                 <th>No.of Working Days</th>
                                 <th>Guaranteed Leave</th>
                                 <th>Leave</th>
                                
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
                                 <td>{{$data->employee_type}}</td>
                                 <td>{{$data->present_designation}}</td>
                                 <td>
                                    <select class="form-control" style="margin:0 auto;">
                                       <option value="">NGo</option>
                                       <option value="">NGo</option>
                                       <option value="">NGo</option>
                                       <option value="">NGo</option>
                                       <option value="">NGo</option>
                                    </select>
                                 </td>
                                 <td>30</td>
                                 <td><input type="text" class="form-control" style="margin:0 auto;"></td>
                                 <td><input type="text" class="form-control" style="margin:0 auto;"></td>
                                 <td><span></span></td>
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