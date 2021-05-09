@extends('restaurant.chui.master')
@section('title', 'Kot History | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("Y/m/d");
$time = date("h:i");
@endphp

@php
date_default_timezone_set("Asia/Dhaka");
$current =date("Y/m/d");
$time = date("h:i");
@endphp


<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">

                    <form id="search_kot_items" action="{{route('admin.restaurant.chui.menu.kot.history.search')}}" method="post">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>From Date:</b></label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker form-control-sm" name="from_date" type="text" value="{{$date}}">
                                <small class="text-danger from_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>To Date:</b></label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker form-control-sm" name="to_date" type="text" value="{{$date}}">
                                <small class="text-danger to_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Table No:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm select_item" id="exampleFormControlSelect1" name="table_no">
                                    <option selected disabled>---Select A Table -----</option>
                                    @foreach($tables as $row)
                                    <option value="{{$row->id}}">{{$row->table_no}}</option>
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
                            <h4 class="card-title">KOT History</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive kot_ajax_data">
                            





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
            $('.kot_ajax_data').empty();
            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: type,
                data: request,
                success: function(data) {
                    console.log(data);
                    $('.kot_ajax_data').append(data);

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