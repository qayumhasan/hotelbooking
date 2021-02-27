@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
$time = date("h:i");
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
                                        <td class="text-center">- {{$checkindata->booking_no}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Booking By:</th>
                                        <td class="text-center">{{$checkindata->user->username ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Checkin Time/Date:</th>
                                        <td class="text-center">{{$checkindata->checkin_date}} {{$checkindata->checkin_time}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">No Of Pax:</th>
                                        <td class="text-center"> {{$checkindata->number_of_person}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Room</th>
                                        <td class="text-center">{{$checkindata->room_no}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Room Type</th>
                                        <td class="text-center">{{$checkindata->roomtype->room_type ?? ''}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Checkout Date/Time</th>
                                        <td class="text-center">

                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" value="{{$current}}" class="form-control form-control-sm datepicker">
                                                </div>
                                                <div class="col">
                                                    <input type="time" value="{{$time}}" class="form-control form-control-sm col">
                                                </div>
                                            </div>


                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Grace Time</th>
                                        <td>
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                                <option value="12">12 Hours</option>
                                                <option value="5">5 Hours</option>
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
                                        <td class="text-center">{{$checkindata->guest_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Print Name</th>
                                        <td class="text-center">{{$checkindata->print_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender:</th>
                                        <td class="text-center">{{$checkindata->gender}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address:</th>
                                        <td class="text-center">{{$checkindata->address}},{{$checkindata->city}}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td class="text-center">{{$checkindata->email}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile</th>
                                        <td class="text-center">{{$checkindata->mobile}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Company Name</th>
                                        <td class="text-center">
                                        {{$checkindata->company_name}}
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Propose OF Visit:</th>
                                        <td class="text-center">
                                        {{$checkindata->purpose_of_visit}}
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
                        <div class="col-md-12 p-2">
                            <table class="table table-bordered">
                                <tbody>
                                @php
                                $origin = new DateTime($checkindata->checkin_date);
                                $target = strtotime($current);
                                $target = new DateTime($target);

                                $interval = $origin->diff($target);

                                $date =$interval->format('%R%a');

                                $totalamountroom = (int)$date * $checkindata->tarif;


                                @endphp

                                    <tr>
                                        <th scope="row">Room Charge</th>
                                        
                                        <td class="text-center">
                                            <h6>Room No : {{$checkindata->room_no}}</h6><br>

                                            <span>{{$origin->format('d F Y')}} - {{date('d F Y')}} = {{(int)$date}} days</span><br>

                                            <p>Tariff@ {{(int)$checkindata->tarif}}/= Per Day</p><br>
                                        </td>
                                        <td class="text-center">$ {{ $totalamountroom}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Extra Service</th>
                                        <td class="text-center">
                                        <h6>Room No : {{$checkindata->room_no}}({{$checkindata->roomtype->room_type ?? ''}})</h6><br>

                                            @php
                                                $totalamountextra = 0;
                                            @endphp

                                            @foreach($checkindata->checkin as $row)
                                                <div class="border"
                                                <p>{{$row->item_name}} {{$row->qty}} pcs</p>
                                                <p>Rate @ {{$row->rate}} /= per pcs </p>
                                                <p>Total :$ {{$row->qty * $row->rate}}</p>
                                                </div>

                                                @php
                                                    $totalamountextra = $totalamountextra + $row->amount;
                                                @endphp
                                            @endforeach 
                                        </td>
                                        <td class="text-center">$ {{$totalamountextra}}</td>
                                    </tr>

                                    @php
                                        $totalfandb = 0;
                                    @endphp

                                    <tr>
                                        <th scope="row">Food(F & B)</th>
                                        <td class="text-center"><h6>Room No : {{$checkindata->room_no}}({{$checkindata->roomtype->room_type ?? ''}})</h6><br>

                                        @foreach($checkindata->foodandbeverage as $row)
                                        <div class="border">
                                            <p>{{$row->item_name}} {{$row->qty}} pcs</p>
                                            <p>Rate @ {{$row->rate}} per pcs</p>
                                        </div>

                                        @php
                                        $totalfandb = $totalfandb + $row->amount;
                                        @endphp


                                        @endforeach


                                        </td>
                                        <td class="text-center">$ {{$totalfandb}}</td>
                                    </tr>
                                    @php
                                        $restaurant = 0;
                                    @endphp
                                    <tr>
                                        <th scope="row">Ref. Invoice(Restaurant)</th>
                                        <td class="text-center">
                                        <h6>Room No : {{$checkindata->room_no}}({{$checkindata->roomtype->room_type ?? ''}})</h6><br>
                                            @foreach($checkindata->restaurant as $row)
                                            <p>{{$row->item->item_name ?? ''}} {{$row->qty}} pcs</p> 
                                            <p>Rate @ {{$row->rate}} per pcs</p>

                                            @php
                                                $restaurant = $restaurant + $row->amount;

                                            @endphp

                                            @endforeach
                                        </td>
                                        <td class="text-center">$ {{   $restaurant}}</td>
                                    </tr>

                                    <tr>
                                        <th class="text-right" scope="row" colspan="2">Tax Amount</th>
                                        <th class="text-center">0</th>
                                    </tr>


                                    <tr>
                                        <th class="text-right" scope="row" colspan="2">Net Amount</th>
                                        <th class="text-center">$ {{ (int)$totalamountroom +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant }}</th>
                                    </tr>

                                    <tr>
                                        <th class="text-right" scope="row" colspan="2">Blance Amount</th>
                                        <th class="text-center">$
                                        {{ (int)$totalamountroom +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant }}
                                        </th>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary mx-auto">Check Out & Generate Invoice</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- service area end from here -->

    </div>
</div>

@endsection