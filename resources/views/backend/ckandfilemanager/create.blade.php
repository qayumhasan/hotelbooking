@extends('layouts.admin')
@section('title', 'Add User | '.$seo->meta_title)
@section('content')

 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">From For Used</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form class="form">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="col-md-12 p-0">
                                 <div class="row">
                              
                                    <div class="col-md-6 form-group">
                                       <label for="emailid" class="control-label">Demo: *</label>
                                       <input type="text"  class="form-control" required="required" placeholder="Email ID">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="pwd" class="control-label">Demo: *</label>
                                       <input type="text" class="form-control" required="required" name="pwd" placeholder="Password">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="cpwd" class="control-label">Demo: *</label>
                                       <input type="text" class="form-control" id="cpwd" required="required" name="cpwd" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="cno" class="control-label">demo: *</label>
                                       <input type="text" class="form-control" required="required" id="cno" name="cno" placeholder="Contact Number">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="acno" class="control-label">demo: *</label>
                                       <input type="text" class="form-control" required="required" id="acno" name="acno" placeholder="Alternate Contact Number">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="acno" class="control-label">demo: *</label>
                                       <input type="text" class="form-control" required="required" id="acno" name="acno" placeholder="Alternate Contact Number">
                                    </div>
                                    <div class="col-md-12 mb-3 form-group">
                                       <label for="address" class="control-label">Demo TextArea: *</label>
                                       <textarea name="address" class="form-control" id="address" rows="5" required="required"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3 form-group">
                                       <label for="address" class="control-label">Demo CkEditor: *</label>
                                       <textarea name="address" class="form-control" id="address" rows="5" required="required"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3 form-group">

                                     <div id="editor"></div>

                                    </div>
                                    <div class="col-md-12 mb-3 form-group">
                                        <textarea name="editor1"></textarea>
                                    </div>
									                                  
                                 </div>
                                 <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
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
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'editor1',{
      filebrowserImageBrowseUrl:'admin/elFinder/new/ckeditor',
      filebrowserBrowseUrl:'admin/elFinder/new/ckeditor',
   });
</script>
@endsection