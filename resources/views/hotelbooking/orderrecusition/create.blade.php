@extends('inventory.master')
@section('title', 'Create Order Recusition|'.$seo->meta_title)
@section('content')
<style>
.form-control {
    height: 32px;
}
</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="content-page">
    <div class="container-fluid">
    <form action="{{url('/get/item/order/submit/lol')}}" method="post">
                        @csrf
        <div class="row">
  
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Order Recusition</h4>
                        </div>
                       <a href="{{route('admin.ordercusition.index')}}"><i class="ri-add-fill"><span class="pl-1">All Order</span></i></a>
                    </div>
                </div>
              
                <div class="row">
                    
                    <div class="col-md-12">
                      
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h6 class="card-title">Invoice Id: {{$invoice_id}}</h6>
                                </div>
                                <div class="header-title">
                                    <h6 class="card-title">
                                        <input type="text" class="form-control datepicker" name="date" value="{{$current}}">
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Item Name: *</label>
                                            <input type="text" id="item_name" name="item_name" class="form-control" list="allitem" placeholder="Item" />
                                            <input type="hidden" id="i_id" name="i_id"/>
                                            <datalist id="allitem">
                                                @foreach($allitem as $item)
                                                <option value="{{$item->item_name}}"></option>
                                                @endforeach
                                            </datalist>
                                                <div style="color:red" id="item_err"></div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Unit: *</label>
                                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="unit"/>
                                            <input type="hidden" class="form-control" id="unit" name="unit" />
                                            <input type="hidden" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Qty: </label>
                                            <input type="number" class="form-control" id="Qty" name="qty" placeholder="Qty"/>
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
                            <div class="dots text-center" id="searchPreloader" style="display:none">
                                <img src="{{asset('public/uploads/preloader/preloader.gif')}}" width="25%" height="100px" alt="preloader"/>
                            </div>
                                <div class="row" id="showallitem">



                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                <div class="col-md-12">
                                         <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fname">Remarks: *</label>
                                                        <textarea class="form-control" name="remarks"/></textarea>
                                                        @error('branch_id')
                                                            <div style="color:red">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fname">Number Of Item: </label>
                                                        <input type="text" class="form-control num_of_item" placeholder="" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fname">Number Of Quantity: </label>
                                                        <input type="text" class="form-control num_of_qty" value="" disabled/>
                                                        <input type="hidden" class="num_of_item" name="num_of_item" value=""/>
                                                        <input type="hidden" class="num_of_qty" name="num_of_qty" value=""/>
                                                      
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
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                     
                                    </div>
                                </div>
                                <div class="card-body">
                                
                                </div>
                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                      
                                                <button type="submit" class="btn btn-success">Submit</button>
                                        
                                        </div>
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
        $('#searchPreloader').show();

         var i_id = $("#i_id").val();
         var item_name = $("#item_name").val();
         var unit = $("#unit").val();
         var qty = $("#Qty").val();
         var invoice_no = $("#invoice_no").val();
         var date = $("#date").val();
        
        $.ajax({
            type: 'GET',
            url: "{{url('/get/item/insert/lol')}}",
           
            data: {
                i_id:i_id,
                item_name:item_name,
                unit:unit,
                qty:qty,
                i_id:i_id,
                invoice_no:invoice_no,
                date:date,
            },

            success: function(data) {
                $('#item_err').html('');
                totalqty();
                $('#item_name').val("");
                $('#unit').val("");
                $('#unit_name').val("");
                $('#Qty').val("");
                $("#i_id").val("");

                $('#searchPreloader').hide();
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
        var invoice = $("#invoice_no").val();
        $.post('{{ url('/get/item/showlol/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {
			   $('#showallitem').html(data);

            });
            
	}

	alldatashow();
</script>

<script>
    function cartDatadelete(el) {
        
        $('#searchPreloader').show();
        $.post('{{route('get.item.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                $('#addtocartshow').html(data);
                totalqty();
                if (data) {
                    $('#searchPreloader').hide();
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


</script>

<script>
    function totalqty() {
      //alert("ok");
        var invoice = $("#invoice_no").val();
       // alert(invoice);
        $.post('{{ url('get/totalqty/orderrequ/') }}/'+invoice, {_token: '{{ csrf_token() }}'},
            function(data) {
                //console.log(data);
			   $('.num_of_qty').val(data.number_qty);
               $('.num_of_item').val(data.number_item);

            });
            
	}

	totalqty();
</script>

@endsection