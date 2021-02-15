
<div class="modal-content" id="deleteprehistory">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">KOT Details</h5>
    <h5 class="modal-title mx-auto" id="atglance_room_no">Room No : {{$kotdetailamounts->tableName->table_no ?? ''}}</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Kot Details</th>
          <th scope="col">Item Name</th>
          <th scope="col">Qty</th>
          <th scope="col">Rate</th>
          <th scope="col">Amount</th>
          <th scope="col">Complementary</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @if(count($kotdetails) > 0)
        @foreach($kotdetails as $key=>$row)
        <tr class="detete_at_aglance">
          <td scope="row">(Invoice NO & Date)</td>
          <td colspan="3" class="bg-secondary">{{$key}}</td>
          <td colspan="2" class="bg-secondary">{{$row->first()->kot_date}}</td>
          <td class="bg-secondary text-center">
            <a class="badge bg-danger-light mr-2 historydeletebtn" href="{{route('admin.restaurant.chui.menu.kot.history.delete',$key)}}"><i class="la la-trash"></i></a>

            <a data-toggle="modal" data-target="#atglanceprintmodal" data-whatever="{{$key}}"  class="badge bg-info-light mr-2 invoiceshow"><i class="las la-print"></i></a>

          </td>
        </tr>
        @foreach($row as $data)
        <tr class="detete_at_aglance">
          <th scope="row"></th>
          <td>{{$data->item->item_name ?? ' '}}</td>
          <td>{{$data->qty}}</td>
          <td>{{$data->rate}}</td>
          <td>{{$data->amount}}</td>
          <td>{{$data->complementitem->item_name ?? ' '}}</td>
        </tr>
        @endforeach
        @endforeach
        @endif

      </tbody>
    </table>
  </div>

</div>






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