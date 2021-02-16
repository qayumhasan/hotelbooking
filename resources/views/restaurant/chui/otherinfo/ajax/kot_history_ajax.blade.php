<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Invoice No</th>
            <th scope="col">Date</th>
            <th scope="col">Table</th>
            <th scope="col">Waiter</th>
            <th scope="col">Cashier</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($kothistores))
        @foreach($kothistores as $key=>$row)
        <tr class="bg-secondary">
            <th scope="row">{{$key}}</th>
            <td>{{$row->first()->orderHead->created_at ?? ''}}</td>
            <td>{{$row->first()->tableName->table_no ?? ''}}</td>
            <td>{{$row->first()->waiter->employee_name ?? ''}}</td>
            <td>{{$row->first()->cashier->username ?? ''}}</td>

            <td>
                <a data-toggle="modal" data-target="#atglanceprintmodal" data-whatever="{{$key}}" class="badge bg-info-light mr-2 invoiceshow"><i class="las la-print"></i></a>
            </td>
        </tr>
        @foreach($row as $data)
        <tr>
            <th scope="row"></th>
            <td>{{$data->item->item_name ?? ''}}</td>
            <td>{{$data->qty}}</td>
            <td>{{$data->rate}}</td>
            <td>{{$data->amount}}</td>

            <td>12/15/2015</td>
        </tr>
        @endforeach
        <tr>
            <th scope="row"></th>
            <th class="text-primary">Total Quantity</th>
            <td class="text-primary">{{$row->first()->orderHead->number_of_qty??''}}</td>
            <td class="text-primary">Total Amount</td>
            <td class="text-primary">{{$row->first()->orderHead->total_amount??''}}</td>
            <td></td>
        </tr>

        @endforeach
        @endif
    </tbody>
</table>



<div class="modal fade" id="atglanceprintmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="printdata">
        
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.invoiceshow').click(function() {
      var modal = $(this);
      var data = modal.data('whatever');
      $('#printdata').empty();



      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'get',
        url: "{{ url('/admin/restaurant/chui/menu/get/print/invoice/item') }}/" + data,
        success: function(data) {

          $('#printdata').append(data);
        }
      });
    })
  });

</script>