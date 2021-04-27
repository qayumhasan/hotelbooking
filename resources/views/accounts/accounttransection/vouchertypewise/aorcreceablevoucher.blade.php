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
                       <a href="{{route('admin.purchase.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Purchase</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.transection.create')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row">

                                        <div class="col-md-12">
                                        
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><label>Voucher Type:</label></td>
                                                    <td>   
                                                      
                                                        <select name="voucher" id="voucher_type" class="form-control noradious" disabled>
                                                            <option value="AorC Receivable Journal Voucher">A/C Receivable Journal Voucher</option>
                                                        </select>
                                                        @error('voucher')
                                                            <p style="color:red">{{ $message }}</p>
                                                        @enderror
                                                        <input type="hidden" id="voucher_name" name="voucher_name" value="AorC Payble Journal Voucher">
                                                     </td>
                                                     <td><span id="plus_icon" style="display:none"><a href="#" id="changeVoucher"><i class="fas fa-plus-square"></i></a></span></td>
                                                     <td></td>
                                                     <td><label>Referance:</label></td>
                                                   <td>
                                                    <input type="text" class="form-control noradious" name="reference">
                                                   </td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td><label>Narration:</label></td>
                                                    <td colspan="5">
                                                        <textarea name="narration" class="form-control noradious"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                             </div>
                            <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">

                                        <div class="form-group row">
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Sourch Account:</label>
                                            <div class="col-sm-6">
                                            <select id="account_head_main" name="account_head_main" class="form-control"> 

                                                <option value="">--Select--</option>
                                                @foreach($datasourche as $sorch_ofaccgg)
                                                                <option value="{{$sorch_ofaccgg->code}}">{{$sorch_ofaccgg->desription_of_account}}</option>
                                                            @endforeach

                                            </select>
                                                        <span style="font-size:12px;color:#776b6b" id="current_balance_sourch"></span>
                                                        <input type="hidden" value="" name="sourch_cate_code" id="sourch_cate_code">
                                                        <input type="hidden" value="" name="sourch_Accountcate_code" id="sourch_Accountcate_code">
                                                        <input type="hidden" value="" name="sourch_subcate_codeone" id="sourch_subcate_codeone">
                                                        <input type="hidden" value="" name="sourch_subcate_codetwo" id="sourch_subcate_codetwo">
                                            </div>
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Amount:</label>
                                            <div class="col-sm-2">
                                            <input type="number" class="form-control form-control-lg" id="amount" name="amount" placeholder="">
                                            <span style="color:red;font-size:10px;" id="accont_amount"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Account Head Type:</label>
                                            <div class="col-sm-6">
                                                    <select id="account_head" name="account_head" class="form-control"> 

                                                            <option value="">--Select--</option>
                                                            @foreach($account_head as $sorch_ofacc)
                                                            <option value="{{$sorch_ofacc->code}}">{{$sorch_ofacc->desription_of_account}}</option>
                                                            @endforeach
                                                     
                                                           

                                                    </select>
                                                        <span style="font-size:12px;color:#776b6b" id="current_balance_head"></span>

                                                        <span style="color:red" id="accont_head_err"></span>
                                                        <input type="hidden" value="" name="acchead_cate_code" id="acchead_cate_code">
                                                        <input type="hidden" value="" name="acchead_Accountcate_code" id="acchead_Accountcate_code">
                                                        <input type="hidden" value="" name="acchead_subcate_codeone" id="acchead_subcate_codeone">
                                                        <input type="hidden" value="" name="acchead_subcate_codetwo" id="acchead_subcate_codetwo">
                                            </div>
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Davit/Cradit:</label>
                                            <div class="col-sm-2">
                                                            <select name="amount_cate" id="amount_cate" class="form-control">
                                                                        <option value="Debit" selected>Debit</option>
                                                                        <option value="Cradit">Cradit</option>
                                                          
                                                                </select>
                                            </div>
                                         </div>
                                         <div class="form-group row">
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Remarks: </label>
                                            <div class="col-sm-6">
                                                 <input type="text" id="remarks" name="remarks"  class="form-control form-control-lg" placeholder="Remarks">
                                            </div>
                                            <div class="col-sm-4 text-right">
                                            <a id="additem" class="btn-sm" style="padding: 10px;background: #4788ff; color: #fff; cursor:pointer">Add</a>
                                                </div>
                                           
                                         </div>
                                         <div class="form-group row" id="check_r"  style="display:none">
                                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Cheque Referance: </label>
                                                <div class="col-sm-6">
                                                <select name="cheque_reference" id="cheque_reference" class="form-control">
                                                        <option value="">--select--</option>
                                                    </select>
                                                </div>
                                               
                                            </div>

                                         <div class="form-group row">
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">Qty:</label>
                                            <div class="col-sm-1">
                                            <input type="checkbox" id="mainqty">                                            
                                            </div>
                                          
                                                <div class="col-sm-2 text-left qty" style="display:none">
                                                    <input type="number" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Quantity">
                                                </div>
                                                <div class="col-sm-3 qty" style="display:none">
                                                    <input type="number" class="form-control form-control-lg" id="colFormLabelLg" placeholder="Price">
                                                </div>
                                            
                                         </div>
                                         <div class="form-group row">
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">SubHead:</label>
                                            <div class="col-sm-1">
                                            <input type="checkbox" id="mainsubheadone">                                         
                                            </div>
                                           
                                            <div class="col-sm-5 text-left subheadone" style="display:none">
                                                        <select name="subcategory_codeone" id="subcategory_codeone" class="form-control">
                                                            <option value="">--Select--</option>
                                                            @foreach($allsubcategoryone as $subcate)
                                                            <option value="{{$subcate->subcategory_codeone}}">{{$subcate->subcategory_nameone}}</option>
                                                            @endforeach
                                                        </select>
                                            </div>
                                            
                                         </div>
                                         <div class="form-group row">
                                            <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg text-right">SubHead-2:</label>
                                            <div class="col-sm-1">
                                            <input type="checkbox" id="mainsubheadtwo">                                       
                                            </div>
                                           
                                            <div class="col-sm-5 text-left subheadtwo" style="display:none">
                                                <select name="subcategory_codetwo" id="subcategory_codetwo" class="form-control">
                                                    <option value="">--Select--</option>
                                                    @foreach($allsubcategorytwo as $subcatetwo)
                                                    <option value="{{$subcatetwo->subcategory_codetwo}}">{{$subcatetwo->subcategory_nametwo}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                         </div>

                                    </div>


                              
                              
                             </div>
                    </div>
                    <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="card shadow-sm shadow-showcase">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="fname">Voucher No: *</label>
                                                            <input type="text"  class="form-control noradious newinvoice" value="{{$vno}}" disabled>
                                                            <input type="hidden" name="invoice" id="invoice" class="newinvoice" value="{{$vno}}">
                                                            <input type="hidden" name="hiddeninvoice" id="hiddeninvoice" class="hiddeninvoice" value="{{$invoice}}">
                                                            <input type="hidden" name="accounttransecti_id" id="accounttransecti_id" >
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="row" style="padding-bottom:15px">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fname">Voucher Date: *</label>
                                                                <input type="text"  id="date" name="date" class="form-control noradious datepicker" value="{{$current}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="" >Advice:</label>
                                                                <input type="text" name="advice" class="form-control noradious" id="staticEmail" value="">
                                                            </div>
                                                        </div>
                                                </div>
                                              
                                               
                                                   
                                            </div>
                                        </div>
                                        <div class="card shadow-sm shadow-showcase">
                                            <div class="card-body">
                                                <div class="row">
                                                <div class="col-md-12 text-right">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
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
                                <div class="row" id="transectiondata">
                                          
                                  
                                    
                                     
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
                        $('#ref_in').empty();
                        $('#ref_in').append(' <option>--select--</option>');
                        $.each(data,function(index,districtObj){
                          
                         $('#ref_in').append('<option value="' + districtObj.desription_of_account + '">'+districtObj.desription_of_account+'</option>');
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
                   
                        console.log(data);
                        $('#ref_inss').empty();
                        $('#ref_inss').append(' <option>--select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#ref_inss').append('<option value="' + districtObj.desription_of_account + '">'+districtObj.desription_of_account+'</option>');
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

@if(Session::has('accounthead'))
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="text-center printableAreasaveprintsectioninvoice">
            <div class="modal-header" >
                <h5 class="modal-title">INVOICE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row">
                        @if(Session::has('accounthead'))
                                    @php
                                        $accounthead =session('accounthead');
                                    
                                        $totalamount=0;
                                    @endphp
                        @endif
                    <div class="col-md-4">
                        <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" alt="" height="40px">
                        
                        <h6 style="margin-top:5px;font-size:10px">ChequeNo: {{ $accounthead['accountnew']->checque_reference }}<span id="ChequeNo"></span></h6>
                        
                    </div>
                    <div class="col-md-4">
                        <h3></h3>
                        <h6></h6>
                    </div>
                    <div class="col-md-4">
                        <h6 style="margin-top:5px;font-size:10px">VoucherNo: {{ $accounthead['accountnew']->voucher_no }}<span id="voucherno"></span></h6>
                        <h6>Date:{{ $accounthead['accountnew']->date }}<span class="date"></span></h6>
                        <p style="margin-top:2px;font-size:10px">ReferenceChecque:<span id="referenceno">{{ $accounthead['accountnew']->reference }}</span></p>
                    </div>
                    
                    <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row asif">
                                        <div class="col-md-12 text-left">
                                        Narration:{{ $accounthead['accountnew']->narration }} <span id="Narration"></span>
                                        </div>
                                        <div class="col-md-12" style="font-size:12px">
                                        <div class="card" id="">
                                        <div class="card-body">
                                            <table border="1" width="100%">
                                                <thead class="thead-light">
                                                    <tr>
                                                    <th scope="col">A/C CODE</th>
                                                    <th scope="col">HeadofAccount</th>
                                                    <th scope="col">Details</th>
                                                    <th scope="col">Dabit</th>
                                                    <th scope="col">Cradit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total_amount=0;
                                                        $accounts = $accounthead['accounthead'];
                                                    
                                                    @endphp
                                                    @foreach($accounts as $head)
                                                                    <tr>
                                                                    <th scope="row">{{$head->account_head_code}}</th>
                                                                    <td>{{$head->account_head_details}}</td>
                                                                    <td>{{$head->remarks}}</td>
                                                                    <td>{{$head->dr_amount}}</td>
                                                                    <td>{{$head->cr_amount}}</td>
                                                                </tr>
                                                                @php
                                                                    $total_amount=$total_amount + $head->dr_amount;
                                                                @endphp
                                                    
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <table  border="0"  width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>Total: {{$total_amount}}</td>
                                                    
                                                    </tr>
                                                
                                                </tbody>
                                            </table>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-12 row" style="margin-bottom:20px;font-size:10px">

                                                <table  width="100%">
                                                    <tbody>
                                                    
                                                    <tr>
                                                        <th scope="row">In Word: ( {{$numToWord->numberTowords($total_amount)}} )</th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td> Total: {{$total_amount}} | {{$total_amount}}</td>
                                                    </tr>
                                                                
                                                    </tbody>
                                                </table>
                                           
                                        </div>
                                        <br>
                                        <div class="col-md-12 row">
                                                <table  width="100%" style="font-size:12px">
                                                    <tbody>
                                                    
                                                    <tr>
                                                        <th scope="row">  <span style="border-top:2px solid #000; width:50%;"> PreparedBy:</span></th>
                                                        <td> <span style="border-top:2px solid #000; width:50%;"> CheckedBy:</span></td>
                                                        <td><span style="border-top:2px solid #000; width:50%;"> VerifiedBy:</span></td>
                                                        <td> <span style="border-top:2px solid #000; width:50%;"> ApproveBy:</span></td>
                                                        <td></td>
                                                    </tr>
                                                                
                                                    </tbody>
                                                </table>
                                     
                                       
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
                    
                        <div class="modal-footer ">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-primary savepritbtnareainvoice"><i class="fa fa-print"></i></button>
                                </div>
                        </div>
           
            </div>
         </div>
      </div>
   </div>
</div> 
@endif

@if(Session::has('accounthead'))
<script>
   $(document).ready(function() {
      $('#exampleModal').modal('show');
   });
</script>

 {{ Session::forget('accounthead')}}
@endif

<script>

    $(function() {
        $(".savepritbtnareainvoice").on('click', function() {
               // alert("ok");
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreasaveprintsectioninvoice").printArea(options);
            <?php session()->forget('accounthead'); ?>
        });
    });
</script>                                   
@endsection
