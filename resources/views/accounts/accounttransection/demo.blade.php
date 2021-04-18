@extends('accounts.master')
@section('title', 'Create Account Transection| '.$seo->meta_title)
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
$current = date("m/d/Y");
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
                       <a href="{{route('admin.transection.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Transection</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.transection.create')}}" method="post">
                @csrf
                 <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                    <div class="form-group row">
                                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Voucher Type:</label>
                                        <div class="col-sm-6">
                                        <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="">
                                        </div>
                                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Date:</label>
                                        <div class="col-sm-2">
                                        <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Sourch Account:</label>
                                        <div class="col-sm-6">
                                        <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="">
                                        </div>
                                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Amount:</label>
                                        <div class="col-sm-2">
                                        <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="">
                                        </div>
                                    </div>
                                 
                                    <div class="form-group row">
                                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Account Head Type:</label>
                                        <div class="col-sm-6">
                                        <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="">
                                        </div>
                                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Davit/Cradit:</label>
                                        <div class="col-sm-2">
                                        <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-6">
                                            <button class="btn-sm btn-info">Add</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
            
                    </div>
                    <div class="col-md-4">
                         <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Narration</label>
                                        <textarea  class="form-control"> </textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Voucher</label>
                                      <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Reference</label>
                                      <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4">Advice</label>
                                      <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail4"></label>
                                         <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
   $('#voucher_type').on('change', function(){
       var voucher_type = $(this).val();
        
       if(voucher_type) {
           $.ajax({
               url: "{{  url('/get/admin/vouchertype/voucherno/all/') }}/"+voucher_type,
               type:"GET",
               dataType:"json",
               success:function(data) {
                   //console.log(data);
                    $(".newinvoice").val(data);
                    alldata();
                    
                }
           });
       } else {
           
       }

   });
});
</script>
<!-- voucher type wise  davit cradit -->

<script type="text/javascript">
$(document).ready(function() {
   $('#voucher_type').on('change', function(){
       var voucher_type = $(this).val();
    
       if(voucher_type=='Cash Payment Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit">Debit</option>');
       }else if(voucher_type=='Bank Payment Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit">Debit</option>');
       }
       else if(voucher_type=='Cash Receipt Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Cradit">Cradit</option>');
       }
       else if(voucher_type=='Bank Receipt Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Cradit">Cradit</option>');
       }
       else if(voucher_type=='AorC Receivable Journal Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit" selected>Debit</option> <option value="Cradit">Cradit</option>');
       } else if(voucher_type=='AorC Payble Journal Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit" >Debit</option> <option value="Cradit" selected>Cradit</option>');
       }
       else if(voucher_type=='Adjustment Journal Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit" >Debit</option> <option value="Cradit" selected>Cradit</option>');
       }
       else if(voucher_type=='Account Opening Voucher'){
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit" >Debit</option> <option value="Cradit" selected>Cradit</option>');
       }
       else{
        $('#amount_cate').empty();
        $('#amount_cate').append('<option value="Debit" >Debit</option> <option value="Cradit">Cradit</option>');
       }
        
    

   });
});
</script>

<!-- voucher type wise davit cradit  end-->





<!-- voucher type wise sourh account -->
<script type="text/javascript">
$(document).ready(function() {
   $('#voucher_type').on('change', function(){
       var voucher_type = $(this).val();
      
        
       if(voucher_type) {
           $.ajax({
               url: "{{  url('/get/admin/vouchertype/sourchaccount/') }}/"+voucher_type,
               type:"GET",
               dataType:"json",
               success:function(data) {
                   
                //console.log(data);
                        $('#account_head_main').empty();
                        $('#account_head_main').append(' <option>--select--</option>');
                        $.each(data,function(index,districtObj){
                          
                         $('#account_head_main').append('<option value="' + districtObj.code + '">'+districtObj.desription_of_account+'</option>');
                       });
                    
                }
           });
       } else {
           
       }

   });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
   $('#voucher_type').on('change', function(){
       var voucher_type = $(this).val();
      //alert("okkkkkk");
        
       if(voucher_type) {
           $.ajax({
               url: "{{  url('/get/admin/vouchertype/accountheadaccount/') }}/"+voucher_type,
               type:"GET",
               dataType:"json",
               success:function(data) {
                   
                        //console.log(data);
                        $('#account_head').empty();
                        $('#account_head').append(' <option>--select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#account_head').append('<option value="' + districtObj.code + '">'+districtObj.desription_of_account+'</option>');
                       });
                    
                }
           });
       } else {
           
       }

   });
});
</script>




