

<thead>
<tr>
    <th scope="col">Manage</th>
    <th scope="col">ItemName</th>
    <th scope="col">Qty</th>
    <th scope="col">unit</th>
   
</tr>
</thead>
<tbody>
    @foreach($allitem as $item)
    <tr>
        <th scope="row">
         <button type="button" onclick="cartdata(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$item->id}}" data-original-title=""><i class="lar la-edit"></i></button>
         <button type="button" onclick="cartDatadelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$item->id}}" data-original-title=""><i class="la la-trash"></i></button>
        </th>
        <td>{{$item->item_name}}</td>
        <td>{{$item->qty}}</td>
        <td>{{$item->unit_name}}</td>
       
    </tr>
    @endforeach

</tbody>