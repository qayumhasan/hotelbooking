@extends('accounts.master')
@section('title', 'Add Purchase | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
.form-control {
    height: 35px;
 
}
.noradious{
    border-radius:0px;
}
</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("d/m/Y");
@endphp
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
          
       
            <div class="col-md-12">
              
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Account Transection</h4>
                        </div>
                       <a href="{{route('admin.purchase.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Purchase</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.purchase.insert')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row">

                                        <div class="col-md-12">
                                        
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><label>Voucher Type:</label></td>
                                              
                                                    <td>   
                                                            
                                                        
                                                                
                                                                    <select name="" id="" class="form-control noradious">
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                        <option value="">--select--</option>
                                                                    </select>
                                                     
                                                     </td>

                                                     <td><label>Referance:</label></td>
                                                   <td>
                                                   
                                             
                                                        
                                                        
                                                        <input type="text" class="form-control noradious" name="">
                                                        
                                             
                                                   
                                                   </td>
                                                   <td><label>Branch:</label></td>
                                                    <td>

                                                
                                                        
                                                        
                                                        <input type="text" class="form-control noradious" name="">
                                                        
                                           
                                                    
                                                    
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Narration:</label></td>
                                                    <td colspan="5">
                                                    
                                        
                                                        
                                        
                                                            <textarea name="" class="form-control noradious"></textarea>
                                        
                                        
                                                    
                                                    </td>
                                                   
                                                </tr>
                                                <!-- <tr>
                                                 
                                                    <td >Larry the Bird</td>
                                                    <td>@twitter</td>
                                                </tr> -->
                                            </tbody>
                                            </table>
                                        </div>


















































                         
                                    <!-- <div class="col-md-4 text-left">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label text-right">Voucher Type:</label>
                                            <div class="col-sm-8">
                                                <select name="" id="" class="form-control noradious">
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                    <option value="">--select--</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Referance:</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control noradious" name="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label text-right">Branch:</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control noradious" name="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label  class="col-md-2">Narration:</label>
                                            <div class="col-md-10">
                                                <textarea name="" class="form-control noradious"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                   
                            </div>
                        </div>

                    </div>
                
                </div>
     
                    <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">All Transection Details</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="showallitem">
                                          
                                  
                                    
                                     
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
              
             </form>
            
        </div>
    </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
     $("#category_code").on('change', function(){
         var cate_id = $(this).val();
         //alert(cate_id);
         if(cate_id) {
             $.ajax({
                 url: "{{  url('/get/account/cateid/') }}/"+cate_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#account_code').empty();
                        $('#account_code').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#account_code').append('<option value="' + districtObj.id + '">'+districtObj.maincategory_name+'</option>');
                       });

                    }
             });
         } 
     });

    //  
    $("#account_code").on('change', function(){
         var accountid = $(this).val();
         if(accountid) {
             $.ajax({
                 url: "{{  url('/get/account/mainaccountcate/') }}/"+accountid,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#sub_account_codeone').empty();
                        $('#sub_account_codeone').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#sub_account_codeone').append('<option value="' + districtObj.id + '">'+districtObj.subcategory_nameone+'</option>');
                       });

                    }
             });
         } 
     });

    //  
    $("#sub_account_codeone").on('change', function(){
        alert("ok");
         var subcateone_id = $(this).val();
         if(subcateone_id) {
             $.ajax({
                 url: "{{  url('/get/account/subaccountcate/') }}/"+subcateone_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#sub_account_codetwo').empty();
                        $('#sub_account_codetwo').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#sub_account_codetwo').append('<option value="' + districtObj.id + '">'+districtObj.subcategory_nametwo+'</option>');
                       });

                    }
             });
         } 
     });



    // 
 });
</script>

<script type="text/javascript">
  $(document).ready(function() {
     $("#item_name").on('change', function(){
         var item_name = $(this).val();
         //alert(item_name);
         if(item_name) {
             $.ajax({
                 url: "{{  url('/get/item/all/') }}/"+item_name,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#unit').val(data.unit_name);
                        $('#unit_name').val(data.name);
                        $('#Qty').val(1);
                        $('.rate').val(data.rate);
                        $('.amount').val(data.rate);

                    }
             });
         } else {
             //alert('danger');
         }

     });
 });
</script>
<script>
$(document).ready(function() {
        $('#additemajax').click(function (e) {
            //alert("success");
            $('#err_item_name').html("");
            
        $.ajax({
            type: 'POST',
            url: "{{route('itementery.modalinsert.data')}}",
            data: $('#ajaxitementry').serializeArray(),
            success: function(data) {
                if(data=='success'){
                    getallitem();
                    $('.ajax_item_name').val("");
                    $('.short_name').val("");
                    $('.category_name').val("");
                    $('.ajaxunit_name').val("");
                    $('.rate').val("");
                    $('.min_level').val("");
                    $('#itementrymodal').modal('hide');
                   
                }else{

                    $('#err_item_name').html("");
                    
                }
            },

            error: function (err) {
                console.log(err);
                if(err.responseJSON.errors.item_name[0]){
                    $('#err_item_name').html(err.responseJSON.errors.item_name[0]);
                }
               
              
               
            }
          
        });
    });
});

