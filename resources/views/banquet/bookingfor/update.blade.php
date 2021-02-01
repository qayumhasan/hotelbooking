

@extends('banquet.master')
@section('title', 'Booking For | '.$seo->meta_title)
@section('content')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Booking For</h4>
                        </div>
                       <a href="{{route('admin.bookingfor.create')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All BookingFor</span></i></button></a>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Booking For Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="{{route('admin.bookingfor.create')}}" method="POST">
                                 @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Booking For: *</label>
                                                <input type="text" class="form-control" name="booking_for" placeholder="Booking For" value="{{$edit->booking_for}}"/>
                                                @error('booking_for')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Status: *</label>
                                                <select class="form-control" name="is_active">
                                                    <option value="1" @if($edit->is_active==1) selected @endif>Active</option>
                                                    <option value="0" @if($edit->is_active==0) selected @endif>Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 text-center">
                                            <div id="file-upload-form" class="uploader-file">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-sm shadow-showcase">
                        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                     <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h4 class="card-title">All Booking For</h4>
                                            </div>
                                            <span class="float-right mr-2">
                                              
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table data-table table-striped table-bordered" >
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @foreach($alldata as $key => $data)
                                                    <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$data->booking_for}}</td>
                                                        <td>
                                                        @if($data->is_active==1)
                                                        <span class="btn btn-success btn-sm">Active<span>
                                                        @else
                                                        <span class="btn btn-danger btn-sm">Deactive<span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($data->is_active==1)
                                                        <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/bookingfor/deactive/'.$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                                        @else
                                                            <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/bookingfor/active/'.$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                                        @endif
                                                        <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/bookingfor/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                                        <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/bookingfor/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                                        
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection