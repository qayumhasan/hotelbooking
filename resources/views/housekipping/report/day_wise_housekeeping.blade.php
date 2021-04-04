@extends('housekipping.master')
@section('title', 'Day Wise Housekeeping | '.$seo->meta_title)
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
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
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
                        

                        <div class="col-sm-2">
                        <button type="Submit" class="btn btn-primary btn-sm" >Search</button>
                        </div>
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
                            <h4 class="card-title">Day Wise House Keeping</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive room_ajax_data">
                            





                        </div>

                        <!-- preloader area start -->
                        <section id="preloader">
                            <div class="preloader">
                                <!-- <div></div>
                                <div></div>
                                <div></div> -->
                                <h3 class="text-center">Loading</h3>
                            </div>

                        </section>
                        <!-- preloader area end -->



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
    $('.datepicker').datepicker(
        {
            format: 'dd/mm/yyyy',
        }
    );
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
            $.ajax({
                type: 'GET',
                url: "{{ url('/admin/housekepping/clean/day/wise/ajax/list') }}",
                data:$('#clean_duration_search').serializeArray(),
                success: function(data) {
                    console.log(data);
                    $('.preloader').hide();
                    $('.room_ajax_data').append(data);

                },
                error:function(err){
                        $('.preloader').hide();
                        if(err.responseJSON.errors.room_no){
                            $('.room_no').html(err.responseJSON.errors.room_no[0]);
                        }

                        if(err.responseJSON.errors.to_date){
                            $('.to_date').html(err.responseJSON.errors.to_date[0]);
                        }
                        if(err.responseJSON.errors.from_date){
                            $('.from_date').html(err.responseJSON.errors.from_date[0]);
                        }
                        
                        
                    }

            });
        });
    });
</script>



@endsection