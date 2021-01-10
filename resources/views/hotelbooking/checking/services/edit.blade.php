@extends('hotelbooking.master')
@section('title', 'Edit Check In | '.$seo->meta_title)
@section('content')
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
                                            <a class="buttoncss add" href="#"><i class="fa fa-plus" aria-hidden="true"></i> Add Voucher</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fas fa-edit"></i> Edit Voucher</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-times" aria-hidden="true"></i> Delete Voucher</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-star" aria-hidden="true"></i> view Voucher</a>
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
                                            <a class="buttoncss add" href="#"><i class="fas fa-edit"></i> Edit Guest Info</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-times" aria-hidden="true"></i> Edit Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a style="font-size: 12px;" class="buttoncss add" href="#"><i class="fa fa-star" aria-hidden="true"></i> Change Tariff For new Day</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-star" aria-hidden="true"></i> Delete Booking</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 12px;" class=" d-block">
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
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10 card basic-drop-shadow shadow-showcase mt-4 p-4">
                        <form action="{{route('admin.checkin.service.add')}}" method="post">
                            @csrf

                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Date/Time:</label>
                                <div class="col-sm-4">
                                    <input type="date" required name="service_date" class="controll-from" id="inputEmail3">
                                    <input type="hidden" name="service_id" value="{{$checkin->id}}" class="controll-from" id="inputEmail3">
                                    <input type="hidden" name="service_no" value="{{rand(1111,99999)}}" class="controll-from" id="inputEmail3">
                                </div>
                                <div class="col-sm-4">
                                    <input type="time" required name="service_time" class="controll-from" id="inputEmail3">
                                </div>
                            </div>
                            <div class=" row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Services Category:</label>
                                <div class="col-sm-8">
                                    <select class="controll-from" id="exampleFormControlSelect1" name="service_category" required>
                                        <option value="1">Extra Rooms</option>
                                        <option value="2">Extra Bad</option>
                                        <option value="3">Wifi</option>
                                    </select>
                                </div>
                            </div>

                            <div class=" row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label text-center control-label">Services:</label>
                                <div class="col-sm-8">
                                    <select class="controll-from" id="exampleFormControlSelect1" name="services" required>
                                        <option value="1">Extra Rooms</option>
                                        <option value="2">Extra Bad</option>
                                        <option value="3">Wifi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Remarks:</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="remarks" class="controll-from" id="inputEmail3">
                                </div>

                            </div>
                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-4 col-form-label text-center control-label">Rate:</label>
                                <div class="col-sm-8">
                                    <input type="number" required name="rate" class="controll-from" id="inputEmail3">
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
                                        <option value="1">Extra Rooms</option>
                                        <option value="2">Extra Bad</option>
                                        <option value="3">Wifi</option>
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
                <form>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Shift Date/Time</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control form-control-sm" id="shift_date" placeholder="col-form-label-sm">
                        </div>
                        <div class="col-sm-5">
                            <input type="time" class="form-control form-control-sm" id="shift_time" placeholder="col-form-label-sm">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Old Room No:</label>
                        <div class="col-sm-5">
                            203 (Delux Rooms)
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Old Tariff Rate :</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control form-control-sm" id="shift_date">
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">New Room No:</label>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">New Tariff Rate :</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control form-control-sm" id="shift_date">
                        </div>

                    </div>

                    
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Plane Code:</label>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Remarks :</label>
                        <div class="col-sm-7">
                            
                            <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-5">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                    
                    
                </form>
            </div>


        </div>

    </div>
</div>
<!-- Change Room area end -->






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



@endsection