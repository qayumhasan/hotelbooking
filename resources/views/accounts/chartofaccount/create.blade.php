@extends('accounts.master')
@section('title', 'Chart Of Account Create| '.$seo->meta_title)
@section('content')
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
                            <h4 class="card-title">Add Chart Of Account</h4>
                        </div>
                       <a href="{{route('admin.chartofaccount.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Chart Of Account</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.chartofaccount.create')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Chart Of Account Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Category Name: *</label>
                                            <select name="category_name" class="form-control" id="category_name">
                                                <option value="">--Select--</option>
                                                @foreach($allcategory as $cate)
                                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_name')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Category Code: *</label>
                                            <input type="text" class="form-control" id="catecategory_code" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Main Category Name: </label>
                                            <select name="maincategory_name" class="form-control" id="maincategory_name">
                                                <option value="">--Select--</option>
                                              {{-- @foreach($allmaincategory as $maincate)
                                                <option value="{{$maincate->id}}">{{$maincate->maincategory_name}}</option>
                                                @endforeach --}}  
                                               
                                            </select>
                                            @error('maincategory_name')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">MainCategory Code:</label>
                                            <input type="text" class="form-control" id="maincatecategory_code"  disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">SubCategory Name One: </label>
                                            <select name="subcateone" class="form-control floor" id="subcateone">
                                                <option value="">--Select--</option>
                                              {{--   @foreach($allsubcategoryone as $subone)
                                                <option value="{{$subone->id}}">{{$subone->subcategory_nameone}}</option>
                                                @endforeach    --}} 
                                               
                                            </select>
                                            @error('subcateone')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">SubCategory One Code:</label>
                                            <input type="text" class="form-control" id="subcatecategory_codeone" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">SubCategory Name Two: </label>
                                            <select name="subcate_two" class="form-control" id="subcate_two">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('subcate_two')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">SubCategory Two Code:</label>
                                            <input type="text" class="form-control" id="subcatecategory_codetwo" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="fname">Description Of Account: *</label>
                                            <input type="text" class="form-control"  name="desription_of_account" placeholder="Description Of Account"/>
                                            @error('desription_of_account')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
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

<script type="text/javascript">

  $(document).ready(function() {

     $('select[name="category_name"]').on('change', function(){
         var cate_id = $(this).val();
            //alert(cate_id);
         if(cate_id) {
             $.ajax({
                 url: "{{  url('/get/account/maincategory/all/') }}/"+cate_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#maincategory_name').empty();
                        $('#maincategory_name').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#maincategory_name').append('<option value="' + districtObj.id + '">'+districtObj.maincategory_name+'</option>');
                       });
                     }
             });
         } else {
           
         }

     });
    //  get code
    $('select[name="category_name"]').on('change', function(){
         var cate_id = $(this).val();
            //alert(cate_id);
         if(cate_id) {
             $.ajax({
                 url: "{{  url('/get/account/maincategory/code/') }}/"+cate_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#catecategory_code').val(data.category_code);
                      
                     }
             });
         } else {
           
         }

     });


    //  subacte one
    $('select[name="maincategory_name"]').on('change', function(){
         var maincate_id = $(this).val();
            //alert(maincate_id);
         if(maincate_id) {
             $.ajax({
                 url: "{{  url('/get/account/subcategoryone/all/') }}/"+maincate_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                        $('#subcateone').empty();
                        $('#subcateone').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#subcateone').append('<option value="' + districtObj.id + '">'+districtObj.subcategory_nameone+'</option>');
                       });
                     }
             });
         } 

     });

     $('select[name="maincategory_name"]').on('change', function(){
         var maincate_id = $(this).val();
            //alert(maincate_id);
         if(maincate_id) {
             $.ajax({
                 url: "{{  url('/get/account/subcategoryone/code/') }}/"+maincate_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                    $('#maincatecategory_code').val(data.maincategory_code);
                }
             });
         }

     });
    //  subcate two
    $('select[name="subcateone"]').on('change', function(){
         var subcateone_id = $(this).val();
          
         if(subcateone_id) {
             $.ajax({
                 url: "{{  url('/get/account/subcategorytwo/all/') }}/"+subcateone_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#subcate_two').empty();
                        $('#subcate_two').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#subcate_two').append('<option value="' + districtObj.id + '">'+districtObj.subcategory_nametwo+'</option>');
                       });
                     }
             });
         } else {
           
         }

     });
    //  
    $('select[name="subcateone"]').on('change', function(){
         var subcateone_id = $(this).val();
          
         if(subcateone_id) {
             $.ajax({
                 url: "{{  url('/get/account/subcategorytwo/code/') }}/"+subcateone_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                    $('#subcatecategory_codeone').val(data.subcategory_codeone);
                }
             });
         }

     });

    //  
    $('select[name="subcate_two"]').on('change', function(){
         var subcateone_id = $(this).val();
          //alert("ok");
         if(subcateone_id) {
             $.ajax({
                 url: "{{  url('/get/account/subcategorythree/code/') }}/"+subcateone_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                    $('#subcatecategory_codetwo').val(data.subcategory_codetwo);
                }
             });
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