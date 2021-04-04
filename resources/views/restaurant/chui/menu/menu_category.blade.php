@extends('restaurant.chui.master')
@section('title', 'Menu Category | '.$seo->meta_title)
@section('content')



<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Category Configuration</h4>
                        </div>
                        <span class="float-right mr-2">
                            <a data-toggle="modal" data-target="#addcategory" data-whatever="@mdo" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Category</span></i>
                            </a>
                        </span>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Under Category</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categores as $key=>$row)
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td>{{$row->name}}</td>
                                    <td>Finished Goods</td>
                                    <td class="text-center">
                                    <a data-toggle="modal" data-target="#editcategory" data-whatever="{{$row}}"  class="badge bg-primary-light mr-2 editcategory"> <i class="lar la-edit"></i></a>
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




<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.restaurant.chui.menu.category.store')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Category Name:</label>
                        <input required class="form-control form-control-sm" type="text" name="category">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Under Category</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="under_category">
                            <option value="1">Finished Goods</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.restaurant.chui.menu.category.update')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Category Name:</label>
                        <input type="hidden" name="id" id="cat_id">
                        <input required class="form-control form-control-sm" type="text" id="cat_name" name="category">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Under Category</label>
                        <select class="form-control form-control-sm" id="under_category" name="under_category">
                            <option value="1">Finished Goods</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $('.editcategory').click(function(){
        var modal = $(this);
        var data = modal.data('whatever');
        $('#cat_id').val(data.id);
        $('#cat_name').val(data.name);
        $('#under_category').val(data.under_category).selected;
    })
});
</script>
@endsection