<script>

$(document).ready(function() {
   $('#account_head_main').on('change', function(){
       var account_head = $(this).val();
        //alert(account_head);
       if(account_head) {
           $.ajax({
               url: "{{  url('/get/admin/accounthead/checkbok/all') }}/"+account_head,
               type:"GET",
               dataType:"json",
               success:function(data) {
                  
                        $('#cheque_reference').empty();
                        $('#cheque_reference').append(' <option value="">--select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#cheque_reference').append('<option value="' + districtObj.id + '">'+districtObj.check_number+'</option>');
                       });
                    alldata();
                    
                }
           });
       } else {
         
       }

   });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
   $('#changeVoucher').on('click', function(){
       var invoice =$("#invoice").val();
      
       if(invoice) {
           $.ajax({
               url: "{{  url('/get/admin/vouchertype/open/voucher/') }}/"+invoice,
               type:"GET",
               dataType:"json",
               success:function(data) {
                 
                    var item =document.querySelector('#voucher_type').disabled = false;
                    $("#plus_icon").hide();
                    alldata();
                    
                }
           });
       } else {
        
       }

   });
});
</script>


<script type="text/javascript">
$(document).ready(function() {
   $('#voucher_type').on('change', function(){
       
       var mainval=$(this).val();
       $("#voucher_name").val(mainval);
        var item =document.querySelector('#voucher_type').disabled = true;
        alldata();
        
      
   });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
   $('#voucher_type').on('change', function(){
       $("#plus_icon").show();

       var v_val=$(this).val();
       if(v_val=="Bank Receipt Voucher"){
        $("#check_r").show();
       }else if(v_val=="Bank Payment Voucher"){
        $("#check_r").show();
       }else{
           $("#check_r").hide();
       }
       alldata();
      
   });
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
     $("#mainqty").on('click', function(){
        
            if($(this).is(":checked")) {
                $(".qty").show();
            } else {
                $(".qty").hide();
            }
       
        });

      $("#mainsubheadone").on('click', function(){
        
        if($(this).is(":checked")) {
            $(".subheadone").show();
        } else {
            $(".subheadone").hide();
        }
   
         });
         $("#mainsubheadtwo").on('click', function(){
        
        if($(this).is(":checked")) {
            $(".subheadtwo").show();
        } else {
            $(".subheadtwo").hide();
        }
   
         });

         
        
 });
</script>

<script type="text/javascript">
$(document).ready(function() {
   $('#account_head_main').on('change', function(){
       var account_head = $(this).val();
       if(account_head) {
           $.ajax({
               url: "{{  url('/get/admin/sourchofaccount/all/') }}/"+account_head,
               type:"GET",
               dataType:"json",
               success:function(data) {
                    $("#sourch_cate_code").val(data.category_code);
                    $("#sourch_Accountcate_code").val(data.maincategory_code);
                    $("#sourch_subcate_codeone").val(data.subcategoryone_code);
                    $("#sourch_subcate_codetwo").val(data.subcategorytwo_code);
                }
           });
       } else {
           //alert('danger');
       }

   });
});
</script>


