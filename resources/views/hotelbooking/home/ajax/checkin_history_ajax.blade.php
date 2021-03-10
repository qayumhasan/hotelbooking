@if(count($checkins) >0)
@foreach($checkins as $row)
<tr>
    <td>{{$row->room_no}}</td>
    <td>{{$row->checkin_date}}</td>
    <td>{{$row->checkin_time}}</td>
    <td>{{$row->guest_name}}</td>
    <td>{{$row->city}}</td>
    <td>{{$row->additional_room_amount}}</td>
</tr>
@endforeach
@else
<tr>
    <th colspan="6" class="text-center">No Data Found!</th>
</tr>
@endif