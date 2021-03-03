@extends('hotelbooking.master')
@section('content')

@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
$time = date("h:i");
@endphp
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
                                                    <select class="form-control form-control-sm" id="tax-details" name="tax_details" onchange="getTaxAllData(this)">
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
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="bg-light" scope="col">Tax Name</th>
                                                <th class="bg-light" scope="col">Calculation On</th>
                                                <th class="bg-light" scope="col">Based On</th>
                                                <th class="bg-light" scope="col">Effect</th>
                                                <th class="bg-light" width="15%" scope="col">Rate</th>
                                                <th class="bg-light text-center" width="15%" scope="col">Amount</th>
                                                <th class="bg-light" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                                <td>@mdo</td>
                                            </tr>

                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Net Amount</th>
                                                <th class="text-center">$ {{$checkout->net_amount}}</th>
                                            </tr>


                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">Gross Amount</th>
                                                <th class="text-center">$ {{$checkout->gross_amount}}</th>
                                            </tr>

                                            @php
                                            $paybleAmount =$checkout->gross_amount - $checkout->voucher_amount;
                                            @endphp
                                            <tr>
                                                <th class="text-right" scope="row" colspan="5">OutStanding Amount</th>
                                                <th class="text-center">$
                                                    {{$paybleAmount}}
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
                        <button type="submit" class="btn btn-primary mx-auto">Check Out & Generate Invoice</button>
                    </div>

                </div>
            </div>


        </div>
    </form>
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
        $('#addToGrid').click(function() {
            $('.calculation_on_alt').html('');
            $('.tax_details_alt').html('');
            $('.rate_alt').html('');

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
                    console.log(data);

                    $('#amount').val(data);


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
</script>
@endsection