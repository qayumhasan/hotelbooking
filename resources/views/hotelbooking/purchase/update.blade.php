@extends('inventory.master')
@section('title', 'Update Purchase | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
.form-control {
    height: 35px;
 
}
</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");
@endphp
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Purchase</h4>
                        </div>
                       <a href="{{route('admin.purchase.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Purchase</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.purchase.update',$edit->id)}}" method="post">
                @csrf
                <div class="row">
                    
                    <div class="col-md-12">
                    
                        <div class="card shadow-sm shadow-showcase">
                            
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Invoice No: *</label>
                                            <input type="text" value="{{$edit->invoice_no}}" class="form-control" disabled>
                                            
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Ref Invoice No: *</label>
                                            <input type="text" value="{{$edit->ref_invoice_no}}" class="form-control" name="ref_invoice">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Order No: </label>
                                            <input type="text" id="ref_invoice" name="order_no" class="form-control" list="ref_in" placeholder="Reference Invoice" value="{{$edit->order_no}}" />
                                            <datalist id="ref_in">
                                                @foreach($allorderhead as $orderhead)
                                                <option value="{{$orderhead->order_no}}" >{{$orderhead->order_no}}</option>
                                                @endforeach
                                            </datalist>
                                        
                                            <input type="hidden" class="invoice" name="invoice_no" value="{{$edit->invoice_no}}" id="invoice_no"/>
                                            <input type="hidden" name="id" value="{{$edit->id}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Date: </label>
                                            <input id="datepicker" type="text" class="form-control" name="tax_date" value="{{$edit->date}}"/>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Supplier: *</label>
                                            <select name="supplier" class="form-control">
                                                <option value="">--select--</option>
                                                @foreach($allsupplier as $supplier)
                                                <option value="{{$supplier->id}}" @if($edit->supplier_id == $supplier->id) selected @endif>{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Stock Center : *</label>
                                            <select name="stock_center" id="" class="form-control">
                                                <option value="">--select--</option>
                                                @foreach($allstock as $stock)
                                                <option value="{{$stock->id}}" @if($edit->stock_center == $stock->id) selected @endif>{{$stock->name}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Item Name: *</label>
                                            <input type="text" id="item_name" name="item_name" class="form-control" list="allitem" placeholder="Item" />
                                            <input type="hidden" id="i_id" name="i_id"/>
                                            <datalist id="allitem">
                                             
                                                @foreach($allitem as $item)
                                                <option value="{{$item->item_name}}">{{$item->item_name}}</option>
                                                @endforeach
                                           
                                            </datalist>
                                                <div style="color:red" id="item_err"></div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Unit: *</label>
                                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="unit"/>
                                            <input type="hidden" class="form-control" id="unit" name="unit" />
                                            <input type="hidden" name="invoice_no" value="{{$edit->invoice_no}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Qty: </label>
                                            <input type="number" class="form-control qty" id="Qty" name="qty" placeholder="Qty"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Rate: </label>
                                            <input type="text" class="form-control rate"  placeholder="Rate" disabled/>
                                            <input type="hidden" class="form-control rate" name="rate" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Amount: </label>
                                            <input type="text" class="form-control amount"  placeholder="Amount" disabled/>
                                            <input type="hidden" class="form-control amount" name="amount"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <div class="form-group">
                                            <button type="button" class="btn-sm btn-primary" id="addnow">Add</button>
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
                                    <h4 class="card-title">All Item</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="showallitem">
                                          
                                  
                                    
                                     
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Tax</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="table" class="table-editable">
                                    <span class="table-add float-right mb-3 mr-2">
                                
                                    </span>
                                    <table class="table table-bordered table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Taxt Name</th>
                                            <th>Calculation On</th>
                                            <th>Based On</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td>
                                            <select name="tax_id" class="form-control" id="tax_id">
                                                    <option value="">--select--</option>
                                                    @foreach($alltax as $tax)
                                                    <option value="{{$tax->id}}">{{$tax->tax_description}}</option>
                                                    @endforeach
                                            </select>
                                            <div style="color:red" id="tax_err"></div>
                                            </td>
                                            <td>
                                                <input type="hidden" name="tax_invoice" value="{{$edit->invoice_no}}">
                                                <input type="text" id="calculation_on" name="calculation_on" class="form-control" list="calculation" placeholder="--select--" />
                                                <datalist id="calculation">
                                                
                                                </datalist>
                                            </td>
                                            <td>
                                               <input type="text" id="based_on" name="based_on" class="form-control" list="allbase" placeholder="--select--" />
                                                <datalist id="allbase">
                                                <option value="amount">amount</option>
                                                <option value="percentage">percentage</option>
                                                </datalist>
                                            </td>
                                            <td>
                                                <input type="text" name="rate" class="form-control taxrate" id="taxrate">
                                            </td>
                                            <td class="">
                                            <input type="text" name="" id="tax_amount" class="form-control tax_amount" disabled value="0">
                                            <input type="hidden" name="tax_amount" class="tax_amount" >
                                            <input type="hidden" name="taxupdate_id" class="taxupdate_id" id="taxupdate_id">
                                            </td>
                                            <td contenteditable="true"><button type="button" class="btn-sm btn-primary" id="addtax">Add</button></td>
                                            
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table class="table table-bordered table-responsive-md table-striped text-center" id="taxdata">
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  

                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title"></h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="fname">Naration: *</label>
                                                <textarea class="form-control" name="narration" row="5">
                                                {{$edit->narration}}
                                                </textarea>
                                                
                                            </div>
                                        </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fname">Total Amount: *</label>
                                                    <input type="text" class="form-control totalamount" value="" disabled>
                                                    <input type="hidden" name="totalamount" class="form-control totalamount" value="{{$edit->total_amount}}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fname">Paid: *</label>
                                                    <input type="number" class="form-control paidamount" name="paidamount" value="{{$edit->payment}}">
                                                    
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- <input type="hidden" name="finalamount" class="finalamount">
                                        <input type="hidden" name="finalpaidamount" class="finalpaidamount">
                                        <input type="hidden" name="finaldueamount" class="finaldueamount"> -->
                                        <div class="col-md-12">
                                            <div>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
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
</div>
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
                        $("#calculation_on").val(data.data.calculation);
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
<!-- tax include script end -->

<script type="text/javascript">
  $(document).ready(function() {
     $('input[name="item_name"]').on('change', function(){
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
        $.post('{{ url('/get/itempurchase/data/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
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
         //$('.dueamount').val(totalamount - paidamount);
        

         if(paidamount) {
                $('.dueamount').val(totalamount - paidamount);
          
         }else {
            $('.dueamount').val(totalamount);
         }

     });
 });
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
<script>
    $('body').on('keydown','input,select,textarea',function(e){
    var self=$(this)
    ,form=self.parents('form:eq(0)')
    ,focusable
    ,next
    ;
    if(e.keyCode==13){
    focusable=form.find('input,a,select,button,textarea').filter(':visible');
    next=focusable.eq(focusable.index(this)+1);
    if (next.length){
    next.focus();
    } else{
    form.submit();
    }
    return false;
    }
    });
</script>
@endsection