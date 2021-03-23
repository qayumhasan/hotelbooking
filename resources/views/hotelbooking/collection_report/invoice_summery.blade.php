@extends('hotelbooking.master')
@section('title', 'Invoice Summery | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("d/m/Y");
$time = date("h:i");
@endphp


<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">

                <div class="card p-4">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Guest Payment History</h4>
                        </div>
                    </div>

                    <form id="clean_duration_search">
                        <div class="form-group row mt-4">

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Guest:</b></label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" name="guest_name" id="guest_name select_room_no">
                                    <option disabled selected>---- Select A Guest Name ----</option>
                                    @foreach($guests as $row)
                                    <option value="{{$row->guest_name}}">{{$row->guest_name}}</option>
                                    @endforeach

                                </select>
                                <small class="text-danger from_date"></small>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="row invoice_summery_ajax">
            <div class="col-sm-12 printableAreasaveprint">
                @if(count($bookinghistory) > 0)
                @foreach($bookinghistory as $data)
                <div class="card">

                    @php
                    $receive = 0;
                    $refund = 0;

                    if(count($data->voucherData) >0){

                    foreach($data->voucherData as $row){
                    if($row->type ==1){
                    $receive = $receive + $row->amount;

                    }elseif($row->type ==0){

                    $refund = $refund + $row->amount;

                    }
                    }
                    }
                    @endphp







                    <div class="card-body ">
                        <div class="table-responsive guest_ajax_data">


                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Outstanding</th>
                                        <th scope="col">Tax Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>


                                        <td>{{$data->checkin->guest_name ?? ''}}</td>
                                        <td>{{$data->invoice_no}}</td>
                                        <td>{{$data->invoice_date}}</td>
                                        @php
                                        $outstanding = ($data->gross_amount - $refund) + $receive;
                                        @endphp
                                        <td>{{$outstanding}}</td>
                                        <!-- tax area start -->
                                        <td rowspan="5">
                                            @if(count($data->taxdetails) > 0)
                                            @foreach($data->taxdetails as $row)
                                            <div class="row">
                                                <div class="col">
                                                    <span>{{$row->taxDescription}} On {{$row->baseonamount}} :</span>
                                                </div>
                                                <div class="col">
                                                    $ {{$row->amount}}
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row">
                                                <div class="col text-center"><strong>No Tax Amount Found!</strong></div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="thead-light">
                                        <th scope="col">Room No</th>
                                        <th scope="col">CheckIn Date</th>
                                        <th scope="col">Checkout Date</th>
                                        <th scope="col">No Of Night</th>
                                    </tr>
                                    @php
                                    $booking_type = 0;
                                    @endphp
                                    @if(count($data->checkindata) > 0)
                                    @foreach($data->checkindata as $row)
                                    <tr>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->checkin_date}}</td>
                                        <td>{{$data->checkout_date}}</td>
                                        <td>{{$row->additional_room_day}}</td>

                                    </tr>
                                    @php
                                    $booking_type .= $row->booking_type;
                                    @endphp
                                    @endforeach
                                    @else
                                    <tr>
                                        <th class="text-center" colspan="4">No Data Found!</th>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th scope="col">Booking Type</th>
                                        <th scope="col">Room Amount</th>
                                        <th scope="col">Food Amount</th>
                                        <th scope="col">Ep/Laundry Amount</th>
                                    </tr>

                                    <tr>

                                        <td>{{$booking_type}}</td>
                                        <td>{{round($data->room_amount,2)}}</td>
                                        <td>{{round($data->fb_amount,2)}}</td>
                                        <td>{{round($data->extra_service_amount,2)}}</td>

                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <thead class="bg-success">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Voucher Type</th>
                                        <th scope="col">Payment Mode</th>
                                        <th scope="col">Voucher No</th>
                                        <th scope="col">Debit</th>
                                        <th scope="col">Credit</th>
                                        <th scope="col">Against</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data->voucherData) > 0)
                                    @foreach($data->voucherData as $row)
                                    <tr>
                                        <td>{{$row->date}}</td>
                                        <td>{{$row->vouchertype}}</td>
                                        <td>{{$row->paymentMode}}</td>
                                        <td>{{$row->voucher_no}}</td>
                                        <td>{{$row->debitAmount}}</td>
                                        <td>{{$row->creditAmount}}</td>
                                        <td>Booking</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <th colspan="7" class="text-center">No Data Found!</th>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th colspan="6" class="text-right">Gross Amount</th>
                                        <td>$ {{round($data->gross_amount,2)}}</td>
                                    </tr>
                                </tbody>
                            </table>




                        </div>






                    </div>

                </div>
                @endforeach

                @else
                <div class="card">
                    <div class="card-body ">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">No Data Found!</th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>


        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn-sm btn-info savepritbtn">Print</button>
            </div>
        </div>
    </div>
</div>




<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
</script>

<script>
    $("#select_room_no").select2({
        placeholder: '----Select Room No----'
    });
</script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '#clean_duration_search', function(e) {

            e.preventDefault();
            $('.invoice_summery_ajax').empty();

            $.ajax({
                type: 'GET',
                url: "{{ route('admin.invoice.summery.ajax.report') }}",
                data: $('#clean_duration_search').serializeArray(),
                success: function(data) {
                    $('.invoice_summery_ajax').append(data);

                },
                error: function(err) {
                    if (err.responseJSON.errors.employee) {
                        $('.employee').html(err.responseJSON.errors.employee[0]);
                    }

                    if (err.responseJSON.errors.to_date) {
                        $('.to_date').html(err.responseJSON.errors.to_date[0]);
                    }
                    if (err.responseJSON.errors.from_date) {
                        $('.from_date').html(err.responseJSON.errors.from_date[0]);
                    }


                }

            });
        });
    });
</script>



@endsection