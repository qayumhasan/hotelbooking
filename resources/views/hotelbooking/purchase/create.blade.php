@extends('inventory.master')
@section('title', 'Add Purchase | '.$seo->meta_title)
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
.form-control {
    height: 35px;
 
}
button.btn-sm.btn-primary.mt-2 {
    border: beige;
    padding: 2px 9px;
    font-size: 11px;
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
                            <h4 class="card-title">Purchase</h4>
                        </div>
                  
                       
                       <a href="{{route('admin.purchase.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Purchase</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.purchase.insert')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Invoice No: *</label>
                                            <input type="text" value="{{$invoice_id}}" class="form-control" disabled>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Ref Invoice No: *</label>
                                            <input type="text" name="ref_invoice" class="form-control" placeholder="Ref Invoice No">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Order No: </label>
                                            <input type="text" id="ref_invoice" name="order_no" class="form-control" list="ref_in" placeholder="Order No" />
                                            <datalist id="ref_in">
                                                @foreach($allorderhead as $orderhead)
                                                <option value="{{$orderhead->invoice_no}}">{{$orderhead->invoice_no}}</option>
                                                @endforeach
                                            </datalist>
                                        
                                            <input type="hidden" class="invoice" name="invoice_no" value="{{$invoice_id}}" id="invoice_no"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Date: </label>
                                            <input id="datepicker" type="text" class="form-control" name="tax_date" value="{{$current}}"/>

                                        </div>
                                    </div>
                                    <div class="col-md-6" id="selectsupplier">

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Stock Center : *</label>
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

                        </div>
                        
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row" id="mainfile">
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label for="fname">Item Name:*</label> <button type="button" class="btn-sm btn-primary mt-2" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fa fa-plus"></i></button>
                                            <input type="text" id="item_name" name="item_name" class="form-control item_name" list="allitem" placeholder="Item" />
                                            <input type="hidden" id="i_id" name="i_id"/>
                                            <datalist id="allitem">
                                                @foreach($allitem as $item)
                                                <option value="{{$item->item_name}}"></option>
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
                                                <input type="hidden" name="tax_invoice" value="{{$invoice_id}}">
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
                                            <input type="hidden" name="tax_amount" class="tax_amount">
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
                                                <textarea class="form-control" name="narration"></textarea>
                                            </div>
                                        </div>
                                        </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="fname">Total Amount: *</label>
                                                    <input type="text" class="form-control totalamount" value="" disabled>
                                                    <input type="hidden" name="totalamount" class="form-control totalamount" value="">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Paid: *</label>
                                                    <input type="number" class="form-control paidamount" name="paidamount">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fname">Due: *</label>
                                                    <input type="text" class="form-control dueamount" value="" disabled>
                                                    <input type="hidden" class="form-control dueamount" name="dueamount" value="">
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
                                                <button type="submit" class="btn btn-success">Submit</button>
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
<!-- item modal  -->



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-hidden="true" id="itementrymodal">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        
        <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Item</h4>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                </div>
                <form  method="POST" id="ajaxitementry">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Item Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Item Name: *</label>
                                            <input type="text" class="form-control ajax_item_name"  name="item_name" placeholder="Item Name"/>
                                           
                                                <div style="color:red" id="err_item_name"></div>
                                           
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Short Name: *</label>
                                            <input type="text" class="form-control short_name"  name="short_name" placeholder="Short Name"/>
                                           
                                                <div style="color:red"></div>
                                           
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Category Name: </label>
                                            <select name="category_name" class="form-control category_name" id="category_name">
                                                <option value="">--Select--</option>
                                                @foreach($category as $cate)
                                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                                @endforeach
                                            </select>
                                          
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Unit Name: </label>
                                            <select name="unit_name" class="form-control ajaxunit_name" id="unit_name">
                                                <option value="">--Select--</option>
                                                @foreach($unit as $allunit)
                                                <option value="{{$allunit->id}}">{{$allunit->name}}</option>
                                                @endforeach
                                            </select>
                                           
                                                <div style="color:red" id="err_unitnamr"></div>
                                            
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Rate:</label>
                                            <input type="text" class="form-control rate" name="rate" placeholder="Rate"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Minimum Level:</label>
                                           <Input type="number" name="min_level" class="form-control min_level"  placeholder="Minimum Level">
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="" name="direct_stock">
                                            <label class="form-check-label" for="invalidCheck2">
                                            Is Direct Stock Deduct?
                                            </label>
                                        </div>
                                        </div>

                                        <div class="col-md-6 p-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="" name="add_vat">
                                            <label class="form-check-label" for="invalidCheck2">
                                                Vat Added On Bill
                                            </label>
                                        </div>
                                        </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-3">
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
                                            <input type="radio" name="menu_type" id="customRadio-1" class="custom-control-input bg-primary" value="Food" checked>
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
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="file-upload-form" class="uploader-file">
                                            <button type="button" class="btn btn-success" id="additemajax">Submit</button>
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
</div>
</div>


<!-- item modal end-->

<!-- modal suppplier modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true" id="supllirmodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    
                    <form id="addsuppiler" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Date: </label>
                                                <input type="text" id="datepicker" class="form-control" name="date" placeholder="" value="{{$current}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Title: *</label>
                                                <input type="text" class="form-control title" name="title" placeholder="Title"/>
                                              
                                                    <div style="color:red" id="errtitle"></div>
                                             
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Name: *</label>
                                                <input type="text" class="form-control name" name="name" placeholder="Name" id="name"/>
                                              
                                                    <div style="color:red" id="errname"></div>
                                              
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Print Name: *</label>
                                                <input type="text" class="form-control print_name" name="print_name" id="print_name" placeholder="Print Name"/>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Designation:</label>
                                                <Input type="text" name="designation" class="form-control designation"  placeholder="Designation">
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">TIN Vat No:</label>
                                            <Input type="text" name="tin_vat_no" class="form-control tin_vat_no"  placeholder="TIN Vat No">
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Address 1: *</label>
                                                <textarea class="form-control addressline_one" name="addressline_one"></textarea>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Address 2: </label>
                                                <textarea class="form-control addressline_two" name="addressline_two"></textarea>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">City: </label>
                                                <input type="text" class="form-control city"  name="city" placeholder="City"/>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Zip Code:</label>
                                                <input type="text" class="form-control zip_code" name="zip_code" placeholder="Zip Code"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">TelePhone:</label>
                                            <Input type="text" name="telephone" class="form-control telephone"  placeholder="TelePhone">
                                        
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Contact Person:</label>
                                            <Input type="text" name="contact_persion" class="form-control contact_persion"  placeholder="Contact Person">
                                            
                                            </div>
                                        </div>
                                    
                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Mobile:</label>
                                            <Input type="text" name="mobile" class="form-control mobile"  placeholder="Mobile">
                                              
                                                    <div style="color:red" id="errmobile"></div>
                                             
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fname">Email:</label>
                                            <Input type="text" name="email" class="form-control email"  placeholder="Email">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Gender</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                                <input type="radio" name="gender" id="customRadio-1" class="custom-control-input bg-primary" value="Male" checked>
                                                <label class="custom-control-label" for="customRadio-1"> Male </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="gender" id="customRadio-2"  class="custom-control-input bg-primary" value="Female">
                                                <label class="custom-control-label" for="customRadio-2"> Female </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                                <input type="radio" name="gender" id="customRadio-3"  class="custom-control-input bg-primary" value="Other">
                                                <label class="custom-control-label" for="customRadio-3"> Other </label>
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
                            <div class="card shadow-sm shadow-showcase">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <button type="button" class="btn btn-success" id="suupliradd">Submit</button>
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
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- endmodal -->
<script type="text/javascript">
  $(document).ready(function() {
     $(".item_name").on('change', function(){
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
           
         }

     });
 });
