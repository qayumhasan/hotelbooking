@extends('layouts.admin')
@section('title', 'Department | '.$seo->meta_title)
@section('content')


<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Department</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.department.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Department</label>
                                <input type="text" name="department" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Department">
                                @error('department')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Image</label>
                                <div class="input-group mb-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control-sm" id="inputGroupFile02" name="department_image">
                                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                                    </div>

                                </div>
                                @error('department_image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Department List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($departments as $row)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$row->name}}</td>
                                    <td>
                                        <img src="{{asset('public/uploads/departments')}}/{{$row->image}}" alt="" width="20%" />
                                    </td>
                                    <td>

                                        @if($row->is_active == 1)
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.department.status',$row->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                        @else
                                        <a class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.department.status',$row->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                        @endif

                                        <a class="badge bg-primary-light mr-2 editmodal" data-placement="top" data-original-title="Edit" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$row}}"><i class="lar la-edit"></i></a>


                                        <a id="delete" class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.department.delete',$row->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>

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



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.department.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputPassword1">Department</label>
                        <input type="hidden" name="id" value="" id="department_id"/>
                        <input type="text" name="department" class="form-control form-control-sm" id="department" placeholder="Department">
                        @error('department')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Image</label>
                        <div class="input-group mb-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02" name="department_image">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                            </div>

                        </div>
                        @error('department_image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <img src="" alt=" " id="image" class="img-fluid w-100"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".editmodal").click(function() {
            var modal = $(this)
      
            var data = modal.data('whatever');
            console.log(data);
            document.getElementById('department_id').value = data.id;
            document.getElementById('department').value = data.name;
            document.getElementById('image').src = "{{asset('/public/uploads/departments')}}/" +data.image;
      
            
        });
    });
</script>

@endsection