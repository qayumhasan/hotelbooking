@if(count($housekeepings) > 0)
@foreach($housekeepings as $row)
<tr>

    <th>{{$loop->iteration}}</th>
    <td>{{$row->log_date}}</td>
    <td>{{$row->log_time}}</td>
    <td>{{$row->keeping_name}}</td>
    <td>{{$row->keeping_status}}</td>
    <td>{{$row->remarks}}</td>
</tr>
@endforeach
@else
<tr>
    <th colspan="6" class="text-center">No Data Found!</th>
</tr>
@endif