</script>
<script>
    function getallitem(){
      
        $.get('{{ url('get/allitem/item/') }}', {_token: '{{ csrf_token() }}'},
            function(data) {
                  
                      
                       var html = '<div class="form-group" id="allnewitem">';
                         html += '<label for="fname">Item Name: *  </label>';
                         html += '<input type="text" id="item_name" name="item_name" class="form-control item_name" list="allitem" placeholder="Item" />';
                         html += '<input type="hidden" id="i_id" name="i_id"/>';
                         html += '<datalist id="allitem">';

                        $.each(data,function(index,districtObj){
                           
                              html += '<option value="' + districtObj.item_name + '">'+districtObj.item_name+'</option>';
                           
                        });
                        html += '</datalist>';
                        html += '<div style="color:red" id="item_err"></div>';
                        $('#allnewitem').remove();
                        $('#allitempurchase').append(html);
            
                 });
	}

    getallitem();

</script>


<script>
$(document).ready(function() {
        $('#additemajax').click(function (e) {
            //alert("success");
            $('#err_item_name').html("");
            
        $.ajax({
            type: 'POST',
            url: "{{route('itementery.modalinsert.data')}}",
            data: $('#ajaxitementry').serializeArray(),
            success: function(data) {
                if(data=='success'){
                    getallitem();
                    $('.ajax_item_name').val("");
                    $('.short_name').val("");
                    $('.category_name').val("");
                    $('.ajaxunit_name').val("");
                    $('.rate').val("");
                    $('.min_level').val("");
                    $('#itementrymodal').modal('hide');
                   
                }else{

                    $('#err_item_name').html("");
                    
                }
            },

            error: function (err) {
                console.log(err);
                if(err.responseJSON.errors.item_name[0]){
                    $('#err_item_name').html(err.responseJSON.errors.item_name[0]);
                }
               
              
               
            }
          
        });
    });
});

