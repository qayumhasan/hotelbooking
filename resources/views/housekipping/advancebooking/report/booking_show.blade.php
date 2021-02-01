@extends('housekipping.master')
@section('title', 'All Room | '.$seo->meta_title)
@section('content')
@php
date_default_timezone_set("Asia/Dhaka");
$current =date("Y-m-d");
@endphp



<style>
    .search_area {
        width: 100%;

    }

    #datatable_filter {
        visibility: hidden;
    }
</style>

<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Advance Booking Reports of <b class="text-primary">{{$advancebooking->guest->guest_name?? ''}}</b> </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                           
                            <tbody>
                                <tr>
                                    <th scope="row">Room No</th>
                                    <td colspan="3" class="text-center"><b class="text-primary">{{$advancebooking->room->room_no??''}}</b></td>
                                   
                                </tr>
                                <tr>
                                    <th scope="row">Booking No</th>
                                    <td>{{$advancebooking->booking_id}}</td>
                                    <th scope="row">Date Of Booking</th>
                                    <td>{{$advancebooking->booking_date}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date Of Arrival</th>
                                    <td>{{$advancebooking->checkindate}}</td>
                                    <th scope="row">Date Of Departure</th>
                                    <td>{{$advancebooking->checkoutdate}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Guest Name</th>
                                    <td>{{$advancebooking->guest->guest_name?? ''}}</td>
                                    <th scope="row">City</th>
                                    <td>{{$advancebooking->guest->city??''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile</th>
                                    <td>{{$advancebooking->guest->mobile?? ''}}</td>
                                    <th scope="row">No of Room</th>
                                    <td>{{$advancebooking->no_of_rooms}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Remarks</th>
                                    <td colspan="3">{{$advancebooking->remarks}}</td>
                                    
                                </tr>

                                <tr>
                                    <th scope="row">Booking Source</th>
                                    <td>{{$advancebooking->booking_source}}</td>
                                    <th scope="row">Thru Agent</th>
                                    <td>{{$advancebooking->thru_agent}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Balance Amount</th>
                                    <td></td>
                                    <th scope="row">Booked By</th>
                                    <td>{{$advancebooking->bookedby->username??''}}</td>
                                </tr>
                               
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection