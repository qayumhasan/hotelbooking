
@foreach($alldata as $key => $aldata)
<tr class="remove_data">
    <td>{{++ $key}}</td>
    <td>{{$aldata->item_name}}</td>
    <td>{{$aldata->qty}}</td>
    <td>{{$aldata->rate}}</td>
    <td>{{$aldata->amount}}</td>
    <style>
      .badge {
        border: none;
      }
      </style>
    <td>
    <button type="button" onclick="cartdata(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$aldata->id}}" data-original-title="Remove"><i class="lar la-edit"></i></button>
    <button type="button" onclick="cartDatadelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$aldata->id}}" data-original-title="Remove"><i class="la la-trash"></i></button>
    </td>
</tr>
@endforeach