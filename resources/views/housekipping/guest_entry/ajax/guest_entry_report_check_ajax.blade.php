<table class="table table-bordered" id="table_id">
    <thead>
        <tr>
            <th scope="col">SL</th>
            <th scope="col">Booking No.</th>
            <th scope="col">Guest Name</th>
            <th scope="col">Room</th>
            <th scope="col">In Date</th>
            <th scope="col">Total Pax</th>
            <th scope="col">Actual Pax</th>
            <th scope="col">Varified By</th>
        </tr>
    </thead>

    @if(count($guestentresChecks) > 0)
    <tbody>
        @foreach($guestentresChecks as $row)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$row->room->checkin->booking_no?? ''}}</td>

            <td>{{$row->room->checkin->guest_name?? ''}}</td>
            <td>{{$row->room->room_no?? ''}}</td>
            <td>{{$row->entry_date}}</td>

            <td>{{$row->room->checkin->number_of_person?? ''}}</td>
            <td>{{$row->no_of_pax}}</td>
            <td>{{$row->varifiedby->username?? ''}}</td>
        </tr>
        @endforeach
    </tbody>
    @else
    <h4>No Data Found!</h4>
    @endif



</table>