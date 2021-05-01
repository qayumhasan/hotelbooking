@extends('hotelbooking.master')
@section('title', 'Edit Check In | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$time = date("h:i:sa");
@endphp
<style>
    .heading_area {
        background: gainsboro;
        display: inline-block;
    }

    .controll-from {
        width: 100%;
        border: 1px solid #ccc;
        background: #FFF;
        margin: 0 0 5px;
        padding: 3px;
        font-size: 10px;

    }

    .control-label {
        font-size: 12px;
    }

    fieldset {
        display: block;
        margin-inline-start: 2px;
        margin-inline-end: 2px;
        padding-block-start: 0.35em;
        padding-inline-start: 0.75em;
        padding-inline-end: 5.75em;
        padding-block-end: 0.625em;
        min-inline-size: min-content;
        border-width: 2px;
        border-style: groove;
        border-color: threedface;
        border-image: initial;
        height: 100%;
    }

    legend {
        display: block;
        padding-inline-start: 2px;
        padding-inline-end: 2px;
        border-width: initial;
        border-style: none;
        border-color: initial;
        border-image: initial;
        font-size: 15px;
        font-weight: bold;
        text-align: center;

    }

    .tableclass {
        position: relative;
        top: 50%;
        width: 100%;
        left: 10%;
    }

    .tableclass a {
        background: #E9EAE7;
        color: black;
        /* padding: 2% 12% 2% 0%; */
        margin: 3% 0;
        border: 2px solid #777;
        width: 100%;
        display: block;
        cursor: pointer;
    }

    .tableclass a i {
        background: #ccc;
        color: #ffffff;
        height: 100%;
        line-height: 180%;
        padding: 0% 2%;
        width: 15%;
        height: 100%;
        display: inline-block;
        border-right: 2px solid #777;
        text-align: center;
    }

    input:required:focus {
        border: 1px solid red;
        outline: none;
    }
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Booking Service Add/Modify/Delete</h4>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <fieldset class="mainitem">
                            <legend>Extra Service</legend>

                            <table class="tableclass">
                                <tbody>





                                    <tr class="item">
                                        <td class=" d-block">
                                            <a class="buttoncss add" data-toggle="modal" data-target="#add_service" data-whatever="@getbootstrap"><i class="fa fa-plus" aria-hidden="true"></i> Add Service</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a id="editservicebtn" class="buttoncss add" data-toggle="modal" data-target="#edit_service" data-whatever="@getbootstrap"><i class="fas fa-edit"></i> Edit Service</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a id="deleteservicebtn" class="buttoncss add" data-toggle="modal" data-target="#deleted_service" data-whatever="@getbootstrap"><i class="fa fa-times" aria-hidden="true"></i> Delete Service</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a id="viewservicebtn" data-toggle="modal" data-target="#view_service" data-whatever="@getbootstrap" class="buttoncss add"><i class="fa fa-star" aria-hidden="true"></i> view Service</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </fieldset>

                    </div>
                </div>
            </div>

            <!-- money receipt area start -->

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <fieldset class="mainitem">
                            <legend>Money Receipt</legend>

                            <table class="tableclass">
                                <tbody>





                                    <tr class="item">
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{route('admin.checkin.show.voucher',$checkin->booking_no)}}"><i class="fa fa-plus" aria-hidden="true"></i> Add Voucher</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{route('admin.checkin.list.voucher',$checkin->booking_no)}}"><i class="fas fa-edit"></i> Edit Voucher</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{route('admin.checkin.delete.voucher.list',$checkin->booking_no)}}"><i class="fa fa-times" aria-hidden="true"></i> Delete Voucher</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{route('admin.checkin.list.voucher.view',$checkin->booking_no)}}"><i class="fa fa-star" aria-hidden="true"></i> view Voucher</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </fieldset>

                    </div>
                </div>
            </div>

            <!-- money receipt area end -->

            <!-- other service area start -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <fieldset class="mainitem">
                            <legend>Others</legend>

                            <table class="tableclass">
                                <tbody>





                                    <tr class="item">
                                        <td class=" d-block">
                                            <a class="buttoncss add" data-toggle="modal" data-target="#change_room"><i class="fa fa-plus" aria-hidden="true"></i> Change Room</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" data-toggle="modal" data-target="#guest_info_update"><i class="fas fa-edit"></i> Edit Guest Info</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{route('admin.edit.booking',$checkin->id)}}"><i class="fa fa-times" aria-hidden="true"></i> Edit Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" data-toggle="modal" data-target="#changetarif"><i class="fa fa-star" aria-hidden="true"></i> Change Tariff For new Day</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" id="delete" href="{{route('admin.delete.booking',$checkin->id)}}"><i class="fa fa-star" aria-hidden="true"></i> Delete Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-star" aria-hidden="true"></i> Link Advance Booking</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </fieldset>

                    </div>
                </div>
            </div>
            <!-- other service area end -->

                <!-- other service area start -->
                <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <fieldset class="mainitem">
                            <legend>Group Booking Edition</legend>

                            <table class="tableclass">
                                <tbody>





                                    <tr class="item">
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{ url('admin/singlecheckout/ingroupbooking',$checkin->id) }}"><i class="fa fa-plus" aria-hidden="true"></i>Single Checkout In GroupBooking</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{url('admin/addroom/existingbooking',$checkin->id)}}"><i class="fas fa-edit"></i>Add Booking In Existing Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{url('admin/change/room/groupbooking',$checkin->id)}}"><i class="fa fa-times" aria-hidden="true"></i>Change Room In Group Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{url('admin/change/masterroom/groupbooking',$checkin->id)}}"><i class="fa fa-star" aria-hidden="true"></i>Master Room In Group Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="{{url('admin/change/roomtarif/groupbooking',$checkin->id)}}"><i class="fa fa-star" aria-hidden="true"></i>Change Tariff For New Day</a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>

                        </fieldset>

                    </div>
                </div>
            </div>
            <!-- Checkout service area end -->



        </div>
    </div>
