@extends('hotelbooking.master')
@section('title', 'Order Recusition | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="content-page">
    <div class="container-fluid">
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
                    <form action="#" method="get" id="option-choice-form">
                        @csrf
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h6 class="card-title">Invoice Id: {{$edit->invoice_no}}</h6>
                                </div>
                                <div class="header-title">
                                    <h6 class="card-title">
                                        <input type="date" class="form-control" name="date" value="">
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fname">Item Name: *</label>
                                            <input type="text" id="item_name" name="item_name" class="form-control" list="allitem" placeholder="Item" />
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
                                            <button type="button" class="btn btn-primary" id="addnow">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    </div>
        <form action="{{route('orderhead.update')}}" method="post">
            @csrf
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
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Item Name</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                @foreach($allitem as $item)
                                                <li>{{$item->item_name}}</li>
                                                @endforeach
                                              
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$edit->id}}">
                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <button type="submit" class="btn btn-success">Update</button>
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
      // alert('ok');
        $.ajax({
            type: 'GET',
            url: "{{route('item.insert.data')}}",
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

                alldatashow();
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
        
        
       //alert(el.value);
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