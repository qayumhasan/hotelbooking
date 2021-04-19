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
            <td>{{$row->created_at}}</td>
            <td>{{$row->log_date}}</td>
            @php
                $newDate = date("d-m-Y", strtotime($row->created_at)); 
             
                $origin = new DateTime(Carbon\Carbon::parse("{$row->log_date}")->toFormattedDateString());
                $target=Carbon\Carbon::parse("{$newDate}")->toFormattedDateString();
                $target = new DateTime($target);

                $interval =$origin->diff($target);

                $date =abs($interval->format('%R%a'));
                $date = $date > 0 ? $date : 1;

            @endphp
            <td>{{$date}}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No Data Found!</td>
        </tr>
        @endif

    </tbody>






</table>