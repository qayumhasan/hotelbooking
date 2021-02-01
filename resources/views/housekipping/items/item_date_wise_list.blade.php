@extends('housekipping.master')
@section('title', 'Item Issue Room Wise List | '.$seo->meta_title)
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

                    <form id="item_issue_list" action="{{route('admin.housekeeping.distribution.items.issue.date.ajax.list')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>From Date:</b></label>
                            <div class="col-sm-4">
                                <input class="form-control datepicker form-control-sm" name="from_date" type="text" value="{{$date}}">
                                <small class="text-danger from_date"></small>
                            </div>

                            <label for="inputPassword" class="col-sm-1 col-form-label"><b>To Date:</b></label>
                            <div class="col-sm-4">
                                <input class="form-control datepicker form-control-sm" name="to_date" type="text">
                                <small class="text-danger to_date"></small>
                            </div>




                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
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
                            <h4 class="card-title">Item Issue Date Wise List</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive room_ajax_data">
                            <table class="table table-bordered" id="old_data">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Room No</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($itemslists as $key=>$value)
                                    @foreach($value as $room_id=>$row )
                                    @php
                                    $room_no = App\Models\Room::where('id',$room_id)->first();
                                    @endphp
                                    <tr @if($loop->first) class="bg-secondary" @else '' @endif>
                                        @if($loop->first)
                                        <th scope="row">{{$key}}</th>
                                        @else
                                        <th></th>
                                        @endif

                                        <th @if($loop->first) ''@else class="bg-light" @endif>{{$room_no->room_no?? ''}}</th>
                                        

                                        
                                        <td @if($loop->first) ''@else class="bg-light" @endif>{{$row->first()->issuedby->username?? ''}}</td>
                                        <td @if($loop->first) ''@else class="bg-light" @endif>{{$row->first()->remarks}}</td>
                                    </tr>
                                    
                                    @php
                                        $total = 0;
                                    @endphp

                                    @foreach($row as $data)
                                 
                                    <tr>
                                        <td></td>
                                        <td>{{$data->items->item_name?? ''}}</td>
                                        <td>{{$data->qty}}</td>
                                       
                                        <td>{{$data->unit->name?? ''}}</td>

                                        @php
                                            $total = $total + $data->qty;
                                        @endphp

                                    </tr>
                                    
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <th class="text-success">Total</th>
                                        <td class="text-success" colspan="2">{{$total}}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach


                                </tbody>






                            </table>





                        </div>





                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn-sm btn-info savepritbtn">Print </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#select_room_no").select2({
        placeholder: '----Select Room No----'
    });
</script>


<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('submit', '#item_issue_list', function(e) {
            e.preventDefault();
            document.querySelector('#old_data').remove();
            var url = $(this).attr('action');
            var type = $(this).attr('method');
            var request = $(this).serialize();
            $.ajax({
                url: url,
                type: type,
                data: request,
                success: function(data) {
                    console.log(data);
                    $('.room_ajax_data').append(data);
                },
                error: function(err) {
                    if (err.responseJSON.errors.to_date) {
                        $('.to_date').html(err.responseJSON.errors.to_date);
                    }

                    if (err.responseJSON.errors.from_date) {
                        $('.from_date').html(err.responseJSON.errors.from_date);
                    }



                    console.log(err.responseJSON.errors.to_date)
                }
            });
        });
    });
</script>






@endsection