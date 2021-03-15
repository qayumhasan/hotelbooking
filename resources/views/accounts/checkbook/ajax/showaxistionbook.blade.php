<div class="col-md-1"></div>
<div class="col-md-6">
    <select name="status_show_book_id" class="form-control" id="status_show_book_id">
        @if($allbankin->count() > 0)
        @foreach($allbankin as $albnk)
        <option value="{{$albnk->book_id}}">Book ID:{{$albnk->book_id}} , Reg Date:{{$albnk->reg_date}}, Start No:{{$albnk->start_id}}, Check Qty:{{$albnk->check_qty}} ,Used:0, Remins:0</option>
        @endforeach
        @else
            <option value="">NO CheckBook Entry</option>
        @endif
    </select>
</div>
<div class="col-md-2">
    <button type="button" class="btn btn-primary" id="show_status">Show Status</button>
</div>

<script type="text/javascript">
  $(document).ready(function() {
     $("#show_status").on('click', function(){
       
        var status_show_book_id= $("#status_show_book_id").val();

        if(status_show_book_id) {
             $.ajax({
                 url: "{{  url('/get/account/showallstatus/bankentry/') }}/"+status_show_book_id,
                 type:"GET",
                 success:function(data) {

                    $("#showalldata").html(data);
                     
                }
             });
         } else {
           alert("You Have No Entry");
         }
   
            
           
       
    });
 });
</script>