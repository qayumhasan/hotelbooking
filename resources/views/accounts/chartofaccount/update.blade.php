@extends('accounts.master')
@section('title', 'Chart Of Account Update| '.$seo->meta_title)
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
                            <h4 class="card-title">Update Chart Of Account</h4>
                        </div>
                       <a href="{{route('admin.chartofaccount.create')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Chart Of Account</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.chartofaccount.update')}}" method="POST">
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
                                            <select name="category_name" class="form-control" id="category_name" disabled>
                                                <option value="">--Select--</option>
                                                @foreach($allcategory as $cate)
                                                <option value="{{$cate->id}}" @if($edit->category_id == $cate->id) selected @endif>{{$cate->category_name}}</option>
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
                                            <input type="text" class="form-control" id="catecategory_code" value="{{$edit->category_code}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Main Category Name: </label>
                                            <select name="maincategory_name" class="form-control" id="maincategory_name" disabled>
                                            @php
                                                $allmaincategory=App\Models\AccountMainCategory::where('is_deleted',0)->where('is_active',1)->where('category_id',$edit->category_id)->get();
                                            @endphp
                                                <option value="">--Select--</option>
                                               @foreach($allmaincategory as $maincate)
                                                <option value="{{$maincate->id}}" @if($edit->maincategory_id == $maincate->id) selected @endif>{{$maincate->maincategory_name}}</option>
                                                @endforeach   
                                               
                                            </select>
                                            @error('maincategory_name')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">MainCategory Code:</label>
                                            <input type="text" class="form-control" id="maincatecategory_code"  value="{{$edit->maincategory_code}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">SubCategory Name One: </label>
                                            <select name="subcateone" class="form-control floor" id="subcateone" disabled>
                                             @php
                                                $allsubcategoryone=App\Models\AccountSubCategoryOne::where('is_deleted',0)->where('is_active',1)->where('maincategory_id',$edit->maincategory_id)->get();
                                            @endphp
                                                <option value="">--Select--</option>
                                               @foreach($allsubcategoryone as $subone)
                                                <option value="{{$subone->id}}" @if($edit->subcategoryone_id == $subone->id) selected @endif>{{$subone->subcategory_nameone}}</option>
                                                @endforeach    
                                               
                                            </select>
                                            @error('subcateone')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">SubCategory One Code:</label>
                                            <input type="text" class="form-control" id="subcatecategory_codeone" value="{{$edit->subcategoryone_code}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">SubCategory Name Two: </label>
                                            @php
                                                $allsubcategorytwo=App\Models\AccountSubCategoryTwo::where('is_deleted',0)->where('is_active',1)->where('subcategoryone_id',$edit->subcategoryone_id)->get();
                                            @endphp
                                            <select name="subcate_two" class="form-control" id="subcate_two" disabled>
                                                @foreach($allsubcategorytwo as $sucatetwo)
                                                <option value="{{$sucatetwo->id}}" @if($edit->subcategorytwo_id == $sucatetwo->id) selected @endif>{{$sucatetwo->subcategory_nametwo}}</option>
                                                @endforeach
                                                
                                               
                                            </select>
                                            @error('subcate_two')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">SubCategory Two Code:</label>
                                            <input type="text" class="form-control" value="{{$edit->subcategorytwo_code}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Description Of Account: *</label>
                                            <input type="text" class="form-control"  name="desription_of_account" placeholder="Description Of Account" value="{{$edit->desription_of_account}}"/>
                                            <input type="hidden" name="id" value="{{$edit->id}}"/>
                                            @error('desription_of_account')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname">Description Of Account Code:</label>
                                            <input type="text" class="form-control" value="{{$edit->code}}" disabled>
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
         } else {
           
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
                         $('#subcate_two').append('<option value="' + districtObj.id + '">'+districtObj.subcategory_nameone+'</option>');
                       });
                     }
             });
         } else {
           
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