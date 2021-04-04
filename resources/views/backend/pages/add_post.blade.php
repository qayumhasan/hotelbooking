@extends('layouts.admin')
@section('title', 'AddOn | '.$seo->meta_title)
@section('content')
<style>
    #delectimage{
        position: absolute;
        top: 0;
        right: 2%;
    }
</style>
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Page</h4>
                        </div>
                        <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm bg-primary"><i class="ri-add-fill"><span class="pl-1">Pages</span></i>
                        </button>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Page Content</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fname">Title: *</label>
                                            <input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="First Name" required="required" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="lname">Content: *</label>
                                            <div id="editor"></div>
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
                                    <h4 class="card-title">Publish</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-radio custom-radio-color-checked custom-control">
                                            <input type="radio" id="customRadio-1" name="customRadio-10" class="custom-control-input bg-primary">
                                            <label class="custom-control-label" for="customRadio-1"> Active </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-radio-color-checked custom-control mt-1">
                                            <input type="radio" id="customRadio-2" name="customRadio-10" class="custom-control-input bg-warning">
                                            <label class="custom-control-label" for="customRadio-2"> InActive </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Template Setting</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <select id="inputState" class="form-control form-control-sm">
                                            <option selected>Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Feature Image</h4>
                                </div>
                            </div>


                            <div id="imageuploaditem">
                                <div class="card-body" id="frontupload">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="file-upload-form" class="uploader-file">
                                                <!-- <input id="file-upload" type="file" name="fileUpload" accept="image/*" /> -->
                                                <label id="mainimageupload">
                                                    <!-- <img id="file-image" src="#" alt="Preview"> -->
                                                    <span id="start-one">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                        <span class="d-block">Select a file or drag here</span>
                                                        <span id="notimage" class="hidden d-block">Please select image</span>
                                                        <span id="file-upload-btn" class="btn btn-primary findImage" data-toggle="modal" data-target="#imageuploadmodal" data-whatever="@mdo">Select a file</span>
                                                    </span>

                                                </label>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
                <div class="row">

                    <div class="col-md-9">
                        <div class="card shadow-sm shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Seo Manager</h4>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox custom-control">

                                            <input type="checkbox" class="custom-control-input" id="customCheck-t">
                                            <label class="custom-control-label" for="customCheck-t">Allow search engines to show this service in search results?</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <div class="seo_content d-none" id="seo_content">
                                            <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General Options</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Share Facebook</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Share Twitter</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="myTabContent-2">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="fname">Seo Title: *</label>
                                                            <input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="First Name" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="lname">Seo Description: *</label>
                                                            <textarea class="form-control form-control-sm" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="lname">Featured Image: *</label>
                                                        <div id="file-upload-form" class="uploader-file">
                                                            <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
                                                            <label id="file-drag">
                                                                <img id="file-image" src="#" alt="Preview" class="hidden">
                                                                <span id="start-one">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                    <span class="d-block">Select a file or drag here</span>
                                                                    <span id="notimage" class="hidden d-block">Please select image</span>
                                                                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                                                </span>
                                                                <span id="response" class="hidden">
                                                                    <span id="messages"></span>
                                                                    <progress class="progress" id="file-progress" value="0">
                                                                        <span>0</span>%
                                                                    </progress>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="fname">Facebook Title: *</label>
                                                            <input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="First Name" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="lname">Facebook Description: *</label>
                                                            <textarea class="form-control form-control-sm" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="lname">Facebook Featured Image: *</label>
                                                        <div id="file-upload-form" class="uploader-file">
                                                            <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
                                                            <label id="file-drag">
                                                                <img id="file-image" src="#" alt="Preview" class="hidden">
                                                                <span id="start-one">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                    <span class="d-block">Select a file or drag here</span>
                                                                    <span id="notimage" class="hidden d-block">Please select image</span>
                                                                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                                                </span>
                                                                <span id="response" class="hidden">
                                                                    <span id="messages"></span>
                                                                    <progress class="progress" id="file-progress" value="0">
                                                                        <span>0</span>%
                                                                    </progress>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="fname">Twitter Title: *</label>
                                                            <input type="text" class="form-control form-control-sm" id="fname" name="fname" placeholder="First Name" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="lname">Twitter Description: *</label>
                                                            <textarea class="form-control form-control-sm" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="lname">Twitter Featured Image: *</label>
                                                        <div id="file-upload-form" class="uploader-file">
                                                            <input id="file-upload" type="file" name="fileUpload" accept="image/*" />
                                                            <label id="file-drag">
                                                                <img id="file-image" src="#" alt="Preview" class="hidden">
                                                                <span id="start-one">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                    <span class="d-block">Select a file or drag here</span>
                                                                    <span id="notimage" class="hidden d-block">Please select image</span>
                                                                    <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                                                </span>
                                                                <span id="response" class="hidden">
                                                                    <span id="messages"></span>
                                                                    <progress class="progress" id="file-progress" value="0">
                                                                        <span>0</span>%
                                                                    </progress>
                                                                </span>
                                                            </label>
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


                    <div class="col-md-3">
                        <div class=" text-center">
                            <span id="start-one">
                                <button id="file-upload-btn" type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                            </span>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<script>
    window.onload = function() {
        var seocheckbox = document.getElementById("customCheck-t");
        var seocontent = document.getElementById("seo_content");
        seocheckbox.addEventListener("click", function(e) {
            if (seocheckbox.checked) {
                seocontent.classList.add("d-block");
                seocontent.classList.remove("d-none");
            } else {
                seocontent.classList.add("d-none");
                seocontent.classList.remove("d-block");
            }

        });





    }

    function uploadimg(el) {
        
        $('#usefile').click(function(params) {
            if (el.checked == true) {
               
                var imgID = el.value;
               

                var photo_div = '<div class="card-body" id="delectselctImage">';
                        photo_div += '<div class="row">';
                        photo_div += '<div class="col-md-12">';
                        photo_div += '<img src="public/uploads/imagemanager/'+imgID+'" id="mainimage" class="w-100">';
                        photo_div += '<button type="button" class="btn-danger btn-sm" onclick="delectselctImage(this)" id="delectimage"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                        photo_div += '<input type="hidden" name="image"/ value="'+imgID+'">';

                        photo_div += '</div>';
                        photo_div += '</div>';
                        photo_div += '</div>'; 

                    
                    $('#delectselctImage').closest('.card-body').remove();
                    $('#frontupload').hide();
                    $('#imageuploaditem').append(photo_div);
                    

            }
            
        });

        



    }

    function delectselctImage(em) {

        
        $(em).closest('.card-body').remove();
        $('#frontupload').show();
        // var delectimage = document.querySelector('#delectimage');
        // var mainimageupload = document.querySelector('#mainimageupload');
        // var mainimage = document.querySelector('#mainimage');

        // mainimageupload.classList.remove("d-none");
        // mainimage.classList.add("d-none");

        


    }
</script>




@endsection