@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
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
                        <!-- hidden data -->
                        <input type="hidden" id="room_id" value="{{$checkindata->room_id}}" name="room_id">
                        <!-- hidden data -->
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
                                                    <input type="text" id="checkoutDate" name="checkoutDate" value="{{$current}}" class="form-control form-control-sm datepickernew">
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

 



        <!-- service area start from here -->

        <div class="addcheckout">
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
                                        $origin = new DateTime(Carbon\Carbon::parse("{$checkindata->checkin_date}")->toFormattedDateString());
                                        $target=Carbon\Carbon::parse("{$current}")->toFormattedDateString();
                                        $target = new DateTime($target);

                                        $interval =$origin->diff($target);

                                        $date =abs($interval->format('%R%a'));
                                        $date = $date > 0 ? $date : 1;


                                        $totalamountroom = $date > 0 ?(int)$date * $checkindata->tarif : $checkindata->tarif;

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
                                                <div class="border" <p>{{$row->item_name}} {{$row->qty}} pcs</p>
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
                                            <td class="text-center">
                                                <h6>Room No : {{$checkindata->room_no}}({{$checkindata->roomtype->room_type ?? ''}})</h6><br>

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
                                            <td class="text-center">$ {{ $restaurant}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 p-0">
                                <div class="checkout_details bg-secondary p-3">
                                    <h5 class="text-white">Advance</h5>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-4">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Voucher No</th>
                                            <th scope="col">Voucher Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Mode</th>
                                            <th scope="col">Against</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                        $totaladvance = 0;
                                        @endphp
                                        @if(count($checkindata->vouchers) > 0)
                                        @foreach($checkindata->vouchers as $row)

                                        <tr>
                                            <th scope="row">{{$row->voucher_no}}</th>
                                            <td>{{$row->date}}</td>
                                            <td>Receipt</td>
                                            <td>{{ucfirst($row->debit)}}</td>
                                            <td>Booking</td>
                                            <td class="text-center">$ {{$row->amount}}</td>
                                        </tr>

                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tax Description</th>
                                            <th scope="col">Calculation On</th>
                                            <th scope="col">Base On</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <tbody>
                                        @php
                                        $totaladvance = $totaladvance + $row->amount;
                                        @endphp
                                        @endforeach

                                        @endif
                                        <tr>
                                            <th class="text-right" scope="row" colspan="5">Tax Amount</th>
                                            <th class="text-center">0</th>
                                        </tr>


                                        <tr>
                                            <th class="text-right" scope="row" colspan="5">Net Amount</th>
                                            <th class="text-center">$ {{ (int)$totalamountroom +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant }}</th>
                                        </tr>

                                        <tr>
                                            <th class="text-right" scope="row" colspan="5">Blance Amount</th>
                                            <th class="text-center">$
                                                {{ ((int)$totalamountroom +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant) - $totaladvance }}
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                @php
                                $totalinword = abs(((int)$totalamountroom + (int)$totalamountextra + (int)$totalfandb + (int)$restaurant) - $totaladvance) ;
                                @endphp
                                <h5 class="text-right mr-auto"><strong>In Word:</strong> <code>{{$numToWord->numberTowords($totalinword)}}</code></h5>

                            </div>

                            <button type="submit" class="btn btn-primary mx-auto">Check Out & Generate Invoice</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- service area end from here -->

    </div>
</div>
@endsection