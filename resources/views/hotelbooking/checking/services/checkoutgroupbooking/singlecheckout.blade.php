@extends('hotelbooking.master')
@section('title', 'Single Check out In-GroupBookig | '.$seo->meta_title)
@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("d-m-Y");
$time = date("h:i A");
@endphp


<style>
    #delectimage {
        position: absolute;
        top: 0;
        right: 2%;
    }

    .form-group {
        margin-bottom: 5%;
    }

    html {
        scroll-behavior: smooth;
    }


    .controll-from {
        width: 100%;
        border: 1px solid #ccc;
        background: #FFF;
        margin: 0 0 5px;
        padding: 3px;
        font-size: 10px;

    }

    .control-label {
        font-size: 12px;
    }

    input:required:focus {
        border: 1px solid red;
        outline: none;
    }
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Single Check-Out in Group Booking</h4>
                        </div>


                    </div>
                </div>

                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Details</h4>
                                    </div>
                                </div>


                                <div class="card-body">
                                    <div class="row">

                                        <table class="table table-borderless">
                                            <tbody>

                                                <tr>
                                                    <th class="control-label" scope="row">Booking No</th>
                                                    <td class="control-label">- {{$checkin->booking_no}}</td>

                                                    <th class="control-label" scope="row">Booking Date</th>
                                                    <td class="control-label">{{$checkin->created_at}}</td>

                                                </tr>

                                                <tr>
                                                    <th class="control-label" scope="row">Room Type</th>
                                                    <td class="control-label">{{$checkin->roomtype->room_type ?? ''}}</td>

                                                    <th class="control-label" scope="row">Room No</th>
                                                    <td class="control-label">{{$checkin->room_no}}</td>


                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">CheckOut</h4>
                                    </div>
                                </div>


                                <form action="{{url('admin/singlecheckout/ingroupbooking/request')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">Select Room No. for Check-Out:</label>
                                                <div class="col-sm-6">
                                                    <input type="hidden" name="booking_no" value="{{ $checkin->booking_no }}">
                                                    <select name="room_id"  class="form-control form-control-sm">
                                                        @php
                                                          $allroom=App\Models\Checkin::where('booking_no',$checkin->booking_no)->where('is_occupy',1)->get();
                                                        @endphp
                                                        <option value="">--Select--</option>
                                                        @foreach($allroom as $room)
                                                            @php
                                                                $singleroom=App\Models\Room::where('id',$room->room_id)->first();
                                                            @endphp
                                                        <option value="{{$singleroom->id}}">{{ $singleroom->room_no }}({{ $singleroom->roomtype->room_type }})</option>
                                                        @endforeach
                                                 
                                                    </select>
                                                    @error('room_id')
                                                        <div style="color:red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center" for="email">CheckOut Date And Time:</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="date" class="form-control form-control-sm datepickernew" value="{{$current}}">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" name="time" class="form-control form-control-sm" value="{{$time}}">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-12">

                                    
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" text-center">
                                            <span id="start-one">
                                                <button id="file-upload-btn" type="submit" class="btn btn-lg btn-primary">Check Before Submit</button>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class=" text-center">
                                            <span id="start-one">
                                                <button id="file-upload-btn" type="submit" class="btn btn-lg btn-primary">Submit</button>
                                            </span>

                                        </div>
                                    </div>





                                    </div>
                                  
                                    </div>

                                   
                                </div>
                                </form>

                            </div>

                        </div>
                    </div>



            </div>


        </div>
    </div>
</div>


@endsection