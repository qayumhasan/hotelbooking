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
                                                        <select name="" id="" class="form-control noradious">
                                                            <option value="">--select--</option>
                                                            <option value="">Cash Payment Voucher</option>
                                                            <option value="">Bank Payment Voucher</option>
                                                            <option value="">Fund Transfer Voucher</option>
                                                            <option value="">Cash Receipt Voucher</option>
                                                            <option value="">Bank Receipt Voucher</option>
                                                            <option value="">A/C Receivable Journal Voucher</option>
                                                            <option value="">A/C Payble Journal Voucher</option>
                                                            <option value="">Adjustment Journal Voucher</option>
                                                            <option value="">Acount Opening Voucher</option>
                                                           
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
                                                        <input type="text" id="" name="sourchcash" class="form-control noradious" list="ref_in" placeholder="Sourch Cash" />
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
                                                            <input type="hidden" name="invoice" id="invoice" value="{{$invoice}}" disabled>
                                                        </div>
                                                    </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="fname">Voucher Date: *</label>
                                                                <input type="text" name="date" class="form-control noradious" value="{{$current}}">
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
                                                                <input type="text" class="form-control noradious" id="amount" name="amount" value="">
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
                                                                
                                                            <button id="additem" class="btn-sm btn-primary">Add Record</button>
                                                                    
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
                                <div class="row" id="showallitem">
                                          
                                  
                                    
                                     
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
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
      var location=$("#location").val();
      var amount=$("#amount").val();
      var amount_cate=$("#amount_cate").val();
      var invoice=$("#invoice").val();
      var date=$("#date").val();
     
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
                location:location,
                amount:amount,
                amount_cate:amount_cate,
                invoice:invoice,
                date:date,
            },

            success: function(data) {
                $('#tax_id').val("");
              
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
