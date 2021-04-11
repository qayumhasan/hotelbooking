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

    <tbody>
        @if(count($guestentresChecks) > 0)
        @foreach($guestentresChecks as $row)

        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$row->checkin->booking_no?? ''}}</td>

            <td>{{$row->checkin->guest_name?? ''}}</td>
            <td>{{$row->room_no?? ''}}</td>
            <td>{{$row->entry_date}}</td>

            <td>{{$row->checkin->number_of_person?? ''}}</td>
            <td>{{$row->guestentrycrosscheck->no_of_pax}}</td>
            <td>{{$row->guestentrycrosscheck->varifiedby->username?? ''}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <th colspan="8" class="text-center">No Data Found!</th>
        </tr>

        @endif
    </tbody>



</table>