</script>
<script>
$(document).ready(function() {
        $('#suupliradd').click(function (e) {
            $('#errtitle').html("");
            $('#errmobile').html("");
            $('#errname').html("");
            
        $.ajax({
            type: 'POST',
            url: "{{route('supplier.modalinsert.data')}}",
            data: $('#addsuppiler').serializeArray(),
            success: function(data) {
                if(data=='success'){
                    getallitem();
                    getallsuplier();
                    $('.title').val("");
                    $('.name').val("");
                    $('.print_name').val("");
                    $('.designation').val("");
                    $('.tin_vat_no').val("");
                    $('.addressline_one').val("");
                    $('.addressline_two').val("");
                    $('.city').val("");
                    $('.zip_code').val("");
                    $('.telephone').val("");
                    $('.contact_persion').val("");
                    $('.mobile').val("");
                    $('.email').val("");
                    $('#errtitle').html("");
                    $('#errmobile').html("");
                    $('#errname').html("");
                    $('#supllirmodal').modal('hide');
                   
                }else{
                    $('#errtitle').html("");
                    $('#errmobile').html("");
                    $('#errname').html("");
                }
            },

            error: function (err) {
                if(err.responseJSON.errors.title[0]){
                    $('#errtitle').html(err.responseJSON.errors.title[0]);
                }
                if(err.responseJSON.errors.mobile[0]){
                    $('#errmobile').html(err.responseJSON.errors.mobile[0]);
                }
                if(err.responseJSON.errors.name[0]){
                    $('#errname').html(err.responseJSON.errors.name[0]);
                }
              
               
            }
          
        });
    });
});

</script>
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
                getallitem();
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
                      //console.log(data.amount);
                      getallitem();
                        $("#calculation_on").val(data.data.calculation);
                        //$("#based_on").html("<option value=" + data.data.base_on+ ">"+ data.data.base_on +"</option>");
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
                getallitem();
                alltaxfile();
                totalamount();
            });
           
   
	}
	
    
</script>

<!-- tax include script end -->



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
                getallitem();
                $('#item_err').html('');
                $('.item_name').val("");
                $('#unit').val("");
                $('#unit_name').val("");
                $('#Qty').val("");
                $("#i_id").val("");
                $(".rate").val("");
                $(".amount").val("");
       
                 
                alltaxfile();
                totalamount();
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
        

         if(paidamount) {
                $('.dueamount').val(totalamount - paidamount);
          
         }else {
            $('.dueamount').val(totalamount);
         }

     });
 });
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


<script>
    function getallsuplier() {
     
        $.get('{{ url('get/allsupplier/supplier/') }}', {_token: '{{ csrf_token() }}'},
            function(data) {
                        
                        var html = '<div class="form-group" id="sup_id">';
                         html += '<label for="fname">Supplier: *</label>  <button type="button" class="btn-sm btn-primary mt-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i></button>';
                         html += '<select name="supplier" id="supplier" class="form-control supplier">';
                         html += '<option value="">--select--</option>';
                        $.each(data,function(index,districtObj){
                          
                              html += '<option class="sup_id" value="' + districtObj.id + '">'+districtObj.name+'</option>';
                        });
                         html += '</select>';
                         html += '</div>';
                         html += ' @error("stock_center")'
                         html += '<div style="color:red">{{ $message }}</div>'
                         html +=' @enderror'

                         $('#sup_id').remove();
                         $('#selectsupplier').append(html);
            
                 });
	}

	getallsuplier();
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
@if(Session::has('purchasedata'))
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
                                    <td>Price</td>
                                    <td>Qty</td>
                                    <td>Amount</td>
                               
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                            
                            @if(Session::has('purchasedata'))
                                @php
                                    $purchasedata =session('purchasedata');
                                    $totalamount=0;
                                @endphp
                           
                              
                               @foreach($purchasedata as $kdata)
                                        @foreach($kdata as $row)
                                            <tr>
                                                <td>{{$row->invoice_no}}</td>
                                                <td>{{$row->item_name}}</td>
                                                <td>{{$row->rate}}</td>
                                                <td>{{$row->qty}}</td>
                                                <td>{{$row->amount}}</td>
                                            <tr>
                                            @php
                                            $totalamount=$totalamount+$row->amount;
                                            @endphp
                                        @endforeach
                            
                             @endforeach
                                   
                               
                            @endif
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                       <h5>Total Amount: {{$totalamount}}</h5>
                      
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


@if(Session::has('purchasedata'))
<script>
   $(document).ready(function() {
      $('#kotinvoice').modal('show');
   });
</script>
{{session()->forget('purchasedata')}}
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
            <?php session()->forget('purchasedata'); ?>
        });
    });
</script>
                                      
@endsection
