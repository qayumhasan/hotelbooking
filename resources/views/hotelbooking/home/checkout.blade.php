@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
$time = date("h:i");
@endphp
<div class="content-page">

    <form action="{{route('admin.checkout.store')}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="checkout_details bg-secondary p-3">
                        <h5 class="text-white">Checkout Details </h5>
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
                                            <td class="text-center">{{$checkindata->room_no}} </td>
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
                                                        <input type="time" name="checkout_time" value="{{$time}}" class="form-control form-control-sm col">
                                                    </div>
                                                </div>


                                            </td>

                                        </tr>
                                        <tr>
                                            <th>Grace Time</th>
                                            <td>
                                                <select name="grace_time" class="form-control form-control-sm" id="exampleFormControlSelect1">
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
                                            <td class="text-center">{{$checkindata->genderdata}}</td>
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

            <div class="row" id="preloader">
                <div class="col">
                    <div class="preloader">
                        <img src="{{asset('public/uploads/preloader/preloader.gif')}}" alt="" class="w-100" />
                    </div>
                </div>
            </div>


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


                                            <tr>
                                                <th scope="row">Room Charge</th>


                                                @php
                                                $totalroomamount = 0;
                                                @endphp

                                                @foreach($addi_checkins as $row)
                                                @if(!$loop->first)
                                                <td></td>
                                                @endif




                                                <!-- if room alreay checkout -->
                                                @if($row->is_occupy == 0)


                                                @php

                                                $gettarrif = $roomTarrif->getTotalTarrif($row->tarif, $row->booking_no, $row->checkin_date,$row->add_room_checkout_date, $row->room_no);

                                                $totalroomamount = $totalroomamount + $row->additional_room_amount;
                                                @endphp


                                                <td class="text-center">
                                            <tr class="text-center">

                                                @if(!$loop->first)
                                                <td></td>
                                                @endif
                                                <td width="25%">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="room_no">
                                                                <h6>Room No : {{$row->room_no}}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="room_details">

                                                                <ul class="list-group">
                                                                    @foreach($gettarrif['date_show'] as $item)
                                                                    @php

                                                                    $startdate = strtotime($item['start_date']);
                                                                    $startdate = date('d F Y', $startdate);

                                                                    $end_date = strtotime($item['end_date']);
                                                                    $end_date = date('d F Y', $end_date);

                                                                    @endphp
                                                                    <li class="list-group-item mt-1">{{$startdate}} <b>To</b> {{$end_date}} @ {{$item['day']}} ✖ {!!$currency->symbol ?? ' '!!} {{$item['tarrif']}}</li>
                                                                    @endforeach
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$gettarrif['total_tarrif']}}</td>
                                                </td>
                                                @endif
                                                <!-- if room alreay checkout -->




                                                <!-- if room alreay not checkout -->
                                                @if($row->is_occupy == 1)

                                                @php
                                                $date = 0;

                                                @endphp
                                                @php
                                                $gettarrif = $roomTarrif->getTotalTarrif($row->tarif, $row->booking_no, $row->checkin_date,date('Y-m-d'), $row->room_no);
                                                @endphp

                                                <td class="text-center" width="45%">


                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="room_no">
                                                                <h6>Room No : {{$row->room_no}}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="room_details">

                                                                <ul class="list-group">
                                                                    @foreach($gettarrif['date_show'] as $item)
                                                                    @php

                                                                    $startdate = strtotime($item['start_date']);
                                                                    $startdate = date('d F Y', $startdate);

                                                                    $end_date = strtotime($item['end_date']);
                                                                    $end_date = date('d F Y', $end_date);

                                                                    $date += $item['day'];

                                                                    @endphp
                                                                    <li class="list-group-item mt-1">{{$startdate}} <b>To</b> {{$end_date}} @ {{$item['day']}} ✖ {!!$currency->symbol ?? ' '!!} {{$item['tarrif']}}</li>
                                                                    @endforeach
                                                                </ul>


                                                                <input type="hidden" name="non_checkout_room[]" value="{{$row->room_id}}" />

                                                                <input type="hidden" name="non_checkout_room_day" value="{{(int)$date}} " />


                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>




                                                <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$gettarrif['total_tarrif']}} </td>
                                                @php
                                                $totalroomamount = $totalroomamount + $gettarrif['total_tarrif'];
                                                @endphp


                                                @endif
                                                <!-- if room alreay not checkout -->



                                                </td>
                                            </tr>
                                            </td>
                                            @endforeach





                                            </tr>

                                            @php
                                            $totalamountextra = 0;
                                            @endphp

                                            @if(count($checkindata->checkin) > 0)
                                            <tr>
                                                <th scope="row">Extra Service</th>
                                                <td class="text-center">



                                                    @foreach($checkindata->checkin as $row)
                                                    <h6>Room No : {{$row->room_no}}</h6><br>
                                                    <div class="border" <p>{{$row->item_name}} {{$row->qty}} pcs</p>
                                                        <p>Rate @ {{$row->rate}} /= per pcs </p>
                                                        <p>Total :{!!$currency->symbol ?? ' '!!} {{$row->qty * $row->rate}}</p>
                                                    </div>

                                                    @php
                                                    $totalamountextra = $totalamountextra + $row->amount;
                                                    @endphp
                                                    @endforeach
                                                </td>
                                                <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$totalamountextra}}</td>
                                            </tr>

                                            @endif

                                            @php
                                            $totalfandb = 0;
                                            @endphp

                                            @if(count($checkindata->foodandbeverage))

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
                                                <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$totalfandb}}</td>
                                            </tr>
                                            @endif
                                            @php
                                            $restaurant = 0;
                                            @endphp

                                            @if(count($checkindata->restaurant) > 0)
                                            <tr>
                                                <th scope="row">Ref. Invoice(Restaurant)</th>
                                                <td class="text-center">
                                                    <h6>Room No : {{$checkindata->room_no}}({{$checkindata->roomtype->room_type ?? ''}})</h6><br>
                                                    @foreach($checkindata->restaurant as $row)
                                                    <p>{{$row->item->item_name ?? ''}} {{$row->qty}} pcs</p>
                                                    <p>Rate @ {{$row->rate}} per pcs</p>

                                                    @php
                                                    $head = App\Models\Restaurant_Order_head::where('invoice_no',$row->invoice_id)->first();
                                                    $restaurant = $restaurant + $head->gross_amount;

                                                    @endphp

                                                    @endforeach
                                                </td>
                                                <td class="text-center">{!!$currency->symbol ?? ' '!!} {{ $restaurant}}</td>
                                            </tr>
                                            @endif



                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
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
                                            <th class="text-center" scope="col">Amount</th>
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
                                            <td class="text-center">{!!$currency->symbol ?? ' '!!}
                                                {{$row->price}}
                                            </td>


                                        </tr>

                                        @php



                                        $totaladvance = $totaladvance + $row->price;




                                        @endphp
                                        @endforeach

                                        @endif
                                        <!-- <tr>
                                            <th class="text-right" scope="row" colspan="5">Tax Amount</th>
                                            <th class="text-center">0</th>
                                        </tr> -->


                                        <tr>
                                            <th class="text-right" scope="row" colspan="5">Net Amount</th>
                                            <th class="text-center">{!!$currency->symbol ?? ' '!!} {{ (int)$totalroomamount +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant }}</th>
                                        </tr>
                                        @php
                                        $totalamount = ((int)$totalroomamount + (int)$totalamountextra + (int)$totalfandb + (int)$restaurant) - $totaladvance;
                                        @endphp


                                        <tr>

                                            <th class="text-right" scope="row" colspan="5">Blance Amount
                                                {{$totalamount < 0 ?'(Refund)':'(Payable)'}}
                                            </th>
                                            <th class="text-center">{!!$currency->symbol ?? ' '!!}
                                                {{ ((int)$totalroomamount +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant) - $totaladvance }}
                                            </th>
                                        </tr>

                                        @php
                                        $totalinword = abs(((int)$totalroomamount + (int)$totalamountextra + (int)$totalfandb + (int)$restaurant) - $totaladvance) ;

                                        $totalamount = abs(((int)$totalroomamount + (int)$totalamountextra + (int)$totalfandb + (int)$restaurant)) ;
                                        @endphp



                                    </tbody>
                                </table>


                                <!-- hidden data -->
                                <input type="hidden" id="room_id" value="{{$checkindata->room_id}}" name="room_id">
                                <input type="hidden" value="{{$checkindata->booking_no}}" name="booking_no">
                                <input type="hidden" value="{{(int)$totalroomamount}}" name="room_total_amount">
                                <input type="hidden" value="{{(int)$totalamountextra}}" name="extra_service">
                                <input type="hidden" value="{{(int)$totalfandb}}" name="fb_bservice">
                                <input type="hidden" value="{{(int)$restaurant}}" name="restaurant">
                                <input type="hidden" value="{{(int)$totaladvance}}" name="advance_amount">

                                <input type="hidden" value="{{(int)$totalamount}}" name="net_amount">
                                <input type="hidden" value="{{ ((int)$totalroomamount +  (int)$totalamountextra +  (int)$totalfandb + (int)$restaurant) - $totaladvance }}" name="outstanding_amount">
                                <!-- hidden data -->



                                <h5 class="text-right mr-auto"><strong>In Word{{$totalamount < 0 ?'(Refund)':'(Payable)'}}:</strong> <code>{{$numToWord->numberTowords($totalinword)}}</code></h5>

                            </div>


                            <button type="submit" class="btn btn-primary mx-auto">Generate Invoice</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- service area end from here -->

</div>
</form>
</div>

<script>
    $(document).ready(function() {
        $('#preloader').hide();
        $('#checkoutDate').change(function(e) {
            var date = e.target.value;
            var room_id = $('#room_id').val();
            $('.addcheckout').empty();
            $('#preloader').show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('admin.checkout.get.data') }}",
                data: {
                    date: date,
                    room_id: room_id,
                },
                success: function(data) {
                    $('#preloader').hide();
                    $('.addcheckout').append(data);
                }
            });

        });
    });
</script>



@endsection