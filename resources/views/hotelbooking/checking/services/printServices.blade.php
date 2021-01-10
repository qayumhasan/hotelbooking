<div class="modal fade" id="view_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">View HouseKepping Services</h6>
            </div>
            <div class="modal-body">
                <table>
                    <tr class="heading_area">
                        <th>Guest Information:</th>
                    </tr>
                </table>
                <table class="table table-borderless border-bottom">

                    <tbody>

                        <tr>
                            <th scope="row" class="control-label">Booking No.</th>
                            <td class="control-label">- {{$checkin->booking_no}}</td>
                            <th class="control-label" scope="row">Room No.</th>
                            <td class="control-label">{{$checkin->room_no}}({{$checkin->roomtype->room_type ?? ''}})</td>
                        </tr>
                        <tr>
                            <th class="control-label" scope="row">Checkin Date/Time</th>
                            <td class="control-label">{{$checkin->checkin_date}} - {{$checkin->checkin_time}}</td>
                            <th class="control-label" scope="row">Guest Name</th>
                            <td class="control-label">{{$checkin->guestname}}</td>
                        </tr>

                    </tbody>
                </table>

                <div id="view_extra_service">
    <div class="row">
        <div class="col-md-12 card basic-drop-shadow shadow-showcase mt-4 p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="control-label" scope="col">Service No</th>
                        <th class="control-label" scope="col">Room No</th>
                        <th class="control-label" scope="col">Services</th>
                        <th class="control-label" scope="col">Services Date</th>
                        <th class="control-label" scope="col">Operator</th>
                        <th class="control-label" scope="col">rate</th>
                        <th class="control-label" scope="col">Qty</th>
                        <th class="control-label" scope="col">Amount</th>
               
                    </tr>
                </thead>
                <tbody>
                    @if(count($services) > 0)
                    @foreach($services as $row)

                    <tr>
                    <th scope="row">{{$row->service_no}}</th>
                    <td>{{$row->checkin->room_no ?? ''}}</td>
                    <td>{{$row->services}}</td>
                    <td>{{$row->service_date}}</td>
                    
                    <td>gsdg</td>
                    <td>{{$row->rate}}</td>
                    <td>{{$row->qty}}</td>
                    
                    <td>{{$row->rate*$row->qty}}</td>
                    
                </tr>

                    @endforeach
                @else
                    <tr class="text-center">
                        <td>No Services Found!</td>
                    </tr>
                @endif


                </tbody>
            </table>
            
        </div>
    </div>
</div>


                
                
            </div>


        </div>

    </div>
</div>