</div>


<!-- add service modal area start -->
<div class="modal fade" id="add_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add New HouseKepping Services</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr class="heading_area">
                        <th>Guest Information:</th>
                    </tr>
                </table>
                <table class="table table-borderless border-bottom">

                    <tbody>

                        <tr>
                            <th scope="row" class="control-label">Booking No.</th>
                            <td class="control-label">- {{$checkin->booking_no}}</td>
                            <th class="control-label" scope="row">Room No.</th>
                            <td class="control-label">{{$checkin->room_no}}({{$checkin->roomtype->room_type ?? ''}})</td>
                        </tr>
                        <tr>
                            <th class="control-label" scope="row">Checkin Date/Time</th>
                            <td class="control-label">{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th class="control-label" scope="row">Guest Name</th>
                            <td class="control-label">{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <!-- <table>
                    <tr class="heading_area">
                        <th>HouseKepping Services:</th>
                    </tr>
                </table> -->

                @php
                    date_default_timezone_set("Asia/Dhaka");
                    $servicedate = date("d-m-Y");
                    $servicetime = date("h:i");
                    @endphp
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 card basic-drop-shadow shadow-showcase mt-4 p-4">
                        <form action="{{route('admin.checkin.service.add')}}" method="post">
                            @csrf

                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Date/Time:</label>
                                <div class="col-sm-4">
                                    <input type="text" required name="service_date" class="controll-from datepicker" value="{{$servicedate}}">
                                    <input type="hidden" name="service_id" value="{{$checkin->id}}" class="controll-from" id="inputEmail3">
                                    <input type="hidden" name="service_no" value="{{rand(1111,99999)}}" class="controll-from" id="inputEmail3">
                                    <input type="hidden" name="room_no" value="{{$checkin->room_no}}" class="controll-from" id="inputEmail3">
                                </div>
                                <div class="col-sm-4">
                                    <input type="time" required name="service_time" class="controll-from" value="{{$servicetime}}">
                                </div>
                            </div>
                            <div class=" row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Services Category:</label>
                                <div class="col-sm-8">
                                    <select class="controll-from" name="service_category" id="category" required>
                                        <option disabled selected>---Select Category----</option>
                                        @foreach($menucategores as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class=" row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Services:</label>
                                <div class="col-sm-8">
                                    <select class="controll-from" id="service_category" name="services" required>
                                    <option disabled selected>---Select service----</option>
                                      
                                        @foreach($items as $row)
                                            <option value="{{$row->id}}">{{$row->item_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Remarks:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="remarks" class="controll-from" id="inputEmail3">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Rate:</label>
                                <div class="col-sm-8">
                                    <input type="number" required name="rate" class="controll-from" id="service_rate">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Qty:</label>
                                <div class="col-sm-8">
                                    <input type="number" required name="qty" class="controll-from" id="inputEmail3">
                                </div>

                            </div>

                            <div class="row mt-2">
                                <label class="col-sm-4 col-form-label text-center control-label" for="defaultCheck1">
                                    Third Party Supplier
                                </label>
                                <div class="col-sm-3">
                                    <input id="check_third" class="form-check-input" name="is_third" type="checkbox" value="1" id="defaultCheck1"> Yes
                                </div>
                            </div>
                            <div class=" row" id="third_party">
                                <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label"></label>
                                <div class="col-sm-8">
                                    <select class="controll-from" id="select_third_party" name="third_party">
                                        <option disabled selected>--- Select Suppliers ---</option>
                                        @foreach($supliers as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 p-2 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                    </div>



                    </form>


                </div>
            </div>


        </div>

    </div>
</div>
</div>
<!-- add service modal area end -->



<!-- edit service area start -->
<div class="modal fade" id="edit_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Edit HouseKepping Services</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr class="heading_area">
                        <th>Guest Information:</th>
                    </tr>
                </table>
                <table class="table table-borderless border-bottom">

                    <tbody>

                        <tr>
                            <th scope="row" class="control-label">Booking No.</th>
                            <td class="control-label">- {{$checkin->booking_no}}</td>
                            <th class="control-label" scope="row">Room No.</th>
                            <td class="control-label">{{$checkin->room_no}}({{$checkin->roomtype->room_type ?? ''}})</td>
                        </tr>
                        <tr>
                            <th class="control-label" scope="row">Checkin Date/Time</th>
                            <td class="control-label">{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th class="control-label" scope="row">Guest Name</th>
                            <td class="control-label">{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <!-- <table>
                    <tr class="heading_area">
                        <th>HouseKepping Services:</th>
                    </tr>
                </table> -->


                <div id="editservice">

                </div>
            </div>


        </div>

    </div>
</div>
<!-- edit service area end -->

<!-- deleted service area start -->
<div class="modal fade" id="deleted_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Delete HouseKepping Services</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr class="heading_area">
                        <th>Guest Information:</th>
                    </tr>
                </table>
                <table class="table table-borderless border-bottom">

                    <tbody>

                        <tr>
                            <th scope="row" class="control-label">Booking No.</th>
                            <td class="control-label">- {{$checkin->booking_no}}</td>
                            <th class="control-label" scope="row">Room No.</th>
                            <td class="control-label">{{$checkin->room_no}}({{$checkin->roomtype->room_type ?? ''}})</td>
                        </tr>
                        <tr>
                            <th class="control-label" scope="row">Checkin Date/Time</th>
                            <td class="control-label">{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th class="control-label" scope="row">Guest Name</th>
                            <td class="control-label">{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <!-- <table>
                    <tr class="heading_area">
                        <th>HouseKepping Services:</th>
                    </tr>
                </table> -->


                <div id="deletedservice">

                </div>
            </div>


        </div>

    </div>
</div>
<!-- deleted service area end -->


<!-- view service area start -->
<div class="modal fade" id="view_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">View HouseKepping Services</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr class="heading_area">
                        <th>Guest Information:</th>
                    </tr>
                </table>
                <table class="table table-borderless border-bottom">

                    <tbody>

                        <tr>
                            <th scope="row" class="control-label">Booking No.</th>
                            <td class="control-label">- {{$checkin->booking_no}}</td>
                            <th class="control-label" scope="row">Room No.</th>
                            <td class="control-label">{{$checkin->room_no}}({{$checkin->roomtype->room_type ?? ''}})</td>
                        </tr>
                        <tr>
                            <th class="control-label" scope="row">Checkin Date/Time</th>
                            <td class="control-label">{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th class="control-label" scope="row">Guest Name</th>
                            <td class="control-label">{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <!-- <table>
                    <tr class="heading_area">
                        <th>HouseKepping Services:</th>
                    </tr>
                </table> -->


                <div id="viewservice">

                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{route('admin.print.service',$checkin->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
<!-- deleted service area end -->

<!-- view service area start -->
<div class="modal fade" id="view_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">View HouseKepping Services</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr class="heading_area">
                        <th>Guest Information:</th>
                    </tr>
                </table>
                <table class="table table-borderless border-bottom">

                    <tbody>

                        <tr>
                            <th scope="row" class="control-label">Booking No.</th>
                            <td class="control-label">- {{$checkin->booking_no}}</td>
                            <th class="control-label" scope="row">Room No.</th>
                            <td class="control-label">{{$checkin->room_no}}({{$checkin->roomtype->room_type ?? ''}})</td>
                        </tr>
                        <tr>
                            <th class="control-label" scope="row">Checkin Date/Time</th>
                            <td class="control-label">{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th class="control-label" scope="row">Guest Name</th>
                            <td class="control-label">{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <!-- <table>
                    <tr class="heading_area">
                        <th>HouseKepping Services:</th>
                    </tr>
                </table> -->


                <div id="viewservice">

                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{route('admin.print.service',$checkin->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
<!-- view service area end -->



<!-- Change Room area start -->
<div class="modal fade" id="change_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Room Shift</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.room.change')}}" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Shift Date/Time</label>
                        <div class="col-sm-5">
                            <input required type="text" name="shift_date" value="{{$servicedate}}" class="form-control form-control-sm datepicker" id="shift_date">
                        </div>
                        <div class="col-sm-5">
                            <input required type="time" class="form-control form-control-sm" name="sift_time" id="shift_time" value="{{$servicetime}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Old Room No:</label>
                        <div class="col-sm-5">
                            {{$checkin->room_no}} ({{$checkin->roomtype->room_type ?? ''}})
                        </div>
                        <input type="hidden" required value="{{$checkin->room_no}}" name="room_no" />
                        <input type="hidden" required value="{{$checkin->id}}" name="checkin_id" />

                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Old Tariff Rate :</label>
                        <div class="col-sm-7">
                            <input required type="text" class="form-control form-control-sm" disabled value=" {{$checkin->tarif}}" id="shift_date">
                        </div>

                    </div>

                    @php
                        $rooms = $rooms->where('room_status','!=',3)->where('room_status',1);
                        $roomdata = $rooms->all(); 
                    @endphp

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">New Room No:</label>
                        <div class="col-sm-7">
                            <select required class="form-control form-control-sm" id="newroom" name="newroom">
                                <option disabled selected>---Select Room---</option>
                                @foreach($roomdata as $row)

                          
                                <option value="{{$row->id}}">{{$row->room_no}} ({{$row->roomtype->room_type}})</option>
                                @endforeach
                            </select>
                            @error('newroom')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">New Tariff Rate :</label>
                        <div class="col-sm-7">
                            <input required type="number" name="newtariff" class="form-control form-control-sm" id="newtariff">
                        </div>

                    </div>



                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Remarks :</label>
                        <div class="col-sm-7">

                            <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" name="remarks" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>


                </form>
            </div>


        </div>

    </div>
</div>
<!-- Change Room area end -->

<!-- guest info update start -->

<div class="modal fade" id="guest_info_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Guest Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.guest.update',$checkin->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="staticEmail">Title <small class="text-danger">*</small></label>
                                <select required class="form-control form-control-sm" name="person_title" id="exampleFormControlSelect2">
                                    <option @if($checkin->title =='Mr.') selected @endif value="Mr.">Mr.</option>
                                    <option @if($checkin->title =='Miss') selected @endif value="Miss">Miss</option>
                                    <option @if($checkin->title =='M/s') selected @endif value="M/s">M/S</option>
                                    <option @if($checkin->title =='MS') selected @endif value="MS">MS</option>
                                    <option @if($checkin->title =='Mrs') selected @endif value="Mrs">Mrs</option>
                                    <option @if($checkin->title =='Dr.') selected @endif value="Dr.">Dr.</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="staticEmail">Guest Name <small class="text-danger">*</small></label>
                                <input required type="text" class="form-control form-control-sm" value="{{$checkin->guest_name}}" name="guest_name" id="formGroupExampleInput2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="staticEmail">Gender <small class="text-danger">*</small></label>
                                <select required class="form-control form-control-sm" name="gender" id="exampleFormControlSelect2">
                                    <option @if($checkin->gender == 1) selected @endif value="1">Male</option>
                                    <option @if($checkin->gender == 2) selected @endif value="2">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="staticEmail">Print Name <small class="text-danger">*</small></label>
                                <input type="text" required class="form-control form-control-sm" value="{{$checkin->print_name}}" name="print_name" id="formGroupExampleInput2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staticEmail">Father Name:</label>
                                <input type="text" class="form-control form-control-sm" value="{{$checkin->father_name}}" name="father_name" id="formGroupExampleInput2">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staticEmail">Company Name:</label>
                                <input type="text" value="{{$checkin->company_name}}" class="form-control form-control-sm" name="company_name" id="formGroupExampleInput2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staticEmail">Email:</label>
                                <input type="text" class="form-control form-control-sm" value="{{$checkin->email}}" name="email" id="formGroupExampleInput2">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staticEmail">Address <small class="text-danger">*</small></label>
                                <input required type="text" class="form-control form-control-sm" value="{{$checkin->address}}" name="address" id="formGroupExampleInput2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="staticEmail">Mobile <small class="text-danger">*</small></label>
                                <input type="text" required class="form-control form-control-sm" value="{{$checkin->mobile}}" name="mobile" id="formGroupExampleInput2">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="staticEmail">Nationality<small class="text-danger">*</small></label>
                                <input type="text" required class="form-control form-control-sm" value="{{$checkin->nationality}}" name="nationality" id="formGroupExampleInput2">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="staticEmail">City <small class="text-danger">*</small></label>
                                <input type="text" required class="form-control form-control-sm" value="{{$checkin->city}}" name=" city" id="formGroupExampleInput2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="staticEmail">ID Type <small class="text-danger">*</small></label>
                                <select class="form-control form-control-sm" name="id_type" required id="exampleFormControlSelect2">
                                    <option @if($checkin->doc_type == "passport") selected @endif value="passport">Passport</option>
                                    <option @if($checkin->doc_type == "admit_card") selected @endif value="admit_card">Admit Card</option>
                                    <option @if($checkin->doc_type == "bank_passbook") selected @endif value="bank_passbook">bank passbook</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="staticEmail">ID No <small class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" required value="{{$checkin->id_no}}" name="id_no" id="formGroupExampleInput2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-sm-6">
                            <label for="staticEmail">Current Document Image</label>
                            <img src="{{asset('public/uploads/checkin/')}}/{{$checkin->id_proof_imag}}" alt="" width="80%" />
                        </div>

                        <div class="col-sm-6">
                            <label for="staticEmail">Upload ID <small class="text-danger">*</small></label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="doc_img">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<!-- guest info update end -->


<!-- change tarif area start -->

<div class="modal fade" id="changetarif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tariff Change</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.tarif.update',$checkin->id)}}" method="post">
                @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Shift Date/Time:</label>
                        <div class="col-sm-6">
                            <input type="text" name="tariff_change_date" class="form-control datepickerdaly form-control-sm" id="inputEmail3" required value="{{$servicedate}}">
                            
                        </div>
                        <div class="col-sm-3">
                            <input type="time" class="form-control form-control-sm" name="tariff_change_time"  id="inputEmail3" value="{{$servicetime}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Room No:</label>
                        <div class="col-sm-6">
                            <span>{{$checkin->room_no}} ({{$checkin->roomtype->room_type ?? ''}})</span>

                            <input type="hidden" value="{{$checkin->room_no}}" name="room_no" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Old Tariff Rate:</label>
                        <div class="col-sm-6">
                            <input type="number" disabled class="form-control form-control-sm" value="{{$checkin->tarif}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">New Tariff Rate:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control form-control-sm" required name="new_tariff">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Remarks:</label>
                        <div class="col-sm-6">
                            <textarea class="form-control form-control-sm" name="tariff_remarks" rows="3"></textarea>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Traif</button>
                </div>
                   
                </form>

               
            </div>

        </div>
    </div>
</div>
<!-- change tarif area end -->







<script>
    $('#third_party').hide();
    var check_third = document.querySelector('#check_third');
    check_third.addEventListener('click', function(e) {

        if (e.target.checked == true) {

            $('#third_party').show();
            $('#select_third_party').required = true;
        } else if (e.target.checked == false) {
            $('#third_party').hide();
            $('#select_third_party').required = false;
        }
    })
</script>

<script>
    $(document).ready(function() {
        $('#editservicebtn').click(function(params) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ route('admin.checkin.get.service',$checkin->id)}}",

                success: function(data) {
                    $('#deleted_extra').remove();
                    $('#editservice').append(data);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#deleteservicebtn').click(function(params) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ route('admin.checkin.get.delete.service',$checkin->id)}}",

                success: function(data) {
                    $('#deleted_extra_service').remove();
                    $('#deletedservice').append(data);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#viewservicebtn').click(function(params) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ route('admin.checkin.get.view.service',$checkin->id)}}",
                success: function(data) {
                    $('#view_extra_service').remove();
                    $('#viewservice').append(data);
                }
            });
        });
    });
</script>

<script>
    var room = document.querySelector('#newroom');
    room.addEventListener('change', function(e) {
        var id = e.target.value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/room/change/') }}/" + id,
            success: function(data) {
                document.querySelector('#newtariff').value = data;

            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#service_category').change(function(params) {
            var id = params.target.value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/service/categores/') }}/"+id,
                
                success: function(data) {
                 document.querySelector('#service_rate').value = data.rate;
                }
            });
        });
    });
</script>

<script>
    var category = document.querySelector('#category');
    category.addEventListener('change',function(e){
        var id = e.target.value;

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ url('/admin/service/list/') }}/"+id,
                
                success: function(data) {
                 console.log(data);

                 $('#service_category').empty();
                 if(data.length > 0){
                    $('#service_category').append(' <option value="0">--Please Select Your Item--</option>');
                    $.each(data,function(index,itemobj){
                        $('#service_category').append('<option value="' + itemobj.id + '">'+itemobj.item_name+'</option>');
                    });
                 }else{
                    $('#service_category').append(' <option> No Data Found!</option>');
                 }
                  
                }
            });

    })
</script>

<script>
$(document).ready(function(){
    $('.datepickerdaly').datepicker({
        format: 'dd-mm-yyyy',
    });
});
</script>



@endsection