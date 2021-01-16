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
        margin-bottom: 5%;
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
                            <h4 class="card-title">Edit Booking Information</h4>
                        </div>


                    </div>
                </div>

                
                    <div class="row">
                        <div class="col-md-12">
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
                                                    <th class="control-label" scope="row">Booking No</th>
                                                    <td class="control-label">- {{$checkin->booking_no}}</td>

                                                    <th class="control-label" scope="row">Booking Date</th>
                                                    <td class="control-label">{{$checkin->created_at}}</td>

                                                </tr>

                                                <tr>
                                                    <th class="control-label" scope="row">Room Type</th>
                                                    <td class="control-label">{{$checkin->roomtype->room_type ?? ''}}</td>

                                                    <th class="control-label" scope="row">Room No</th>
                                                    <td class="control-label">{{$checkin->room_no}}</td>


                                                </tr>

                                            </tbody>
                                        </table>

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
                                        <h4 class="card-title">Edit Information</h4>
                                    </div>
                                </div>


                                <form action="{{route('admin.bookin.update',$checkin->id)}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="pwd1">Expected Check-Out Date <small class="text-danger">*</small></label>
                                                <div class="col-sm-7">
                                                    <input type="date" class="form-control form-control-sm" name="expected_checkout_date" required value="{{$checkin->exp_checkin_date}}" id="pwd1">
                                                    @error('expected_checkout_date')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="time" class="form-control form-control-sm"
                                                    value="{{$checkin->exp_checkin_time}}" name="exp_checkout_time" required id="pwd1">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="pwd1">Guest Name</label>
                                                <span class="text-right pl-2">{{$checkin->guestname}}</span>

                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Coming From:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" name="coming_from" value="{{$checkin->comming_form}}" id="pwd1">
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Purpose Of Visit><small class="text-danger">*</small></label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" name="purpose_of_visit" value="{{$checkin->purpose_of_visit}}" required id="pwd1">
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Thru Agent:</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="thru_agent">
                                                        <option @if($checkin->thru_agent == "agoda") selected @endif value="agoda">Agoda</option>
                                                        <option @if($checkin->thru_agent == "booking.com") selected @endif value="booking.com">Booking.com</option>
                                                        <option @if($checkin->thru_agent == "makemytrip") selected @endif value="makemytrip">Makemytrip</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Own Vehicle</label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                        @if($checkin->own_vehicle== '1') checked @endif name="own_vehicle" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            Yes
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Vehicle Type:</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="vehicle_type">
                                                        <option  @if($checkin->vehicle_type == "auto_ricksaw") selected @endif value="auto_ricksaw">Auto Ricksaw</option>

                                                        <option
                                                        @if($checkin->vehicle_type == "bmw_car") selected @endif value="bmw_car">BMW Car</option>

                                                        <option  @if($checkin->vehicle_type == "bus") selected @endif value="bus">Bus</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-2 align-self-center" for="pwd1">Male</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control form-control-sm" name="male_no" value="{{$checkin->male_no}}">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center" for="pwd1">Female</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control form-control-sm" name="female_no" value="{{$checkin->female_no}}">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center" for="pwd1">Children</label>
                                                <div class="col-sm-2">
                                                    <input type="number" class="form-control form-control-sm" name="children_no" value="{{$checkin->children_no}}">
                                                </div>
                                            </div>
                                        </div>









                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Tariff<small class="text-danger">*</small></label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-sm" name="tariff" value="{{$checkin->tarif}}" required id="pwd1">
                                                    @error('tariff')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                                <label class="control-label col-sm-3 align-self-center" for="email">Non-Taxable</label>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" @if($checkin->non_taxable == '1') checked @endif value="1" name="non_tax" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Post To Room Active</label>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" @if($checkin->is_active == "1") checked @endif value="1" name="post_to_room" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Yes
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Going To:<small class="text-danger">*</small></label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" name="going_to" value="{{$checkin->comming_to}}" required id="pwd1">
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">How did you find us:</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="find_us">
                                                        <option value="auto/texi">Auto/Texi</option>
                                                        <option value="direct">Direct</option>
                                                        <option value="friends">Friends</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Checkout Time</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="checkout_time">
                                                        <option value="1">12 Noon Checkout</option>
                                                        <option value="2">12 Hours Checkout</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Vehicle No</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" 
                                                    value="{{$checkin->vehicle_no}}"
                                                    name="vehicle_no" id="pwd1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="pwd1">No of Person <small class="text-danger">*</small></label>
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control form-control-sm"
                                                    value="{{$checkin->number_of_person}}" name="no_of_person" required id="pwd1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="pwd1">Remarks:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-sm" name="remarks" value="{{$checkin->remarks}}" id="pwd1">
                                                </div>
                                            </div>

                                        </div>




                                    </div>

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


        </div>
    </div>
</div>





@endsection