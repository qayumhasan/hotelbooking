@extends('restaurant.chui.master')
@section('title', 'Create Menu Configaraution | '.$seo->meta_title)
@section('content')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Item</h4>
                        </div>
                        <a href="{{route('admin.restaurant.chui.menu.config')}}"><button class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Item</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.restaurant.chui.menu.config.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Item Content</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Item Name: *</label>
                                                <input type="text" class="form-control" name="item_name" placeholder="Item Name" />
                                                @error('item_name')
                                                <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Short Name: *</label>
                                                <input type="text" class="form-control short_name" name="short_name" placeholder="Short Name" />
                                                @error('branch_id')
                                                <div style="color:red">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Category Name: </label>
                                                <select name="category_name" class="form-control" id="category_name">
                                                    <option value="">--Select--</option>
                                                    @foreach($category as $cate)
                                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('room_type')
                                                <div style="color:red">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Unit Name: </label>
                                                <select name="unit_name" class="form-control floor" id="unit_name">
                                                    <option value="">--Select--</option>
                                                    @foreach($unit as $allunit)
                                                    <option value="{{$allunit->id}}">{{$allunit->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('unit')
                                                <div style="color:red">{{ $message }}</div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Rate:</label>
                                                <input type="text" class="form-control" id="fname" name="rate" placeholder="Rate" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Minimum Level:</label>
                                                <Input type="text" name="min_level" class="form-control" placeholder="Minimum Level">
                                                @error('tariff')
                                                <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-4">

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="" name="direct_stock">
                                                <label class="form-check-label" for="invalidCheck2">
                                                  Is Direct Stock Deduct?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-4">

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="" name="add_vat">
                                                <label class="form-check-label" for="invalidCheck2">
                                                    Vat Added On Bill
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Menu Type</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="menu_type" id="customRadio-1" class="custom-control-input bg-primary" value="Food" checked>
                                                <label class="custom-control-label" for="customRadio-1"> Food </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-2" class="custom-control-input bg-primary" value="Beverage">
                                                <label class="custom-control-label" for="customRadio-2"> Beverage </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-3" class="custom-control-input bg-primary" value="Cigarette">
                                                <label class="custom-control-label" for="customRadio-3"> Cigarette </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-4" class="custom-control-input bg-primary" value="Banquet">
                                                <label class="custom-control-label" for="customRadio-4"> Banquet </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-5" class="custom-control-input bg-primary" value="House-kipping">
                                                <label class="custom-control-label" for="customRadio-5"> House-kipping </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Publish</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="is_active" id="customRadio-8" class="custom-control-input bg-primary" value="1" checked>
                                                <label class="custom-control-label" for="customRadio-8"> Active </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="is_active" id="customRadio-9" name="customRadio-10" class="custom-control-input bg-warning" value="0">
                                                <label class="custom-control-label" for="customRadio-9"> Deactive </label>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name="item_name"]').on('change', function() {
            var newname = $(this).val();
            //alert(newname);
            if (newname) {
                $('.short_name').val(newname);
            }


        });
    });
</script>


@endsection