<script type="text/javascript">
$(document).ready(function() {
   $('#account_head').on('change', function(){
     var account_head = $(this).val();
     //alert(account_head);
       if(account_head) {
           $.ajax({
               url: "{{  url('/get/admin/headofaccount/all/') }}/"+account_head,
               type:"GET",
               dataType:"json",
               success:function(data) {
                    $("#acchead_cate_code").val(data.category_code);
                    $("#acchead_Accountcate_code").val(data.maincategory_code);
                    $("#acchead_subcate_codeone").val(data.subcategoryone_code);
                    $("#acchead_subcate_codetwo").val(data.subcategorytwo_code);
                   
                }
           });
       } else {
          // alert('danger');
       }

   });
});
</script>
<script>
$(document).ready(function() {
    $('#additem').on('click', function() {
        var vouchertype=$("#voucher_type").val();
        if(vouchertype == ''){
            alert("Please select Voucher Type");

        }else{
           // alert("ok");
      var subcategory_codetwo=$("#subcategory_codetwo").val();
      var subcategory_codeone=$("#subcategory_codeone").val();
      var remarks=$("#remarks").val();
      var qty=$("#qty").val();
      var price=$("#price").val();

      var account_head=$("#account_head").val();

      var account_head_main=$("#account_head_main").val();
      var location=$("#location").val();
      var amount=$("#amount").val();
      var amount_cate=$("#amount_cate").val();
      var invoice=$("#invoice").val();
      var date=$("#date").val();
      var accounttransecti_id=$("#accounttransecti_id").val();
    //   hidden value
      var sourch_cate_code=$("#sourch_cate_code").val();
      var sourch_Accountcate_code=$("#sourch_Accountcate_code").val();
      var sourch_subcate_codeone=$("#sourch_subcate_codeone").val();
      var sourch_subcate_codetwo=$("#sourch_subcate_codetwo").val();

      var acchead_cate_code=$("#acchead_cate_code").val();
      var acchead_Accountcate_code=$("#acchead_Accountcate_code").val();
      var acchead_subcate_codeone=$("#acchead_subcate_codeone").val();
      var acchead_subcate_codetwo=$("#acchead_subcate_codetwo").val();
      var hiddeninvoice=$("#hiddeninvoice").val();
      var cheque_reference=$("#cheque_reference").val();
     
      //alert(voucher_name);
        $.ajax({
            type: 'GET',
            url: "{{route('account.transection.insert')}}",
            //data: $('#tax_cal').serializeArray(),
            data: {

                subcategory_codetwo:subcategory_codetwo,
                subcategory_codeone:subcategory_codeone,
                remarks:remarks,
                qty:qty,
                price:price,
                account_head:account_head,
                account_head_main:account_head_main,
                location:location,
                amount:amount,
                amount_cate:amount_cate,
                invoice:invoice,
                date:date,
                accounttransecti_id:accounttransecti_id,

                sourch_cate_code:sourch_cate_code,
                sourch_Accountcate_code:sourch_Accountcate_code,
                sourch_subcate_codeone:sourch_subcate_codeone,
                sourch_subcate_codetwo:sourch_subcate_codetwo,

                acchead_cate_code:acchead_cate_code,
                acchead_Accountcate_code:acchead_Accountcate_code,
                acchead_subcate_codeone:acchead_subcate_codeone,
                acchead_subcate_codetwo:acchead_subcate_codetwo,
                hiddeninvoice:hiddeninvoice,
                cheque_reference:cheque_reference,
               



            },

            success: function(data) {
                $('#accont_head_err').html("");
                $('#subcategory_codetwo').val("");
                $('#subcategory_codeone').val("");
                $('#remarks').val("");
                $('#qty').val("");
                $('#price').val("");
                $('#account_head').val("");
                $('#location').val("");
                $('#amount').val("");
                $('#accounttransecti_id').val("");
                $('#account_head_main').val("");


                $('#sourch_cate_code').val("");
                $('#sourch_Accountcate_code').val("");
                $('#sourch_subcate_codeone').val("");
                $('#sourch_subcate_codetwo').val("");

                $('#acchead_cate_code').val("");
                $('#acchead_Accountcate_code').val("");
                $('#acchead_subcate_codeone').val("");
                $('#acchead_subcate_codetwo').val("");
                $('#cheque_reference').val("");
           
               
                
                alldata();
               
            },

            error: function (err) {
               $('#accont_head_err').html(err.responseJSON.errors.account_head[0]);
               $('#accont_amount').html(err.responseJSON.errors.amount[0]);
            }
          
        });
        }
    
      
       

    });
});
</script>

