@extends('payroll.master')
@section('content')

<style>
.form-control {
    height: 32px;
    background: #ececec;
    width:55%;
    /* margin:0 auto; */
  
}
select.form-control {
    width: 81%;
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
                        <h4 class="card-title">All Created Selary</h4>
                     </div>
                     <span class="float-right mr-2">
                        <!-- <a href="{{route('admin.employee.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                        </a> -->
                     </span>
                  </div>
                  <form action="{{route('payroll.employee.selary.create')}}" method="post">
                  @csrf
                  <div class="card-header">
            
                        <div class="row">
                            <div class="col-md-2"></div>
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Month:</label>
                                 {{date('F')}}
                                 <select name="month" class="form-control">
                                    <option value="January" @if(date('F')=='January') selected @endif>January</option>
                                    <option value="February" @if(date('F')=='February') selected @endif>February</option>
                                    <option value="March" @if(date('F')=='March') selected @endif>March</option>
                                    <option value="April" @if(date('F')=='April') selected @endif>April</option>
                                    <option value="May" @if(date('F')=='May') selected @endif>May</option>
                                    <option value="June" @if(date('F')=='June') selected @endif>June</option>
                                    <option value="July" @if(date('F')=='July') selected @endif>July</option>
                                    <option value="August" @if(date('F')=='August') selected @endif>August</option>
                                    <option value="September" @if(date('F')=='September') selected @endif>September</option>
                                    <option value="Octobar" @if(date('F')=='Octobar') selected @endif>Octobar</option>
                                    <option value="November" @if(date('F')=='November') selected @endif>November</option>
                                    <option value="December" @if(date('F')=='December') selected @endif>December</option>
                                 
                                 </select>
                                 
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="form-group">
                                 <label for="exampleInputEmail1">Year:</label>
                                 <select name="year" class="form-control">
                                    @foreach(range(date('Y')-5, date('Y')) as $y)
                                       <option value="{{$y}}" @if(date('Y')==$y)selected @endif > {{$y}} </option>     
                                    @endforeach
                                 </select>
                                 
                               </div>
                           </div>
                        </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" style="font-size:11px;" >
                           <thead class="text-center">
                              <tr>
                                 <th>#</th>
                                 <th>Month Name</th>
                                 <th>Year</th>
                                 <th>Manage</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                            @foreach($allselary as $key => $data)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$data->month}}</td>
                                    <td>{{$data->year}}</td>
                                    <td>
                                     <a class="badge bg-primary-light mr-2" href="{{url('admin/allemployee/selary/edit/'.$data->month.'/'.$data->year)}}"> <i class="lar la-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
                 
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>


@endsection