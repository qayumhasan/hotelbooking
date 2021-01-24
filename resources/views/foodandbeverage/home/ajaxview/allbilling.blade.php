
@foreach($alldata as $key => $aldata)
<tr class="remove_data">
    <td>{{$aldata->invoice_id}}</td>
    <td>{{$aldata->item_name}}</td>
    <td>{{$aldata->qty}}</td>
    <td>yes</td>
    
    <td>
    <!-- <button type="button" onclick="cartdata(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$aldata->id}}" data-original-title="Remove"><i class="lar la-edit"></i></button> -->
    <button type="button" onclick="deleteitemkot(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$aldata->id}}" data-original-title="Remove"><i class="la la-trash"></i></button>
    </td>
</tr>
@endforeach