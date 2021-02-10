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
                       <a href="{{route('admin.itementry.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Item</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.banquet.store')}}" method="POST" enctype='multipart/form-data'>
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
                                                <select name="stock_id" id="" class="form-control">
                                                    <option value="">--select--</option>
                                                   
                                                </select>
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
                                                <input type="hidden" class="item_id"  name="item_id" id="item_id"/>
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
        var item_id=$("#item_id").val();
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
                    item_id:item_id,
                },

                success: function(data) {
                    $('#allitemdata').empty();
                    getphysicalitem();
                    $(".itemname").val("");
                    $("#qty").val("");
                    $("#unit").val("");
                    $("#unit_name").val("");
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
<!-- delete item data -->
<script>
    function cartDatadelete(el) {
        
        //alert("ok");
        $.post('{{route('get.phycalstock.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                $('#allitemdata').empty();
                getphysicalitem();


            });
     
   
	}
	//cartDatadelete();
</script>
<!-- edit item data -->
<script>
    function cartdata(el) {
        
       //alert(el.value)
        $.post('{{route('get.banquetitem.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                            $(".itemname").val(data.item_name);
                            $(".itemqty").val(data.qty);
                            $(".itemrate").val(data.rate);
                            $(".itemamount").val(data.amount);
                            $(".itemtax").val(data.tax).selected;
                            $(".bit_id").val(data.id);

            });
     
   
	}
	cartdata();

</script>
<!-- tax create -->
<script>
    $(document).ready(function() {
        $('#addtax').on('click', function() {
       //alert("ok");
      var booking_no=$("#booking_no").val();
      var tax_calculation=$(".tax_calculation").val();
      var based_on=$(".based_on").val();
      var tax_description=$(".tax_description").val();
      var taxrate=$(".taxrate").val();
      var tax_effect=$(".tax_effect").val();
      var tax_amount=$(".tax_amount").val();
      var btax_id=$(".btax_id").val();
      //alert(itemname);
        $.ajax({
            type: 'GET',
            url: "{{route('bunquet.inserttax.data')}}",
            data: {

                booking_no:booking_no,
                tax_calculation:tax_calculation,
                based_on:based_on,
                tax_description:tax_description,
                taxrate:taxrate,
                tax_amount:tax_amount,
                tax_effect:tax_effect,
                btax_id:btax_id,
               
               
            },

            success: function(data) {
            
                  $('#alltaxsection').empty();
                     alltax();
                     $('#allamountsection').empty();
                    allamount();
                  $(".tax_calculation").val("");
                  $(".tax_rate").val("");
                  $(".tax_amount").val("");
                  $(".tax_effect").val("");
                  $(".btax_id").val("");
                  //$('#taxsection').append(data);
               
            },

            error: function (err) {
               //console.log(err);
             
               $('#tax_rate_err').html(err.responseJSON.errors.taxrate[0]);
              
            }
          
        });
       

        });
    });
</script>

<script>

    function carttax(el) {
        //alert(el.value);
        $.post('{{route('get.banquettax.edit')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                            $(".tax_calculation").val(data.tax_calculation).selected;
                            $(".based_on").val(data.based_on);
                            $(".tax_description").val(data.tax_id).selected;
                            $(".taxrate").val(data.tax_rate);
                            $(".tax_amount").val(data.tax_amount);
                            $(".tax_effect").val(data.tax_effect);
                            $(".btax_id").val(data.id);
               


            });
     
   
	}
	carttax();
</script>
<script>
    function alltax() {
      //alert("ok");
        var booking_no = $("#booking_no").val();
        //alert(invoice);
        $.post('{{ url('get/banquettax/all/') }}/'+booking_no, {_token: '{{ csrf_token() }}'},
            function(data) {
               // console.log(data);
			   $('#alltaxsection').append(data);
              // $('.dueamount').val(data.data);

            });
            
	}

	alltax();
</script>

