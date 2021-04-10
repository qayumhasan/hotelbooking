@extends('inventory.master')
@section('title', 'Update Menu | '.$seo->meta_title)
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
                            <h4 class="card-title">Update Menu Category</h4>
                        </div>
                       <!-- <a href="{{route('admin.branch.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Floor</span></i></button></a> -->
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Menu Category Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="{{route('admin.menucategory.update')}}" method="POST">
                                 @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Category Name: *</label>
                                                <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{$edit->name}}"/>
                                                <input type="hidden" name="id" value="{{$edit->id}}"/>
                                                @error('name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Status: *</label>
                                                <select class="form-control" name="is_active">
                                                    <option value="1" @if($edit->is_active==1) selected @endif>Active</option>
                                                    <option value="0" @if($edit->is_active==0) selected @endif>Active</option>
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
                                                <h4 class="card-title">All Menu Category</h4>
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
                                                        <th>Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-center">
                                                    @foreach($allmenu as $key => $data)
                                                    <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$data->name}}</td>
                                                        <td>
                                                        @if($data->is_active==1)
                                                        <span class="btn btn-success btn-sm">Active<span>
                                                        @else
                                                        <span class="btn btn-danger btn-sm">Deactive<span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        @if($data->is_active==1)
                                                        <a class="badge bg-success-light mr-2"  data-toggle="tooltip" data-placement="top"  href="{{url('admin/menucategory/deactive/'.$data->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                                        @else
                                                            <a class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/menucategory/active/'.$data->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                                        @endif
                                                        <a class="badge bg-primary-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/menucategory/edit/'.$data->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>
                                                        <a id="delete" class="badge bg-danger-light mr-2"  data-toggle="tooltip" data-placement="top" href="{{url('admin/menucategory/delete/'.$data->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                                        
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
<script>
    $('body').on('keydown','input,select,textarea',function(e){
    var self=$(this)
    ,form=self.parents('form:eq(0)')
    ,focusable
    ,next
    ;
    if(e.keyCode==13){
    focusable=form.find('input,a,select,button,textarea').filter(':visible');
    next=focusable.eq(focusable.index(this)+1);
    if (next.length){
    next.focus();
    } else{
    form.submit();
    }
    return false;
    }
    });
</script>
@endsection