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


    .invoice-card {
        display: flex;
        flex-direction: column;
        position: absolute;
        padding: 10px 2em;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-height: 25em;
        width: 22em;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 10px 30px 5px rgba(0, 0, 0, 0.15);
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
</style>
<div class="content-page">

    <form id="invoice_form">
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
                                                        <input type="text" id="invoice_date" name="checkoutDate" value="{{$current}}" class="form-control form-control-sm datepickernew">
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

                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkout_details bg-secondary p-3">
                                    <h5 class="text-white">Advance</h5>
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
                                            @php
                                            $totaladvance = $totaladvance + $row->amount;
                                            @endphp
                                            @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                </div>



                                @php
                                $totalinword = abs(((int)$totalamountroom + (int)$totalamountextra + (int)$totalfandb + (int)$restaurant) - $totaladvance) ;
                                @endphp


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
                                                <td>{{$row->calculation_on}}</td>
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
                                                <th class="text-right" scope="row" colspan="5">Net Amount</th>
                                                <th class="text-center">$ {{round($checkout->net_amount,2)}}</th>
                                            </tr>

                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Discount Amount</th>
                                                <th class="text-center">$ {{round($checkout->discount_amount,2)}}</th>
                                            </tr>


                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Gross Amount</th>
                                                <th class="text-center">$ {{round($checkout->gross_amount,2)}}</th>
                                            </tr>

                                            @php
                                            $paybleAmount =$checkout->gross_amount - $checkout->voucher_amount;
                                            @endphp
                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">OutStanding Amount</th>
                                                <th class="text-center">$
                                                    {{round($paybleAmount,2)}}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Payable Amount (In Word):</th>
                                                <td class="text-center">

                                                    <code>{{$numToWord->numberTowords($paybleAmount)}}</code>
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
                                            <li class="list-group-item invoice_item">ES List Invoice</li>
                                            <li class="list-group-item invoice_item">Receipt Invoice</li>
                                            <li class="list-group-item invoice_item">Refund Invoice</li>
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
                                                    <input type="checkbox" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Print Invoice With Out Food Bill</label>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Print Invoice With Out Extra Service</label>
                                                </div>
                                            </li>

                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input">
                                                    <label class="form-check-label" for="exampleCheck1">Print Invoice With Out Health Club Bill</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input">
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

                                <button type="submit" class="btn btn-primary mx-auto">Check Out & Generate Invoice</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </form>
</div>




<div class="modal fade" id="foodlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">



        <div class="invoice-card">
            <div class="invoice-title">
                <div id="main-title">
                    <h4>INVOICE</h4>
                    <span>#89 292</span>
                </div>

                <span id="date">16/02/2019</span>
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
                        <tr class="row-data">
                            <td>Espresso <span>(large)</span></td>
                            <td id="unit">1</td>
                            <td>2.90</td>
                        </tr>

                        <tr class="row-data">
                            <td>Cappucino <span>(small)</span></td>
                            <td id="unit">2</td>
                            <td>7.00</td>
                        </tr>

                        <tr class="calc-row">
                            <td colspan="2">Total</td>
                            <td>9.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="invoice-footer">
                <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-outline-primary">Save changes</button>
            </div>
        </div>




    </div>
</div>

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
@endsection