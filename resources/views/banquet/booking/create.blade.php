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
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Booking Create</h4>
                        </div>
                       <a href="{{route('admin.itementry.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Item</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.itementry.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Content</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Title: *</label>
                                                <select name="" class="form-control" id="">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Miss.">Miss.</option>
                                                    <option value="M/S.">M/S.</option>
                                                    <option value="MS.">Ms.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Dr.">Dr.</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Guest Name: <span style="color:red">*</span></label>
                                                <input type="text" class="form-control guest_name"  name="guest_name" placeholder="Guest Name"/>
                                                @error('guest_name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Print Name: <span style="color:red">*</span></label>
                                                <input type="text" class="form-control short_name"  name="print_name" placeholder="Print Name"/>
                                                @error('print_name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Company Name: </label>
                                                <input type="text" class="form-control"  name="company_name" placeholder="Company Name"/>
                                                @error('company_name')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Address: </label>
                                                <input type="text" class="form-control"  name="address" placeholder="Address"/>
                                                @error('address')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">City:</label>
                                                <input type="text" class="form-control" id="fname" name="rate" placeholder="City"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Mobile:<span style="color:red">*</span></label>
                                            <Input type="text" name="mobile" class="form-control"  placeholder="Mobile">
                                            @error('mobile')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">email:</label>
                                            <Input type="text" name="email" class="form-control"  placeholder="email">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Booking No: *</label>
                                                <h5>{{$booking_no}}</h5>
                                                <input type="hidden" value="{{$booking_no}}" id="booking_no">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Venue Name:</label>
                                                <select name="veneue_name" id="" class="form-control">
                                                    @foreach($allvanue as $newvenue)
                                                    <option value="{{$newvenue->id}}">{{ $newvenue->venue_name }}</option>
                                                    @endforeach
                                                   
                                                </select>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Booking For: *</label>
                                                <select name="booking_for" id="" class="form-control">
                                                    @foreach($bookingfor as $booking)
                                                    <option value="{{ $booking->booking_for }}">{{ $booking->booking_for }}</option>
                                                    @endforeach
                                             
                                                </select>
                                                
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Booking Date: </label>
                                                <input type="text" class="form-control datepicker"  name="company_name"  value="{{$current}}"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Date of Function From : </label>
                                                <input type="text" class="form-control datepicker"  name="date_of_function" value="{{$current}}"/>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Function Date To:</label>
                                            <Input type="text" name="function_date_to" class="form-control datepicker" value="{{$current}}">
                                            @error('mobile')
                                                    <div style="color:red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Type of Function:</label>
                                                <Input type="text" name="type_of_function" class="form-control"  placeholder="Type of Function">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Any ReMarks:</label>
                                                <Input type="text" name="remarks" class="form-control"  placeholder="Marks">
                                            <!-- <textarea name="remarks" id="" class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Menu Type: *</label>
                                                <select name="menu_type" class="form-control" id="menu_type">
                                                    <option value="">--select--</option>
                                                    @foreach($allmenutype as $menutype)
                                                        <option value="{{$menutype->id}}">{{$menutype->menutype_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Guest Type:</label>
                                                <select name="guest_type" id="guest_type" class="form-control">
                                                    <option value="1">Individual</option>
                                                    <option value="2">Corporate</option>
                                                    <option value="3">NGO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Price Per Pax: </label>
                                                <input type="text" class="form-control"  name="price_per_pax" id="price_per_pax" placeholder="Price Per Pax"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Guarantee Pax: </label>
                                                <input type="text" class="form-control"  name="guarantee_pax" placeholder="Guarantee Pax"/>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">Welcome Board : </label>
                                                <input type="text" class="form-control"  name="welcome_board" placeholder="Welcome Board"/>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fname">No of Rooms:</label>
                                                <input type="text" name="no_of_rooms" class="form-control" placeholder="No of Rooms">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
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
                                <hr>
                                <!-- done -->
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
                                               
                                                    @foreach($alltax as $tax)
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
                                                <input type="text" class="form-control taxrate"  name="taxrate" />
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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="fname">Item Name: </label>
                                                <input type="text" class="form-control"  name="item_name" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Tax(Y\N): </label>
                                                <select name="tax" id="" class="form-control">
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Qty: </label>
                                                <input type="text" class="form-control"  name="price_per_pax" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Rate: </label>
                                                <input type="text" class="form-control"  name="price_per_pax" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="fname">Amount: </label>
                                                <input type="text" class="form-control"  name="price_per_pax" />
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="fname">Add Item: </label>
                                                <input type="submit" class="btn-sm btn-primary" value="Add" />
                                            </div>
                                        </div>
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Manage</th>
                                                                <th scope="col">ItemName</th>
                                                                <th scope="col">Taxes</th>
                                                                <th scope="col">Qty</th>
                                                                <th scope="col">ItemRate</th>
                                                                <th scope="col">Amount</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">1</th>
                                                                    <td>Mark</td>
                                                                    <td>Otto</td>
                                                                    <td>@mdo</td>
                                                                    <td>@mdo</td>
                                                                    <td>@mdo</td>
                                                                </tr>
                                                            
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
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Menu Type</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="menu_type" id="customRadio-1" class="custom-control-input bg-primary" value="Food">
                                                <label class="custom-control-label" for="customRadio-1"> Food </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-2"  class="custom-control-input bg-primary" value="Beverage">
                                                <label class="custom-control-label" for="customRadio-2"> Beverage </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-3"  class="custom-control-input bg-primary" value="Cigarette">
                                                <label class="custom-control-label" for="customRadio-3"> Cigarette </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-4"  class="custom-control-input bg-primary" value="Banquet">
                                                <label class="custom-control-label" for="customRadio-4"> Banquet </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="menu_type" id="customRadio-5" class="custom-control-input bg-primary" value="House-kipping">
                                                <label class="custom-control-label" for="customRadio-5"> House-kipping </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Publish</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="is_active" id="customRadio-8" class="custom-control-input bg-primary" value="1">
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
      //var bit_id=$(".bit_id").val();
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
               
               
            },

            success: function(data) {
            
                  $('#taxsection').empty();
                     alltax();
                  $(".tax_calculation").val("");
                  $(".tax_rate").val("");
                  $(".tax_amount").val("");
                  $(".tax_effect").val("");
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
$(document).ready(function() {
    $('select=" "').on('click', function() {

    });
});
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
               


            });
     
   
	}
	carttaxdelete();
</script>
@endsection