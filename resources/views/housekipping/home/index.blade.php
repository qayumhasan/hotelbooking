@extends('housekipping.master')
@section('content')
<div class="content-page">
        <div class="container-fluid">
            
        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">All House Keeping Report</h4>
                        </div>
                        <!-- <span class="float-right mr-2">
                            <a href="#" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Room</span></i>
                            </a>
                        </span> -->
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive room_ajax_data">
                            <table class="table table-striped table-bordered room_simple_data">
                                <thead class="text-center">
                                    <tr>
                                        <th>Room</th>
                                        <th>Room Type</th>
                                        <th>Status</th>
                                        <th>Availability</th>
                                        <th>Last Log</th>
                                        <th>Log Date</th>
                                        <th>Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @if(count($rooms) > 0)
                                    @foreach($rooms as $room)

                                    <tr>
                                        <td>{{$room->room_no}}</td>
                                        <td>{{$room->roomtype->room_type?? ''}}</td>
                                        <td>{{$room->housekeepingreport->keeping_status?? ''}}</td>



                                        @if($room->room_status == 3)
                                        <td class="bg_red">Booked</td>
                                        @elseif($room->room_status == 2)
                                        <td class="bg-navyblue">House Keeping</td>
                                        @elseif($room->room_status == 1)
                                        <td class="bg-green">Available</td>
                                        @elseif($room->room_status == 4)
                                        <td class="bg-yellow">Maintenance</td>
                                        @endif
                                        <td>{{$room->housekeepingreport->remarks?? ''}}</td>
                                        <td>{{$room->housekeepingreport->log_date ?? ''}}</td>
                                        <td>{{$room->housekeepingreport->keeping_name?? ''}}</td>
                                        <td>
                                            <a class="badge bg-primary-light mr-2 editmodal" data-toggle="modal" data-target="#exampleModal" data-whatever="{{$room}}"><i class="lar la-edit"></i></a>
                                        </td>


                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>




                            </table>

                           



                        </div>

                    



                    </div>
                </div>
            </div>
        </div>
         </div>
      </div
@endsection