@extends('hotelbooking.master')
@section('title', 'CheckIn Report | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("d/m/Y");
$time = date("h:i");
@endphp




<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">CheckIn Report</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive room_ajax_data">
                            <table id="datatable" class="table data-table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Row</th>
                                        <th>Booking No</th>
                                        <th>Check In</th>
                                        <th>CheckOut</th>
                                        <th>Guest</th>
                                        <th>City</th>
                                        <th>Company</th>
                                        <th>Room</th>
                                        <th>Total Days</th>
                                    </tr>
                                </thead>
                             
                                <tbody class="text-center">
                                    @foreach($checkins as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->booking_no}}</td>
                                            <td>{{$row->checkin_date}}</td>
                                            <td>{{$row->checkout->checkout_date ?? ''}}</td>
                                            <td>{{$row->guest_name}}</td>
                                            <td>{{$row->city}}</td>
                                            <td>{{$row->company_name}}</td>
                                            <td>{{$row->room_no}} ({{$row->roomtype->room_type ?? ''}})</td>
                                            <td>{{$row->additional_room_day ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>





                            </table>




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




<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
</script>

<script>
    $("#select_room_no").select2({
        placeholder: '----Select Room No----'
    });
</script>




@endsection