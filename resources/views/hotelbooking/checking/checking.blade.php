@extends('hotelbooking.master')
@section('title', 'Checking | '.$seo->meta_title)

@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
$bookingno = rand(11111,99999);
$time = date("h:i");
@endphp

<style>
    #delectimage {
        position: absolute;
        top: 0;
        right: 2%;
    }

    .form-group {
        margin-bottom: 1px;
    }

    html {
        scroll-behavior: smooth;
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

    input:required:focus {
        border: 1px solid red;
        outline: none;
    }
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Check-In</h4>
                        </div>


                    </div>
                </div>

                <form action="{{route('admin.checkin.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Details</h4>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="row">

                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th class="control-label" scope="row">Date</th>
                                                    <td class="control-label">{{$current}}</td>
                                                    <input type="hidden" name="date" value="{{$current}}">
                                                    <input type="hidden" name="room_id" value="{{$room->id}}">
                                                </tr>
                                                <tr>
                                                    <th class="control-label" scope="row">Booking No</th>
                                                    <td class="control-label">- {{$bookingno}}</td>
                                                    <input type="hidden" name="booking_no" value="{{$bookingno}}">
                                                </tr>
                                                <tr>
                                                    <th class="control-label" scope="row">Room Type</th>
                                                    <td class="control-label">{{$room->roomtype->room_type ?? ''}} ( $ {{$room->tariff}})</td>
                                                    <input type="hidden" name="room_type" value="{{$room->room_type}}">
                                                </tr>
                                                <tr>
                                                    <th class="control-label" scope="row">Room No</th>
                                                    <td class="control-label">{{$room->room_no}}</td>
                                                    <input type="hidden" name="room_no" value="{{$room->room_no}}">
                                                </tr>
                                                <tr>
                                                    <th class="control-label" scope="row">Booking Type</th>
                                                    <td>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="individual" name="booking_type" class="custom-control-input" value="1" checked="checked">
                                                            <label class="custom-control-label" for="individual">Individual</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="group_booking" name="booking_type" value="2" class="custom-control-input">
                                                            <label class="custom-control-label" for="group_booking">Group</label>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="control-label" scope="row">Checkout Time</th>
                                                    <td>
                                                        <select class=" controll-from" name="checkout_time">
                                                            <option value="1" selected>12 Noon Checkout</option>
                                                            <option value="2" selected>12 Hr Checkout</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th class="control-label" scope="row">Link With Advanced Booking?</th>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="is_advance" name="addvance_booking" value="1">
                                                            <label class="form-check-label" for="advance">
                                                                Yes
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table>
                                            <tbody>
                                                <tr class="advance_booking">
                                                    <th class="control-label" scope="row">Guest Name:</th>
                                                    <td>
                                                        <div class="col-12">
                                                            <input type="text" class="controll-from" id="pwd1" name="adv_guest_name" placeholder="Enter Guest Name">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="advance_booking">
                                                    <th class="control-label" scope="row">Advance Booking No:</th>
                                                    <td>
                                                        <div class="col-12">
                                                            <input type="text" class="controll-from" id="pwd1" name="adv_booking_no" placeholder="Enter Advance Booking No">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                            <!-- Guest Registration Form -->

                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Guest Registration Form</h4>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Title:</label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="person_title">
                                                <option value="Mr.">Mr.</option>
                                                <option value="Miss">Miss</option>
                                                <option value="M/s">M/S</option>
                                                <option value="MS">MS</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Dr.">Dr.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Guest Name <small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" required autofocus id="pwd1" name="guest_name" placeholder="Enter Guest Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Print Name <small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" required id="pwd1" name="print_name" placeholder="Enter Print Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Gender<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="gender" required>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Father's Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" id="pwd1" placeholder="Enter Father's Name" name="father_name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Address<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" required id="pwd1" placeholder="Enter Address" name="address">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">City<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="city" id="pwd1" required placeholder="Enter City">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Mobile<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="mobile" required id="pwd1" placeholder="Enter Mobile">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Nationality<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="nationality" required id="pwd1" placeholder="Enter Nationality">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="controll-from" name="email" id="pwd1" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Date of Birth</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="controll-from" id="dofdatepicker" name="date_of_birth" placeholder="Enter Date of Birth">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Document Type<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="doc_type" required>
                                                <option value="passport">Passport</option>
                                                <option value="admit_card">Admit Card</option>
                                                <option value="bank_passbook">bank passbook</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">ID No<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" required name="id_no" id="pwd1" placeholder="Enter ID No">
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Check In Info</h4>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">File No <small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="number" class="controll-from" name="file_no" required id="pwd1" placeholder="Enter File No">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Check-In Date <small class="text-danger">*</small></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="controll-from" name="checkin_date"  required id="datepicker" value="{{$current}}" placeholder="d/m/y">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="time" class="controll-from" name="checkin_time" required id="pwd1" value="{{$time}}" placeholder="h:m">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Expected Check-Out Date <small class="text-danger">*</small></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="controll-from datepicker" name="expected_checkout_date" required id="pwd1" 
                                            placeholder="d/m/y"
                                            value="{{$current}}">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="time" class="controll-from" name="exp_checkout_time" required id="pwd1" placeholder="h:m"
                                            value="{{$time}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Tariff<small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="tariff" value="{{$room->tariff}}" required id="pwd1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Non-Taxable</label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="non_tax" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Company Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="company_name" id="pwd1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Default Grace Time</label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="default_grace_time">
                                                <option value="5">5 Hours</option>
                                                <option value="2">2 Hours</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">How did you find us:</label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="find_us">
                                                <option value="auto/texi">Auto/Texi</option>
                                                <option value="direct">Direct</option>
                                                <option value="friends">Friends</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Own Vehicle</label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="own_vehicle" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Vehicle Type:</label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="vehicle_type">
                                                <option value="auto_ricksaw">Auto Ricksaw</option>
                                                <option value="bmw_car">BMW Car</option>
                                                <option value="bus">Bus</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Vehicle No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="vehicle_no" id="pwd1">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="email">Thru Agent:</label>
                                        <div class="col-sm-9">
                                            <select class="controll-from" id="exampleFormControlSelect1" name="true_agent">
                                                <option value="agoda">Agoda</option>
                                                <option value="booking.com">Booking.com</option>
                                                <option value="makemytrip">Makemytrip</option>
                                            </select>
                                        </div>
                                    </div>






                                </div>

                            </div>

                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">For Official Purpose</h4>
                                    </div>
                                </div>


                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Coming From</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="comming_from" id="pwd1" placeholder="Enter Coming From">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Going To</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="going_to" id="pwd1" placeholder="Enter Going To">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Purpose of Visit <small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="purpose_of_visit" required id="pwd1" placeholder="Enter Purpose of Visit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">No of Person <small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="number" class="controll-from" name="no_of_person" required id="pwd1" placeholder="Enter Purpose of Visit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="pwd1">Relationship <small class="text-danger">*</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="controll-from" name="relationship" required id="pwd1" placeholder="Enter Relationship">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center" for="pwd1">Male</label>
                                        <div class="col-sm-2">
                                            <input type="number" class="controll-from" name="male_no">
                                        </div>
                                        <label class="control-label col-sm-2 align-self-center" for="pwd1">Female</label>
                                        <div class="col-sm-2">
                                            <input type="number" class="controll-from" name="female_no">
                                        </div>
                                        <label class="control-label col-sm-2 align-self-center" for="pwd1">Children</label>
                                        <div class="col-sm-2">
                                            <input type="number" class="controll-from" name="children_no">
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="card shadow-sm shadow-showcase">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Upload Client Image:</p>
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="customFile" name="client_img" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <span class="btn btn-warning" data-toggle="modal" data-target="#client_img"> Take a Image</span>
                                        </div>

                                        <div class="col-md-6">
                                            <p>Upload ID Proof:</p>
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="customFile" name="id_proof_img" required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>

                                            </div>
                                            <span class="btn btn-warning" data-toggle="modal" data-target="#doc_img"> Take a Image</span>
                                        </div>
                                    </div>



                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="row" id="avilableroom">
                        <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Available Rooms</h4>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 border-right" id="rooms">
                                            <!-- <div class="form-check pb-2 bt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="advance">
                                            <label class="form-check-label" for="advance">
                                                403 (Delux Rooms - 13000.00)
                                            </label>
                                        </div>

                                        <div class="form-check pb-2 bt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="advance">
                                            <label class="form-check-label" for="advance">
                                                403 (Delux Rooms - 13000.00)
                                            </label>
                                        </div>

                                        <div class="form-check pb-2 bt-2">
                                            <input class="form-check-input" type="checkbox" value="" id="advance">
                                            <label class="form-check-label" for="advance">
                                                403 (Delux Rooms - 13000.00)
                                            </label>
                                        </div> -->



                                        </div>

                                        <div class="col-md-8">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Room No</th>
                                                        <th scope="col">Room Type</th>
                                                        <th scope="col">Tariff</th>
                                                        <th scope="col">Guest Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="addroomchoosearea">
                                                    <!-- <tr>
                                                    <th>105</th>
                                                    <td>DELUXE ROOMS </td>
                                                    <td><input type="number" class="controll-from" value="15000"></td>
                                                    <td><input type="text" class="controll-from"></td>
                                                </tr> -->

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-12">
                            <div class=" text-center">
                                <span id="start-one">
                                    <button id="file-upload-btn" type="submit" class="btn btn-lg btn-primary">Submit</button>
                                </span>

                            </div>
                        </div>

                    </div>
                </form>
            </div>


        </div>
    </div>
</div>






<!-- Client Image -->
<div class="modal fade" id="client_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Client Image:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="my_camera"></div>
                            <br />
                            
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                        <div class="col-md-6">
                            <div id="results">
                                Your captured image will appear here...
                            </div>
                        </div>
                       
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="take_snapshot()" class="btn btn-secondary mr-auto">Take Snapshot</button>
                <button type="button" data-dismiss="modal" class="btn btn-primary">Use It</button>
            </div>
        </div>
    </div>
</div>



<!-- Document Image -->
<div class="modal fade" id="doc_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="doc_camera"></div>
                            <br />
                            
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                        <div class="col-md-6">
                            <div id="results_doc">Your captured image will appear here...</div>
                        </div>
                       
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onClick="take_snapshot_doc()" class="btn btn-secondary mr-auto">Take Snapshot</button>
                <button type="button" data-dismiss="modal" class="btn btn-primary">Use It</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<script language="JavaScript">
    Webcam.set({
        width: 370,
        height: 320,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
    Webcam.attach( '#doc_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {


            $(".image-tag").val(data_uri);
            $(".client_web_img").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }

    function take_snapshot_doc() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results_doc').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>


<script>
    $(document).ready(function() {
        var adbooking = document.querySelectorAll('.advance_booking');
        adbooking.forEach(function(e) {
            e.style.display = 'none';
        });
        document.querySelector('#avilableroom').style.display = 'none';
        console.log(document.querySelector('#avilableroom'));
    });


    var UIController = (function() {


        function getElement() {
            return {
                is_advance: document.querySelector('#is_advance'),
                adbooking: document.querySelectorAll('.advance_booking'),
                group_booking: document.querySelector('#group_booking'),
                rooms: document.querySelector('#rooms'),
                individual: document.querySelector('#individual'),
                roomhtml: document.querySelectorAll('.roomhtml'),
                room_data: document.querySelectorAll('.room_data'),
                avilableroom: document.querySelector('#avilableroom'),
                addroomdata: document.querySelectorAll('.addroomdata'),
            }
        }
        return {
            element: getElement(),
        }
    })();


    var controller = (function(ctrui) {
        var eventhandeler = ctrui.element.is_advance.addEventListener('click', function(event) {
            ctrui.element.adbooking.forEach(function(e) {
                if (event.target.checked == true) {
                    e.style.display = 'inline';
                    e.style.transition = '.5s';
                } else if (event.target.checked == false) {
                    e.style.display = 'none';
                }

            })

        });

        var rooms = [];

        var getRooms = function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: "{{ route('admin.get.hotel') }}",

                success: function(data) {

                    rooms.push(data);

                }
            });
        }




        var groupBookingEvent = ctrui.element.group_booking.addEventListener('click', function(e) {

            if (e.target.checked == true) {
                // e.target.disabled = true;

                ctrui.element.avilableroom.style.display = 'block';
                rooms.forEach(function(e) {
                    e.forEach(function(element, i) {

                        var roomsdata = '<div class="form-check pb-2 bt-2 roomhtml"><input class="form-check-input room_data" type="checkbox" onclick="chooseRoom(this)" value="%i%"><label class="form-check-label" for="advance">%room_no% ( %room_type% - %price%)</label></div>';

                        var newroomsdata = roomsdata.replace('%room_type%', element.roomtype.room_type);
                        var newroomsdata = newroomsdata.replace('%room_no%', element.room_no);
                        var newroomsdata = newroomsdata.replace('%price%', element.tariff);
                        var newroomsdata = newroomsdata.replace('%i%', i);

                        ctrui.element.rooms.insertAdjacentHTML('beforeend', newroomsdata);
                    })
                })
            }

        });




        var individual = ctrui.element.individual.addEventListener('click', function() {
            ctrui.element.group_booking.disabled = false;

            ctrui.element.avilableroom.style.display = 'none';
            document.querySelectorAll('.addroomdata').forEach(function(e) {
                e.remove();
            });

            document.querySelectorAll('.roomhtml').forEach(function(el) {
                el.remove();
            });

        });





        return {
            init: function() {
                return getRooms();
            },
            data: rooms,
        }

    })(UIController);


    function chooseRoom(el) {
        var chooserooms = [];
        if (el.checked == true) {
            var data = controller.data[0][el.value];
            chooserooms.push(data);
            addchoosroom(chooserooms, el.value);
        } else if (el.checked == false) {

            chooserooms.splice(el.value, 1);
            deleteRoom(el.value);


        }
    }

    function addchoosroom(rooms, value) {
        rooms.forEach(function(room) {
            var html = '<tr id="%id%" class="addroomdata"><th>%room_no%</th><td>%room_type% </td><td><input type="number" class="controll-from" name="add_room_price[]" value="%price%"></td><td><input type="text" class="controll-from" required name="add_room_guest[]" ><input type="hidden" class="controll-from" name="add_room_id[]" value="%room_id%"></td></tr>';

            var newhtml = html.replace('%room_no%', room.room_no);
            var newhtml = newhtml.replace('%id%', 'addchoosroom' + value);
            var newhtml = newhtml.replace('%room_type%', room.roomtype.room_type);
            var newhtml = newhtml.replace('%price%', room.tariff);
            var newhtml = newhtml.replace('%room_id%', room.id);

            document.querySelector('#addroomchoosearea').insertAdjacentHTML('beforeend', newhtml);

        });
    }

    function deleteRoom(value) {

        document.querySelector('#addchoosroom' + value).remove();
    }


    controller.init();
</script>







@endsection