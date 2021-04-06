@extends('housekipping.master')
@section('title', 'Item Department Issue List | '.$seo->meta_title)
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

                    <form id="item_issue_list" action="{{route('admin.housekeeping.maintenance.distribution.items.issue.ajax.list')}}" method="post">
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
                            <h4 class="card-title">Item Issue List</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive room_ajax_data">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="additemlist">
                                @foreach($itemIssues as $key=>$row)
                                    <tr class="deleteditem">
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$row->first()->issue_date}}</td>
                                        <td>{{$row->first()->issuedby->username?? ''}}</td>
                                        <td>{{$row->first()->remarks?? ''}}</td>

                                        <td>
                                        <a href="{{route('admin.housekeeping.maintenance.distribution.items.issue.edit',$key)}}" class="badge bg-primary-light mx-auto editmodal"><i class="lar la-edit"></i></a>
                                        </td>
                                    </tr>
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
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });
</script>
<script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('submit', '#item_issue_list', function(e){
                e.preventDefault();
                document.querySelectorAll('.deleteditem').forEach(function(e){
                    e.remove();
                });
                var url = $(this).attr('action');
                var type = $(this).attr('method');
                var request = $(this).serialize();
                $.ajax({
                    url:url,
                    type:type,
                    data: request,
                    success:function(data){
                        console.log(data);
                        $('#additemlist').append(data);
                    },
                    error:function(err){
                        if(err.responseJSON.errors.to_date){
                            $('.to_date').html(err.responseJSON.errors.to_date);    
                        }

                        if(err.responseJSON.errors.from_date){
                            $('.from_date').html(err.responseJSON.errors.from_date);    
                        }
                        
                        
                        
                       console.log(err.responseJSON.errors.to_date)
                    }
                });
            });
        });
    </script> 






@endsection