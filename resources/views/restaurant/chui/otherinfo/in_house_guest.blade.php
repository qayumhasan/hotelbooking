@extends('restaurant.chui.master')
@section('title', 'In House Guest| '.$seo->meta_title)
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
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">All In House Guest</h4>
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
                                        <th>Company</th>
                                        <th>City</th>
                                        <th>Total Pax</th>
                                        <th>In Date</th>
                                        <th>Exp.Out Date</th>
                                        <th>Checkin By</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Booking No</th>
                                        <th>Room no</th>
                                        <th>Guest</th>
                                        <th>Company</th>
                                        <th>City</th>
                                        <th>Total Pax</th>
                                        <th>In Date</th>
                                        <th>Exp.Out Date</th>
                                        <th>Checkin By</th>
                                       
                                    </tr>
                                </tfoot>
                                <tbody class="text-center">


                                    @foreach($checkins as $row)

                                    <tr>
                                        <td>{{$row->booking_no}}</td>
                                        <td>{{$row->room_no}}</td>
                                        <td>{{$row->guest_name}}</td>
                                        <td>{{$row->company_name }}</td>
                                        <td>{{$row->city}}</td>
                                        <td>{{$row->number_of_person}}</td>
                                        <td>{{$row->checkin_date}}</td>
                                        <td>{{$row->exp_checkin_date}}</td>
                                        <td>{{$row->user->username ?? ''}}</td>
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
                <button type="button" class="btn-sm btn-info savepritbtn">Print</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#datatable thead th').each(function() {
            var title = $('#datatable thead th').eq($(this).index()).text();
            if (title != 'Action') {

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