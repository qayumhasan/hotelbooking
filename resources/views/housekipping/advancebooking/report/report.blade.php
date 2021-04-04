@extends('housekipping.master')
@section('title', 'Booking Report | '.$seo->meta_title)
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
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">All Advance Booking</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Booking No</th>
                                        <th>Room no</th>
                                        <th>Guest</th>
                                        <th>Mobile</th>
                                        <th>In Date</th>
                                        <th>Exp.Out Date</th>
                                        <th>Tariff</th>
                                        <th>Checkin By</th>
                                        <th class="d-none">Action</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Booking No</th>
                                        <th>Room no</th>
                                        <th>Guest</th>
                                        <th>Mobile</th>
                                        <th>In Date</th>
                                        <th>Exp.Out Date</th>
                                        <th>Tariff</th>
                                        <th>Checkin By</th>
                                        <th class="d-none">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody class="text-center">
                                    <!-- <tr>
                                        <th>Booking No</th>
                                        <th>Room No</th>
                                        <th>Guest</th>
                                        <th>Mobile</th>
                                        <th>In Date</th>
                                        <th>Exp.Out Date</th>
                                        <th>Tariff</th>
                                        <th>Checkin By</th>
                                        <th width="150px">Action</th>
                                    </tr> -->

                                    @foreach($advances as $row)

                                    <tr>
                                        <td>{{$row->booking_id}}</td>
                                        <td>{{$row->room->room_no??''}}</td>
                                        <td>{{$row->guest->guest_name ?? ''}}</td>
                                        <td>{{$row->guest->mobile ?? '' }}</td>
                                        <td>{{$row->checkindate}}</td>
                                        <td>{{$row->checkoutdate}}</td>
                                        <td>{{$row->tariff}}</td>
                                        <td>{{$row->bookedby->username?? ''}}</td>
                                        

                                        <td width="10%">
                                            @if($row->is_active==1)
                                            <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.housekeeping.advance.booking.status',$row->id)}}" data-original-title="Active"><i class="la la-thumbs-up"></i></a>
                                            @else
                                            <a class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.housekeeping.advance.booking.status',$row->id)}}" data-original-title="Deactive"><i class="la la-thumbs-down"></i></a>
                                            @endif

                                            <a class="badge bg-primary-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.housekeeping.advance.booking.report.edit',$row->id)}}" data-original-title="Edit"><i class="lar la-edit"></i></a>


                                            <a id="delete" class="badge bg-danger-light mr-2" data-toggle="tooltip" data-placement="top" href="{{route('admin.housekeeping.advance.booking.delete',$row->id)}}" data-original-title="Delete"> <i class="la la-trash"></i></a>
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
    </div>
</div>

<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#datatable thead th').each(function() {
            var title = $('#datatable thead th').eq($(this).index()).text();
            if(title !='Action'){

                $(this).html('<input class="search_area form-control form-control-sm" type="text" placeholder="' + title + '" />');
            }
            
        });

        // DataTable
        var table = $('#datatable').DataTable({
            paging: true,
            bFilter: false,
            ordering: false,
            searching: true,
            // dom: 't',
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.header()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });

    });
</script>

@endsection