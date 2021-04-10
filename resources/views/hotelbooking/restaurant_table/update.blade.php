@extends('restaurant.chui.master')
@section('title', 'Update Table | '.$seo->meta_title)
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
                            <h4 class="card-title">Update Table</h4>
                        </div>
                       <a href="{{route('admin.restaurnat.table')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Table</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.restaurnat.table.update',$edit->id)}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Table Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Table No: *</label>
                                            <input type="text" class="form-control" id="fname" value="{{$edit->table_no}}" name="table_no" placeholder="Table No"/>
                                            @error('table_no')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Branch Name: *</label>
                                            <select name="branch_id" class="form-control" id="branch_id">
                                                <option value="">--Select--</option>
                                                @foreach($allbranch as $branch)
                                                    <option {{$edit->branch_id == $branch->id?'selected':''}} value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Table Type: </label>
                                            <select name="table_type" class="form-control" id="table_type">

                                                <option selected disabled value="">--Select Table Type--</option>
                                                @foreach($types as $row)
                                                    <option {{$edit->table_type_id == $row->id ?'selected':''}} value="{{$row->id}}">{{$row->table_type}}</option>
                                                @endforeach
                                            </select>
                                            @error('table_type')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                              
                                   
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lname">Table Details: </label>
                                           <textarea name="table_details" id="editor3" rows="10"> {!! $edit->details !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Publish</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                            <input type="radio" checked name="is_active" {{$edit->is_active == 1 ?'checked':''}} id="customRadio-1" class="custom-control-input bg-primary" value="1">
                                            <label class="custom-control-label" for="customRadio-1"> Active </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                            <input type="radio" name="is_active" id="customRadio-2" {{$edit->is_active == 0 ?'checked':''}} name="customRadio-10" class="custom-control-input bg-warning" value="0">
                                            <label class="custom-control-label" for="customRadio-2"> DeActive </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="file-upload-form" class="uploader-file">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                 
                </div>
            </form>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace('editor3');
</script>

@endsection