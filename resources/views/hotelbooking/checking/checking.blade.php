@extends('hotelbooking.master')
@section('title', 'Checking | '.$seo->meta_title)
@section('content')
<style>
    #delectimage {
        position: absolute;
        top: 0;
        right: 2%;
    }

    .form-group {
        margin-bottom: 1px;
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
                                                <td class="control-label">03-01-2021</td>
                                            </tr>
                                            <tr>
                                                <th class="control-label" scope="row">Booking No</th>
                                                <td class="control-label">-10671</td>
                                            </tr>
                                            <tr>
                                                <th class="control-label" scope="row">Room Type</th>
                                                <td class="control-label">DELUXE ROOMS ($14000.00)</td>
                                            </tr>
                                            <tr>
                                                <th class="control-label" scope="row">Room No</th>
                                                <td class="control-label">103</td>
                                            </tr>
                                            <tr>
                                                <th class="control-label" scope="row">Booking Type</th>
                                                <td>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Individual</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Group</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="control-label" scope="row">Checkout Time</th>
                                                <td>
                                                    <select class="custom-select">
                                                        <option selected>12 Noon Checkout</option>
                                                        <option selected>12 Hr Checkout</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th class="control-label" scope="row">Link With Advanced Booking?</th>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="advance">
                                                        <label class="form-check-label" for="advance">
                                                            Yes
                                                        </label>
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
                                        <select class="controll-from" id="exampleFormControlSelect1">
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
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Guest Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Print Name <small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Print Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Gender<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <select class="controll-from" id="exampleFormControlSelect1">
                                            <option value="Mr.">Male</option>
                                            <option value="Miss">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Father's Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Father's Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Address<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">City<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter City">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Mobile<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Mobile">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Nationality<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Nationality">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="controll-from" id="pwd1" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Date of Birth</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="controll-from" id="dofdatepicker" placeholder="Enter Date of Birth">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Document Type<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <select class="controll-from" id="exampleFormControlSelect1">
                                            <option value="passport">Passport</option>
                                            <option value="admit card">Admit Card</option>
                                            <option value="bank passbook">bank passbook</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">ID No<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter ID No">
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Upload ID Proof</h4>
                                </div>
                            </div>


                            <div id="imageuploaditem">
                                <div class="card-body" id="frontupload">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <!-- <input id="file-upload" type="file" name="fileUpload" accept="image/*" /> -->
                                                <label id="mainimageupload">
                                                    <!-- <img id="file-image" src="#" alt="Preview"> -->
                                                    <span id="start-one">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                        <span class="d-block">Select a file or drag here</span>
                                                        <span id="notimage" class="hidden d-block">Please select image</span>
                                                        <span id="file-upload-btn" class="btn btn-primary findImage" data-toggle="modal" data-target="#imageuploadmodal" data-whatever="@mdo">Select a file</span>
                                                    </span>

                                                </label>

                                            </div>
                                        </div>
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
                                        <input type="number" class="controll-from" id="pwd1" placeholder="Enter File No">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Check-In Date <small class="text-danger">*</small></label>
                                    <div class="col-sm-7">
                                        <input type="date" class="controll-from" id="pwd1" placeholder="d/m/y">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="time" class="controll-from" id="pwd1" placeholder="h:m">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Expected Check-Out Date <small class="text-danger">*</small></label>
                                    <div class="col-sm-7">
                                        <input type="date" class="controll-from" id="pwd1" placeholder="d/m/y">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="time" class="controll-from" id="pwd1" placeholder="h:m">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Tariff<small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Non-Taxable</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
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
                                        <input type="text" class="controll-from" id="pwd1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Default Grace Time</label>
                                    <div class="col-sm-9">
                                        <select class="controll-from" id="exampleFormControlSelect1">
                                            <option value="5">5 Hours</option>
                                            <option value="2">2 Hours</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">How did you find us:</label>
                                    <div class="col-sm-9">
                                        <select class="controll-from" id="exampleFormControlSelect1">
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
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Vehicle Type:</label>
                                    <div class="col-sm-9">
                                        <select class="controll-from" id="exampleFormControlSelect1">
                                            <option value="auto ricksaw">Auto Ricksaw</option>
                                            <option value="bmw car">BMW Car</option>
                                            <option value="bus">Bus</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Vehicle No</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="email">Thru Agent:</label>
                                    <div class="col-sm-9">
                                        <select class="controll-from" id="exampleFormControlSelect1">
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
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Coming From">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Going To</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Going To">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Purpose of Visit <small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="controll-from" id="pwd1" placeholder="Enter Purpose of Visit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">No of Person <small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="controll-from" id="pwd1" placeholder="Enter Purpose of Visit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="pwd1">Relationship <small class="text-danger">*</small></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="controll-from" id="pwd1" placeholder="Enter Relationship">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center" for="pwd1">Male</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="controll-from">
                                    </div>
                                    <label class="control-label col-sm-2 align-self-center" for="pwd1">Female</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="controll-from">
                                    </div>
                                    <label class="control-label col-sm-2 align-self-center" for="pwd1">Children</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="controll-from">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Upload Client Image</h4>
                                </div>
                            </div>


                            <div id="imageuploaditem">
                                <div class="card-body" id="frontupload">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <!-- <input id="file-upload" type="file" name="fileUpload" accept="image/*" /> -->
                                                <label id="mainimageupload">
                                                    <!-- <img id="file-image" src="#" alt="Preview"> -->
                                                    <span id="start-one">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                        <span class="d-block">Select a file or drag here</span>
                                                        <span id="notimage" class="hidden d-block">Please select image</span>
                                                        <span id="file-upload-btn" class="btn btn-primary findImage" data-toggle="modal" data-target="#imageuploadmodal" data-whatever="@mdo">Select a file</span>
                                                    </span>

                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Available Rooms</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">
                                                403 (DELUXE ROOMS - 13000.00)
                                            </label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">
                                                404 (TWIN ROOMS - 18000.00)
                                            </label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">
                                                403 (DELUXE ROOMS - 13000.00)
                                            </label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">
                                                404 (TWIN ROOMS - 18000.00)
                                            </label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">
                                                403 (DELUXE ROOMS - 13000.00)
                                            </label>
                                        </div>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">
                                                404 (TWIN ROOMS - 18000.00)
                                            </label>
                                        </div>

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
                                            <tbody>
                                                <tr>
                                                    <th>105</th>
                                                    <td>DELUXE ROOMS </td>
                                                    <td><input type="number" class="controll-from" value="15000"></td>
                                                    <td><input type="text" class="controll-from"></td>
                                                </tr>

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
            </div>


        </div>
    </div>
</div>


<script>
  
  

    function uploadimg(el) {

        $('#usefile').click(function(params) {
            if (el.checked == true) {

                var imgID = el.value;


                var photo_div = '<div class="card-body" id="delectselctImage">';
                photo_div += '<div class="row">';
                photo_div += '<div class="col-md-12">';
                photo_div += '<img src="public/uploads/imagemanager/' + imgID + '" id="mainimage" class="w-100">';
                photo_div += '<button type="button" class="btn-danger btn-sm" onclick="delectselctImage(this)" id="delectimage"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                photo_div += '<input type="hidden" name="image"/ value="' + imgID + '">';

                photo_div += '</div>';
                photo_div += '</div>';
                photo_div += '</div>';


                $('#delectselctImage').closest('.card-body').remove();
                $('#frontupload').hide();
                $('#imageuploaditem').append(photo_div);


            }

        });





    }

    function delectselctImage(em) {


        $(em).closest('.card-body').remove();
        $('#frontupload').show();
    }
</script>





@endsection