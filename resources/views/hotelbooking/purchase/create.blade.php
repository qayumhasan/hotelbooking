@extends('hotelbooking.master')
@section('title', 'Add Purchase | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
           
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Purchase</h4>
                        </div>
                       <a href="{{route('admin.ordercusition.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Purchase</span></i></button></a>
                    </div>
                </div>
              
                <div class="row">
                    
                    <div class="col-md-12">
                    
                        <div class="card shadow-sm shadow-showcase">
                            
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Invoice No: *</label>
                                            <input type="text" value="{{$invoice_id}}" class="form-control" disabled>
                                            
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Order No: *</label>
                                            <h6>011</h6>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Ref Invoice No: *</label>
                                            <input type="text" id="ref_invoice" name="ref_invoice" class="form-control" list="ref_in" placeholder="Reference Invoice" />
                                            <datalist id="ref_in">
                                                @foreach($allorderhead as $orderhead)
                                                <option value="{{$orderhead->invoice_no}}">{{$orderhead->invoice_no}}</option>
                                                @endforeach
                                            </datalist>
                                        
                                            <input type="hidden" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Supplier: *</label>
                                            <input type="text" name="supplier" class="form-control" list="allsup" placeholder="--select--" />
                                            <datalist id="allsup">
                                                @foreach($allsupplier as $supplier)
                                                <option value="{{$supplier->name}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </datalist>
                                          
                                            <input type="hidden" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Stock Center : *</label>
                                            <select name="stock-center" id="" class="form-control">
                                                <option value="">--select--</option>
                                                @foreach($allstock as $stock)
                                                <option value="{{$stock->id}}">{{$stock->name}}</option>
                                                @endforeach
                                            </select>
                                          
                                            <input type="hidden" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <form action="#" method="get" id="option-choice-form">
                        @csrf
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Item Name: *</label>
                                            <input type="text" id="item_name" name="item_name" class="form-control" list="allitem" placeholder="Item" />
                                            <input type="hidden" id="i_id" name="i_id"/>
                                            <datalist id="allitem">
                                             
                                                <option value=""></option>
                                           
                                            </datalist>
                                                <div style="color:red" id="item_err"></div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Unit: *</label>
                                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="unit"/>
                                            <input type="hidden" class="form-control" id="unit" name="unit" />
                                            <input type="hidden" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
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
                                            <button type="button" class="btn btn-primary" id="addnow">Add</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </form>
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
            <div class="col-sm-12">
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
                            <form action="" id="tax_cal">
                                 @csrf
                              <tr>
                                 <td>
                                   <select name="tax_id" class="form-control" id="tax_id">
                                        <option value="">--select--</option>
                                        @foreach($alltax as $tax)
                                        <option value="{{$tax->id}}">{{$tax->tax_description}}</option>
                                        @endforeach
                                   </select>
                                 </td>
                                 <td>
                                    <select name="calculation_on" id="calculation_on" class="form-control">
                                        <option value="">--select--</option>
                                    </select>
                                 </td>
                                 <td>
                                    <select name="based_on" id="based_on" class="form-control">
                                        <option value="">--select--</option>
                                    </select>
                                </td>
                                 <td>
                                    <input type="text" class="form-control taxrate">
                                 </td>
                                 <td class="">
                                 <input type="text" name="" id="tax_amount" class="form-control tax_amount" disabled value="0">
                                 <input type="hidden" name="tax_amount" class="tax_amount" >
                                 </td>
                                 <td contenteditable="true"><button type="button" class="btn-sm btn-success" id="addtax">Add</button></td>
                                 
                              </tr>
                              </form>
                           </tbody>
                        </table>
                        <table class="table table-bordered table-responsive-md table-striped text-center">
                           <thead>
                              <tr>
                                 <th></th>
                                 <th>Tax Name</th>
                                 <th>Calculation on</th>
                                 <th>Based On</th>
                                 <th>Effect</th>
                                 <th>Rate</th>
                                 <th>Amount</th>
                              </tr>
                           </thead>
                           <tbody id="taxdata">
                             
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
<!-- tax add -->
<script>
$(document).ready(function() {
    $('#addtax').on('click', function() {
      alert('ok');
        $.ajax({
            type: 'GET',
            url: "{{route('tax.insert.data')}}",
            data: $('#tax_cal').serializeArray(),

            success: function(data) {
                $('#item_err').html('');
                iziToast.success({  message: 'success ',
                                        'position':'topCenter'
                                    });
                $('#item_name').val("");
                $('#unit').val("");
                $('#unit_name').val("");
                $('#Qty').val("");
                $("#i_id").val("");
                $(".rate").val("");
                $(".amount").val("");

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











<!-- tax include script-->

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
                        $("#calculation_on").html("<option value=" + data.data.calculation+ ">"+ data.data.calculation +"</option>");
                        $("#based_on").html("<option value=" + data.data.base_on+ ">"+ data.data.base_on +"</option>");

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
      //alert('ok');
        $.ajax({
            type: 'GET',
            url: "{{route('itempurchese.insert.data')}}",
            data: $('#option-choice-form').serializeArray(),

            success: function(data) {
                $('#item_err').html('');
                iziToast.success({  message: 'success ',
                                        'position':'topCenter'
                                    });
               
                $('#item_name').val("");
                $('#unit').val("");
                $('#unit_name').val("");
                $('#Qty').val("");
                $("#i_id").val("");
                $(".rate").val("");
                $(".amount").val("");

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
    function cartDatadelete(el) {
        
       
        $.post('{{route('get.purchaseitem.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                $('#addtocartshow').html(data);

                if (data) {
                  iziToast.success({  message: 'Delete success ',
                                          'position':'topCenter'
                                      });
                }


            });
     alldatashow();
   
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
   
	}
	cartheaderdelete();

</script>

@endsection