<script>
    function carttaxdelete(el) {
        
        //alert("ok");
        $.post('{{route('get.banquettax.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                $('#alltaxsection').empty();
                alltax();
                $('#allamountsection').empty();
                 allamount();
               


            });
     
   
	}
	carttaxdelete();
</script>
<script>
 $(document).ready(function() {
    $('#taxsec').on('keyup', function() {
      
      var based_on=$(".based_on").val();
      var rate=$("#taxsec").val();
      if(based_on=='amount'){
          $('.tax_amount').val(rate);
      }else{
        $('.tax_amount').val("");
      }
        });
    });
</script>

<script>

  $(document).ready(function() {
     $('select[name="category_id"]').on('change', function(){
         var cate_id= $(this).val();
        // var geust_type= $("#guest_type").val();
         //alert(cate_id);
         if(cate_id) {
             $.ajax({
                 url: "{{  route('get.banquet.categorytype') }}",
                 type:"GET",
                 data: {
                    cate_id:cate_id,
                    },
                 success:function(data) {
                        //console.log(data);
                        $("#caegoryitem").empty();
                        $("#caegoryitem").append(data);
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
        $('#addcateitem').on('click', function() {
        //alert("ok");
        var category_id=$("#category_id").val();
        var booking_no=$("#booking_no").val();
        var item_id = [];
        $("input[name='cate_item']:checked").each(function(){
            item_id.push(this.value);
        });

            $.ajax({
                type: 'GET',
                url: "{{route('bunquet.cateiteminsert.data')}}",
                data: {
                    category_id:category_id,
                    item_id:item_id,
                    booking_no:booking_no,
                },
               

                success: function(data) {
                    
                    $('#allcategoryitemsection').empty();
                    allcateitem();
                    $("#category_id").val("");
                    $("#item_id").val("");
                   
                
                },

                error: function (err) {
                //console.log(err.responseJSON.errors.itemname[0]);
                
                // $('#item_err').html(err.responseJSON.errors.itemname[0]);
                // $('#item_rate_err').html(err.responseJSON.errors.itemname[0]);
                // $('#item_qty_err').html(err.responseJSON.errors.itemname[0]);
                }
            
            });
        

        });
    });

</script>
<script>
    function allcateitem() {
      //alert("ok");
        var booking_no = $("#booking_no").val();
        //alert(invoice);
        $.post('{{ url('get/allcateitem/all/') }}/'+booking_no, {_token: '{{ csrf_token() }}'},
            function(data) {
               // console.log(data);
			   $('#allcategoryitemsection').append(data);
              // $('.dueamount').val(data.data);

            });
            
	}

	allcateitem();
</script>
<script>
    function categoryitemdelete(el) {
        
       // alert("ok");
        $.post('{{route('get.categoryitemdelete.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                $('#allcategoryitemsection').empty();
                allcateitem();

               


            });
     
   
	}
	//carttaxdelete();
</script>



<script>
    function allamount() {
      //alert("ok");
        var booking_no = $("#booking_no").val();
        var total_pax_amount = $(".total_pax_amount").val();
         
         //alert(total_pax_amount);
        $.post('{{ route('get.banquet.allamount') }}', {_token: '{{ csrf_token() }}',booking_no:booking_no,total_pax_amount:total_pax_amount},
            function(data) {
               // console.log(data);
			   $('#allamountsection').append(data);
              // $('.dueamount').val(data.data);

            });
            
	}

	allamount();
</script>


<script>
    $(document).ready(function() {
        $('.guarantee_pax').on('keyup', function() {
         var pax_price =$(".price_per_pax").val();
         var guarentee_price =$(this).val();
         //alert(pax_price);
            $(".total_pax_amount").val(pax_price * guarentee_price);
            $(".span_total_pax_amount").html("<p>"+ pax_price * guarentee_price +"</p>");
            $('#allamountsection').empty();
            allamount();
    
        

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