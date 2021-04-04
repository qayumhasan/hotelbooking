@extends('housekipping.master')
@section('title', 'Person Entry | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("d/m/Y");
$time = date("h:i");
@endphp

@php
date_default_timezone_set("Asia/Dhaka");
$current =date("d/m/Y");
$time = date("h:i");
@endphp

<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-4">

                    <form id="clean_duration_search">
                        <div class="form-group row ml-auto">
                        
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Shift:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" id="select_room_no" name="room_no">
                                    
                                    <option>Morning Shift</option>
                                    <option>Evening Shift</option>
                                </select>
                                <small class="text-danger room_no"></small>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Actual No of Guest Entry</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(count($rooms) >0)
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Room</th>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Booking No</th>
                                        <th scope="col">Arrival</th>
                                        <th scope="col" width="10%">No. of Pax</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($rooms as $row)
                                    <tr class="getpaxelement{{$row->id}}">
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->checkin->guest_name?? ''}}</td>
                                        <td>{{$row->checkin->booking_no?? ''}}</td>
                                        <td>{{$row->checkin->checkin_date?? ''}}</td>
                                        <td>
                                            <form id="getpaxelement{{$row->id}}" onkeyup="getPaxdata(this)">
                                                <input type="hidden" value="{{$row->id}}" name="room_id">
                                                <input type="number" name="no_of_pax"  id="getpaxelement{{$row->id}}" value="{{$row->guestentry->no_of_pax?? ''}}" class="form-control-sm getpaxdata w-100">
                                            </form>
                                        </td>
                                        


                                    </tr>

                                    @endforeach

                                </tbody>


                            </table>

                            @else
                            <h5>No Data Found!</h5>
                            @endif






                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

<script>
    function getPaxdata(el) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'get',
            url: "{{ url('/admin/housekeeping/guest/entry/pax/store') }}",
            data: $('#' + el.id).serializeArray(),
            success: function(data) {
                var myvar =setInterval(function(){
                    iziToast.success({
                    message: data.message,
                    position:'topCenter'

                });
                // window.location = "{{ url()->current() }}";
                clearInterval(myvar);
                },700);
                
               
            },
            error: function(err) {
                console.log(err.responseJSON.errors);

            }
        });
    }
</script>


@endsection