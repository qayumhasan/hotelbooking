@extends('hotelbooking.master')
@section('title', 'Occupancy Report | '.$seo->meta_title)
@section('content')


<style>
    .search_area {
        width: 100%;

    }

    #datatable_filter {
        visibility: hidden;
    }
</style>

<div class="content-page">
    <div class="container-fluid printableAreasaveprint">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex text-center">
                        <div class="header-title mx-auto">
                            <h4 class="card-title">Occupancy Report</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="card-body">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full</th>
                                        <td class="text-center">{{$data['full']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Vacant</th>
                                        <td class="text-center">{{$data['vacant']}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Expected collection Today</th>
                                        <td class="text-center">{{$data['total']}}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Room</th>
                                    <th scope="col">Guest</th>
                                    <th scope="col">City</th>
                                    <th scope="col">In Date</th>
                                    <th scope="col">In Time</th>
                                    <th scope="col">Exp. Out Date</th>
                                    <th scope="col">Exp. Out Time</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tariff</th>
                                    <th scope="col">Checkin By</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($rooms as $row)
                          
                                <tr>
                                    <th scope="row">{{$row->room_no}}</th>
                                    <td>{{$row->checkin->guest_name?? ''}}</td>
                                    <td>{{$row->checkin->city?? ''}}</td>
                                    <td>{{$row->checkin->checkin_date?? ''}}</td>
                                    <td>{{$row->checkin->checkin_time?? ''}}</td>
                                    <td>{{$row->checkin->exp_checkin_date?? ''}}</td>
                                    <td>{{$row->checkin->exp_checkin_time?? ''}}</td>
                                    <td>{{$row->roomtype->room_type?? ''}}</td>
                                    @if($row->room_status == 3)
                                    <td class="text-danger">
                                    Full</td>
                                    @else
                                    <td class="text-primary">Vacant</td>
                                    @endif
                                    <td>{{$row->checkin->tarif?? ''}}</td>
                                    <td>{{$row->checkin->user->username?? ''}}</td>
                                    
                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


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




@endsection