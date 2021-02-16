@extends('restaurant.chui.master')
@section('title', 'First Moving Items | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("d/m/Y");
$time = date("h:i");
@endphp

@php
date_default_timezone_set("Asia/Dhaka");
$current =date("d/m/Y");
$time = date("h:i");
@endphp


<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">

                    <form id="search_kot_items" action="{{route('admin.restaurant.chui.menu.fast.moving.item.search')}}" method="post">
                        <div class="form-group row mx-auto">

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Category:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm select_item" id="exampleFormControlSelect1" name="category">
                                    <option selected disabled>---Select A Table -----</option>
                                    @foreach($menucategories as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <small id="table_no" class="text-danger"></small>
                            </div>



                            <div class="col-sm-2">
                                <button type="Submit" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Fast Moving Items</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive fast_moving_item">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Items</th>
                                        <th scope="col">Sale Of Qty</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($firstmovings) > 0)
                                    @foreach($firstmovings as $row)
                                    <tr>
                                        <td>{{$row->item_name}}</td>
                                        <td>{{$row->no_of_sale}}</td>
                                        <td>{{$row->rate}}</td>
                                        @php
                                        $amount =(float)$row->rate * $row->no_of_sale;
                                        @endphp
                                        <td>{{$amount}}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <th class="text-center" colspan="5">No Item Found!</th>
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
</div>



<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '#search_kot_items', function(e) {
            e.preventDefault();
            $('.fast_moving_item').empty();
            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: type,
                data: request,
                success: function(data) {
                    console.log(data);
                    $('.fast_moving_item').append(data);

                },
                error: function(err) {
                    if (err.responseJSON.errors.table_no) {
                        $('#table_no').html(err.responseJSON.errors.table_no[0])
                    }
                    if (err.responseJSON.errors.to_date) {
                        $('#to_date').html(err.responseJSON.errors.to_date[0])
                    }
                }
            });
        });
    });
</script>




@endsection