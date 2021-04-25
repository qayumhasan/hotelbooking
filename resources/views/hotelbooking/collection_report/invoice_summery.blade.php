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
                                <select class="form-control form-control-sm select_room_no" name="guest_name" id="guest_name ">
                                    <option disabled selected>---- Select A Guest Name ----</option>
                                    @foreach($guests as $row)
                                    <option value="{{$row->id}}">{{$row->guest_name}}</option>
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
           
                <div class="card">







@if(count($invoicesummarys) > 0)
    @foreach($invoicesummarys as $row)

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


                                        <td>{{$row->guest_name}}</td>
                                        <td>{{$row->invoice_no}}</td>
                                        <td>{{$row->invoice_date}}</td>
                                        <td>{{round($row->outstanding_amount,2)}}</td>
                                        <!-- tax area start -->
                                        
                                        <td rowspan="5">
                                        @if(count($row->taxs) > 0)
                                            @foreach($row->taxs as $data)
                                            <div class="row">
                                                <div class="col">
                                                    <span>On {{$data->taxDescription}} @ {{$data->baseonamount}} </span>
                                                </div>
                                                <div class="col">
                                                    = {{$data->amount}}
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
                                   
                                    <tr>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->checkin_date}}</td>
                                        <td>{{$row->checkout_date}}</td>
                                        <td>{{$row->day}}</td>

                                    </tr>
                                    
                                    <tr>
                                        <th scope="col">Booking Type</th>
                                        <th scope="col">Room Amount</th>
                                        <th scope="col">Food Amount</th>
                                        <th scope="col">Ep/Laundry Amount</th>
                                    </tr>

                                    <tr>

                                        @if($row->booking_type == 2)
                                        <td>Group Booking</td>
                                        @else
                                        <td>Individual</td>
                                        @endif
                                        <td>{{round($row->room_amount,2)}}</td>
                                        <td>{{round($row->fb_amount,2)}}</td>
                                        <td>{{round($row->extra_service_amount,2)}}</td>

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
                      
                                    <tr>
                                        <td>{{$row->TransectionDate}}</td>
                                        <td>{{$row->voucher_type}}</td>
                                        <td></td>
                                        <td>{{$row->voucherNo}}</td>
                                        
                                        <td>{{$row->TransectionAmount}}</td>
                                        <td>{{abs($row->TransectionAmount)}}</td>
                                        <td>Booking</td>
                                    </tr>
                            
                                
                                    <tr>
                                        <th colspan="6" class="text-right">Gross Amount</th>
                                        <td> {!!$currency->symbol ?? ' '!!} {{round($row->gross_amount,2)}}</td>
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
    $(document).ready(function(){
        $(".select_room_no").select2({
        placeholder: '----Select Room No----'
    });
    })
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
                url: "{{route('admin.invoice.summery.ajax.report')}}",
                data: $('#clean_duration_search').serializeArray(),
                success: function(data) {
                    $('.invoice_summery_ajax').empty();
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