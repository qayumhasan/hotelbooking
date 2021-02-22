@foreach($kotdetails as $row)
<tr class="deleteddata">
    <th scope="row">{{$row->item->item_name}}</th>
    <td>{{$row->qty}}</td>
    <td>{{$row->rate}}</td>
    <td>{{$row->amount}}</td>
    <td><a data-whatever="{{$row->id}}" onclick="edititem(this)" class="badge bg-primary-light mr-2"><i class="la la-edit"></i></a><a data-whatever="{{$row->id}}" class="badge bg-danger-light mr-2" onclick="deletitem(this)"><i class="la la-trash"></i></a></td>
</tr>
@endforeach