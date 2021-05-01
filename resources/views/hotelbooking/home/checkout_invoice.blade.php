@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
$time = date("h:i");
@endphp
<style>
    .invoice_item:hover {
        background: gray;
        color: white;
        cursor: pointer;
    }

    .mouse_pointer {
        cursor: pointer;
    }


    .invoice-card {

        padding: 10px 2em;
        background-color: #fff;
        border-radius: 5px;
    }

    .invoice-card>div {
        margin: 5px 0;
    }

    .invoice-title {
        flex: 3;
    }

    .invoice-title #date {
        display: block;
        margin: 8px 0;
        font-size: 12px;
    }

    .invoice-title #main-title {
        display: flex;
        justify-content: space-between;
        margin-top: 2em;
    }

    .invoice-title #main-title h4 {
        letter-spacing: 2.5px;
    }

    .invoice-title span {
        color: rgba(0, 0, 0, 0.4);
    }

    .invoice-details {
        flex: 1;
        border-top: 0.5px dashed grey;
        border-bottom: 0.5px dashed grey;
        display: flex;
        align-items: center;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table thead tr td {
        font-size: 12px;
        letter-spacing: 1px;
        color: grey;
        padding: 8px 0;
    }

    .invoice-table thead tr td:nth-last-child(1),
    .row-data td:nth-last-child(1),
    .calc-row td:nth-last-child(1) {
        text-align: right;
    }

    .invoice-table tbody tr td {
        padding: 8px 0;
        letter-spacing: 0;
    }

    .invoice-table .row-data #unit {
        text-align: center;
    }

    .invoice-table .row-data span {
        font-size: 13px;
        color: rgba(0, 0, 0, 0.6);
    }

    .invoice-footer {
        flex: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .invoice-footer #later {
        margin-right: 5px;
    }

    .btn#later {
        margin-right: 2em;
    }

    .company_info {
        font-size: 10px;
        font-weight: normal;
    }
</style>

<!-- print invoice -->


