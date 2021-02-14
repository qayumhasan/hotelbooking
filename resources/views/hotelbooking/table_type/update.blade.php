@extends('hotelbooking.master')
@section('title', 'Create Table Type | '.$seo->meta_title)
@section('content')
<style>
.form-control {
    height: 32px;
}
.card-header.d-flex.justify-content-between.asif {
    background-color: #c1b8b8;
}
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Table Type</h4>
                        </div>
                       <a href="{{route('admin.restaurnat.table.type.create')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">Add Table Type</span></i></button></a>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Table Type Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="{{route('admin.restaurnat.table.type.update',$edit->id)}}" method="POST">
                                 @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Table Type: *</label>
                                                <input type="text" class="form-control" name="table_type" value="{{$edit->table_type}}" placeholder="Table Type" required/>
                                                @error('table_type')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Branch Name: *</label>
                                                <select class="form-control" name="branch_id">
                                                    @foreach($allbranch as $branch)
                                                        <option {{$edit->branch_id == $branch->id ?'selected':''}} value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                    @endforeach
                                                </select>
                                               
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Block: *</label>
                                                <input type="text" class="form-control" name="block" value="{{$edit->block}}" placeholder="Block" required/>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Status: *</label>
                                                <select class="form-control" name="is_active">
                                                    <option {{$edit->is_active =='1'?'selected':''}} value="1">Active</option>
                                                    <option {{$edit->is_active =='0'?'selected':''}} value="0">Deactive</option>
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
                                                <h4 class="card-title">All Table Type</h4>
                                            </div>
                                            <span class="float-right mr-2">
                                                <!-- <a href="{{route('admin.branch.create')}}" class="btn btn-sm bg-primary">
                                                <i class="ri-add-fill"><span class="pl-1">Add New</span></i>
                                                </a> -->
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table data-table table-striped table-bordered" >
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Table Type</th>
                                                        <th>Block</th>
                                                        <th>Branch Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                 @foreach($alltableype as $key => $data)
                                                    <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$data->table_type}}</td>
                                                        <td>{{$data->block}}</td>
                                                        <td>{{$data->branch->branch_name ?? ' '}}</td>
                                                        <td>
                                                        @if($data->is_active==1)
                                                        <span class="btn btn-success btn-sm">Active<span>
                                                        @else
                                                        <span class="btn btn-danger btn-sm">Deactive<span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($data->is_active==1)
                                                        <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{route('admin.restaurnat.table.type.status',$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                                        @else
                                                            <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{route('admin.restaurnat.table.type.status',$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                                        @endif
                                                        <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{route('admin.restaurnat.table.type.edit',$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                                        <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{route('admin.restaurnat.table.type.delete',$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                                        
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