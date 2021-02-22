@extends('hotelbooking.master')
@section('title', 'Add Room | '.$seo->meta_title)
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
                            <h4 class="card-title">Add Room</h4>
                        </div>
                       <a href="{{route('admin.room.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Room</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.room.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Room Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Room No: *</label>
                                            <input type="text" class="form-control" id="fname" name="room_no" placeholder="Room No"/>
                                            @error('room_no')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Branch Name: *</label>
                                            <select name="branch_id" class="form-control" id="branch_id">
                                                <option value="">--Select--</option>
                                                @foreach($allbranch as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Room Type: </label>
                                            <select name="room_type" class="form-control" id="room_type">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('room_type')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Floor: </label>
                                            <select name="floor" class="form-control floor" id="floor">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('floor')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Toilet:</label>
                                            <select name="toilet" class="form-control">
                                                <option value="">--Select--</option>
                                                <option value="General">General</option>
                                                <option value="English">English</option>
                                            </select>
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Tariff:</label>
                                           <Input type="text" name="tariff" class="form-control" id="tariff" placeholder="Price">
                                           @error('tariff')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Category:</label>
                                            <input type="text" id="category" name="category" class="form-control" list="allcategory" placeholder="Category" />
                                            <datalist id="allcategory">
                                            @foreach($category as $cate)
                                                <option value="{{$cate->category}}">{{$cate->category}}</option>
                                            @endforeach
                                            </datalist>
                                       
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lname">Room Details: </label>
                                           <textarea name="room_details" id="editor3" cols="30" rows="10"></textarea>
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
                                            <input type="radio" name="is_active" id="customRadio-1" class="custom-control-input bg-primary" value="1" checked>
                                            <label class="custom-control-label" for="customRadio-1"> Active </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                            <input type="radio" name="is_active" id="customRadio-2" name="customRadio-10" class="custom-control-input bg-warning" value="0">
                                            <label class="custom-control-label" for="customRadio-2"> DeActive </label>
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
<script>
   CKEDITOR.replace('editor3');
</script>

<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="branch_id"]').on('change', function(){
         var branch = $(this).val();
         //alert(branch);

         if(branch) {
             $.ajax({
                 url: "{{  url('/get/roomsetup/all/') }}/"+branch,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                        $('#room_type').empty();
                        $('#room_type').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#room_type').append('<option value="' + districtObj.id + '">'+districtObj.room_type+'</option>');
                        });
                    }
             });
         } 

     });
 });
</script>
<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="branch_id"]').on('change', function(){
         var branch = $(this).val();
         
         if(branch) {
             $.ajax({
                 url: "{{  url('/get/floorsetup/all/') }}/"+branch,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                        $('.floor').empty();
                        $('.floor').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,district){
                         $('.floor').append('<option value="' + district.id + '">'+district.name+'</option>');
                        });
                    }
             });
         } 


     });
 });
</script>
<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="room_type"]').on('change', function(){
         var roomtype = $(this).val();
        //alert(roomtype);
         if(roomtype) {
             $.ajax({
                 url: "{{  url('/get/pricesetup/all/') }}/"+roomtype,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {
                    $('#tariff').val(data.price);
                }
             });
         } 


     });
 });
</script>
@endsection