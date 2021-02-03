<thead>
<tr>
    <th scope="col">Manage</th>
    <th scope="col">Category Name</th>
    <th scope="col">ItemName</th>
    
    
</tr>
</thead>
<tbody>
    @foreach($allitem as  $item)
    <tr>
        <th scope="row">
         <button type="button" onclick="categoryitemdelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$item->id}}" data-original-title=""><i class="la la-trash"></i></button>
        </th>
        <td>{{$item->category_name}}</td>
        <td>{{$item->item_name}}</td>
    </tr>
    @endforeach

</tbody>