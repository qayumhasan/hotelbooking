@extends('layouts.admin')
@section('title', 'Currency | '.$seo->meta_title)
@section('content')



<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Currency</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.currency.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Currency Name</label>
                                <input type="text" name="name" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Currency Name">

                                @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Currency Symbol</label>
                                <input type="text" name="symbol" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Currency Symbol">

                                @error('symbol')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Type</label>

                                <select class="form-control form-control-sm" name="is_default">
                                    <option disabled selected>------Select A Type------</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>

                                @error('type')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary mx-auto">Submit</button>
                            </div>
                            
                        </form>



                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Currency List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Currency Name</th>
                                    <th  class="text-center" scope="col">Currency Symbol</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($currencs) > 0)
                                @foreach($currencs as $row)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$row->name}}</td>
                                    <td class="text-center icon"><h2>{!! $row->symbol!!}</h2></td>
                                    <td>{!! $row->status !!}</td>
                                    <td>

                                    @if($row->is_default == "1")
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.currency.status',$row->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                        @else
                                        <a class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.currency.status',$row->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                        @endif

                                        <a class="badge bg-primary-light mr-2 editmodal" data-placement="top" data-original-title="Edit" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$row}}"><i class="lar la-edit"></i></a>


                                        <a id="delete" class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.currency.delete',$row->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                    </td>

                                    
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5" class="text-center">No Data Found!</th>
                                </tr>
                            @endif



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
                <h5 class="modal-title" id="exampleModalLabel">Edit Currency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{route('admin.currency.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Currency Name</label>
                                <input type="hidden" name="id" class="form-control form-control-sm" id="currency_id"">
                                <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="Currency Name">

                                @error('name')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Currency Symbol</label>
                                <input type="text" name="symbol" class="form-control form-control-sm" id="symbol" placeholder="Currency Symbol">

                                @error('symbol')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Type</label>

                                <select class="form-control form-control-sm" name="is_default" id="type">
                                    <option disabled selected>------Select A Type------</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>

                                @error('type')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            
                        </form>
            </div>

        </div>
    </div>
</div>

@if(Session::has('errors'))
{{Session::get('MessageBag')}}

@endif

<script>
    $(document).ready(function() {
        $(".editmodal").click(function() {
            var modal = $(this)

            var data = modal.data('whatever');
            $('#currency_id').val(data.id);
            $('#name').val(data.name);
            $('#symbol').val(data.symbol);
            if(data.is_default == 1){
                $('#type').val('1').selected;
            }else{
                $('#type').val('0').selected;
            }
            


        });
    });
</script>



@endsection