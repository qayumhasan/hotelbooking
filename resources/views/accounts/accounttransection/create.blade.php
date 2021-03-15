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
                                                   
                                                        <select name="voucher" id="voucher_type" class="form-control noradious">
                                                            <option value="">--select--</option>
                                                            <option value="Cash Payment Voucher">Cash Payment Voucher</option>
                                                            <option value="Bank Payment Voucher">Bank Payment Voucher</option>
                                                            <option value="Fund Transfer Voucher">Fund Transfer Voucher</option>
                                                            <option value="Cash Receipt Voucher">Cash Receipt Voucher</option>
                                                            <option value="Bank Receipt Voucher">Bank Receipt Voucher</option>
                                                            <option value="A/C Receivable Journal Voucher">A/C Receivable Journal Voucher</option>
                                                            <option value="A/C Payble Journal Voucher">A/C Payble Journal Voucher</option>
                                                            <option value="Adjustment Journal Voucher">Adjustment Journal Voucher</option>
                                                            <option value="Acount Opening Voucher">Acount Opening Voucher</option>
                                                        </select>
                                                        @error('voucher')
                                                            <p style="color:red">{{ $message }}</p>
                                                        @enderror
                                                       
                                                       
                                                     </td>
                                                       

                                                     <td><label>Referance:</label></td>
                                                   <td>
                                                    <input type="text" class="form-control noradious" name="reference">
                                                   
                                                   </td>
                                                   <td><label>Cheque Referance:</label></td>
                                                    <td>
                                                        <input type="text" class="form-control noradious" name="cheque_reference">
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><label>Sourch Cash:</label></td>
                                                    <td colspan="5">
                                                        <input type="text" id="account_head_main" name="account_head_main" class="form-control noradious" list="ref_in" placeholder="Sourch Cash" />
                                                        <datalist id="ref_in">
                                                             @foreach($allchartofaccount as $account)
                                                            <option value="{{$account->desription_of_account}}">{{$account->desription_of_account}}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label>Account Head:</label></td>
                                                    <td colspan="5">
                                                         <input type="text" id="account_head" name="account_head" class="form-control noradious account_head" list="ref_inss" placeholder="Account Head" />
                                                        <datalist id="ref_inss">
                                                             @foreach($allchartofaccount as $account)
                                                            <option value="{{$account->desription_of_account}}">{{$account->desription_of_account}}</option>
                                                            @endforeach
                                                        </datalist>
                                                        <span style="color:red" id="accont_head_err"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td >
                                                        <label>Qty:</label>
                                                        <input type="checkbox" id="mainqty">
                                                    </td>
                                                    <td class="qty" style="display:none"> <input type="text" id="qty" name="qty"  class="form-control noradious" placeholder="Qty"></td>
                                                    <td class="qty" style="display:none"> <input type="text" id="price" name="price" class="form-control noradious" placeholder="Price"></td>
                                                    <td><label>Remarks:</label></td>
                                                    <td colspan="2">
                                                        <input type="text"  id="remarks" name="remarks" class="form-control noradious">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td >
                                                        <label>Sub Head:</label>
                                                        <input type="checkbox" id="mainsubheadone">
                                                    </td>
                                                 
                                                    <td class="subheadone" style="display:none">
                                                        <select name="subcategory_codeone" id="subcategory_codeone" class="form-control noradious">
                                                            <option value="">--Select--</option>
                                                            @foreach($allsubcategoryone as $subcate)
                                                            <option value="{{$subcate->subcategory_codeone}}">{{$subcate->subcategory_nameone}}</option>
                                                            @endforeach
                                                        </select>
                                                    
                                                    </td> 
                                                    <td >
                                                        <label>Sub Head-2:</label>
                                                        <input type="checkbox" id="mainsubheadtwo">
                                                        
                                                    </td>
                                                    <td class="subheadtwo" style="display:none"> 
                                                            <select name="subcategory_codetwo" id="subcategory_codetwo" class="form-control noradious">
                                                            <option value="">--Select--</option>
                                                            @foreach($allsubcategorytwo as $subcatetwo)
                                                            <option value="{{$subcatetwo->subcategory_codetwo}}">{{$subcatetwo->subcategory_nametwo}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
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
                                                            <input type="text"  class="form-control noradious" value="{{$invoice}}" disabled>
                                                            <input type="hidden" name="invoice" id="invoice" value="{{$invoice}}">
                                                            <input type="hidden" name="accounttransecti_id" id="accounttransecti_id" >
                                                        </div>
                                                    </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="fname">Voucher Date: *</label>
                                                                <input type="text" id="date" name="date" class="form-control noradious" value="{{$current}}">
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="staticEmail" class="col-form-label">Advice:</label>
                                                             
                                                                <input type="text" name="advice" class="form-control noradious" id="staticEmail" value="">
                                                                
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card shadow-sm shadow-showcase">
                                      
                                            <div class="card-body">
                                             
                                                <div class="row">
                                                      
                                                        <div class="col-md-12">
                                                             <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-3 col-form-label">Location:</label>
                                                                <div class="col-sm-9">
                                                                <input type="text" class="form-control noradious" id="location" name="location">
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label for="staticEmail" class="col-sm-5 col-form-label">Amount:</label>
                                                                <div class="col-sm-7">
                                                                <input type="text" class="form-control noradious" id="amount" name="amount" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                             <div class="form-group row">
                                                                <div class="col-sm-9">
                                                                    <select name="amount_cate" id="amount_cate" class="form-control noradious">
                                                                        <option value="Debit">Debit</option>
                                                                        <option value="Cradit">Cradit</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 ">
                                                               
                                                            <a id="additem" class="btn-sm" style="padding: 10px;background: red; color: #151515;">Add</a>
                                                                    
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
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
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


<!-- tax add -->
<script>
$(document).ready(function() {
    $('#additem').on('click', function() {

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
     
      //alert(invoice_no);
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
               
                
                alldata();
               
            },

            error: function (err) {
               $('#accont_head_err').html(err.responseJSON.errors.account_head[0]);
            }
          
        });
       

    });
});
</script>

<!-- tax include script-->

<script>
    function alldata() {
      //alert("ok");
        var invoice = $("#invoice").val();
        //alert(invoice);
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
	taxDatadelete();
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
	taxedit();

</script>

                                      
@endsection
