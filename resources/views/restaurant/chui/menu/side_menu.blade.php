@extends('restaurant.chui.master')
@section('title', 'Menu Inventory | '.$seo->meta_title)
@section('content')



<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Configure Side Menu</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <form id="clean_duration_search" action="{{route('admin.restaurant.chui.menu.side.store')}}" method="get">
                            @csrf
                            <input type="text" style="opacity: 0;" name="item_name" id="item_name"/>
                            <div class="form-group row ml-auto">

                                <label for="inputPassword" class="col-sm-1 col-form-label"><b>Main Menu:</b></label>
                                <div class="col-sm-4">
                                    <select class="form-control form-control-sm select_item" id="modalbtn" name="main_menu">
                                        <option selected disabled>----Select A Item ---------</option>
                                        @foreach($items as $row)
                                        <option value="{{$row->id}}">{{$row->item_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('main_menu')
                                    <small class="text-danger ">{{$message}}</small>
                                    @enderror
                                </div>

                                <label for="inputPassword" class="col-sm-1 col-form-label"><b>Side Menu:</b></label>
                                <div class="col-sm-4">
                                    <select class="form-control form-control-sm select_item" id="side_menu" name="side_menu">
                                    <option selected disabled>----Select A Item ---------</option>
                                        @foreach($items as $row)
                                        <option value="{{$row->id}}">{{$row->item_name}}</option>
                                        @endforeach
                                    </select>

                                    
                                   
                                    @error('side_menu')
                                    <small class="text-danger room_no">{{$message}}</small>
                                    @enderror

                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="col-sm-12">

                <div class="card" id="sidemenuajax">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Side Menu</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="addsidemenu">
                                @if(count($sidemenus) > 0)
                                @foreach($sidemenus as $row)
                                @foreach(json_decode($row->items) as $data)
                                <tr id="deletemenu">
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$data->item_name}}</td>
                                    <td>
                                    <a href="{{route('admin.restaurant.chui.side.menu.delete',[$row->id,$data->item_id])}}" class="badge bg-danger-light mr-2"><i class="la la-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
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


<script>
    $(document).ready(function() {
        $('#modalbtn').change(function(params) {
            var val = params.target.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/restaurant/chui/menu/side/menu/items') }}/" + val,
                success: function(data) {

                    $('#deletemenu').remove();

                    document.querySelector('.addsidemenu').insertAdjacentHTML('afterend', data);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#side_menu').change(function(e){
            var items = e.target.selectedOptions[0].innerHTML;
            document.querySelector('#item_name').value =items;
        });
    })
</script>


@endsection