<div class="modal fade" id="printvoucer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Voucer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="showinvoiceprint">

            </div>
            <div class="modal-footer">
                <div class="invoice-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary saveextraservice">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content-page">

    <form id="invoice_form" action="{{route('admin.checkout.invoice.store')}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="checkout_details bg-secondary p-3">
                        <h5 class="text-white">Invoice Details</h5>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-md-6 p-2">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Invoice No:</th>
                                            <td class="text-center">{{$checkout->invoice_no}}</td>
                                        </tr>
                                        <input type="hidden" name="invoice_no" value="{{$checkout->invoice_no}}" />
                                        <tr>
                                            <th scope="row">Booking By:</th>
                                            <td class="text-center">{{$checkindata->user->username ?? ''}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">Guest Name:</th>
                                            <td class="text-center">{{$checkindata->guest_name}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6 p-2">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Booking No</th>
                                            <td class="text-center">{{$checkindata->booking_no}}</td>
                                        </tr>
                                        <input type="hidden" name="booking_no" value="{{$checkindata->booking_no}}" />
                                        <tr>
                                            <th scope="row">Invoice Date</th>
                                            <td class="text-center">

                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" id="invoice_date" name="invoicedate" value="{{$current}}" class="form-control form-control-sm datepickernew">
                                                    </div>
                                                </div>


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


                                            <tr>
                                                <th scope="row">Room Charge</th>


                                                @php
                                                $totalroomamount = 0;
                                                @endphp

                                                @foreach($roomdata as $row)
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
                                    <h5 class="text-white">Advance & Refund</h5>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Voucher No</th>
                                                <th scope="col">Voucher Date</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Mode</th>
                                                <th scope="col">Against</th>
                                                <th class="text-center" scope="col">Amount</th>
                                                <th class="text-center" scope="col">Action</th>
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
                                                <td></td>
                                                <td>{{ucfirst($row->debit)}}</td>
                                                <td>Booking</td>
                                                <td class="text-center">{!!$currency->symbol ?? ' '!!}
                                                    {{$row->price}}
                                                </td>
                                                </td>


                                                <td class="text-center">
                                                    <a href="{{route('admin.checkout.invoice_print',$row->id)}}" class="badge bg-danger-light mr-2 printvoucher mouse_pointer" data-toggle="tooltip" data-placement="top" data-original-title="Print"> <i class="la la-print"></i></a>
                                                </td>
                                            </tr>
                                            @php
                                            $totaladvance = $totaladvance + $row->amount;
                                            @endphp
                                            @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                </div>






                            </div>


                        </div>

                        <!-- hidden field -->
                        <input type="hidden" name="checkout_id" value="{{$checkout->id}}">
                        <input type="hidden" name="tax_id" value="" id="tax_id">
                        <!-- hidden field -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkout_details bg-secondary p-3">
                                    <h5 class="text-white">Tax Calculation</h5>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
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
                                                <td>
                                                    <select class="form-control form-control-sm" id="tax_details" name="tax_details" onchange="getTaxAllData(this)">
                                                        <option disabled selected>---Select Tax Description---</option>
                                                        @foreach($taxs as $row)
                                                        <option value="{{$row->id}}">{{$row->tax_description}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger tax_details_alt"></span>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm" id="calculation_on" name="calculation_on" onchange="calculateTax()">
                                                        <option disabled="" selected="">---- Select----</option>
                                                        <option value="1">Calculate On Room Amount</option>
                                                        <option value="2">Calculate On Food Amount</option>
                                                        <option value="3">Calculate On Room Discount</option>
                                                        <option value="4">Calculate On Net Amount</option>
                                                        <option value="5">Calculate On Gross Amount</option>

                                                    </select>
                                                    <small class="text-danger calculation_on_alt"> </small>
                                                </td>
                                                <td>
                                                    <select class="form-control form-control-sm base_on" id="base_on" name="base_on" onchange="calculateTax()">
                                                        <option>---- Select----</option>
                                                        <option value="percentage">Percentage</option>
                                                        <option value="amount">Amount</option>
                                                    </select>
                                                    <span class="text-danger base_on_alt"></span>
                                                </td>
                                                <td width="10%">
                                                    <input type="number" onkeyup="calculateTax()" class="form-control form-control-sm" name="rate" id="rate">
                                                    <small class="text-danger rate_alt"></small>
                                                </td>
                                                <td width="10%">
                                                    <input type="number" class="form-control form-control-sm" disabled id="amount">
                                                    <input type="hidden" class="form-control form-control-sm" name="amount" id="amountActual">
                                                </td>
                                                <td width="10%">
                                                    <button type="button" id="addToGrid" class="btn btn-sm btn-primary">Add To Grid</button>
                                                    <button type="button" class="btn btn-sm btn-primary" id="tax_update">Update</button>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <table class="table table-bordered" id="tax_details_amount">
                                        <thead>
                                            <tr>
                                                <th class="bg-light" scope="col">Tax Name</th>
                                                <th class="bg-light" scope="col">Calculation On</th>
                                                <th class="bg-light" scope="col">Based On</th>
                                                <th class="bg-light" scope="col">Effect</th>
                                                <th class="bg-light" width="15%" scope="col">Rate</th>
                                                <th class="bg-light text-center" width="15%" scope="col">Amount</th>
                                                <th class="bg-light text-center" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($tax_details) > 0)
                                            @foreach($tax_details as $row)
                                            <tr class="delelement">

                                                <td>{{$row->tax_description_name}}</td>
                                                @if($row->calculation_on == 1)
                                                <td>Room Amount</td>
                                                @elseif($row->calculation_on == 2)
                                                <td>Food Amount</td>
                                                @elseif($row->calculation_on == 3)
                                                <td>Discount Amount</td>
                                                @elseif($row->calculation_on == 4)
                                                <td>Net Amount</td>
                                                @elseif($row->calculation_on == 5)
                                                <td>Gross Amount</td>
                                                @endif
                                                <td>{{$row->base_on}}</td>
                                                <td>{{$row->effect}}</td>
                                                <td>{{$row->rate}}</td>
                                                <td class="text-center">{{round($row->amount,2)}}</td>
                                                <td class="text-center">
                                                    <a class="badge bg-primary-light tax_edit mr-2" data-toggle="tooltip" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$row}}"><i class="lar la-edit"></i></a>

                                                    <a class="badge bg-danger-light mr-2 deletetax" data-toggle="tooltip" onclick="delete_row(this)" data-placement="top" data-whatever="{{$row->id}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif

                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Total Amount</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->net_amount,2)}}</th>
                                            </tr>

                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Discount Amount</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->discount_amount,2)}}</th>
                                            </tr>


                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Net Amount</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->gross_amount,2)}}</th>
                                            </tr>

                                            @php
                                            $paybleAmount =$checkout->outstanding_amount;
                                            @endphp
                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">{{$paybleAmount < 0 ?'Refund':'Payable'}}</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!}
                                                    {{round($paybleAmount,2)}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">{{$paybleAmount < 0 ?'Refund':'Payable'}} (In Word):</th>
                                                <td class="text-center">

                                                    <code>{{$numToWord->numberTowords(abs($paybleAmount))}}</code>
                                                </td>
                                                <td></td>

                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>



                        </div>

                        <div class="invoice_create card p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice_alt">
                                        <ul class="list-group">
                                            <li class="list-group-item active">Make Invoice</li>
                                            <li class="list-group-item invoice_item" data-toggle="modal" data-target="#foodlist" data-whatever="@getbootstrap">Food List Invoice</li>
                                            <li class="list-group-item invoice_item" data-toggle="modal" data-target="#eslistinvoice">Extra Service List Invoice</li>
                                            <li class="list-group-item invoice_item"><a id="recepipt_invoice" href="{{route('admin.checkout.show.voucher',$checkindata->booking_no)}}">Receipt Invoice</a></li>

                                            <li class="list-group-item invoice_item"> <a id="refund_invoice" href="{{route('admin.checkout.refund.voucher',$checkindata->booking_no)}}">Refund Invoice</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="invoice_alt">
                                        <ul class="list-group">
                                            <li class="list-group-item active">
                                                <div class="form-check">
                                                    <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" name="withoutFoodBill" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Print Invoice With Out Food Bill</label>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" name="withoutExtraService" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Print Invoice With Out Extra Service</label>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" name="withoutHealthClub" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Print Invoice With Out Health Club Bill</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" name="othercurrency" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Want to Print Invoice in other Currency? </label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center p-4">


                                <button type="submit" class="btn btn-primary mx-auto">Checkout & Print</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </form>
</div>



<!-- save and print -->

@if(isset($data['identifier']))

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 printableAreasaveprint">
                        <style>
                            table.items {
                                border: 0.1mm solid #e7e7e7;
                            }

                            td {
                                vertical-align: top;
                            }

                            .items td {
                                border-left: 0.1mm solid #e7e7e7;
                                border-right: 0.1mm solid #e7e7e7;
                            }

                            table thead td {
                                text-align: center;
                                border: 0.1mm solid #e7e7e7;
                            }

                            .items td.blanktotal {
                                background-color: #EEEEEE;
                                border: 0.1mm solid #e7e7e7;
                                background-color: #FFFFFF;
                                border: 0mm none #e7e7e7;
                                border-top: 0.1mm solid #e7e7e7;
                                border-right: 0.1mm solid #e7e7e7;
                            }

                            .items td.totals {
                                text-align: right;
                                border: 0.1mm solid #e7e7e7;
                            }

                            .items td.cost {
                                text-align: "."center;
                            }
                        </style>
                        </head>

                        <body>
                            <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                                <tr>
                                    <td width="100%" style="padding: 0px; text-align: center;">
                                        <a href="#" target="_blank"><img src="{{asset('public/uploads/logo/')}}/{{$logos->logo}}" width="264" height="110" alt="Logo" align="center" border="0"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
                                        Voucher
                                    </td>
                                </tr>
                                <tr>
                                    <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" style="font-family: sans-serif;" cellpadding="10">
                                <tr>


                                    <td width="49%" style="border: 0.1mm solid #eee; text-align: left;"><strong>Guest Name:</strong>{{$checkindata->guest_name}}
                                        <br>

                                        <b>Address: </b> {{$checkindata->address}} , {{$checkindata->city}}
                                        <br>
                                        <b>Phone: </b>{{$checkindata->mobile}}
                                    </td>
                                    <td width="2%">&nbsp;</td>
                                    <td width="49%" style="border: 0.1mm solid #eee;">

                                        <table width="100%" align="left" style="font-family: sans-serif; font-size: 14px;">

                                        </table>
                                        <table width="100%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Invoice No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$checkout->invoice_no}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Booking No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$checkout->booking_no}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Room No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$checkout->prime_room}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Invoice Date Date</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$checkout->invoice_date}}</td>
                                            </tr>


                                        </table>


                                    </td>
                                </tr>
                            </table>
                            <br>
                            <table class="w-100 table-bordered p-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Details</th>
                                        <th width: 10%>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- room area start from here -->
                                    <tr class="text-center">
                                    <th scope="row" class="text-left">Room</th>
                                        @php
                                        $totalroomprice = 0;
                                        @endphp
                                        <th>
                                            @foreach($roomdata as $key=>$row)
                                            Room No: {{$row->room_no}}
                                            <p>{{$row->additional_room_day}} Days @ {{$row->tarif}} ={!!$currency->symbol ?? ' '!!} {{$row->additional_room_amount}}</p>
                                            @php
                                            $totalroomprice = $totalroomprice +$row->additional_room_amount;
                                            @endphp
                                            @endforeach

                                        </th>

                                        <td class="text-center">{!!$currency->symbol ?? ' '!!} {{$totalroomprice}}</td>


                                    </tr>

                                    <!-- room area end from here -->
                                    <tr>
                                        <th scope="row">Extra Service</th>
                                        <td class="text-center">
                                            @php
                                            $totalamountextra = 0;
                                            @endphp

                                            @foreach($checkindata->checkin as $row)
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
                                    <!-- Extra service end from here -->


                                    <!-- Food & Beverage start from here -->
                                    <tr>
                                                <th scope="row">Food(F & B)</th>
                                                <td class="text-center">
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

                                    <!-- Food & Beverage end from here -->

                                    <!-- Restaurant area stat from here -->
                                    @php
                                            $restaurant = 0;
                                            @endphp
                                            <tr>
                                                <th scope="row">Ref. Invoice(Restaurant)</th>
                                                <td class="text-center">
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

                                    <!-- Restaurant area end from here -->

                                    <tr>
                                                <th class="text-right" scope="row" colspan="2">Total Amount</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->net_amount,2)}}</th>
                                            </tr>

                                            <tr>
                                                <th class="text-right" scope="row" colspan="2">Discount Amount</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->discount_amount,2)}}</th>
                                            </tr>


                                            <tr>
                                                <th class="text-right" scope="row" colspan="2">Net Amount</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!} {{round($checkout->gross_amount,2)}}</th>
                                            </tr>

                                            @php
                                            $paybleAmount =$checkout->outstanding_amount;
                                            @endphp
                                            <tr>
                                                <th class="text-right" scope="row" colspan="2">{{$paybleAmount < 0 ?'Refund':'Payable'}}</th>
                                                <th class="text-center">{!!$currency->symbol ?? ' '!!}
                                                    {{round($paybleAmount,2)}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right" scope="row" colspan="2">{{$paybleAmount < 0 ?'Refund':'Payable'}} (In Word):</th>
                                                <td class="text-center">

                                                    <code>{{$numToWord->numberTowords(abs($paybleAmount))}}</code>
                                                </td>

                                            </tr>






                                </tbody>
                            </table>

                            <span>Assign By: {{$checkout->user->username ?? ''}}</span>

                            <br>
                            <table width="100%" style="font-family: sans-serif; font-size: 14px;">
                                <br>
                                <tr>
                                    <td>

                                        <table width="100%" align="left" style="font-family: sans-serif; font-size: 13px; text-align: center;">
                                            <tr>
                                                <td class="text-center" style="padding: 0px; line-height: 20px;">
                                                    <strong>Company Name</strong>
                                                    <br>
                                                    {{$companyinformation->company_name}}
                                                    <br>
                                                    Tel: {{$companyinformation->mobile}} | Email: {{$companyinformation->email}}
                                                    <br>
                                                    Company Registered in {{$companyinformation->address}}. Company Reg. 12121212.
                                                    <br>
                                                    VAT Registration No. 021021021 | ATOL No. 1234
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <br>


                            </table>

                    </div>
                    <br>
                    <button type="button" class="btn btn-primary mx-auto mt-5 savepritbtn">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endif


<!-- food list invoice -->





<div class="modal fade" id="foodlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Food List Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="invoice-card printfood">
                    <style>
                        .invoice_item:hover {
                            background: gray;
                            color: white;
                            cursor: pointer;
                        }


                        .invoice-card {

                            padding: 10px 2em;
                            background-color: #fff;
                            border-radius: 5px;
                        }

                        .invoice-card>div {
                            margin: 5px 0;
                        }

                        .invoice-title {
                            flex: 3;
                        }

                        .invoice-title #date {
                            display: block;
                            margin: 8px 0;
                            font-size: 12px;
                        }

                        .invoice-title #main-title {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 2em;
                        }

                        .invoice-title #main-title h4 {
                            letter-spacing: 2.5px;
                        }

                        .invoice-title span {
                            color: rgba(0, 0, 0, 0.4);
                        }

                        .invoice-details {
                            flex: 1;
                            border-top: 0.5px dashed grey;
                            border-bottom: 0.5px dashed grey;
                            display: flex;
                            align-items: center;
                        }

                        .invoice-table {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        .invoice-table thead tr td {
                            font-size: 12px;
                            letter-spacing: 1px;
                            color: grey;
                            padding: 8px 0;
                        }

                        .invoice-table thead tr td:nth-last-child(1),
                        .row-data td:nth-last-child(1),
                        .calc-row td:nth-last-child(1) {
                            text-align: right;
                        }

                        .invoice-table tbody tr td {
                            padding: 8px 0;
                            letter-spacing: 0;
                        }

                        .invoice-table .row-data #unit {
                            text-align: center;
                        }

                        .invoice-table .row-data span {
                            font-size: 13px;
                            color: rgba(0, 0, 0, 0.6);
                        }

                        .invoice-footer {
                            flex: 1;
                            display: flex;
                            justify-content: flex-end;
                            align-items: center;
                        }

                        .invoice-footer #later {
                            margin-right: 5px;
                        }

                        .btn#later {
                            margin-right: 2em;
                        }

                        .company_info {
                            font-size: 10px;
                            font-weight: normal;
                        }
                    </style>
                    <div class="invoice-title">
                        <div id="main-title">
                            <h4>INVOICE</h4>
                            <span>#{{$checkout->invoice_no}}</span>
                        </div>

                        <span id="date">{{$current}}</span>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <td>PRODUCT</td>
                                    <td>UNIT</td>
                                    <td>PRICE</td>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                $totalfandb = 0;
                                $restaurant = 0;
                                @endphp


                                <tr>
                                    <th>Food(F & B)</th>
                                </tr>

                                @foreach($checkindata->foodandbeverage as $row)
                                <tr class="row-data">
                                    <td>{{$row->item_name}} <span>@ {{$row->rate}} per pcs</span></td>
                                    <td id="unit">{{$row->qty}}</td>
                                    <td>{{$row->qty * $row->rate}}</td>
                                </tr>
                                @php
                                $totalfandb = $totalfandb + $row->amount;
                                @endphp
                                @endforeach

                                <tr>
                                    <th>Restaurant</th>
                                </tr>

                                @foreach($checkindata->restaurant as $row)
                                <tr class="row-data">
                                    <td>{{$row->item->item_name ?? ''}} <span>@ {{$row->rate}} per pcs</span></td>
                                    <td id="unit">{{$row->qty}}</td>
                                    <td>{{$row->qty * $row->rate}}</td>
                                </tr>
                                @php
                                $restaurant = $restaurant + $row->amount;
                                @endphp
                                @endforeach





                                <tr class="calc-row">
                                    <td colspan="2">Total</td>
                                    <td>{!!$currency->symbol ?? ' '!!} {{$totalfandb + $restaurant}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="invoice-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-outline-primary savefood">Print</button>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>


<!-- checkout invoice -->


<!-- es list invoice -->


<div class="modal fade" id="eslistinvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extra Service List Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="invoice-card printextraservice">
                    <style>
                        .invoice_item:hover {
                            background: gray;
                            color: white;
                            cursor: pointer;
                        }


                        .invoice-card {

                            padding: 10px 2em;
                            background-color: #fff;
                            border-radius: 5px;
                        }

                        .invoice-card>div {
                            margin: 5px 0;
                        }

                        .invoice-title {
                            flex: 3;
                        }

                        .invoice-title #date {
                            display: block;
                            margin: 8px 0;
                            font-size: 12px;
                        }

                        .invoice-title #main-title {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 2em;
                        }

                        .invoice-title #main-title h4 {
                            letter-spacing: 2.5px;
                        }

                        .invoice-title span {
                            color: rgba(0, 0, 0, 0.4);
                        }

                        .invoice-details {
                            flex: 1;
                            border-top: 0.5px dashed grey;
                            border-bottom: 0.5px dashed grey;
                            display: flex;
                            align-items: center;
                        }

                        .invoice-table {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        .invoice-table thead tr td {
                            font-size: 12px;
                            letter-spacing: 1px;
                            color: grey;
                            padding: 8px 0;
                        }

                        .invoice-table thead tr td:nth-last-child(1),
                        .row-data td:nth-last-child(1),
                        .calc-row td:nth-last-child(1) {
                            text-align: right;
                        }

                        .invoice-table tbody tr td {
                            padding: 8px 0;
                            letter-spacing: 0;
                        }

                        .invoice-table .row-data #unit {
                            text-align: center;
                        }

                        .invoice-table .row-data span {
                            font-size: 13px;
                            color: rgba(0, 0, 0, 0.6);
                        }

                        .invoice-footer {
                            flex: 1;
                            display: flex;
                            justify-content: flex-end;
                            align-items: center;
                        }

                        .invoice-footer #later {
                            margin-right: 5px;
                        }

                        .btn#later {
                            margin-right: 2em;
                        }

                        .company_info {
                            font-size: 10px;
                            font-weight: normal;
                        }
                    </style>
                    <div class="invoice-title">
                        <div id="main-title">
                            <h4>INVOICE</h4>
                            <span>#{{$checkout->invoice_no}}</span>
                        </div>

                        <span id="date">{{$current}}</span>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <td>PRODUCT</td>
                                    <td>UNIT</td>
                                    <td>PRICE</td>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                $totalamountextra = 0;
                                @endphp


                                @foreach($checkindata->checkin as $row)
                                <tr class="row-data">
                                    <td>{{$row->item_name}} <span>@ {{$row->rate}} per pcs</span></td>
                                    <td id="unit">{{$row->qty}}</td>
                                    <td>{{$row->qty * $row->rate}}</td>
                                </tr>
                                @php
                                $totalamountextra = $totalamountextra + $row->amount;
                                @endphp
                                @endforeach

                                <tr class="calc-row">
                                    <td colspan="2">Total</td>
                                    <td>{!!$currency->symbol ?? ' '!!} {{ $totalamountextra}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>






                </div>
            </div>
            <div class="modal-footer">
                <div class="invoice-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary saveextraservice">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- es list invoice -->

<!-- voucher area start -->

<div class="modal fade" id="voucher_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vouchername">Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="voucerareastart">

            </div>
        </div>
    </div>
    <!-- voucher area end -->


    <!-- print voucher -->












    @if(isset($data['identifier']))
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });
    </script>
    @endif


    <script>
        function calculateTax() {
            var element = $('#invoice_form').serializeArray();
            $('.calculation_on_alt').html('');
            $('.tax_details_alt').html('');
            $('.rate_alt').html('');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('admin.checkout.invoice.get.tax.amount')}}",
                data: element,
                success: function(data) {
                    console.log(data);

                    $('#amount').val(data);
                    $('#amountActual').val(data);


                },
                error: function(err) {
                    if (err.responseJSON.errors.calculation_on) {
                        $('.calculation_on_alt').html(err.responseJSON.errors.calculation_on[0]);
                    }
                    if (err.responseJSON.errors.tax_details) {
                        $('.tax_details_alt').html(err.responseJSON.errors.tax_details[0]);
                    }
                    if (err.responseJSON.errors.rate) {
                        $('.rate_alt').html(err.responseJSON.errors.rate[0]);
                    }
                }
            });
        }

        function getCalculateData(el) {

            var element = $('#invoice_form').serializeArray();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{route('admin.checkout.invoice.get.tax.data')}}",
                data: element,
                success: function(data) {
                    console.log(data);
                    $('#base_on').val(data.base_on).selected;
                    if (data.base_on == 'percentage') {
                        $('#rate').val(data.rate);
                    } else {
                        $('#rate').val(data.amount);
                    }

                }
            });
        }

        function getTaxAllData(el) {
            getCalculateData(el);

            calculateTax();

        }


        $(document).ready(function() {
            $('#tax_update').hide();
            $('#addToGrid').click(function() {
                $('.calculation_on_alt').html('');
                $('.tax_details_alt').html('');
                $('.rate_alt').html('');
                $('#tax_details_amount').empty();

                var element = $('#invoice_form').serializeArray();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.checkout.invoice.get.gross.amount')}}",
                    data: element,
                    success: function(data) {


                        $('#tax_details_amount').append(data);

                        $('#tax_id').val(0);
                        $('#tax_details').val(0);
                        $('#calculation_on').val(0);
                        $('#base_on').val(0);
                        $('#rate').val(0);
                        $('#amountActual').val(0);
                        $('#amount').val(0);


                    },
                    error: function(err) {
                        if (err.responseJSON.errors.calculation_on) {
                            $('.calculation_on_alt').html(err.responseJSON.errors.calculation_on[0]);
                        }
                        if (err.responseJSON.errors.tax_details) {
                            $('.tax_details_alt').html(err.responseJSON.errors.tax_details[0]);
                        }
                        if (err.responseJSON.errors.rate) {
                            $('.rate_alt').html(err.responseJSON.errors.rate[0]);
                        }
                    }
                });

            });
        })



        $(document).ready(function() {
            $('.tax_edit').click(function(e) {
                $('#tax_update').show();
                $('#addToGrid').hide();
                var modal = $(this);
                var data = modal.data('whatever');

                $('#tax_id').val(data.id);
                $('#tax_details').val(data.tax_description_id).selected;
                $('#calculation_on').val(data.calculation_on).selected;
                $('#base_on').val(data.base_on).selected;
                $('#rate').val(data.rate);
                $('#amountActual').val(data.amount);
                $('#amount').val(data.amount);
            });
        })

        $(document).ready(function() {
            $('#tax_update').click(function() {





                var element = $('#invoice_form').serializeArray();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.checkout.invoice.tax.data.edit')}}",
                    data: element,
                    success: function(data) {


                        $('#addToGrid').show();
                        $('#tax_update').hide();
                        $('#tax_details_amount').empty();
                        $('#tax_details_amount').append(data);



                        $('#tax_id').val(0);
                        $('#tax_details').val(0);
                        $('#calculation_on').val(0);
                        $('#base_on').val(0);
                        $('#rate').val(0);
                        $('#amountActual').val(0);
                        $('#amount').val(0);

                    },
                    error: function(err) {
                        if (err.responseJSON.errors.calculation_on) {
                            $('.calculation_on_alt').html(err.responseJSON.errors.calculation_on[0]);
                        }
                        if (err.responseJSON.errors.tax_details) {
                            $('.tax_details_alt').html(err.responseJSON.errors.tax_details[0]);
                        }
                        if (err.responseJSON.errors.rate) {
                            $('.rate_alt').html(err.responseJSON.errors.rate[0]);
                        }
                    }
                });
            })
        });

        function delete_row(em) {
            $('#tax_update').hide();
            $('#addToGrid').show();
            $(em).closest('.delelement').remove();
            var modal = $(em);
            var data = modal.data('whatever');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'get',
                url: "{{url('admin/checkout/invoice/tax/data/delete')}}/" + data,
                success: function(data) {

                    $('#tax_details_amount').empty();
                    $('#tax_details_amount').append(data);


                }
            });



        }
    </script>


    <script>
        $(document).ready(function() {
            $(".savefood").on('click', function() {

                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printfood").printArea(options);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".saveextraservice").on('click', function() {

                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printextraservice").printArea(options);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#recepipt_invoice').click(function(e) {
                e.preventDefault();
                var url = e.currentTarget.href;

                $('#vouchername').html('Payment Voucher');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {

                        $('#voucerareastart').empty();
                        $('#voucerareastart').append(data);
                        $('#voucher_area').modal('show');
                    }
                });
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#refund_invoice').click(function(e) {
                e.preventDefault();
                var url = e.currentTarget.href;
                $('#vouchername').html('Refund Voucher');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {

                        $('#voucerareastart').empty();
                        $('#voucerareastart').append(data);
                        $('#voucher_area').modal('show');
                    }
                });
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#refund_invoice').click(function(e) {
                e.preventDefault();
                var url = e.currentTarget.href;
                $('#vouchername').html('Refund Voucher');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {

                        $('#voucerareastart').empty();
                        $('#voucerareastart').append(data);
                        $('#voucher_area').modal('show');
                    }
                });
            });
        })
    </script>


    <!-- Edit Invoice -->
    <script>
        $(document).ready(function() {
            $('.editinvoice').click(function(e) {
                e.preventDefault();
                var url = e.currentTarget.href;
                $('#vouchername').html('Edit Voucher');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $('#voucerareastart').empty();
                        $('#voucerareastart').append(data);
                        $('#voucher_area').modal('show');
                    }
                });
            });
        })
    </script>

    <!-- print Invoice -->
    <script>
        $(document).ready(function() {
            $('.printvoucher').click(function(e) {
                e.preventDefault();

                var url = e.currentTarget.href;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $('#showinvoiceprint').empty();
                        $('#showinvoiceprint').append(data);
                        $('#printvoucer').modal('show');
                    }
                });
            });
        })
    </script>
    @endsection