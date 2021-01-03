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
                                            <h6>{{$invoice_id}}</h6>
                                            
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
                                            <select name="" id="" class="form-control">
                                                <option value="">--select--</option>
                                                @foreach($allorderhead as $orderhead)
                                                <option value="{{$orderhead->invoice_no}}">{{$orderhead->invoice_no}}</option>
                                                @endforeach
                                            </select>
                                          
                                            <input type="hidden" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Supplier: *</label>
                                            <select name="" id="" class="form-control">
                                            <option value="">--select--</option>
                                                @foreach($allsupplier as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                          
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
                        @csrfs
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
                                            <input type="number" class="form-control" id="Qty" name="qty" placeholder="Qty"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fname">Rate: </label>
                                            <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Amount: </label>
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount"/>
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
                                <div class="row" >
                                            <!--  -->
                                    <div class="col-md-12">
                  
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable" class="table data-table table-striped table-bordered" >
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Invoice No</th>
                                                            <th>Item ID</th>
                                                            <th>Item Name</th>
                                                            <th>Unit</th>
                                                            <th>Qty</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                
                                                      
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">Number Of Item: </label>
                                                        <input type="text" class="form-control" placeholder="" value="5" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">Number Of Quantity: </label>
                                                        <input type="text" class="form-control" placeholder="" value="8" disabled/>
                                                       
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fname">Remarks: *</label>
                                                            <textarea class="form-control" name="remarks"/></textarea>
                                                            @error('branch_id')
                                                                <div style="color:red">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                             </div>
                                        </div>
                                    </div>
                                    
                                     
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
                        $('#rate').val(data.rate);
                        $('#amount').val(data.rate);

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
         var qtyall = $(this).val();
        // alert(qtyall);

         if(qtyall) {
             $.ajax({
                 url: "{{  url('/get/item/all/') }}/"+item_name,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                        $('#amount').val(data.rate);
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
    $('#addnow').on('click', function() {
      // alert('ok');
        $.ajax({
            type: 'GET',
            url: "{{route('itempurchese.insert.data')}}",
            data: $('#option-choice-form').serializeArray(),

            success: function(data) {
                $('#item_err').html('');
                iziToast.success({  message: 'success ',
                                        'position':'topCenter'
                                    });
                //  document.getElementById('cartdatacount').innerHTML = data.count;
                //  document.getElementById('checkoutid').innerHTML = data.count;
                $('#item_name').val("");
                $('#unit').val("");
                $('#unit_name').val("");
                $('#Qty').val("");
                $("#i_id").val("");

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
        $.post('{{ url('/get/item/show/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {
			   $('#showallitem').html(data);

            });
            
	}

	alldatashow();
</script>

<script>
    function cartDatadelete(el) {
        
       
        $.post('{{route('get.item.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
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
        $.post('{{route('get.item.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                            $("#item_name").val(data.item_name);
                            $("#i_id").val(data.id);
                            $("#unit").val(data.unit);
                            $("#unit_name").val(data.name);
                            $("#Qty").val(data.qty);


            });
     alldatashow();
   
	}
	cartheaderdelete();

</script>

@endsection