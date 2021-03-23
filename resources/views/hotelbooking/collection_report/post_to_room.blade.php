@extends('hotelbooking.master')
@section('title', 'Post To Room Report | '.$seo->meta_title)
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

                    <form id="clean_duration_search">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>From Date:</b></label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker form-control-sm" name="from_date" type="text" value="{{$date}}">
                                <small class="text-danger from_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>To Date:</b></label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker form-control-sm" name="to_date" type="text">
                                <small class="text-danger to_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Employee:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" name="employee">
                                    <option selected disabled>---Select A Employee---</option>
                                    @foreach($guests as $row)
                                    <option value="{{$row->id}}">{{$row->guest_name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger employee"></small>

                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mb-2">Search</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Restaurant Post To Room Report</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive room_ajax_data">

                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-secondary">
                                        <th scope="col">SL</th>
                                        <th scope="col">Booking</th>
                                        <th scope="col">In Date</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Out Date</th>
                                        <th scope="col">Print</th>
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
                                        <td>@mdo</td>
                                    </tr>

                                    <tr class="bg-secondary">
                                        <th scope="col"></th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Restaurant Name</th>
                                        <th scope="col">Room No</th>
                                        <th scope="col">Waiter</th>
                                        <th scope="col" colspan="3">Amount</th>
                                        
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="7">Booking Total:</th>
                                        <td>Otto</td>
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

<script>
    $(document).ready(function() {
        $('.preloader').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '#clean_duration_search', function(e) {

            e.preventDefault();

            $('.preloader').show();
            $('.room_simple_data').hide();
            $('.room_ajax_data').empty();
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.daily.collection.ajax.report') }}",
                data: $('#clean_duration_search').serializeArray(),
                success: function(data) {

                    $('.preloader').hide();
                    $('.room_ajax_data').append(data);

                },
                error: function(err) {
                    $('.preloader').hide();

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