@extends('stock.master')
@section('title', 'Physical Stock Create | '.$seo->meta_title)
@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");

@endphp
<style>
.form-control {
    height: 32px;

}
.card-header.d-flex.justify-content-between.asif {
    background-color: #c1b8b8;
}


button.editcat.badge.bg-primary-light {
    border: none;
}
button.badge.bg-danger-light {
    border: antiquewhite;
}

</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Physical Stock Input</h4>
                        </div>
                       <a href="{{route('admin.physicalstock.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Item</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.physicalstock.store')}}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <!-- <h4 class="card-title">Guest Registration</h4> -->
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Date:</label>
                                                <input type="text" class="form-control datepicker"  name="date" value="{{ $current }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Stock Center: <span style="color:red">*</span></label>
                                                <select name="stock_center" id="" class="form-control">
                                                    <option value="">--select--</option>
                                                    @foreach($allstock as $stock)
                                                    <option value="{{$stock->id}}">{{$stock->name}}</option>
                                                   @endforeach
                                                </select>
                                                
                                                @error('stock_center')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            
                              
                                <hr>
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Item Details</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            
                                                <label for="fname">Item Name: </label>
                                                <input type="text" class="form-control itemname"  name="itemname" list="brow" id="itemname"/>
                                                <input type="hidden" class="i_id"  name="i_id" id="i_id"/>
                                                <input type="hidden" class="invoice_no"  name="invoice_no" id="invoice_no" value="{{ $invoice_id }}"/>
                                                <datalist id="brow">
                                                    @foreach($allitem as $item)
                                                    <option value="{{$item->item_name}}">
                                                    @endforeach
                                                </datalist> 
                                                <div style="color:red" id="item_err"></div>

                                            </div>
                                        </div>
                                     
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fname">Qty:</label>
                                                <input type="number" class="form-control qty" name="qty" id="qty"/>
                                                <div style="color:red" id="item_qty_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fname">Unit:</label>
                                                <input type="text" class="form-control" id="unit_name"/>
                                                <input type="hidden" class="" id="unit"  />
                                                <div style="color:red" id="item_rate_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="fname">Add Item: </label>
                                                <input type="button" class="btn-sm btn-primary" value="Add" id="additem"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table" style="font-size:12px" id="allitemdata">
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fname">Remarks:</label>
                                                                <textarea name="narration" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fname">Number Of Item:</label>
                                                                <input type="text" class="form-control number_of_item" disabled>
                                                                <input type="hidden"  name="num_of_item" class="form-control number_of_item">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fname">Number Of Qty:</label>
                                                                <input type="text" class="form-control number_of_qty" disabled>
                                                                <input type="hidden" name="num_of_qty" class="form-control number_of_qty">
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
                        <div class="col-md-2">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Publish</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="is_active" id="customRadio-8" class="custom-control-input bg-primary" value="1" checked>
                                                <label class="custom-control-label" for="customRadio-8"> Active </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="is_active" id="customRadio-9" name="customRadio-10" class="custom-control-input bg-warning" value="0">
                                                <label class="custom-control-label" for="customRadio-9"> Deactive </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" class="total_pax_amount" value="0">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <button type="submit" class="btn btn-success">Submit</button>
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


