
@extends('layouts.admin')
@section('title', 'Add Supplier | '.$seo->meta_title)
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
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Supplier</h4>
                        </div>
                       <a href="{{route('admin.supplier.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Supplier</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.supplier.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Supplier Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Date: </label>
                                            <input type="text" class="form-control datepicker" name="date" placeholder="" value="{{$current}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Title: *</label>
                                            <input type="text" class="form-control" name="title" placeholder="Title"/>
                                            <input type="hidden"  name="account_head" value="Accounts Payable - Purchase"/>
                                            <input type="hidden"  name="account_head_code" value="212-28-0040-10132"/>
                                            @error('title')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Name: *</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name" id="name"/>
                                            @error('name')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Print Name: *</label>
                                            <input type="text" class="form-control" name="print_name" id="print_name" placeholder="Print Name"/>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Designation:</label>
                                             <Input type="text" name="designation" class="form-control"  placeholder="Designation">
                                         
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">TIN Vat No:</label>
                                           <Input type="text" name="tin_vat_no" class="form-control"  placeholder="TIN Vat No">
                                         
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Address 1: *</label>
                                            <textarea class="form-control" name="addressline_one"></textarea>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Address 2: </label>
                                            <textarea class="form-control" name="addressline_two"></textarea>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">City: </label>
                                            <input type="text" class="form-control"  name="city" placeholder="City"/>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Zip Code:</label>
                                            <input type="text" class="form-control" name="zip_code" placeholder="Zip Code"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">TelePhone:</label>
                                           <Input type="text" name="telephone" class="form-control"  placeholder="TelePhone">
                                       
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Contact Person:</label>
                                           <Input type="text" name="contact_persion" class="form-control"  placeholder="Contact Person">
                                         
                                        </div>
                                    </div>
                                   
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Mobile:</label>
                                           <Input type="text" name="mobile" class="form-control"  placeholder="Mobile">
                                           @error('mobile')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Email:</label>
                                           <Input type="text" name="email" class="form-control"  placeholder="Email">
                                          
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
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
     $('input[name="name"]').on('change', function(){
         var newname = $(this).val();
         //alert(newname);
         if(newname) {
            $('#print_name').val(newname);
         } 


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