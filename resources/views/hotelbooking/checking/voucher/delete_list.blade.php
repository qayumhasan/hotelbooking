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

            <div class="col-sm-12 col-lg-12">
                <div class="card p-4">
                    <h4 class="card-title">Money Receipt Register</h4>
                    @if(count($voucherdetails) >0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Guest Name</th>
                                <th scope="col">Voucher No</th>
                                <th scope="col">Voucher Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @php
                            $totalamount = 0;
                        @endphp
                        <tbody>
                            @foreach($voucherdetails as $row)
                      
                            <tr>
                                <th scope="row">{{$row->credit}}</th>
                                <td>{{$row->voucher_no}}</td>
                                <td>{{$row->date}}</td>
                                <td>{{$row->amount}}</td>
                                <td>
                                <a id="delete" class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.checkin.delete.voucher',$row->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
                                </td>
                            </tr>
                            @php
                                $totalamount = (float) $totalamount + $row->amount;
                            @endphp
                            @endforeach
                            <tr>
                                <th class="text-right" colspan="3">Total</th>
                                <td>{{(float) $totalamount}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <table>
                 

                    <tr>
                        <th class="text-center"> No Data Found!</th>
                    </tr>

                    </table>
                    @endif
                </div>
            </div>


        </div>



    </div>
</div>

@endsection