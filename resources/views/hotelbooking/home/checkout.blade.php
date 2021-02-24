@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
@endphp
<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="checkout_details bg-secondary p-3">
                    <h5 class="text-white">Checkout Details</h5>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Booking No:</th>
                                        <td class="text-center">-125489</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Booking By:</th>
                                        <td class="text-center">Demo User</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Checkin Time/Date:</th>
                                        <td class="text-center">12-12-12 08:50</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Of Pax:</th>
                                        <td class="text-center">1</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Room</th>
                                        <td class="text-center">206</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Room Type</th>
                                        <td class="text-center">Deleux Rooms</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Checkout Date/Time</th>
                                        <td class="text-center">
                                            <input type="tex" value="{{$current}}" class="form-control form-control-sm">
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Grace Time</th>
                                        <td>
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- guest details area start from here -->

        <div class="row">
            <div class="col-sm-12">
                <div class="checkout_details bg-secondary p-3">
                    <h5 class="text-white">Guest Details</h5>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Guest Name:</th>
                                        <td class="text-center">Qayum Hasan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Print Name</th>
                                        <td class="text-center">Qayum Hasan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender:</th>
                                        <td class="text-center">Male</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address:</th>
                                        <td class="text-center">Mirpur,Dhaka</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td class="text-center">dev.qayumhasan@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile</th>
                                        <td class="text-center">01559505992</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Company Name</th>
                                        <td class="text-center">
                                        Durbar-It
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Propose OF Visit:</th>
                                        <td class="text-center"> 
                                        Business
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- guest details area end from here -->


        <!-- service area start from here -->

        <div class="row">
            <div class="col-sm-12">
                <div class="checkout_details bg-secondary p-3">
                    <h5 class="text-white">Services</h5>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Guest Name:</th>
                                        <td class="text-center">Qayum Hasan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Print Name</th>
                                        <td class="text-center">Qayum Hasan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender:</th>
                                        <td class="text-center">Male</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address:</th>
                                        <td class="text-center">Mirpur,Dhaka</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td class="text-center">dev.qayumhasan@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile</th>
                                        <td class="text-center">01559505992</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Company Name</th>
                                        <td class="text-center">
                                        Durbar-It
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Propose OF Visit:</th>
                                        <td class="text-center"> 
                                        Business
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- service area end from here -->

    </div>
</div>

@endsection