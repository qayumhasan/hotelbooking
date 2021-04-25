@extends('inventory.master')
@section('title', 'Update Order Recusition|'.$seo->meta_title)
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
    <form action="{{route('admin.ordercusition.update')}}" method="post">
            @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Update Order Recusition</h4>
                        </div>
                       <a href="{{route('admin.ordercusition.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Order</span></i></button></a>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h6 class="card-title">Invoice Id: {{$edit->invoice_no}}</h6>
                                </div>
                                <div class="header-title">
                                    <h6 class="card-title">
                                        <input type="text" class="form-control datepicker" name="date" value="{{$edit->date}}">
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Item Name: *</label>
                                            <select id="item_name" name="item_name" class="form-control"> 
                                                <option value="">--select--</option>
                                                @foreach($allitem as $item)
                                                <option value="{{$item->id}}">{{$item->item_name}}</option>
                                                @endforeach
                                            </select>
                                                <div style="color:red" id="item_err"></div>
                                            
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Unit: *</label>
                                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="unit"/>
                                            <input type="hidden" class="form-control" id="unit" name="unit" />
                                            <input type="hidden" name="invoice_no" value="{{$edit->invoice_no}}" id="invoice_no"/>
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
                                                        <textarea class="form-control" name="remarks"/>{{$edit->remarks}}</textarea>
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
                                                        <input type="hidden" name="num_of_item"  value=""/>
                                                        <input type="hidden" name="num_of_qty"  value=""/>
                                                      
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
                                    <div class="row">
                                        <div class="col-md-12">
                                         
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$edit->id}}">
                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                          
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

<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="item_name"]').on('change', function(){
         var item_name = $(this).val();
         

         if(item_name) {
             $.ajax({
                 url: "{{  url('/get/item/all/orderrecu/') }}/"+item_name,
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
                $('#searchPreloader').hide();
               
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
                            $("#item_name").val(data.item_id).selected;
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


@if(Session::has('kotnewdata'))
<div class="modal fade" id="kotinvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kitchen Order List Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="invoice-card printableAreasaveprintsectioninvoice">
                    <style>
                        .invoice_item:hover {
                            background: gray;
                            color: white;
                            cursor: pointer;
                        }


                        .invoice-card {

                            padding: 10px 2em;
                            background-color: #fff;
                            border-radius: 5px;
                        }

                        .invoice-card>div {
                            margin: 5px 0;
                        }

                        .invoice-title {
                            flex: 3;
                        }

                        .invoice-title #date {
                            display: block;
                            margin: 8px 0;
                            font-size: 12px;
                        }

                        .invoice-title #main-title {
                            display: flex;
                            justify-content: space-between;
                            margin-top: 2em;
                        }

                        .invoice-title #main-title h4 {
                            letter-spacing: 2.5px;
                        }

                        .invoice-title span {
                            color: rgba(0, 0, 0, 0.4);
                        }

                        .invoice-details {
                            flex: 1;
                            border-top: 0.5px dashed grey;
                            border-bottom: 0.5px dashed grey;
                            display: flex;
                            align-items: center;
                        }

                        .invoice-table {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        .invoice-table thead tr td {
                            font-size: 12px;
                            letter-spacing: 1px;
                            color: grey;
                            padding: 8px 0;
                        }

                        .invoice-table thead tr td:nth-last-child(1),
                        .row-data td:nth-last-child(1),
                        .calc-row td:nth-last-child(1) {
                            text-align: right;
                        }

                        .invoice-table tbody tr td {
                            padding: 8px 0;
                            letter-spacing: 0;
                        }

                        .invoice-table .row-data #unit {
                            text-align: center;
                        }

                        .invoice-table .row-data span {
                            font-size: 13px;
                            color: rgba(0, 0, 0, 0.6);
                        }

                        .invoice-footer {
                            flex: 1;
                            display: flex;
                            justify-content: flex-end;
                            align-items: center;
                        }

                        .invoice-footer #later {
                            margin-right: 5px;
                        }

                        .btn#later {
                            margin-right: 2em;
                        }

                        .company_info {
                            font-size: 10px;
                            font-weight: normal;
                        }
                    </style>
                         @if(Session::has('kotnewdata'))
                                @php
                                    $kotnewdata =session('kotnewdata');
                                    $totalamount=0;
                                @endphp
                            @endif
                    <div class="invoice-title">
                        <div id="main-title">
                            <h4>INVOICE</h4>
                            <span>#</span>
                        </div>

                        <span id="date">{{ $current }}</span>
                    </div>

                    <div class="invoice-details">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <td>Invoice No</td>
                                    <td>Item</td>
                                    <td>Unit</td>
                                    <td>Qty</td>
                               
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                          
                            @foreach($kotnewdata as $kdata)
                                @foreach($kdata as $row)
                                    <tr>
                                        <td>{{$row->invoice_no}}</td>
                                        <td>{{$row->item_name}}</td>
                                        <td>{{$row->unitname->name}}</td>
                                        <td>{{$row->qty}}</td>
                                    <tr>
                                @endforeach
                      
                            @endforeach
                            
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                       
                    </div>
             

                </div>
            </div>
            <div class="modal-footer">
                <div class="invoice-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary mr-4" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-outline-primary savepritbtnareainvoice">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@if(Session::has('kotnewdata'))
<script>
   $(document).ready(function() {
      $('#kotinvoice').modal('show');
   });
</script>
{{session()->forget('kotnewdata')}}
@endif

<script>
    $(function() {
        $(".savepritbtnareainvoice").on('click', function() {
                alert("ok")
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableAreasaveprintsectioninvoice").printArea(options);
            <?php session()->forget('kotnewdata'); ?>
        });
    });
</script>
@endsection