</script>
<script>
$(document).ready(function() {
        $('#suupliradd').click(function (e) {
            $('#errtitle').html("");
            $('#errmobile').html("");
            $('#errname').html("");
            
        $.ajax({
            type: 'POST',
            url: "{{route('supplier.modalinsert.data')}}",
            data: $('#addsuppiler').serializeArray(),
            success: function(data) {
                if(data=='success'){
                    getallsuplier();
                    $('.title').val("");
                    $('.name').val("");
                    $('.print_name').val("");
                    $('.designation').val("");
                    $('.tin_vat_no').val("");
                    $('.addressline_one').val("");
                    $('.addressline_two').val("");
                    $('.city').val("");
                    $('.zip_code').val("");
                    $('.telephone').val("");
                    $('.contact_persion').val("");
                    $('.mobile').val("");
                    $('.email').val("");
                    $('#errtitle').html("");
                    $('#errmobile').html("");
                    $('#errname').html("");
                    $('#supllirmodal').modal('hide');
                   
                }else{
                    $('#errtitle').html("");
                    $('#errmobile').html("");
                    $('#errname').html("");
                }
            },

            error: function (err) {
                if(err.responseJSON.errors.title[0]){
                    $('#errtitle').html(err.responseJSON.errors.title[0]);
                }
                if(err.responseJSON.errors.mobile[0]){
                    $('#errmobile').html(err.responseJSON.errors.mobile[0]);
                }
                if(err.responseJSON.errors.name[0]){
                    $('#errname').html(err.responseJSON.errors.name[0]);
                }
              
               
            }
          
        });
    });
});

</script>
<!-- tax add -->
<script>
$(document).ready(function() {
    $('#addtax').on('click', function() {
      var tax_id=$("#tax_id").val();
      var calculation_on=$("#calculation_on").val();
      var based_on=$("#based_on").val();
      var tax_amount=$("#tax_amount").val();
      var taxrate=$(".taxrate").val();
      var invoice_no = $(".invoice").val();
      var taxupdate_id = $("#taxupdate_id").val();
     
      //alert(invoice_no);
        $.ajax({
            type: 'GET',
            url: "{{route('tax.insert.data')}}",
            //data: $('#tax_cal').serializeArray(),
            data: {
                tax_id:tax_id,
                calculation_on:calculation_on,
                based_on:based_on,
                tax_amount:tax_amount,
                taxrate:taxrate,
                invoice_no:invoice_no,
                taxupdate_id:taxupdate_id,
            },

            success: function(data) {
                $('#tax_id').val("");
                $('#calculation_on').val("");
                $('#based_on').val("");
                $("#tax_amount").val("");
                $(".taxrate").val("");
                $(".taxamount").val("");
                $("#taxupdate_id").val("");
                totalamount();
                alltaxfile();
               
            },

            error: function (err) {
               $('#tax_err').html(err.responseJSON.errors.tax_id[0]);
            }
          
        });
       

    });
});
</script>

<!-- tax include script-->

<script>
    function alltaxfile() {
      //alert("ok");
        var invoice = $("#invoice_no").val();
        //alert(invoice);
        $.post('{{ url('/get/alltax/data/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {
			   $('#taxdata').html(data);

            });
            
	}

	alltaxfile();
</script>

<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="tax_id"]').on('change', function(){
         var tax = $(this).val();
         //alert(tax);

         if(tax) {
             $.ajax({
                 url: "{{  url('/get/tax/data/') }}/"+tax,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                      //console.log(data.amount);
                        $("#calculation_on").val(data.data.calculation);
                        //$("#based_on").html("<option value=" + data.data.base_on+ ">"+ data.data.base_on +"</option>");
                        $("#based_on").val(data.data.base_on);
                        $('.tax_amount').val(data.amount);
                        if(data.data.base_on == 'amount'){
                            $('.taxrate').val(data.data.amount);
                        }else if(data.data.base_on == 'percentage'){
                            $('.taxrate').val(data.data.rate);
                        }
                       
                       
                      

                    }
             });
         } else {
                         
         }

     });
 });
</script>

<script>
    function taxDatadelete(el) {
        
       //alert(el.value);
        $.post('{{route('get.taxdata.delete')}}', {_token: '{{ csrf_token() }}',tax_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);

                // if (data) {
                //   iziToast.success({  message: 'Delete success ',
                //                           'position':'topCenter'
                //                       });
                // }

                alltaxfile();
                totalamount();
            });
           
   
	}
	taxDatadelete();
</script>

<!-- tax include script end -->



