@extends('restaurant.chui.master')
@section('title', 'All Room | '.$seo->meta_title)
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

                    <form id="clean_duration_search">
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
                <div class="card printableAreasaveprint">
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
                        <div class="table-responsive room_ajax_data">






                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn-sm btn-info savepritbtn">Print</button>
            </div>
        </div>
    </div>
</div>





@endsection

