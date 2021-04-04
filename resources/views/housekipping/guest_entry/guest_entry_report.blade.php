@extends('housekipping.master')
@section('title', 'Person Entry Report| '.$seo->meta_title)
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

                    <form id="search_guest_entry_report">
                        <div class="form-group row">

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Room No:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" id="select_room_no" name="room_no">
                                    <option selected disabled>---Select A Room---</option>
                                    @foreach($rooms as $row)
                                    <option value="{{$row->id}}">{{$row->room_no}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger room_no"></small>
                            </div>


                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Shift:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" id="select_shift" name="select_shift">

                                    <option>Morning Shift</option>
                                    <option>Evening Shift</option>
                                </select>
                                <small class="text-danger select_shift"></small>
                            </div>

                            <div class="col-sm-2">
                                <button type="Submit" class="btn btn-primary btn-sm">Search</button>
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
                            <h4 class="card-title">Actual No of Guest Entry Report</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="guest_entry_ajax_data">

                            <table class="table table-bordered" id="table_id">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Room</th>
                                        <th scope="col">Guest Name</th>
                                        <th scope="col">Arrival</th>
                                        <th scope="col">Varified Date</th>
                                        <th scope="col">Actual Pax</th>
                                        <th scope="col">Varified By</th>
                                    </tr>
                                </thead>
                                @if(count($rooms) > 0)


                                <tbody>
                                    @foreach($rooms as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->checkin->guest_name??''}}</td>
                                        <td>{{$row->checkin->checkin_date?? ''}}</td>
                                        <td>{{$row->guestentry->entry_date??''}}</td>
                                        <td>{{$row->guestentry->no_of_pax??''}}</td>
                                        <td>
                                            {{$row->guestentry->varifiedby->username?? ''}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif


                            </table>








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
        $(document).on('submit', '#search_guest_entry_report', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/housekepping/guest/entry/report/ajax/list') }}",
                data: $('#search_guest_entry_report').serializeArray(),
                success: function(data) {
                    console.log(data);
                    document.querySelector('#table_id').remove();

                    $('#guest_entry_ajax_data').append(data);

                },
                error: function(err) {

                    if (err.responseJSON.errors.room_no) {
                        $('.room_no').html(err.responseJSON.errors.room_no[0]);
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