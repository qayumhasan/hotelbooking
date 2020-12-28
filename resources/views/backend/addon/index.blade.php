@extends('layouts.admin')
@section('title', 'AddOn | '.$seo->meta_title)
@section('content')

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Addon Manager</h4>
                        </div>
                        <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">Install New Addon</span></i>
                        </button>
                    </div>
                    <div class="card-body">



                        <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Installed AddOn</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Available Addon</a>
                            </li>

                        </ul>


                        <div class="tab-content" id="myTabContent-2">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <!-- <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Age</th>
                                            <th>Company Name</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>Sort</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        @foreach($permit->all() as $row)
                                        <tr>
                                            <td class="text-left" style="width: 100px;"><img src="{{asset('public/addon/')}}/{{$row->image}}" width="100px"></td>

                                            <td contenteditable="true">{{$row->name}}</td>
                                            <td contenteditable="true">Version: {{$row->version}}</td>

                                            <td>
                                                <!-- Default switch -->
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input addonstatus" value="{{$row->id}}" id="customSwitches" @if($row->status == 1) checked @endif/>
                                                    <label class="custom-control-label" for="customSwitches"></label>
                                                    <a class="delete" href="{{route('admin.addon.delete',$row->id)}}"><i class="fa la la-trash"></i></a>
                                                </div>


                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <style>
                                .addon_price {
                                    position: absolute;
                                    left: 5%;
                                }
                            </style>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">





                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="card card-block card-stretch card-height blog blog-date">
                                            <div class="card-body">
                                                <div class="image-block position-relative">
                                                    <img src="{{asset('public/addon/employee.png')}}" class="img-fluid rounded w-100" alt="blog-img">
                                                    <div class="blog-meta-date">
                                                        <div class="date">10</div>
                                                        <div class="month">Version</div>
                                                    </div>
                                                </div>
                                                <div class="blog-description mt-3">
                                                    <div class="blog-meta d-flex align-items-center justify-content-between mb-2">
                                                        <div class="author"><i class="ri-user-fill pr-2"></i>By: Admin</div>
                                                        <div class="hit">
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                        </div>
                                                    </div>
                                                    <h5 class="mb-2">Containing coronavirus spread comes</h5>
                                                    <p>In the blogpost, the IMF experts observed, "Success in containing the virus comes at the price of slowing economic activity."</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <h5 class="addon_price text-orange">$25</h5>
                                                    <a type="button" class="btn btn-secondary text-white" data-dismiss="modal">Preview</a>
                                                    <a type="button" class="btn btn-primary text-white">Purchase</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <div class="card card-block card-stretch card-height blog blog-date">
                                            <div class="card-body">
                                                <div class="image-block position-relative">
                                                    <img src="{{asset('public/addon/employee.png')}}" class="img-fluid rounded w-100" alt="blog-img">
                                                    <div class="blog-meta-date">
                                                        <div class="date">10</div>
                                                        <div class="month">Version</div>
                                                    </div>
                                                </div>
                                                <div class="blog-description mt-3">
                                                    <div class="blog-meta d-flex align-items-center justify-content-between mb-2">
                                                        <div class="author"><i class="ri-user-fill pr-2"></i>By: Admin</div>
                                                        <div class="hit">
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                            <i class="ri-star-fill pr-2"></i>
                                                        </div>
                                                    </div>
                                                    <h5 class="mb-2">Containing coronavirus spread comes</h5>
                                                    <p>In the blogpost, the IMF experts observed, "Success in containing the virus comes at the price of slowing economic activity."</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <h5 class="addon_price text-orange">$25</h5>
                                                    <a type="button" class="btn btn-secondary text-white" data-dismiss="modal">Preview</a>
                                                    <a type="button" class="btn btn-primary text-white">Purchase</a>

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
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Install New Addon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.addon.install')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" accept=".zip" name="addon_zip" required>
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                    </div>
                    <small class="text-danger">Only .zip file</small>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Install</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.addonstatus').click(function(params) {
            var addonid = $(this).val();
            
            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.addon.status') }}",
                data: {
                    addonid: addonid
                },
                success: function(data) {
                    iziToast.success({
                        message: data.message,
                        'position': 'topCenter'
                    });

                    setInterval(function() {
                        window.location = "{{ url()->current() }}";
                    }, 700);


                }
            });
        });
    });
</script>


@endsection