<script type="text/javascript">
  $(document).ready(function() {
     $('input[id="taxrate"]').on('keyup', function(){
         var newtax = $(this).val();
         var baseon = $("#based_on").val();
         var amount = $(".calculateamount").val();
         //alert(amount);

         if(newtax) {
             if(baseon=='amount'){
                $('.tax_amount').val(newtax);
             }else if(baseon=='percentage'){
                $('.tax_amount').val(parseFloat(amount*newtax/100).toFixed(2));
             }
           
         }

     });
 });
</script>
<script type="text/javascript">
  $(document).ready(function() {
     $('input[id="based_on"]').on('change', function(){
         var newtax = $("#taxrate").val();
         var baseon = $(this).val();
         var amount = $(".calculateamount").val();
         //alert(baseon);

         if(newtax) {
             if(baseon=='amount'){
                $('.tax_amount').val(newtax);
             }else if(baseon=='percentage'){
                $('.tax_amount').val(parseFloat(amount*newtax/100).toFixed(2));
             }
           
         }

     });
 });
</script>



<script type="text/javascript">
  $(document).ready(function() {
     $('input[name="qty"]').on('change', function(){
         var Qty = $('.qty').val();
         var rate = $('.rate').val();
         //alert(rate);

         if(Qty) {
                $('.amount').val(rate * Qty);
          
         } else {
             //alert('danger');
         }

     });
 });
</script>

<script>
$(document).ready(function() {
    $('#addnow').on('click', function() {
     
       var item_name = $("#item_name").val();
       var unit = $("#unit").val();
       var unit_name = $("#unit_name").val();
       var Qty = $("#Qty").val();
       var i_id = $("#i_id").val();
       var rate = $(".rate").val();
       var amount = $(".amount").val();
       var invoice_no = $(".invoice").val();
       //alert(invoice);

        $.ajax({
            type: 'GET',
            url: "{{route('itempurchese.insert.data')}}",
            //data: $('#option-choice-form').serializeArray(),
            data: {
                item_name:item_name,
                unit:unit,
                unit_name:unit_name,
                Qty:Qty,
                i_id:i_id,
                rate:rate,
                amount:amount,
                invoice_no:invoice_no
            },

            success: function(data) {
                
                $('#item_err').html('');
                $('#item_name').val("");
                $('#unit').val("");
                $('#unit_name').val("");
                $('#Qty').val("");
                $("#i_id").val("");
                $(".rate").val("");
                $(".amount").val("");
                alltaxfile();
                totalamount();
                alldatashow();
                mainshow();
               
              
            },

            error: function (err) {
                $('#item_err').html(err.responseJSON.errors.item_name[0]);
            }
          
        });
       

    });
});
</script>


<script>
    function alldatashow() {
      //alert("ok");
        var invoice = $("#invoice_no").val();
        //alert(invoice);
        $.post('{{ url('') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {
			   $('#showallitem').html(data);

            });
            
	}

	alldatashow();
</script>
<script>
    function totalamount() {
      //alert("ok");
        var invoice = $("#invoice_no").val();
        //alert(invoice);
        $.post('{{ url('get/total/amount/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {
                //console.log(data);
			   $('.totalamount').val(data.data);
               $('.dueamount').val(data.data);

            });
            
	}

	totalamount();
</script>
<script>
 $(document).ready(function() {
     $('input[name="paidamount"]').on('keyup', function(){
         var paidamount = $('.paidamount').val();
         var totalamount = $('.totalamount').val();
        

         if(paidamount) {
                $('.dueamount').val(totalamount - paidamount);
          
         }else {
            $('.dueamount').val(totalamount);
         }

     });
 });
</script>
<script>

function taxedit(el) {

        $.post('{{route('get.taxitem.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                  console.log(data.id);  
                $("#tax_id").val(data.tax_descripton).selected;
                $("#calculation_on").val(data.calculation);
                $("#based_on").val(data.based_on);
                $("#taxrate").val(data.rate);
                $(".tax_amount").val(data.amount);
                $("#taxupdate_id").val(data.id);

            });
   
   
	}
	taxedit();

</script>


<script>
    function cartDatadelete(el) {
        
       
        $.post('{{route('get.purchaseitem.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                $('#addtocartshow').html(data);

                if (data) {
                //   iziToast.success({  message: 'Delete success ',
                //                           'position':'topCenter'
                //                       });
                }


            });
     alldatashow();
     alltaxfile();
     totalamount();
   
	}
	cartheaderdelete();
</script>
<script>
    function cartdata(el) {
        
       //alert(el.value)
        $.post('{{route('get.itempurchase.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                            $("#item_name").val(data.item_name);
                            $("#i_id").val(data.id);
                            $("#unit_name").val(data.unit);
                            $("#Qty").val(data.qty);
                            $(".rate").val(data.rate);
                            $(".amount").val(data.amount);


            });
     alldatashow();
     totalamount();
   
	}
	cartheaderdelete();

</script>




                                      
@endsection
