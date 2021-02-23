

<div class="col-md-12">
<div class="card">
<input type="hidden" name="table_id" class="table_id" value="{{$table_id}}">
<div class="card-body">
    <div class="table-responsive">
            
            <table class="table table-striped table-bordered" >
                <thead class="text-center">
                    <tr>
                        <th>Kot Date</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Complementory</th>
                    </tr>
                </thead>
                <tbody class="text-center ">
                @foreach($alldata as $data)
                    <tr class="remove_data">
                        <td>{{$data->kot_date}}</td>
                        <td>{{$data->item->item_name}}</td>
                        <td>{{$data->qty}}</td>
                        <td>{{$data->rate}}</td>
                        <td>{{$data->amount}}</td>
                        <td>@if($data->complement == NULL) -- @else {{$data->complement}} @endif</td>
                    </tr>
                @endforeach
            
                </tbody>
            </table>
          
            
        
    </div>
</div>
</div>
</div>