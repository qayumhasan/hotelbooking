@extends('hotelbooking.master')
@section('content')
<style>
.form-control {
    height: 32px;
}
.card-header.d-flex.justify-content-between.asif {
    background-color: #c1b8b8;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Branch</h4>
                        </div>
                       <a href="{{route('admin.branch.index')}}"><button  class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">All Branch</span></i></button></a>
                    </div>
                </div>
                <form action="{{route('admin.branch.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between asif">
                                <div class="header-title">
                                    <h4 class="card-title">Branch Content</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Branch ID: *</label>
                                            <input type="text" class="form-control" id="branch_id" name="branch_id" placeholder="Branch ID"  required/>
                                            @error('branch_id')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Branch Name: *</label>
                                            <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name"  required/>
                                            @error('branch_name')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Mobile: *</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" />
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Email: *</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Web Address: *</label>
                                            <input type="text" class="form-control" id="web_address" name="web_address" placeholder="Web Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lname">Address: *</label>
                                           <textarea name="address" id="editor3" cols="30" rows="10"></textarea>
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
                                            <label class="custom-control-label" for="customRadio-2"> Deactive </label>
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
<!-- <script>
    var idArray = ["branch_id","branch_name","mobile","email","web_address"];
    function focusNext(e){
        //alert("ok");
        try{
            for(var i=0; i < idArray.length; i++){
                if(e.keycode == 13 && e.target.id === idArray[i]){
                    document.querySelector(` #${idArray[i+1] } `).fucus();
                }
            }


        }catch(error){

        }
    }
</script> -->
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