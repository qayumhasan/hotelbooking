@extends('hotelbooking.master')
@section('title', 'Extra Service Report | '.$seo->meta_title)
@section('content')






<div class="content-page">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Extra Services Report</h4>
                        </div>
                        <span class="float-right mr-2">
                            <span>Report Create On: </span><strong> {{date("d-M-Y")}}</strong>      
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive room_ajax_data">
                            <table id="datatable" class="table data-table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Row</th>
                                        <th>Room No</th>
                                        <th>Guest Name</th>
                                        <th>Service</th>
                                        <th>Remarks</th>
                                        <th>Rate</th>
                                        <th>Qty</th>
                                        <th>Charge Based</th>
                                        <th>Operator</th>
                                        <th>Total Charged</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @foreach($services as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->room_no}}</td>
                                            <td>{{$row->checkin->guest_name ?? ''}}</td>
                                            <td>{{$row->item_name}}</td>
                                            <td>{{$row->remarks}}</td>
                                            <td>{{$row->rate}}</td>
                                            <td>{{$row->qty}}</td>
                                            
                                            <td>{{$row->itementry->unit->name ?? ''}}</td>
                                            <td>{{$row->user->username ?? ''}}</td>
                                            <td>{{$row->amount}}</td>
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
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    });

</script>

<script>
    $("#select_room_no").select2({
        placeholder: '----Select Room No----'
    });
</script>

@endsection