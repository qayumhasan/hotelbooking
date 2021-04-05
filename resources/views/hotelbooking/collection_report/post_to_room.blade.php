@extends('hotelbooking.master')
@section('title', 'Post To Room Report | '.$seo->meta_title)
@section('content')

@php
date_default_timezone_set("Asia/Dhaka");
$date = date("d-m-Y");
$time = date("h:i");
@endphp

<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">

                <div class="card p-4">
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

                    <form id="clean_duration_search">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>From Date:</b></label>
                            <div class="col-sm-2">
                                <input class="form-control datepickernew form-control-sm" name="from_date" type="text" value="{{$date}}">
                                <small class="text-danger from_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>To Date:</b></label>
                            <div class="col-sm-2">
                                <input class="form-control datepickernew form-control-sm" value="{{$date}}" name="to_date" type="text">
                                <small class="text-danger to_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>Guest:</b></label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" name="guest_name" id="select_room_no">
                                    <option selected disabled>---Select A Employee---</option>
                                    @foreach($guests as $row)
                                    <option value="{{$row->guest_name}}">{{$row->guest_name}}</option>
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

        <div class="row" id="post_to_room_ajax">




            @foreach($postToRooms as $row)
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">

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
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$row->checkin->booking_no ?? ''}}</td>
                                        <td>{{$row->checkin->checkin_date ?? ''}}</td>
                                        <td>{{$row->checkin->guest_name ?? ''}}</td>
                                        <td>{{$row->checkin->company_name ?? ''}}</td>
                                        <td>{{$row->checkin->checkinstatus ?? ''}}</td>
                                        <td>{{$row->checkin->checkout->checkout_date ?? ''}}</td>
                                        <td>
                                            <a href="{{route('admin.post.to.room.invoice.print',$row->id)}}" class="btn btn-primary badge bg-info-light mr-2 invoicebtn" data-toggle="modal" data-target="#invoiceprint"><i class="las la-print"></i></a>
                                        </td>

                                    </tr>

                                    <tr class="bg-secondary">
                                        <th scope="col"></th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Restaurant Name</th>
                                        <th scope="col">Room No</th>
                                        <th scope="col">Waiter</th>
                                        <th scope="col" class="text-center" colspan="2">Amount</th>

                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>{{$row->orderDetail->kot_date ?? ''}}</td>
                                        <td>{{$row->orderDetail->invoice_id ?? ''}}</td>

                                        <td>Durbar-Restaturant</td>
                                        <td>{{$row->checkin->room_no ?? ''}}</td>
                                        <td>{{$row->orderDetail->waiter->employee_name ?? ''}}</td>
                                        <td class="text-center" colspan="2">{{$row->gross_amount}}</td>

                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="6">Booking Total:</th>
                                        <td class="text-center" colspan="2">{{$row->gross_amount}}</td>
                                    </tr>

                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>





            @endforeach










        </div>


        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn-sm btn-info savepritbtn">Print</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="invoiceprint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post to Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="posttoroomdata">
            
            </div>

        </div>
    </div>
</div>







<script>
    $(document).ready(function(){
        $('.invoicebtn').click(function(){
            var url =$(this)[0].href;

        $('#posttoroomdata').empty();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: url,
               
                success: function(data) {
                    $('#posttoroomdata').append(data);
                }
            });
        });
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
            
            $('#post_to_room_ajax').empty();

            $.ajax({
                type: 'post',
                url: "{{ route('admin.post.to.room.ajax.report') }}",
                data: $('#clean_duration_search').serializeArray(),
                success: function(data) {
                    $('#post_to_room_ajax').append(data);
                },
                error: function(err) {
                  

                    if (err.responseJSON.errors.guest_name) {
                        $('.employee').html(err.responseJSON.errors.guest_name[0]);
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