

   
        @foreach($alldata as $key => $aldata)
        <tr class="remove_data text-left">
            <td>
                <label class="chech_container mb-4">
                    <input type="checkbox" name="delid[]" class="checkbox delid" value="{{$aldata->id}}" checked>
                    <span class="checkmark"></span>
                </label>
            </td>
            <td>{{$aldata->invoice_id}}</td>
            <td>{{$aldata->item_name}}</td>
            <td class="text-center">
                <input class="form-control form-control-sm" type="number" value="{{$aldata->qty}}" style=" width:40%; margin:0 auto;" id="{{$aldata->id}}" onchange="getPaxdata(this)">
            </td>
            <td>No</td>
            <td>
            <style>
      .badge {
        border: none;
      }
      </style>
            <!-- <button type="button" onclick="cartdata(this)" data-toggle="tooltip" title="" class="editcat badge bg-primary-light" value="{{$aldata->id}}" data-original-title="Remove"><i class="lar la-edit"></i></button> -->
            <button type="button" onclick="deleteitemkot(this)" data-toggle="tooltip" title="" class="badge bg-danger-light" value="{{$aldata->id}}" data-original-title="Remove"><i class="la la-trash"></i></button>
            </td>
        </tr>
        @endforeach
        
   

<!-- Modal -->










