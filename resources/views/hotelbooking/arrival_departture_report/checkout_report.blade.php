@extends('hotelbooking.master')
@section('title', 'CheckIn Report | '.$seo->meta_title)
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
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">CheckIn Report</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive room_ajax_data">
                            <table id="datatable" class="table data-table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Row</th>
                                        <th>Booking No</th>
                                        <th>Room</th>
                                        <th>Room Type</th>
                                        <th>Amount</th>
                                        <th>Guest</th>
                                        <th>City</th>
                                        <th>Company</th>
                                        <th>Discount</th>
                                        <th>PAX</th>
                                        <th>Source</th>
                                        <th>Arrival</th>
                                        <th>Departure</th>
                                        <th>Total Night</th>
                                        <th>Checkout By</th>
                                    </tr>
                                </thead>
                                @php
                                    $totalnight = 0;
                                    $noofpax = 0;
                                    $totaldiscount = 0;
                                    $netamount = 0;
                                @endphp

                                <tbody class="text-center">
                                    @foreach($checkins as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->booking_no}}</td>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->roomtype->room_type ?? ''}}</td>
                                        @if(isset($row->checkout->gross_amount))
                                        <td>{{round($row->checkout->gross_amount,2)}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>{{$row->guest_name}}</td>
                                        <td>{{$row->city}}</td>
                                        <td>{{$row->company}}</td>
                                        @if(isset($row->checkout->discount_amount))
                                        <td>{{round($row->checkout->discount_amount,2)}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>{{$row->number_of_person}}</td>
                                        <td>{{$row->vehicle_type}}</td>
                                        <td>{{$row->checkin_date}}</td>
                                        <td>{{$row->checkout->checkout_date ?? ''}}</td>
                                        <td>{{$row->additional_room_day}}</td>
                                        <td>{{$row->checkout->user->username ?? ''}}</td>


                                        @php
                                        $totalnight =  $totalnight + (int)$row->additional_room_day;
                                        $noofpax = $noofpax +$row->number_of_person;
                               
                                        if(isset($row->checkout->discount_amount)){
                                            $totaldiscount  =  $totaldiscount + $row->checkout->discount_amount;
                                        }else{
                                            $totaldiscount  =  $totaldiscount + 0;
                                        }
                                        

                                        if(isset($row->checkout->gross_amount)){
                                            $netamount  =  $netamount + $row->checkout->gross_amount;
                                        }else{
                                            $netamount  =  $netamount + 0;
                                        }
                                        

                                        @endphp


                                    </tr>
                                    @endforeach

                                </tbody>





                            </table>




                        </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Summary Of Report</h4>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Total Night</th>
                                        <th scope="col">No of PAX</th>
                                        <th scope="col">Total Discount</th>
                                        <th scope="col">Net Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$totalnight}}</td>
                                        <td>{{$noofpax}}</td>
                                        <td>{{$totaldiscount}}</td>
                                        <td>{{$netamount}}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
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

@endsection