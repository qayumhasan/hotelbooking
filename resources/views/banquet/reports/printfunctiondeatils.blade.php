@extends('banquet.master')
@section('title', 'All Banquet | '.$seo->meta_title)
@section('content')
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
                        <h4 class="card-title">All print Banquet</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.hall.create')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">Add Banquet</span></i>
                        </a>
                     </span>
                  </div>
                  <form action="{{route('admin.banquet.printdetais')}}" method="POST">
                  <div class="card-header d-flex justify-content-center row">
                        @csrf
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">From Date: *</label>
                                <input type="text" class="form-control datepicker" name="fromdate" @if(isset($fromdate)) value="{{$fromdate}}"  @else value="{{$current}}" @endif>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fname">To Date: *</label>
                                <input type="text" class="form-control datepicker" name="todate" @if(isset($todate)) value="{{$todate}}"  @else value="{{$current}}" @endif>
                            </div>
                        </div>
       
                     <div class="col-md-3">
                          <button type="submit" class="btn btn-success">Search</button>
                     </div>
                  </div>
                  <form>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table data-table table-striped table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>Function Start Date</th>
                                 <th>Function End Date</th>
                                 <th>Vanue</th>
                                 <th>Name</th>
                                 <th>Mobile</th>
                                 <th>Entry Date</th>
                               
                                 <th>Print</th>
                              </tr>
                           </thead>
                           <tbody class="text-center">
                            @if(isset($searchdata))

                                @foreach($searchdata as $data)
                                <tr>
                                    <td>{{$data->date_of_function_form}}</td>
                                    <td>{{$data->date_of_function_to}}</td>
                                    <td>{{$data->venue->venue_name}}</td>
                                    <td>{{$data->guest_name}}</td>
                                    <td>{{$data->mobile}}</td>
                                    <td>{{$data->booking_date}}</td>
                                   
                                    <td> <a href=""><i class="fa fa-print"></i></a></td>
                                </tr>
                                @endforeach
                            @else

                              @foreach($allbanquet as $data)
                              <tr>
                               
                                    <td>{{$data->date_of_function_form}}</td>
                                    <td>{{$data->date_of_function_to}}</td>
                                    <td>{{$data->venue->venue_name}}</td>
                                    <td>{{$data->guest_name}}</td>
                                    <td>{{$data->mobile}}</td>
                                    <td>{{$data->booking_date}}</td>
                                   
                                    <td>
                                        <a href=""><i class="fa fa-print"></i></a>
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