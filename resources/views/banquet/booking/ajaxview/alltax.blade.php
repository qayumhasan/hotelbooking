<thead>
<tr>
    <th scope="col">Manage</th>
    <th scope="col">Description</th>
    <th scope="col">Calculation On</th>
    <th scope="col">Based_on</th>
    <th scope="col">Rate</th>
    <th scope="col">Amount</th>
    <th scope="col">Effect</th>
</tr>
</thead>
<tbody>
@foreach($alldata as $data)
    <tr>
        <th scope="row">
            <button type="button" onclick="carttax(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$data->id}}" data-original-title=""><i class="lar la-edit"></i></button>
            <button type="button" onclick="carttaxdelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$data->id}}" data-original-title=""><i class="la la-trash"></i></button>
        </th>
        <td>{{$data->tax_description}}</td>
        <td>{{$data->calculation_on}}</td>
        <td>{{$data->based_on}}</td>
        <td>{{$data->tax_rate}}</td>
        <td>{{$data->tax_amount}}</td>
        <td>{{$data->tax_effect}}</td>
    </tr>
@endforeach
</tbody>