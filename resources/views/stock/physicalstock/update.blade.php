@extends('banquet.master')
@section('title', 'Booking Create | '.$seo->meta_title)
@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");
$time = date("h:i");
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
                            <h4 class="card-title">Booking Update</h4>
                        </div>
                       <a href="{{route('admin.banquet.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Item</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.banquet.update',$edit->id)}}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Guest Registration</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Title:<span style="color:red">*</span></label>
                                                <select name="title" class="form-control" id="">
                                                    <option value="Mr." @if($edit->title =='Mr.') selected @endif>Mr.</option>
                                                    <option value="Miss." @if($edit->title =='Miss.') selected @endif>Miss.</option>
                                                    <option value="M/S." @if($edit->title =='M/S.') selected @endif>M/S.</option>
                                                    <option value="MS." @if($edit->title =='MS.') selected @endif>Ms.</option>
                                                    <option value="Mrs." @if($edit->title =='Mrs.') selected @endif>Mrs.</option>
                                                    <option value="Dr." @if($edit->title =='Dr.') selected @endif>Dr.</option>
                                                </select>
                                                <input type="hidden" name="id" value="{{$edit->id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Guest Name: <span style="color:red">*</span></label>
                                                <input type="text" class="form-control guest_name"  name="guest_name" placeholder="Guest Name" value="{{$edit->guest_name}}"/>
                                                @error('guest_name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Print Name: <span style="color:red">*</span></label>
                                                <input type="text" class="form-control short_name"  name="print_name" placeholder="Print Name" value="{{$edit->print_name}}"/>
                                                @error('print_name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Company Name: </label>
                                                <input type="text" class="form-control"  name="company_name" placeholder="Company Name" value="{{$edit->company_name}}"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Address: </label>
                                                <input type="text" class="form-control"  name="address" placeholder="Address" value="{{$edit->address}}"/>
                                                @error('address')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">City:</label>
                                                <input type="text" class="form-control" name="city" placeholder="City" value="{{$edit->city}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Mobile:<span style="color:red">*</span></label>
                                            <Input type="text" name="mobile" class="form-control"  placeholder="Mobile" value="{{$edit->mobile}}">
                                                @error('mobile')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">email:</label>
                                                <Input type="text" name="email" class="form-control"  placeholder="email" value="{{$edit->email}}">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Details</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Booking No: *</label>
                                                <h5>{{$edit->booking_no}}</h5>
                                                <input type="hidden" value="{{$edit->booking_no}}" id="booking_no" name="booking_no">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Venue Name:</label>
                                                <select name="veneue_id" id="" class="form-control">
                                                    @foreach($allvanue as $newvenue)
                                                    <option value="{{$newvenue->id}}" @if($edit->veneue_id == $newvenue->id) selected @endif>{{ $newvenue->venue_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('veneue_name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Booking For: *</label>
                                                <select name="booking_for" id="" class="form-control">
                                                    @foreach($bookingfor as $booking)
                                                    <option value="{{ $booking->booking_for }}" @if($edit->booking_for == $booking->booking_for) selected @endif>{{ $booking->booking_for }}</option>
                                                    @endforeach
                                                </select>
                                                @error('booking_for')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                                
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Booking Date: </label>
                                                <input type="text" class="form-control datepicker"  name="booking_date"  value="{{$edit->booking_date}}"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Date of Function From : </label>
                                                <input type="text" class="form-control datepicker"  name="date_of_function_form" value="{{$edit->date_of_function_form}}"/>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Function Date To:</label>
                                            <Input type="text" name="date_of_function_to" class="form-control datepicker" value="{{$edit->date_of_function_to}}">
                                            @error('mobile')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Type of Function:</label>
                                                <Input type="text" name="type_of_function" class="form-control"  placeholder="Type of Function" value="{{$edit->type_of_function}}">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Any ReMarks:</label>
                                                <Input type="text" name="remarks" class="form-control"  placeholder="Marks" value="{{$edit->remarks}}">
                                            <!-- <textarea name="remarks" id="" class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Pax Details</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Menu Type: *</label>
                                                <select name="menu_type" class="form-control" id="menu_type">
                                                    <option value="">--select--</option>
                                                    @foreach($allmenutype as $menutype)
                                                        <option value="{{$menutype->id}}" @if($edit->menutype == $menutype->id) selected @endif>{{$menutype->menutype_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('menu_type')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Guest Type:</label>
                                                <select name="guest_type" id="guest_type" class="form-control">
                                                    <option value="1" @if($edit->menu_type == 1) selected @endif>Individual</option>
                                                    <option value="2" @if($edit->menu_type == 2) selected @endif>Corporate</option>
                                                    <option value="3" @if($edit->menu_type == 3) selected @endif>NGO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Price Per Pax: </label>
                                                <input type="text" class="form-control price_per_pax"  name="price_per_pax" id="price_per_pax" placeholder="Price Per Pax" value="{{$edit->price_per_pax}}"/>
                                                @error('price_per_pax')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Guarantee Pax: </label>
                                                <input type="text" class="form-control guarantee_pax"  name="guarantee_pax" placeholder="Guarantee Pax" value="{{$edit->guarantee_pax}}"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Welcome Board : </label>
                                                <input type="text" class="form-control"  name="welcome_board" placeholder="Welcome Board" value="{{$edit->welcome_board}}"/>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">No of Rooms:</label>
                                                <input type="text" name="no_of_rooms" class="form-control" placeholder="No of Rooms" value="{{$edit->no_of_rooms}}">
                                            
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
                                                <input type="hidden" class="bit_id"  name="bit_id"/>
                                                <datalist id="brow">
                                                    @foreach($allitem as $item)
                                                    <option value="{{$item->item_name}}">
                                                    @endforeach
                                                </datalist> 
                                                <div style="color:red" id="item_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Tax(Y\N): </label>
                                                <select name="item_tax"  class="form-control itemtax" id="itemtax">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Qty: </label>
                                                <input type="number" class="form-control itemqty"  name="itemqty" />
                                                <div style="color:red" id="item_qty_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Rate: </label>
                                                <input type="text" class="form-control itemrate"  name="itemrate" />
                                                <div style="color:red" id="item_rate_err"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Amount: </label>
                                                <input type="text" class="form-control itemamount"  name="" value="" disabled/>
                                                <input type="hidden" class="itemamount"  name="itemamount"/>
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

                                <!-- done -->
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Tax Details</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fname">Tax Description: </label>
                                                <select name="tax_description" class="form-control tax_description" id="tax_description">
                                                    <option >--select--</option>
                                                    @foreach($alltax as $tax)
                                                    <option value="{{$tax->id}}">{{$tax->tax_description}}</option>
                                                    @endforeach
                                                </select>
                                                <div style="color:red" id="tax_description_err" ></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Calculation On: </label>
                                                <select name="tax_calculation" id="tax_calculation" class="form-control tax_calculation">
                                               
                                                    @foreach($alltax->unique('calculation') as $tax)
                                                        <option value="{{$tax->calculation}}">{{$tax->calculation}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Based On: </label>
                                                <input type="text" class="form-control based_on"  name="based_on" list="taxbrow" id="based_on"/>
                                                <input type="hidden" class="tax_effect" name="tax_effect" id="tax_effect"/>
                                                <datalist id="taxbrow">
                                                    <option value="percentage">
                                                    <option value="amount">
                                                </datalist> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Rate: </label>
                                                <input type="text" class="form-control taxrate"  name="taxrate" id="taxsec"/>
                                                <input type="hidden" class="btax_id"  name="btax_id" />
                                                <div style="color:red" id="tax_rate_err"> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Amount: </label>
                                                <input type="text" class="form-control tax_amount" disabled/>
                                                <input type="hidden" class="tax_amount" name="tax_amount"/>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="fname">Add Item: </label>
                                                <input type="button" class="btn-sm btn-primary" value="addtax" id="addtax"/>
                                            </div>
                                        </div>
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table" style="font-size:10px;" id="alltaxsection">
                                                           
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Select Menu</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fname">Category: </label>
                                               <select name="category_id" id="category_id" class="form-control">
                                                    <option value="">--Select--</option>
                                                    @foreach($allcategory as $category)
                                                     <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                               </select>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col-md-1"></div>
                                            <div class="col-md-5">
                                                <div class="card shadow-sm shadow-showcase">
                                                    <div class="card-header d-flex justify-content-between">
                                                        <div class="header-title">
                                                            <h4 class="card-title">Items</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" id="caegoryitem">
                                                       

                                                    </div>
                                                </div>
                                            </div>
                                         <!--  -->
                                         <div class="col-md-3 mt-4">
                                            <button type="button" class="btn-sm btn-primary" id="addcateitem">Add Item</button>
                                         </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="row">
                                    <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table" style="font-size:10px;" id="allcategoryitemsection">
                                                           
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-header d-flex justify-content-between asif">
                                    <div class="header-title">
                                        <h4 class="card-title">Total</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formFileSm" class="form-label">File Input:</label>
                                            <input class="" id="formFileSm" type="file" name="pdf">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table" style="font-size:10px;" >
                                                           
                                                            <tbody id="allamountsection">
                                                           
                                                               
                     

                                                            </tbody>
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
                                                <input type="radio" name="is_active" id="customRadio-8" class="custom-control-input bg-primary" value="1" @if($edit->is_active == 1) checked @endif>
                                                <label class="custom-control-label" for="customRadio-8"> Active </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="is_active" id="customRadio-9" name="customRadio-10" class="custom-control-input bg-warning" value="0" @if($edit->is_active == 0) checked @endif>
                                                <label class="custom-control-label" for="customRadio-9"> Deactive </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input type="hidden" class="total_pax_amount" value="{{$edit->total_pax_amount}}">
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
                </form>
            </div>

        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
        $('.guest_name').on('keyup', function() {
                
            var guest_name=$(this).val();
            $(".short_name").val(guest_name);
                

        });
});
</script>
<script>
    $(document).ready(function() {
        $('.itemrate').on('change', function() {
            var itemrate=$(this).val();
            var qty=$(".itemqty").val();
            var toalamount= itemrate * qty;
            $(".itemamount").val(toalamount);


        });
        $('.itemqty').on('change', function() {
            var qty=$(this).val();
            var itemrate=$(".itemrate").val();
            var toalamount= itemrate * qty;
            $(".itemamount").val(toalamount);
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#additem').on('click', function() {
        
        var booking_no=$("#booking_no").val();
        var itemname=$(".itemname").val();
        var itemtax=$(".itemtax").val();
        var itemqty=$(".itemqty").val();
        var itemrate=$(".itemrate").val();
        var itemamount=$(".itemamount").val();
        var bit_id=$(".bit_id").val();
        //alert(itemname);
            $.ajax({
                type: 'GET',
                url: "{{route('bunquet.insertitem.data')}}",
                data: {
                    booking_no:booking_no,
                    itemname:itemname,
                    itemtax:itemtax,
                    itemqty:itemqty,
                    itemrate:itemrate,
                    itemamount:itemamount,
                    bit_id:bit_id,
                },

                success: function(data) {
                
                        $('#allitemdata').empty();
                        getbanquetitem();
                        $('#allamountsection').empty();
                        allamount();
                    $(".itemname").val("");
                    $(".itemqty").val("");
                    $(".itemrate").val("");
                    $(".itemamount").val("");
                    $(".bit_id").val("");
                    //$('.alldataitem').append(data);
                
                },

                error: function (err) {
                //console.log(err.responseJSON.errors.itemname[0]);
                
                $('#item_err').html(err.responseJSON.errors.itemname[0]);
                $('#item_rate_err').html(err.responseJSON.errors.itemname[0]);
                $('#item_qty_err').html(err.responseJSON.errors.itemname[0]);
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
    function getbanquetitem() {
      //alert("ok");
        var booking_no = $("#booking_no").val();
        //alert(invoice);
        $.post('{{ url('get/banquetitem/all/') }}/'+booking_no, {_token: '{{ csrf_token() }}'},
            function(data) {
               // console.log(data);
			   $('#allitemdata').append(data);
              // $('.dueamount').val(data.data);

            });
            
	}

	getbanquetitem();
</script>
<!-- delete item data -->
<script>
    function cartDatadelete(el) {
        
        //alert("ok");
        $.post('{{route('get.banquetitem.delete')}}', {_token: '{{ csrf_token() }}',item_id: el.value},
            function(data) {
                //$('#addtocartshow').html(data);
                $('#allitemdata').empty();
                $('#allitemdata').append(data);
                $('#allamountsection').empty();
                allamount();


            });
     
   
	}
	cartDatadelete();
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
@endsection