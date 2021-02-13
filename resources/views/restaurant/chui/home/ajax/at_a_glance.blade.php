@if(count($kotdetails) > 0)
@foreach($kotdetails as  $key=>$row)
<tr class="detete_at_aglance">
    <td scope="row">(Invoice NO & Date)</td>
    <td colspan="3" class="bg-secondary">{{$key}}</td>
    <td colspan="2" class="bg-secondary">{{$row->first()->kot_date}}</td>
    <td class="bg-secondary text-center">
        <a class="badge bg-danger-light mr-2 historydeletebtn" href="{{route('admin.restaurant.chui.menu.kot.history.delete',$key)}}"><i class="la la-trash"></i></a>
        <a data-toggle="modal" data-target=".printmodal" data-whatever="@getbootstrap" class="badge bg-info-light mr-2"><i class="las la-print"></i></a>
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


<div class="modal fade printmodal" id="printmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>



<script>
   $(document).ready(function(){
      $('.historydeletebtn').click(function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
         $.ajax({
            type: 'get',
            url: href,
            success: function(data) {
                document.querySelector('#atglance_room_no').innerHTML = 'Table No : '+table_no;
               $('.detete_at_aglance').remove();
               $('#kotatglancedetails').append(data);
               
            }
         });

      });
   })
</script>
