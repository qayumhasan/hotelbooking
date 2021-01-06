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
                                            <a class="buttoncss add" href="#"><i class="fas fa-edit"></i> Edit Service</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-times" aria-hidden="true"></i> Delete Service</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class=" d-block">
                                            <a class="buttoncss add" href="#"><i class="fa fa-star" aria-hidden="true"></i> view Service</a>
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
                                            <a class="buttoncss add" href="#"><i class="fa fa-plus" aria-hidden="true"></i> Change Room</a>
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
                            <th scope="row">Booking No.</th>
                            <td>- {{$checkin->booking_no}}</td>
                            <th scope="row">Room No.</th>
                            <td>{{$checkin->room_no}}({{$checkin->room_type}})</td>
                        </tr>
                        <tr>
                            <th scope="row">Checkin Date/Time</th>
                            <td>{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th scope="row">Guest Name</th>
                            <td>{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <table>
                    <tr class="heading_area">
                        <th>HouseKepping Services:</th>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-7">
                        <form>

                            <div class="row mt-2">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="controll-from" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class=" row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="controll-from" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
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


@endsection