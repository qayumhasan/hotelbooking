<table class="table table-striped table-bordered room_simple_data">
    <thead class="text-center">
        <tr>
            <th>Sl</th>
            <th>Room</th>
            <th>Done By</th>
            <th>Updated By</th>
            <th>Status</th>
            <th>Checkout</th>
            <th>Clean</th>

            <th>Diffrent</th>
        </tr>
    </thead>

    <tbody class="text-center">
        @if(count($rooms) > 0)
        @foreach($rooms as $row)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$row->room->room_no?? ''}}</td>
            <td>{{$row->updatedby->username?? ''}}</td>
            <td>{{$row->updatedby->username ?? ''}}</td>
            <td>{{$row->keeping_status}}</td>
            <td></td>
            <td>{{$row->log_date}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td>No Data Found!</td>
        </tr>
        @endif
        
    </tbody>

    




</table>