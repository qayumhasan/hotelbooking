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
                                    <td class="text-center">
                                <tr class="text-center">

                                    @php

                                    $gettarrif = $roomTarrif->getTotalTarrif($row->tarif, $row->booking_no, $row->checkin_date,$row->add_room_checkout_date, $row->room_no);

                                    $totalroomamount = $totalroomamount + $row->additional_room_amount;
                                    @endphp

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
                                    $gettarrif = $roomTarrif->getTotalTarrif($row->tarif, $row->booking_no, $row->checkin_date,{{$current}}, $row->room_no);
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