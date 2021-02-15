@if(count($sidemenus) > 0)
@foreach($sidemenus as $row)
@foreach(json_decode($row->items) as $data)
<tr id="deletemenu">
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{$data->item_name}}</td>
    <td>
    <a href="{{route('admin.restaurant.chui.side.menu.delete',[$row->id,$data->item_id])}}" class="badge bg-danger-light mr-2"><i class="la la-trash"></i></a>
    </td>
</tr>
@endforeach
@endforeach
@endif