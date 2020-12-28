@extends('layouts.admin')
@section('title', 'Compose Mail | '.$seo->meta_title)
@section('content')
<div class="content-page">
      <div class="container-fluid">
         <div class="row row-eq-height">
            <div class="col-md-7">
               <div class="row">
                  <div class="col-md-12">
                     <div class="card iq-border-radius-20">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12 mb-3">
                                 <h5 class="text-primary card-title"><i class="ri-pencil-fill"></i> Compose Message</h5>
                              </div>
                           </div>
                           <form class="email-form" method="post" action="{{route('admin.email.send')}}">
                           	@csrf
                              <div class="form-group row">
                                 <label for="multiple" class="col-sm-2 col-form-label">To:</label>
                                 <div class="col-sm-10">
                                    <select  id="multiple" class="js-states form-control @error('email') is-invalid @enderror" name="email[]" multiple>
                                    	@foreach($subscrivemail as $smail)
                                       <option value="{{$smail->email}}">{{$smail->email}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                                 <div class="col-sm-10">
                                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="subject" class="col-sm-2 col-form-label">Your Message:</label>
                                 <div class="col-md-10">
                                    <textarea name="send_message" class="textarea form-control @error('send_message') is-invalid @enderror" rows="5" id="editor1"></textarea>
                                 </div>
                              </div>
                              <div class="form-group row align-items-center">
                                 <div class="d-flex flex-grow-1 align-items-center send-buttons">
                                    <div class="send-btn pl-3">
                                       <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                    <!-- <div class="send-panel">
                                       <label class="ml-2 bg-primary-light rounded" for="file"> <input type="file" id="file" style="display: none"> <a><i class="ri-attachment-line text-primary"></i> </a> </label>
                                       <label class="ml-2 bg-primary-light rounded"> <a href="javascript:void(0);"> <i class="ri-map-pin-user-line text-primary"></i></a>  </label>
                                       <label class="ml-2 bg-primary-light rounded"> <a href="javascript:void(0);"> <i class="ri-drive-line text-primary"></i></a>  </label>
                                       <label class="ml-2 bg-primary-light rounded"> <a href="javascript:void(0);"> <i class="ri-camera-line text-primary"></i></a>  </label>
                                       <label class="ml-2 bg-primary-light rounded"> <a href="javascript:void(0);"> <i class="ri-user-smile-line text-primary"></i></a>  </label>
                                    </div> -->
                                 </div>
                                 <div class="d-flex mr-3 align-items-center">
                                    <!-- <div class="send-panel float-right">
                                       <label class="ml-2 mb-0 bg-primary-light rounded" ><a href="javascript:void(0);"><i class="ri-settings-2-line text-primary"></i></a></label>
                                       <label class="ml-2 mb-0 bg-primary-light rounded"><a href="javascript:void(0);">  <i class="ri-delete-bin-line text-primary"></i></a>  </label>
                                    </div> -->
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--  -->
            

            <!--  -->
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
