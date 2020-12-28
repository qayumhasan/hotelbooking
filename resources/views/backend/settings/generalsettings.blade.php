@extends('layouts.admin')
@section('title', 'General Settings | '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="iq-edit-list usr-edit">
                        <ul class="iq-edit-profile d-flex nav nav-pills">

                           <li class="col-md-2 p-0">
                          @if(Session::has('soft_success'))
                          <a class="nav-link" data-toggle="pill" href="#personal-information">Company Information</a>
                          @elseif(Session::has('logo_success'))
                          <a class="nav-link" data-toggle="pill" href="#personal-information">Company Information</a>
                         @elseif(Session::has('social_success'))
                          <a class="nav-link" data-toggle="pill" href="#personal-information">Company Information</a>
                         @elseif(Session::has('seo_success'))
                          <a class="nav-link" data-toggle="pill" href="#personal-information">Company Information</a>
                         @else
                           <a class="nav-link active" data-toggle="pill" href="#personal-information">Company Information</a>
                          @endif
                           </li>
                           <li class="col-md-2 p-0">
                              @if(Session::has('soft_success'))
                              <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                               Logo Settings
                              </a>
                               @elseif(Session::has('logo_success'))
                               <a class="nav-link active" data-toggle="pill" href="#chang-pwd">
                               Logo Settings
                              </a>
                               @elseif(Session::has('social_success'))
                                <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                               Logo Settings
                              </a>
                               @elseif(Session::has('seo_success'))
                                <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                               Logo Settings
                              </a>
                              @else
                              <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                               Logo Settings
                              </a>
                              @endif

                           </li>
                           <li class="col-md-2 p-0">
                              @if(Session::has('soft_success'))
                              <a class="nav-link" data-toggle="pill" href="#emailandsms">
                              Social Media Settings
                              </a>
                              @elseif(Session::has('logo_success'))
                              <a class="nav-link" data-toggle="pill" href="#emailandsms">
                              Social Media Settings
                              </a>
                              @elseif(Session::has('social_success'))
                              <a class="nav-link active" data-toggle="pill" href="#emailandsms">
                              Social Media Settings
                              </a>
                              @elseif(Session::has('seo_success'))
                              <a class="nav-link" data-toggle="pill" href="#emailandsms">
                              Social Media Settings
                              </a>
                              @else
                              <a class="nav-link" data-toggle="pill" href="#emailandsms">
                              Social Media Settings
                              </a>
                              @endif
                           </li>
                           <li class="col-md-2 p-0">
                              @if(Session::has('soft_success'))
                              <a class="nav-link" data-toggle="pill" href="#manage-contact">
                               SEO Settings
                              </a>
                              @elseif(Session::has('logo_success'))
                              <a class="nav-link" data-toggle="pill" href="#manage-contact">
                               SEO Settings
                              </a>
                              @elseif(Session::has('social_success'))
                              <a class="nav-link" data-toggle="pill" href="#manage-contact">
                               SEO Settings
                              </a>
                              @elseif(Session::has('seo_success'))
                              <a class="nav-link active" data-toggle="pill" href="#manage-contact">
                               SEO Settings
                              </a>
                              @else
                              <a class="nav-link" data-toggle="pill" href="#manage-contact">
                               SEO Settings
                              </a>
                              @endif

                           </li>
                           <li class="col-md-2 p-0">
                              <a class="nav-link" data-toggle="pill" href="#payment">
                               Payment Gatway
                              </a>
                           </li>
                           <li class="col-md-2 p-0">
                              @if(Session::has('soft_success'))
                              <a class="nav-link active" data-toggle="pill" href="#sms">
                               Sms & Mail Settings
                              </a>
                              @elseif(Session::has('logo_success'))
                               <a class="nav-link" data-toggle="pill" href="#sms">
                               Sms & Mail Settings
                              </a>
                              @elseif(Session::has('social_success'))
                               <a class="nav-link" data-toggle="pill" href="#sms">
                               Sms & Mail Settings
                              </a>
                              @elseif(Session::has('seo_success'))
                               <a class="nav-link" data-toggle="pill" href="#sms">
                               Sms & Mail Settings
                              </a>
                              @else
                               <a class="nav-link" data-toggle="pill" href="#sms">
                               Sms & Mail Settings
                              </a>
                              @endif
                           </li>

                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="iq-edit-list-data">
                  <div class="tab-content">
                        @if(Session::has('soft_success'))
                        <div class="tab-pane fade" id="personal-information" role="tabpanel">
                        @elseif(Session::has('logo_success'))
                        <div class="tab-pane fade" id="personal-information" role="tabpanel">
                        @elseif(Session::has('social_success'))
                        <div class="tab-pane fade" id="personal-information" role="tabpanel">
                        @elseif(Session::has('seo_success'))
                        <div class="tab-pane fade" id="personal-information" role="tabpanel">
                        @else
                         <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        @endif
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Company Information</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="{{route('admin.settings.general.update')}}" method="post">
                                 @csrf
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="fname">Company Name :</label>
                                       <input type="text" class="form-control" name="company_name" id="fname" placeholder="Company Name" value="{{$companyinformation->company_name}}">
                                       <input type="hidden" name="id" value="{{$companyinformation->id}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="lname">Mobile Number :</label>
                                       <input type="text" class="form-control" name="mobile" id="lname" placeholder="Mobile Number" value="{{$companyinformation->mobile}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Email Id :</label>
                                       <input type="text" class="form-control" name="email" id="uname" placeholder="Email Id" value="{{$companyinformation->email}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Fax :</label>
                                       <input type="text" class="form-control" name="fax" id="uname" placeholder="Fax" value="{{$companyinformation->fax}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="cname">Address :</label>
                                       <textarea class="form-control" name="address" placeholder="Address">{{$companyinformation->address}}</textarea>
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="dob">Google Map :</label>
                                       <textarea class="form-control" name="google_map" placeholder="Google Map">{{$companyinformation->google_map}}</textarea>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary mr-2">Update</button>
                                 <button type="reset" class="btn btn-info">Reset</button>
                              </form>
                           </div>
                        </div>
                     </div>
                       @if(Session::has('soft_success'))
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        @elseif(Session::has('logo_success'))
                        <div class="tab-pane fade active show" id="chang-pwd" role="tabpanel">
                        @elseif(Session::has('social_success'))
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        @elseif(Session::has('seo_success'))
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        @else
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        @endif

                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Logo</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="{{route('admin.settings.logo.update')}}" method="post"enctype="multipart/form-data">
                                 @csrf
                                 <div class="form-group row">
                                    <div class="col-md-4">
                                       <input type="hidden" name="id" value="{{$logo->id}}">
                                        <input type="file" class="custom-file-input" id="customFile" name="logo">
                                       <label class="custom-file-label" for="customFile">Logo (250px*60px)</label>
                                    </div>
                                    <div class="col-md-4">
                                      <img src="{{asset('public/uploads/logo/'.$logo->logo)}}" height="50px">
                                       <input type="hidden" name="old_logo" value="{{$logo->logo}}">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                      <div class="col-md-4">
                                        <input type="file" class="custom-file-input" id="customFile" name="favicon">
                                        <label class="custom-file-label" for="customFile">Fav Icon (16px*16px)</label>
                                      </div>
                                      <div class="col-md-4">
                                          <img src="{{asset('public/uploads/logo/'.$logo->favicon)}}" height="20px">
                                          <input type="hidden" name="old_fav" value="{{$logo->favicon}}">
                                      </div>
                                 </div>
                                  <div class="form-group row">
                                      <div class="col-md-4">
                                        <input type="file" class="custom-file-input" id="customFile" name="Lazy_loader">
                                        <label class="custom-file-label" for="customFile">Lazy Loader (400px*300px)</label>
                                      </div>
                                       <div class="col-md-4">
                                          <img src="{{asset('public/uploads/logo/'.$logo->Lazy_loader)}}" height="50px" width="250px">
                                           <input type="hidden" name="old_lazy" value="{{$logo->Lazy_loader}}">
                                      </div>
                                 </div>
                                 <div class="form-group row">
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                    <button type="reset" class="btn btn-info">Reset</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                       @if(Session::has('soft_success'))
                        <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        @elseif(Session::has('logo_success'))
                       <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        @elseif(Session::has('social_success'))
                       <div class="tab-pane fade active show" id="emailandsms" role="tabpanel">
                        @elseif(Session::has('seo_success'))
                        <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        @else
                        <div class="tab-pane fade" id="emailandsms" role="tabpanel">
                        @endif
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Socail Media</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="{{route('admin.settings.socialmedia.update')}}" method="post">
                                 @csrf
                                  <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="fname">FaceBook :</label>
                                       <input type="text" class="form-control" name="facebook" id="fname" placeholder="FaceBook" value="{{$social->facebook}}">
                                       <input type="hidden" name="id" value="{{$social->id}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="lname">Twitter:</label>
                                       <input type="text" class="form-control" name="twitter" id="lname" placeholder="Twitter Number" value="{{$social->twitter}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Linkend:</label>
                                       <input type="text" class="form-control" name="linkend" id="uname" placeholder="Linkend" value="{{$social->linkend}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Youtube:</label>
                                       <input type="text" class="form-control" name="youtube" id="uname" placeholder="Youtube" value="{{$social->youtube}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="cname">Feed :</label>
                                        <input type="text" class="form-control" name="feed" id="uname" placeholder="Feed" value="{{$social->feed}}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="dob">Google-Plus :</label>
                                       <input type="text" class="form-control" name="google_plus" id="uname" placeholder="Google-Plus" value="{{$social->google_plus}}">
                                    </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary mr-2">Update</button>
                                 <button type="reset" class="btn btn-info">Reset</button>
                              </form>
                           </div>
                        </div>
                     </div>
                      @if(Session::has('soft_success'))
                         <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                        @elseif(Session::has('logo_success'))
                      <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                        @elseif(Session::has('social_success'))
                        <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                        @elseif(Session::has('seo_success'))
                         <div class="tab-pane fade active show" id="manage-contact" role="tabpanel">
                        @else
                         <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                        @endif


                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">SEO(Search engine optimization)</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <form action="{{route('admin.settings.seo.update')}}" method="post">
                                 @csrf
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="fname">Meta Title :</label>
                                       <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$seo->meta_title}}">
                                       <input type="hidden" name="id" value="{{$seo->id}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="lname">Meta Author :</label>
                                       <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Meta Keyword :</label>
                                       <input type="text" class="form-control" data-role="tagsinput" name="meta_keyword" placeholder="" value="{{$seo->meta_keyword}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Meta Description :</label>
                                       <input type="text" class="form-control" name="meta_description" id="uname" placeholder="Meta Description" value="{{$seo->meta_description}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="cname">Google Verification :</label>
                                        <input type="text" class="form-control" name="google_verification" id="uname" placeholder="Google Verification" value="{{$seo->google_verification}}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="dob">Bing Verification :</label>
                                       <input type="text" class="form-control" name="bing_verification" id="uname" placeholder="Bing Verification" value="{{$seo->bing_verification}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="dob">Google Analytics :</label>
                                       <input type="text" class="form-control" name="google_analytics" id="uname" placeholder="Google Analytics" value="{{$seo->google_analytics}}">
                                    </div>
                                     <div class="form-group col-sm-6">
                                       <label for="dob">Alexa Analytics :</label>
                                       <input type="text" class="form-control" name="alexa_analytics" id="uname" placeholder="Alexa Analytics" value="{{$seo->alexa_analytics}}">
                                    </div>
                                     <div class="form-group col-sm-6">
                                       <label for="dob">Facebook Pixel :</label>
                                       <input type="text" class="form-control" name="facebook_pixel" id="uname" placeholder="Facebook Pixel" value="{{$seo->facebook_pixel}}">
                                    </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary mr-2">Update</button>
                                 <button type="reset" class="btn btn-info">Reset</button>

                              </form>
                           </div>
                        </div>
                     </div>
                     <!-- payment gateway -->
                        <div class="tab-pane fade" id="payment" role="tabpanel">
                            <div class="row">
                              <!-- paypal -->
                              <div class="col-sm-4">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Pypal Payment Gateway</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <form action="" method="post">
                                          @csrf
                                           <div class="row align-items-center">
                                             <div class="form-group col-sm-12">
                                                <label for="fname">UserName :</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$seo->meta_title}}">
                                                <input type="hidden" name="id" value="{{$seo->id}}">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <label for="lname">Password:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <label for="lname">Secret Key:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                <div class="custom-switch-inner">
                                                   <p class="mb-0"></p>
                                                   <input type="checkbox" class="custom-control-input bg-success" id="customSwitch-22" checked="">
                                                   <label class="custom-control-label" for="customSwitch-22" data-on-label="Tr" data-off-label="Fal">
                                                   </label>
                                                </div>
                                             </div>
                                             </div>



                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button type="reset" class="btn btn-info">Reset</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- paypalend end -->
                                <div class="col-sm-4">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Ssl Commerce Gateway</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <form action="" method="post">
                                          @csrf
                                           <div class="row align-items-center">
                                             <div class="form-group col-sm-12">
                                                <label for="fname">UserName :</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$seo->meta_title}}">
                                                <input type="hidden" name="id" value="{{$seo->id}}">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <label for="lname">Password:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <label for="lname">Secret Key:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                   <div class="custom-switch-inner">
                                                      <p class="mb-0"></p>
                                                      <input type="checkbox" class="custom-control-input bg-success" id="customSwitch-22" checked="">
                                                      <label class="custom-control-label" for="customSwitch-22" data-on-label="Tr" data-off-label="Fal">
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button type="reset" class="btn btn-info">Reset</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- ssl end -->
                              <div class="col-sm-4">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Stripe Gateway</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <form action="" method="post">
                                          @csrf
                                           <div class="row align-items-center">
                                             <div class="form-group col-sm-12">
                                                <label for="fname">UserName :</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$seo->meta_title}}">
                                                <input type="hidden" name="id" value="{{$seo->id}}">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <label for="lname">Password:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <label for="lname">Secret Key:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                   <div class="custom-switch-inner">
                                                      <p class="mb-0"></p>
                                                      <input type="checkbox" class="custom-control-input bg-success" id="customSwitch-22" checked="">
                                                      <label class="custom-control-label" for="customSwitch-22" data-on-label="Tr" data-off-label="Fal">
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button type="reset" class="btn btn-info">Reset</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- stripeend -->
                              <div class="col-sm-4">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Bkash Gateway</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <form action="" method="post">
                                          @csrf
                                           <div class="row align-items-center">
                                             <div class="form-group col-sm-12">
                                                <label for="fname">UserName :</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$seo->meta_title}}">
                                                <input type="hidden" name="id" value="{{$seo->id}}">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <label for="lname">Password:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <label for="lname">Secret Key:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                   <div class="custom-switch-inner">
                                                      <p class="mb-0"></p>
                                                      <input type="checkbox" class="custom-control-input bg-success" id="customSwitch-22" checked="">
                                                      <label class="custom-control-label" for="customSwitch-22" data-on-label="Tr" data-off-label="Fal">
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button type="reset" class="btn btn-info">Reset</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- bkash end -->
                              <div class="col-sm-4">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Nagad Gateway</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <form action="" method="post">
                                          @csrf
                                           <div class="row align-items-center">
                                             <div class="form-group col-sm-12">
                                                <label for="fname">UserName :</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$seo->meta_title}}">
                                                <input type="hidden" name="id" value="{{$seo->id}}">
                                             </div>
                                             <div class="form-group col-sm-12">
                                                <label for="lname">Password:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <label for="lname">Secret Key:</label>
                                                <input type="text" class="form-control" name="meta_author" placeholder="Meta Author" value="{{$seo->meta_author}}">
                                             </div>
                                              <div class="form-group col-sm-12">
                                                <div class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                                                   <div class="custom-switch-inner">
                                                      <p class="mb-0"></p>
                                                      <input type="checkbox" class="custom-control-input bg-success" id="customSwitch-22" checked="">
                                                      <label class="custom-control-label" for="customSwitch-22" data-on-label="Tr" data-off-label="Fal">
                                                      </label>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button type="reset" class="btn btn-info">Reset</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <!-- nagad -->
                           </div>
                        </div>


                        @if(Session::has('soft_success'))
                          <div class="tab-pane fade active show" id="sms" role="tabpanel">
                        @elseif(Session::has('logo_success'))
                        <div class="tab-pane fade" id="sms" role="tabpanel">
                        @elseif(Session::has('social_success'))
                       <div class="tab-pane fade" id="sms" role="tabpanel">
                        @elseif(Session::has('seo_success'))
                         <div class="tab-pane fade" id="sms" role="tabpanel">
                        @else
                         <div class="tab-pane fade" id="sms" role="tabpanel">
                        @endif

                         <div class="row">
                              <!-- paypal -->
                              <div class="col-sm-12">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Sms</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <form action="{{route('admin.sms.update')}}" method="post">
                                          @csrf
                                           <div class="row align-items-center">
                                             <div class="form-group col-sm-6">
                                                <label for="fname">Sms Link :</label>
                                                <input type="text" class="form-control" name="sms_url" placeholder="Sms Link" value="{{$smsmodel->sms_url}}">
                                                <input type="hidden" name="id" value="{{$smsmodel->id}}">
                                             </div>
                                             <div class="form-group col-sm-6">
                                                <label for="lname">User Name:</label>
                                                <input type="text" class="form-control" name="sms_username" placeholder="User Name" value="{{$smsmodel->sms_username}}">
                                             </div>
                                              <div class="form-group col-sm-6">
                                                <label for="lname">Password:</label>
                                                <input type="text" class="form-control" name="sms_password" placeholder="Password" value="{{$smsmodel->sms_password}}">
                                             </div>
                                              <div class="form-group col-sm-6">
                                                <label for="lname">Sms Type:</label>
                                                <select class="form-control" name="sms_type">
                                                   <option value="1" @if($smsmodel->sms_type==1) selected @endif>Text</option>
                                                   <option value="2" @if($smsmodel->sms_type==2) selected @endif>Flash</option>
                                                   <option value="3" @if($smsmodel->sms_type==3) selected @endif>Flash Unicode</option>
                                                   <option value="4" @if($smsmodel->sms_type==4) selected @endif>Unicode/Bangla</option>
                                                </select>
                                             </div>
                                             <div class="form-group col-sm-6">
                                                <label for="lname">Sms Masking:</label>
                                                <select class="form-control" name="sms_masking">
                                                   <option value="Masking" @if($smsmodel->sms_masking=='Masking') selected @endif>Masking</option>
                                                   <option value="Non-Masking" @if($smsmodel->sms_masking=='Non-Masking') selected @endif>Non-Masking</option>
                                                </select>
                                             </div>
                                          </div>
                                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                                          <button type="reset" class="btn btn-info">Reset</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Smtp</h4>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                    <form action="{{route('admin.Smtp.update')}}" method="post">
                                       @csrf
                                    <div class=" row align-items-center">
                                       <div class="form-group col-sm-6">
                                          <label for="fname">Mail Maliar:</label>
                                          <input type="text" class="form-control" name="MAIL_MAILER" id="fname" placeholder="Mail Maliar" value="{{ env('MAIL_MAILER') }}">
                                            <input type="hidden" name="types[]" value="MAIL_MAILER">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="lname">Mail Host :</label>
                                          <input type="hidden" name="types[]" value="MAIL_HOST">
                                          <input type="text" class="form-control" name="MAIL_HOST"  placeholder="Mail Host" value="{{ env('MAIL_HOST') }}">
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="uname">Mail Port :</label>
                                          <input type="hidden" name="types[]" value="MAIL_PORT">
                                          <input type="text" class="form-control" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}" placeholder="Mail Port" required>
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="uname">Mail UserName :</label>
                                          <input type="hidden" name="types[]" value="MAIL_USERNAME">
                                          <input type="text" class="form-control" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" placeholder="Mail UserName" required>
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="cname">Mail Password :</label>
                                         <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                                          <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" placeholder="Mail Password" required>
                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="cname">Mail Encryption :</label>
                                           <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                                           <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}" placeholder="Mail Encription" required>

                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="cname">Mail Form Name :</label>
                                          <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                                          <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}" placeholder="Mail Form Name" required>

                                       </div>
                                       <div class="form-group col-sm-6">
                                          <label for="cname">Mail Form Address :</label>
                                          <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                                          <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{ env('MAIL_FROM_ADDRESS') }}" placeholder="Mail Form Address" required>
                                       </div>


                                 </div>
                                 <button type="submit" class="btn btn-primary mr-2">Update</button>
                                 <button type="reset" class="btn btn-infor">Reset</button>
                                       </form>
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
   </div>
   <script>
      function(){
       $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
      }

   </script>

@endsection
