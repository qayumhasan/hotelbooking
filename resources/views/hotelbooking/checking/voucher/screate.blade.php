@extends('hotelbooking.master')
@section('title', 'Voucher | '.$seo->meta_title)

@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
$bookingno = rand(11111,99999);
$time = date("h:i");
@endphp

@section('content')


<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Voucher</h4>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('admin.checkin.voucher.submit',$booking_no)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-lg-12">

                    <div class="card">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="modal-footer">

                                    <input type="hidden" value="{{$voucher_no}}" name="voucher_no" />
                                    <span class="btn btn-secondary mr-auto">Voucher No: {{$voucher_no}}</span>

                                    <button type="button" class="btn btn-primary">
                                        <input type="text" class="form-control datepicker" name="date" value="{{$current}}" />
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="bg-light">
                                    <div class="row p-4">
                                        <div class="col-sm-1">
                                            <span>Dr/Cr:</span>
                                        </div>
                                        <div class="col-sm-2">
                                            <span>Particulars:</span>
                                        </div>
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-3 text-center">
                                            Debit(KHS)
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            Credit(KHS)
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row p-4">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                                <option>Cr.</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                                <option>Dr.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">

                                            <select name="credit" class="form-control form-control-sm" id="exampleFormControlSelect1">
                                                <option>{{$guestname->guest_name}}</option>
                                            </select>
                                        </div>
                                        <br>

                                        <div class="form-group">

                                            <select name="debit" class="form-control form-control-sm" id="exampleFormControlSelect1">
                                                <option value="bank">Bank</option>
                                                <option value="cash">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row p-4">
                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <input type="text" disabled class="form-control form-control-sm" id="exampleFormControlInput1">
                                        </div>
                                        <br>
                                        <div class="form-group">

                                            <input type="number" disabled class="form-control form-control-sm" id="showdrvalue">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">

                                            <input type="number" name="amount" required onkeyup="getDebetValue(this)" class="form-control form-control-sm" id="exampleFormControlInput1">
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="text" disabled class="form-control form-control-sm" id="exampleFormControlInput1">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row p-4">
                            <div class="col-sm-8">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Narration :</label>
                                    <div class="col-sm-10">
                                        <input name="remarks" type="text" class="form-control form-control-sm" id="staticEmail">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row p-4">
                        <div class="col-sm-8">
                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary mx-auto">Submit & Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@if(isset($voucher))
<div class="modal fade" id="amountmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Voucher</h5>
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


                                    <td width="49%" style="border: 0.1mm solid #eee; text-align: left;"><strong>Guest Name:</strong> {{$guestname->guest_name}}
                                        <br>

                                        <b>Address: </b> {{$guestname->address}} , {{$guestname->city}}
                                        <br>
                                        <b>Phone: </b> {{$guestname->mobile}}
                                    </td>
                                    <td width="2%">&nbsp;</td>
                                    <td width="49%" style="border: 0.1mm solid #eee;">

                                        <table width="100%" align="left" style="font-family: sans-serif; font-size: 14px;">

                                        </table>
                                        <table width="100%" align="right" style="font-family: sans-serif; font-size: 14px;">
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Voucher No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$voucher->voucher_no}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Booking No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$voucher->booking_no}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Room No:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$guestname->room_no}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Voucher Date</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$voucher->date}}</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Payment Method:</strong></td>
                                                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{ucfirst($voucher->debit)}}</td>
                                            </tr>

                                        </table>


                                    </td>
                                </tr>
                            </table>
                            <br>
                            <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
                                <thead>
                                    <tr>
                                        <td width="15%" style="text-align: left;"><strong>Date</strong></td>
                                        <td width="45%" style="text-align: left;"><strong>Remarks</strong></td>
                                        <td width="20%" style="text-align: left;"><strong>Amount</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalamount = 0;
                                @endphp
                                    <!-- ITEMS HERE -->
                                @foreach($voucherdetails as $row)
                                    <tr>
                                        <td style="padding: 5px 7px;border: 1px #eee solid; line-height: 20px;">{{$row->date}}</td>
                                        <td style="padding: 5px 7px;border: 1px #eee solid; line-height: 20px;">{{$row->remarks}}</td>
                                        <td style="padding: 5px 7px;border: 1px #eee solid; line-height: 20px;">$ {{$row->amount}}</td>

                                        @php
                                            $totalamount = $totalamount + $row->amount;
                                        @endphp
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="2" class="text-right" style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Total Amount</strong></td>
                                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">$ {{$totalamount}}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-right"><strong>In Word:</strong></td>
                                        <td>{{$numToWord->numberTowords($totalamount)}}</td>
                                        
                                    </tr>
                                </tfoot>
                            </table>

                            <span>Assign By:{{$guestname->user->username ?? ''}}</span>

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
                    <button type="button" class="btn btn-primary mx-auto mt-5 savepritbtn" >Print</button>
                </div>
            </div>
        </div>
    </div>
    @endif



    <script>
        function getDebetValue(e) {
            $('#showdrvalue').val(e.value);
        }
    </script>
    @if(isset($voucher))
    <script>
        $(document).ready(function() {
            $('#amountmodal').modal('show');
        })
    </script>
    @endif
    @endsection