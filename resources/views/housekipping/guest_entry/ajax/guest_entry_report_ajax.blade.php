

    <table class="table table-bordered" id="table_id">
        <thead>
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Room</th>
                <th scope="col">Guest Name</th>
                <th scope="col">Arrival</th>
                <th scope="col">Varified Date</th>
                <th scope="col">Actual Pax</th>
                <th scope="col">Varified By</th>
            </tr>
        </thead>
        @if(count($guestentres) > 0)


        <tbody>
        @foreach($guestentres as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->room->room_no??''}}</td>
                <td>{{$row->room->checkin->guest_name??''}}</td>
                <td>{{$row->room->checkin->checkin_date?? ''}}</td>
                <td>{{$row->entry_date}}</td>
                <td>{{$row->no_of_pax}}</td>
                <td>
                {{$row->varifiedby->username?? ''}}
                                        </td>
            </tr>
        @endforeach
        </tbody>
        @endif


    </table>








