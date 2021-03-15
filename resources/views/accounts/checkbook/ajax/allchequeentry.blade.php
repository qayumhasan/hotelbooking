                                    
@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
@endphp
<div class="col-md-3">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Date:</label>
        <div class="col-sm-5">
        <input type="text" name="reg_date" id="reg_date" class="form-control datepicker" placeholder="Regitration Date" value="{{$current}}">

        <input type="hidden" name="book_id" id="book_id" value="{{$book_id}}">
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Start No:</label>
        <div class="col-sm-5">
        <input type="number" name="start_id" id="start_id" class="form-control" placeholder="Start No" value="">
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Quantity:</label>
        <div class="col-sm-5">
            <select name="check_qty" id="check_qty" class="form-control">
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
            </select>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group row">
            <div class="col-sm-6">
                <button type="button" id="show_btn" class="btn btn-info">Show New Leaves</button>
            </div>
            <div class="col-sm-6">
                <button type="button" id="save_btn" class="btn btn-info">Save New Books</button>
            </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group row">
            <div class="col-sm-2">
                Remarks:
            </div>
            <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="" id="remarks">
            </div>
    </div>
</div>
<div class="col-md-12 mt-4">
        <div class="table-responsive mt-4">
            <table class="table table-striped table-bordered" style="font-size:12px">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Cheque No:</th>
                        <th>Voucher No</th>
                        <th>Cheque Date</th>
                        <th>Cheque Amount</th>
                        <th>Delevery Date</th>
                        <th>status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody class="text-center" id="maindata">
                    
                </tbody>
            </table>
        </div>

</div>

<script>
$(document).ready(function() {
    $('#show_btn').on('click', function() {

                                                        
    var account_code=$("#account_code").val();
    var book_id=$("#book_id").val();
    var check_qty=$("#check_qty").val();
    var start_id=$("#start_id").val();
    //alert(book_id);
    if(start_id){
        $.ajax({
            type: 'GET',
            url: "{{route('account.checktransectiondetails.showitem')}}",
            data: {
                account_code:account_code,
                check_qty:check_qty,
                start_id:start_id,
               
            },

            success: function(data) {
                
                $("#maindata").html(data);
      
                
              
               
            },

            error: function (err) {
               $('#accont_head_err').html(err.responseJSON.errors.account_head[0]);
            }
          
        });
    }else{
        alert("Please Add Start Value");
    }
        
    
      
       

    });
});
</script>
<script>
$(document).ready(function() {
    $('#save_btn').on('click', function() {
     
      var remarks=$("#remarks").val();
      var check_qty=$("#check_qty").val();
      var start_id=$("#start_id").val();
      var reg_date=$("#reg_date").val();
      var book_id=$("#book_id").val();
      var account_code=$("#bank_code").val();
        //alert(account_code);
     if(start_id){
        $.ajax({
            type: 'GET',
            url: "{{route('account.checktransectiondetails.insert')}}",
            //data: $('#tax_cal').serializeArray(),
            data: {
                remarks:remarks,
                check_qty:check_qty,
                start_id:start_id,
                reg_date:reg_date,
                book_id:book_id,
                account_code:account_code,
            },

            success: function(data) {
                
                $('#remarks').val("");
                $('#start_id').val("");
               $("#allcheckbook").html("")
               


               
            },

            error: function (err) {
               $('#accont_head_err').html(err.responseJSON.errors.account_head[0]);
            }
          
        });
     }else{
         alert("Please Add Start Value");
     }
       
       

    });
});
</script>