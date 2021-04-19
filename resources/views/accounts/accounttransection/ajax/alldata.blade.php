<table class="table" style="font-size:12px">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Account Head</th>
     
      <th scope="col">Dabit Amount</th>
      <th scope="col">Credit Amount</th>
      <th scope="col">Remarks</th>
      <th scope="col">Manage</th>
    </tr>
  </thead>
  <tbody>
  @foreach($alldata as $key => $data)
    <tr>
      <th scope="row">{{++$key}}</th>
      <td>{{$data->account_head_details}}</td>
      
      <td>{{$data->dr_amount}}</td>
      <td>{{$data->cr_amount}}</td>
      <td>{{$data->remarks}}</td>
      <td>
      <style>
      .badge {
        border: none;
      }
      </style>
        <button type="button" onclick="Datadelete(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$data->id}}" data-original-title="Remove"><i class="la la-trash"></i></button>
      
      </td>
    </tr>
@endforeach
    
  </tbody>
</table>