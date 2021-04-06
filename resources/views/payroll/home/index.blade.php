@extends('payroll.master')
@section('content')
<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Employee</h4>
                     </div>
                     <span class="float-right mr-2">
                        
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