<!-- tax include script-->

<script>
    function alldata() {
      //alert("ok");
        var invoice = $("#invoice").val();
        // alert(invoice);
        $.post('{{ url('/get/alldatatransection/data/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {

			   $('#transectiondata').html(data);

            });
            
	}

	alldata();
</script>



<script>
    function Datadelete(el) {
       //alert(el.value);
        $.post('{{route('get.transection.delete')}}', {_token: '{{ csrf_token() }}',tran_id: el.value},
            function(data) {
              
                alldata();
            });
           
   
	}

</script>

<script>

function editdata(el) {
       
        $.post('{{route('get.alldatatransection.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
              // console.log(data)

                $("#location").val(data.location);
                $("#account_head").val(data.account_head_details);
                
                $("#account_head_main").val(data.account_head_details);

                $("#price").val(data.price);
                $("#accounttransecti_id").val(data.id);
                
                if(data.qty){
                    $(".qty").show();
                    $("#qty").val(data.qty);
                  

                    var checkeditem = document.querySelector('#mainqty');
                    console.dir(checkeditem.checked = true);
                  
                }else{
                    var checkeditem = document.querySelector('#mainqty');
                    console.dir(checkeditem.checked = false);
                    $(".qty").hide();
                   
                }
                if(data.subcategory_codeone){
                    var checkeditem = document.querySelector('#mainsubheadone');
                    console.dir(checkeditem.checked = true);
                    $(".subheadone").show();
                   $("#subcategory_codeone").val(data.subcategory_codeone).selected

                }else{
                    var checkeditem = document.querySelector('#mainsubheadone');
                    console.dir(checkeditem.checked = false);
                    $(".subheadone").hide();
                }
                if(data.subcategory_codetwo){
                    var checkeditem = document.querySelector('#mainsubheadtwo');
                    console.dir(checkeditem.checked = true);
                    $(".subheadtwo").show();
                    $("#subcategory_codetwo").val(data.subcategory_codetwo).selected
                    
                }else{
                    var checkeditem = document.querySelector('#mainsubheadtwo');
                    console.dir(checkeditem.checked = false);
                    $(".subheadtwo").hide();
                }
                $("#qty").val(data.qty);
                $("#remarks").val(data.remarks);
                
               
                if(data.dr_amount){
                    
                    $("#amount").val(data.dr_amount);
                    $("#amount_cate").val('Debit').selected;
                    

                }
                else{
                  
                   
                    $("#amount").val(data.cr_amount);
                    $("#amount_cate").val('Cradit').selected;

                }

          

            });
   
   
	}


</script>




<!--  -->

<script>
$(document).ready(function() {
   $('#account_head_main').on('change', function(){
       var source_account = $(this).val();
        //alert(source_account);
       if(source_account) {
           $.ajax({
               url: "{{  url('/get/admin/source_account/current/blance/') }}/"+source_account,
               type:"GET",
               dataType:"json",
               success:function(data) {
                  
                        $('#current_balance_sourch').html("Current Balance:" +data);
                    
                    
                }
           });
       }

   });
});
</script>

<script>
$(document).ready(function() {
   $('#account_head').on('change', function(){
       var head_account = $(this).val();
        //alert(head_account);
       if(head_account) {
           $.ajax({
               url: "{{  url('/get/admin/head_account/current/blance/') }}/"+head_account,
               type:"GET",
               dataType:"json",
               success:function(data) {
                  
                        $('#current_balance_head').html("Current Balance: " +data);
                    
                    
                }
           });
       }

   });
});
</script>

                                      
@endsection
