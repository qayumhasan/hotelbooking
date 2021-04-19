<table class="table table-striped table-bordered room_simple_data">
    <thead class="text-center">
        <tr>
            <th>Room No</th>
            <th>Date</th>
            <th>Time</th>
            <th>Employee</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>
    </thead>

    <tbody class="text-center">
        @if(count($rooms) > 0)
        @foreach($rooms as $row)
        <tr>
            <td>{{$row->room->room_no??''}}</td>
            <td>{{$row->log_date}}</td>
            <td>{{$row->log_time}}</td>
            <td>{{$row->keeping_name}}</td>
            <td>{{$row->keeping_status}}</td>
            <td>{{$row->remarks}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No Data Found!</td>
        </tr>
        @endif
        
    </tbody>

    




</table>