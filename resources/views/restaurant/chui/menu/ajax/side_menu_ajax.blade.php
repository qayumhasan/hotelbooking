@if(count($sidemenus) > 0)
@foreach($sidemenus as $row)
@foreach(json_decode($row->items) as $data)
<tr id="deletemenu">
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{$data->item_name}}</td>
    <td>@mdo</td>
</tr>
@endforeach
@endforeach
@endif