<script>
    $(document).ready(function(){
        $('.itemname').on('change', function() {
            var item_name=$(this).val();
           
            if(item_name) {
                $.ajax({
                    url: "{{  url('/get/physicalitem/stock/all/') }}/"+item_name,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {

                            $('#unit').val(data.unit_name);
                            $('#unit_name').val(data.name);
                            $('#qty').val(1);
                        

                        }
                });
            } else {
                //alert('danger');
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#additem').on('click', function() {
        
        var invoice_no=$("#invoice_no").val();
        var itemname=$(".itemname").val();
        var qty=$("#qty").val();
        var unit_id=$("#unit").val();
        var unit_name=$("#unit_name").val();
        var i_id=$("#i_id").val();
        // alert(invoice_no);
        //alert(itemname);
            $.ajax({
                type: 'GET',
                url: "{{route('physicalstock.details.insert')}}",
                data: {
                    invoice_no:invoice_no,
                    itemname:itemname,
                    qty:qty,
                    unit_id:unit_id,
                    unit_name:unit_name,
                    i_id:i_id,
                },

                success: function(data) {
                    $('#allitemdata').empty();
                    getphysicalitem();
                    getphysicalitemqty();
                    $(".itemname").val("");
                    $("#qty").val("");
                    $("#unit").val("");
                    $("#unit_name").val("");
                    $("#i_id").val("");
                    //$('.alldataitem').append(data);
                
                },

                error: function (err) {
                //console.log(err.responseJSON.errors.itemname[0]);
                
                $('#item_err').html(err.responseJSON.errors.itemname[0]);
               
                }
            
            });
        

        });
    });
</script>

<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="menu_type"]').on('change', function(){
         var menutype= $(this).val();
         var geust_type= $("#guest_type").val();
            //alert(geust_type);
         if(menutype) {
             $.ajax({
                 url: "{{  route('get.menutype.price') }}",
                 type:"GET",
                 data: {
                    menutype:menutype,
                    geust_type:geust_type,
                    },
                 dataType:"json",
                 success:function(data) {
                        //console.log(data);
                        $("#price_per_pax").val(data);
                        $('#allamountsection').empty();
                        allamount();
                     }
             });
         } else {
            // alert('danger');
         }

     });

     $('select[name="guest_type"]').on('change', function(){
         var geust_type= $(this).val();
         var menutype= $("#menu_type").val();
           // alert(geust_type);
         if(menutype) {
             $.ajax({
                 url: "{{  route('get.geust_type.price') }}",
                 type:"GET",
                 data: {
                    menutype:menutype,
                    geust_type:geust_type,
                    },
                 dataType:"json",
                 success:function(data) {
                        //console.log(data);
                        $("#price_per_pax").val(data);
                     }
             });
         } else {
            // alert('danger');
         }

     });

     $('select[name="tax_description"]').on('change', function(){
        //alert("ok");
         var tax_des= $(this).val();
        
          //alert(tax_des);

         if(tax_des) {
             $.ajax({
                 url: "{{  route('get.banquettax.all') }}",
                 type:"GET",
                 data: {
                    tax_des:tax_des,
                    
                    },
                 dataType:"json",
                 success:function(data) {
                        //console.log(data);
                        $(".tax_calculation").val(data.calculation).selected;
                        $(".based_on").val(data.base_on).selected;
                        if(data.base_on == 'amount'){
                            $('.taxrate').val(data.amount);
                            $('.tax_amount').val(data.amount);

                        }else if(data.base_on == 'percentage'){
                            $('.taxrate').val(data.rate);
                            $('.tax_amount').val('');
                        }

                        $(".tax_effect").val(data.effect);
                     }
             });
         } else {
            
         }

     });

 });
</script>

<script>
    function getphysicalitem() {
      //alert("ok");
        var invoice_no = $("#invoice_no").val();
        //alert(invoice);
        $.post('{{ url('get/physicalstckitem/all/') }}/'+invoice_no, {_token: '{{ csrf_token() }}'},
            function(data) {
               // console.log(data);
			   $('#allitemdata').append(data);
              // $('.dueamount').val(data.data);

            });
            
	}

	getphysicalitem();
</script>
<!-- get quantity -->
<script>
    function getphysicalitemqty() {
      //alert("ok");
        var invoice_no = $("#invoice_no").val();
        //alert(invoice_no);
        $.post('{{ url('get/physicalstckitem/qty/') }}/'+invoice_no, {_token: '{{ csrf_token() }}'},
            function(data) {
              $(".number_of_item").val(data.total_item);
              $(".number_of_qty").val(data.total_qty);

            });
            
	}

	getphysicalitemqty();
</script>



<!-- delete item data -->
<script>
    function cartDatadelete(el) {
        
        //alert("ok");
        $.post('{{route('get.phycalstock.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                $('#allitemdata').empty();
                getphysicalitemqty();
                getphysicalitem();


            });
     
   
	}
	//cartDatadelete();
</script>
<!-- edit item data -->
<script>
    function cartdata(el) {
        
       //alert(el.value)
        $.post('{{route('get.physicalstockitem.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                            $(".itemname").val(data.item_name);
                            $("#i_id").val(data.id);
                            $(".qty").val(data.qty);
                            $("#unit_name").val(data.unit_name);
                            $("#unit").val(data.unit_id);
                            

            });
     
   
	}
	cartdata();

</script>
<!-- tax create -->













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