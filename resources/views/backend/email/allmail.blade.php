@extends('layouts.admin')
@section('title', 'All Mail | '.$seo->meta_title)
@section('content')
<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3">
               <div class="card">
                  <div class="card-body">
                     <div class="">
                        <div class="iq-email-list">
                           <button class="btn btn-primary btn-lg btn-block mb-3 font-size-16 p-3" data-target="#compose-email-popup" data-toggle="modal"><i class="ri-send-plane-line mr-2"></i>New Message</button>
                           <div class="iq-email-ui nav flex-column nav-pills">
                             @if(Session::has('sendmailsuccess'))
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-inbox"><a href="index.html"><i class="ri-mail-line"></i>Inbox<span class="badge badge-primary ml-2">{{$newmessage}}</span></a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-starred"><a href="#"><i class="ri-star-line"></i>Starred</a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-draft"><a href="#"><i class="ri-file-list-2-line"></i>Draft</a></li>
                              <li class="nav-link active" role="tab" data-toggle="pill" href="#mail-sent"><a href="#"><i class="ri-mail-send-line"></i>Sent Mail</a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-trash"><a href="#"><i class="ri-delete-bin-line"></i>Trash</a></li>
                              @else
                              <li class="nav-link active" role="tab" data-toggle="pill" href="#mail-inbox"><a href="index.html"><i class="ri-mail-line"></i>Inbox<span class="badge badge-primary ml-2">{{$newmessage}}</span></a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-starred"><a href="#"><i class="ri-star-line"></i>Starred</a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-draft"><a href="#"><i class="ri-file-list-2-line"></i>Draft</a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-sent"><a href="#"><i class="ri-mail-send-line"></i>Sent Mail</a></li>
                              <li class="nav-link" role="tab" data-toggle="pill" href="#mail-trash"><a href="#"><i class="ri-delete-bin-line"></i>Trash</a></li>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-9 mail-box-detail">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="">
                        <div class="iq-email-to-list p-3">
                           <div class="d-flex justify-content-between">
                              <ul>
                                 <li>
                                    <a href="#" id="navbarDropdown" data-toggle="dropdown">
                                       <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1"></label>
                                       </div>
                                    </a>
                                 </li>
                                 <li data-toggle="tooltip" data-placement="top" title="Reload"><a href="{{route('admin.email')}}"><i class="ri-restart-line"></i></a></li>
                              <!--    <li data-toggle="tooltip" data-placement="top" title="Archive"><a href="#"><i class="ri-mail-open-line"></i></a></li> -->
                       <!--           <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li> -->


                              </ul>
                              <div class="iq-email-search d-flex">
                                 <form class="mr-3 position-relative">
                                    <div class="form-group mb-0">
                                       <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search">
                                       <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                    </div>
                                 </form>
                                 <ul>
                                    <li class="mr-3">
                                       <a class="font-size-14" href="#" id="navbarDropdown" data-toggle="dropdown">
                                       1 - 50 of 505
                                       </a>
                                       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="#">20 per page</a>
                                          <a class="dropdown-item" href="#">50 per page</a>
                                          <a class="dropdown-item" href="#">100 per page</a>
                                       </div>
                                    </li>
                                    <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                    <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                    <li class="mr-0" data-toggle="tooltip" data-placement="top" title="Setting"><a href="#"><i class="ri-list-settings-line"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="iq-email-listbox">
                           <div class="tab-content">
                              @if(Session::has('sendmailsuccess'))
                              <div class="tab-pane fade" id="mail-inbox" role="tabpanel">
                                 <ul class="iq-email-sender-list">
                                 	<!-- foreach hobe -->
                                 	@foreach($allmail as $key => $data)

                                    <li class="iq-unread">
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                   <label class="custom-control-label" for="mailk{{$key}}"></label>
                                                </div>
                                             </div>
                                             <style>
                        												.star {
                        													    visibility:hidden;
                        													    font-size:30px;
                        													    cursor:pointer;
                        													    position: absolute;
                           														margin-top: -10px;
                        													}
                        													.star:before {
                        													   content: "\2605";
                        													   position: absolute;
                        													   visibility:visible;
                        													}
                        													.star:checked:before {
                        													   content: "\2606";
                        													   position: absolute;
                        													}
                                             </style>
                                               <div class="iq-checkbox-mail">
                                                <div class=" custom-checkbox">
                                                @if($data->starred==0)
                                                  <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                                  @else
                                                  <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                                  @endif
                                                </div>
                                             </div>

                                             <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                             <a  class="iq-email-title">{{$data->name}}</a>
                                          </div>
                                          <div class="iq-email-content" data-id="{{$data->id}}">
                                             <a href="javascript: void(0);" class="iq-email-subject">
                                             <span>{{Str::limit($data->message,100)}}</span>
                                             </a>
                                             <div class="iq-email-date">{{$data->created_at}}</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                         	<a data-id="{{$data->id}}" data-target="#compose-email-popup" data-toggle="modal" class="individual"><i class="ri-mail-open-line"></i>
                                                         	</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                        <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>{{$data->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>{{$data->created_at}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>{{$data->subject}}</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>{{$data->message}}</p>

                                                      </div>
                                                      <hr>
                                                <!--       <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div> -->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- endforeach -->

                                    @endforeach

                                 </ul>
                              </div>
                              <div class="tab-pane fade" id="mail-starred" role="tabpanel">
                                 <ul class="iq-email-sender-list">
                              		 @foreach($allstarted as $key => $data)
                                      <li class="iq-unread">
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                   <label class="custom-control-label" for="mailk{{$key}}"></label>
                                                </div>
                                             </div>
                                             <style>
												.star {
													    visibility:hidden;
													    font-size:30px;
													    cursor:pointer;
													    position: absolute;
   														margin-top: -10px;
													}
													.star:before {
													   content: "\2605";
													   position: absolute;
													   visibility:visible;
													}
													.star:checked:before {
													   content: "\2606";
													   position: absolute;
													}
                                             </style>
                                               <div class="iq-checkbox-mail">
                                                <div class=" custom-checkbox">
                                                @if($data->starred==0)
                                                  <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                                  @else
                                                  <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                                  @endif
                                                </div>
                                             </div>

                                             <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                             <a  class="iq-email-title">{{$data->name}}</a>
                                          </div>
                                          <div class="iq-email-content" data-id="{{$data->id}}">
                                             <a href="javascript: void(0);" class="iq-email-subject">
                                             <span>{{Str::limit($data->message,100)}}</span>
                                             </a>
                                             <div class="iq-email-date">{{$data->created_at}}</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                         	<a  data-target="#compose-email-popup" data-toggle="modal">		<i class="ri-mail-open-line"></i>
                                                         	</a>
                                                         </li>

                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>{{$data->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>{{$data->created_at}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>{{$data->subject}}</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>{{$data->message}}</p>

                                                      </div>
                                                      <hr>
                                                <!--       <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div> -->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- endforeach -->
                                    @endforeach
                                 </ul>
                              </div>
                              <div class="tab-pane fade" id="mail-draft" role="tabpanel">
                                 <ul class="iq-email-sender-list">
                                    <li>
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk9">
                                                   <label class="custom-control-label" for="mailk9"></label>
                                                </div>
                                             </div>
                                             <span class="ri-star-line iq-star-toggle"></span>
                                             <a href="javascript: void(0);" class="iq-email-title">Fabian Ros (Me)</a>
                                          </div>
                                          <div class="iq-email-content">
                                             <a href="javascript: void(0);" class="iq-email-subject">Eb Begg (@ebbegg) has sent
                                             you a direct message on Twitter! &nbsp;–&nbsp;
                                             <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                             </a>
                                             <div class="iq-email-date">11:49 am</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                             <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-time-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                         <img src="../assets/images/user/user-4.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>Medium Daily Digest</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>reply-to:</td>
                                                                           <td>noreply@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>to:</td>
                                                                           <td>iqonicdesigns@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>13 Dec 2019, 08:30</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>The Golden Rule</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>security:</td>
                                                                           <td>Standard encryption</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>Hi Fabian Ros,</p>
                                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                         <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                         <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                      </div>
                                                      <hr>
                                                      <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <li>
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk10">
                                                   <label class="custom-control-label" for="mailk10"></label>
                                                </div>
                                             </div>
                                             <span class="ri-star-line iq-star-toggle"></span>
                                             <a href="javascript: void(0);" class="iq-email-title">Dixa Horton (Me)</a>
                                          </div>
                                          <div class="iq-email-content">
                                             <a href="javascript: void(0);" class="iq-email-subject">Mackenzie Barryo (@mackenzieBarryo) has sent
                                             you a direct message on Twitter! &nbsp;–&nbsp;
                                             <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                             </a>
                                             <div class="iq-email-date">11:49 am</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                             <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-time-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                         <img src="../assets/images/user/user-5.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>Medium Daily Digest</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>reply-to:</td>
                                                                           <td>noreply@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>to:</td>
                                                                           <td>iqonicdesigns@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>13 Dec 2019, 08:30</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>The Golden Rule</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>security:</td>
                                                                           <td>Standard encryption</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>Hi Dixa Horton,</p>
                                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                         <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                         <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                      </div>
                                                      <hr>
                                                      <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <li>
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk11">
                                                   <label class="custom-control-label" for="mailk11"></label>
                                                </div>
                                             </div>
                                             <span class="ri-star-line iq-star-toggle"></span>
                                             <a href="javascript: void(0);" class="iq-email-title">Megan Allen (Me)</a>
                                          </div>
                                          <div class="iq-email-content">
                                             <a href="javascript: void(0);" class="iq-email-subject">Jecno Mac (@jecnomac) has sent
                                             you a direct message on Twitter! &nbsp;–&nbsp;
                                             <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                             </a>
                                             <div class="iq-email-date">11:49 am</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                             <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-time-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                         <img src="../assets/images/user/user-6.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>Medium Daily Digest</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>reply-to:</td>
                                                                           <td>noreply@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>to:</td>
                                                                           <td>iqonicdesigns@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>13 Dec 2019, 08:30</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>The Golden Rule</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>security:</td>
                                                                           <td>Standard encryption</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>Hi Megan Allen,</p>
                                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                         <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                         <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                      </div>
                                                      <hr>
                                                      <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <li>
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk12">
                                                   <label class="custom-control-label" for="mailk12"></label>
                                                </div>
                                             </div>
                                             <span class="ri-star-line iq-star-toggle"></span>
                                             <a href="javascript: void(0);" class="iq-email-title">Jopour Xiong (Me)</a>
                                          </div>
                                          <div class="iq-email-content">
                                             <a href="javascript: void(0);" class="iq-email-subject">Mackenzie Barryo (@mackenzieBarryo) has sent
                                             you a direct message on Twitter! &nbsp;–&nbsp;
                                             <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                             </a>
                                             <div class="iq-email-date">11:49 am</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                             <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-time-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                         <img src="../assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>Medium Daily Digest</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>reply-to:</td>
                                                                           <td>noreply@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>to:</td>
                                                                           <td>iqonicdesigns@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>13 Dec 2019, 08:30</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>The Golden Rule</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>security:</td>
                                                                           <td>Standard encryption</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>Hi Jopour Xiong,</p>
                                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                         <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                         <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                      </div>
                                                      <hr>
                                                      <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <li>
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk13">
                                                   <label class="custom-control-label" for="mailk13"></label>
                                                </div>
                                             </div>
                                             <span class="ri-star-line iq-star-toggle"></span>
                                             <a href="javascript: void(0);" class="iq-email-title">Deray Billings (Me)</a>
                                          </div>
                                          <div class="iq-email-content">
                                             <a href="javascript: void(0);" class="iq-email-subject">Eb Begg(@ebbegg) has sent
                                             you a direct message on Twitter! &nbsp;–&nbsp;
                                             <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                             </a>
                                             <div class="iq-email-date">11:49 am</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                             <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-time-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                         <img src="../assets/images/user/user-2.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>Medium Daily Digest</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>reply-to:</td>
                                                                           <td>noreply@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>to:</td>
                                                                           <td>iqonicdesigns@gmail.com</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>13 Dec 2019, 08:30</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>The Golden Rule</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>security:</td>
                                                                           <td>Standard encryption</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>Hi Deray Billings,</p>
                                                         <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                         <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                         <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                      </div>
                                                      <hr>
                                                      <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </ul>
                              </div>
                              <div class="tab-pane fade show active" id="mail-sent" role="tabpanel">
                                 <ul class="iq-email-sender-list">
                                  @foreach($allsendmail as $key => $data)
                                    <li class="iq-unread">
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                   <label class="custom-control-label" for="mailk{{$key}}"></label>
                                                </div>
                                             </div>
                                             <style>
                                                .star {
                                                       visibility:hidden;
                                                       font-size:30px;
                                                       cursor:pointer;
                                                       position: absolute;
                                                         margin-top: -10px;
                                                   }
                                                   .star:before {
                                                      content: "\2605";
                                                      position: absolute;
                                                      visibility:visible;
                                                   }
                                                   .star:checked:before {
                                                      content: "\2606";
                                                      position: absolute;
                                                   }
                                             </style>
                                               <div class="iq-checkbox-mail">
                                                <div class=" custom-checkbox">

                                                  <input class="star starred" type="checkbox" name="starred" data-id="" title="bookmark page" value="" checked>

                                                </div>
                                             </div>

                                             <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                             <a  class="iq-email-title">{{$seo->meta_title}}</a>
                                          </div>
                                          <div class="iq-email-content" data-id="{{$data->id}}">
                                             <a href="javascript: void(0);" class="iq-email-subject">
                                             <span>{!! Str::limit($data->message,100) !!}</span>
                                             </a>
                                             <div class="iq-email-date">{{$data->created_at}}</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="{{url('admin/sendemail/delete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                            <!--  <li><a href="#"><i class="ri-mail-line"></i></a></li> -->
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                            <a data-id="{{$data->id}}" data-target="#compose-email-popup" data-toggle="modal" class="individual"><i class="ri-mail-open-line"></i>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/sendemail/delete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                        <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">{{$seo->meta_title}} <a href=""></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                               <td>@foreach(json_decode($data->mail_id) as $email)
                                                                  {{$email}},
                                                                  @endforeach
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>{{$data->created_at}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>{{$data->subject}}</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>{!!$data->message!!}</p>

                                                      </div>
                                                      <hr>

                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- endforeach -->

                                    @endforeach
                                 </ul>
                              </div>
                              <div class="tab-pane fade" id="mail-trash" role="tabpanel">
                                 <ul class="iq-email-sender-list">
                                    @foreach($alldeleted as $key => $data)
                                      <li class="iq-unread">
                                       <div class="d-flex align-self-center">
                                          <div class="iq-email-sender-info">
                                             <div class="iq-checkbox-mail">
                                                <div class="custom-control custom-checkbox">
                                                   <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                   <label class="custom-control-label" for="mailk{{$key}}"></label>
                                                </div>
                                             </div>
                                             <style>
                        												.star {
                        													    visibility:hidden;
                        													    font-size:30px;
                        													    cursor:pointer;
                        													    position: absolute;
                           														margin-top: -10px;
                        													}
                        													.star:before {
                        													   content: "\2605";
                        													   position: absolute;
                        													   visibility:visible;
                        													}
                        													.star:checked:before {
                        													   content: "\2606";
                        													   position: absolute;
                        													}
                                             </style>
                                               <div class="iq-checkbox-mail">
                                                <div class=" custom-checkbox">
                                                @if($data->starred==0)
                                                  <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                                  @else
                                                  <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                                  @endif
                                                </div>
                                             </div>

                                             <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                             <a  class="iq-email-title">{{$data->name}}</a>
                                          </div>
                                          <div class="iq-email-content" data-id="{{$data->id}}">
                                             <a href="javascript: void(0);" class="iq-email-subject">
                                             <span>{{Str::limit($data->message,100)}}</span>
                                             </a>
                                             <div class="iq-email-date">{{$data->created_at}}</div>
                                          </div>
                                          <ul class="iq-social-media">
                                             <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                             <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          </ul>
                                       </div>
                                    </li>
                                    <div class="email-app-details">
                                       <div class="card">
                                          <div class="card-body p-0">
                                             <div class="">
                                                <div class="iq-email-to-list p-3">
                                                   <div class="d-flex justify-content-between">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a href="javascript: void(0);">
                                                               <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                            </a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/delete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                      </ul>
                                                      <div class="iq-email-search d-flex">
                                                         <ul>
                                                            <li class="mr-3">
                                                               <a class="font-size-14" href="#">1 of 505</a>
                                                            </li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <hr class="mt-0">
                                                <div class="iq-inbox-subject p-3">
                                                   <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                   <div class="iq-inbox-subject-info">
                                                      <div class="iq-subject-info">
                                                        <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                         <div class="iq-subject-status align-self-center">
                                                            <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                            <div class="dropdown">
                                                               <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               to Me
                                                               </a>
                                                               <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                                  <table class="iq-inbox-details">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td>from:</td>
                                                                           <td>{{$data->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>date:</td>
                                                                           <td>{{$data->created_at}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                           <td>subject:</td>
                                                                           <td>{{$data->subject}}</td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </div>
                                                            </div>
                                                         </div>
                                                         <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                      </div>
                                                      <div class="iq-inbox-body mt-5">
                                                         <p>{{$data->message}}</p>

                                                      </div>
                                                      <hr>
                                                <!--       <div class="attegement">
                                                         <h6 class="mb-2">ATTACHED FILES:</h6>
                                                         <ul>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                            </li>
                                                            <li class="icon icon-attegment">
                                                               <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                            </li>
                                                         </ul>
                                                      </div> -->
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- endforeach -->
                                    @endforeach
                                 </ul>
                              </div>
                           </div>
                           @elseif(Session::has('trashsuccess'))
                           <div class="tab-pane fade" id="mail-inbox" role="tabpanel">
                              <ul class="iq-email-sender-list">
                               <!-- foreach hobe -->
                               @foreach($allmail as $key => $data)

                                 <li class="iq-unread">
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                <label class="custom-control-label" for="mailk{{$key}}"></label>
                                             </div>
                                          </div>
                                          <style>
                                             .star {
                                                   visibility:hidden;
                                                   font-size:30px;
                                                   cursor:pointer;
                                                   position: absolute;
                                                   margin-top: -10px;
                                               }
                                               .star:before {
                                                  content: "\2605";
                                                  position: absolute;
                                                  visibility:visible;
                                               }
                                               .star:checked:before {
                                                  content: "\2606";
                                                  position: absolute;
                                               }
                                          </style>
                                            <div class="iq-checkbox-mail">
                                             <div class=" custom-checkbox">
                                             @if($data->starred==0)
                                               <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                               @else
                                               <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                               @endif
                                             </div>
                                          </div>

                                          <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                          <a  class="iq-email-title">{{$data->name}}</a>
                                       </div>
                                       <div class="iq-email-content" data-id="{{$data->id}}">
                                          <a href="javascript: void(0);" class="iq-email-subject">
                                          <span>{{Str::limit($data->message,100)}}</span>
                                          </a>
                                          <div class="iq-email-date">{{$data->created_at}}</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                       <a data-id="{{$data->id}}" data-target="#compose-email-popup" data-toggle="modal" class="individual"><i class="ri-mail-open-line"></i>
                                                       </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                     <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>{{$data->email}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>{{$data->created_at}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>{{$data->subject}}</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>{{$data->message}}</p>

                                                   </div>
                                                   <hr>
                                             <!--       <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div> -->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- endforeach -->

                                 @endforeach

                              </ul>
                           </div>
                           <div class="tab-pane fade" id="mail-starred" role="tabpanel">
                              <ul class="iq-email-sender-list">
                                @foreach($allstarted as $key => $data)
                                   <li class="iq-unread">
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                <label class="custom-control-label" for="mailk{{$key}}"></label>
                                             </div>
                                          </div>
                                          <style>
                                           .star {
                                                 visibility:hidden;
                                                 font-size:30px;
                                                 cursor:pointer;
                                                 position: absolute;
                                                 margin-top: -10px;
                                             }
                                             .star:before {
                                                content: "\2605";
                                                position: absolute;
                                                visibility:visible;
                                             }
                                             .star:checked:before {
                                                content: "\2606";
                                                position: absolute;
                                             }
                                          </style>
                                            <div class="iq-checkbox-mail">
                                             <div class=" custom-checkbox">
                                             @if($data->starred==0)
                                               <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                               @else
                                               <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                               @endif
                                             </div>
                                          </div>

                                          <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                          <a  class="iq-email-title">{{$data->name}}</a>
                                       </div>
                                       <div class="iq-email-content" data-id="{{$data->id}}">
                                          <a href="javascript: void(0);" class="iq-email-subject">
                                          <span>{{Str::limit($data->message,100)}}</span>
                                          </a>
                                          <div class="iq-email-date">{{$data->created_at}}</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                       <a  data-target="#compose-email-popup" data-toggle="modal">		<i class="ri-mail-open-line"></i>
                                                       </a>
                                                      </li>

                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>{{$data->email}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>{{$data->created_at}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>{{$data->subject}}</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>{{$data->message}}</p>

                                                   </div>
                                                   <hr>
                                             <!--       <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div> -->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- endforeach -->
                                 @endforeach
                              </ul>
                           </div>
                           <div class="tab-pane fade" id="mail-draft" role="tabpanel">
                              <ul class="iq-email-sender-list">
                                 <li>
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk9">
                                                <label class="custom-control-label" for="mailk9"></label>
                                             </div>
                                          </div>
                                          <span class="ri-star-line iq-star-toggle"></span>
                                          <a href="javascript: void(0);" class="iq-email-title">Fabian Ros (Me)</a>
                                       </div>
                                       <div class="iq-email-content">
                                          <a href="javascript: void(0);" class="iq-email-subject">Eb Begg (@ebbegg) has sent
                                          you a direct message on Twitter! &nbsp;–&nbsp;
                                          <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                          </a>
                                          <div class="iq-email-date">11:49 am</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-time-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                      <img src="../assets/images/user/user-4.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>Medium Daily Digest</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>reply-to:</td>
                                                                        <td>noreply@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>to:</td>
                                                                        <td>iqonicdesigns@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>13 Dec 2019, 08:30</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>The Golden Rule</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>security:</td>
                                                                        <td>Standard encryption</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>Hi Fabian Ros,</p>
                                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                      <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                      <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                   </div>
                                                   <hr>
                                                   <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <li>
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk10">
                                                <label class="custom-control-label" for="mailk10"></label>
                                             </div>
                                          </div>
                                          <span class="ri-star-line iq-star-toggle"></span>
                                          <a href="javascript: void(0);" class="iq-email-title">Dixa Horton (Me)</a>
                                       </div>
                                       <div class="iq-email-content">
                                          <a href="javascript: void(0);" class="iq-email-subject">Mackenzie Barryo (@mackenzieBarryo) has sent
                                          you a direct message on Twitter! &nbsp;–&nbsp;
                                          <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                          </a>
                                          <div class="iq-email-date">11:49 am</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-time-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                      <img src="../assets/images/user/user-5.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>Medium Daily Digest</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>reply-to:</td>
                                                                        <td>noreply@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>to:</td>
                                                                        <td>iqonicdesigns@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>13 Dec 2019, 08:30</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>The Golden Rule</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>security:</td>
                                                                        <td>Standard encryption</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>Hi Dixa Horton,</p>
                                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                      <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                      <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                   </div>
                                                   <hr>
                                                   <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <li>
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk11">
                                                <label class="custom-control-label" for="mailk11"></label>
                                             </div>
                                          </div>
                                          <span class="ri-star-line iq-star-toggle"></span>
                                          <a href="javascript: void(0);" class="iq-email-title">Megan Allen (Me)</a>
                                       </div>
                                       <div class="iq-email-content">
                                          <a href="javascript: void(0);" class="iq-email-subject">Jecno Mac (@jecnomac) has sent
                                          you a direct message on Twitter! &nbsp;–&nbsp;
                                          <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                          </a>
                                          <div class="iq-email-date">11:49 am</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-time-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                      <img src="../assets/images/user/user-6.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>Medium Daily Digest</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>reply-to:</td>
                                                                        <td>noreply@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>to:</td>
                                                                        <td>iqonicdesigns@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>13 Dec 2019, 08:30</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>The Golden Rule</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>security:</td>
                                                                        <td>Standard encryption</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>Hi Megan Allen,</p>
                                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                      <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                      <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                   </div>
                                                   <hr>
                                                   <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <li>
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk12">
                                                <label class="custom-control-label" for="mailk12"></label>
                                             </div>
                                          </div>
                                          <span class="ri-star-line iq-star-toggle"></span>
                                          <a href="javascript: void(0);" class="iq-email-title">Jopour Xiong (Me)</a>
                                       </div>
                                       <div class="iq-email-content">
                                          <a href="javascript: void(0);" class="iq-email-subject">Mackenzie Barryo (@mackenzieBarryo) has sent
                                          you a direct message on Twitter! &nbsp;–&nbsp;
                                          <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                          </a>
                                          <div class="iq-email-date">11:49 am</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-time-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                      <img src="../assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>Medium Daily Digest</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>reply-to:</td>
                                                                        <td>noreply@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>to:</td>
                                                                        <td>iqonicdesigns@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>13 Dec 2019, 08:30</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>The Golden Rule</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>security:</td>
                                                                        <td>Standard encryption</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>Hi Jopour Xiong,</p>
                                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                      <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                      <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                   </div>
                                                   <hr>
                                                   <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <li>
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk13">
                                                <label class="custom-control-label" for="mailk13"></label>
                                             </div>
                                          </div>
                                          <span class="ri-star-line iq-star-toggle"></span>
                                          <a href="javascript: void(0);" class="iq-email-title">Deray Billings (Me)</a>
                                       </div>
                                       <div class="iq-email-content">
                                          <a href="javascript: void(0);" class="iq-email-subject">Eb Begg(@ebbegg) has sent
                                          you a direct message on Twitter! &nbsp;–&nbsp;
                                          <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                          </a>
                                          <div class="iq-email-date">11:49 am</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                          <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-time-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                      <img src="../assets/images/user/user-2.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>Medium Daily Digest</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>reply-to:</td>
                                                                        <td>noreply@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>to:</td>
                                                                        <td>iqonicdesigns@gmail.com</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>13 Dec 2019, 08:30</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>The Golden Rule</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>security:</td>
                                                                        <td>Standard encryption</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>Hi Deray Billings,</p>
                                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                      <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                      <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                   </div>
                                                   <hr>
                                                   <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </ul>
                           </div>
                           <div class="tab-pane fade" id="mail-sent" role="tabpanel">
                              <ul class="iq-email-sender-list">
                               @foreach($allsendmail as $key => $data)
                                 <li class="iq-unread">
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                <label class="custom-control-label" for="mailk{{$key}}"></label>
                                             </div>
                                          </div>
                                          <style>
                                             .star {
                                                    visibility:hidden;
                                                    font-size:30px;
                                                    cursor:pointer;
                                                    position: absolute;
                                                      margin-top: -10px;
                                                }
                                                .star:before {
                                                   content: "\2605";
                                                   position: absolute;
                                                   visibility:visible;
                                                }
                                                .star:checked:before {
                                                   content: "\2606";
                                                   position: absolute;
                                                }
                                          </style>
                                            <div class="iq-checkbox-mail">
                                             <div class=" custom-checkbox">

                                               <input class="star starred" type="checkbox" name="starred" data-id="" title="bookmark page" value="" checked>

                                             </div>
                                          </div>

                                          <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                          <a  class="iq-email-title">{{$seo->meta_title}}</a>
                                       </div>
                                       <div class="iq-email-content" data-id="{{$data->id}}">
                                          <a href="javascript: void(0);" class="iq-email-subject">
                                          <span>{!! Str::limit($data->message,100) !!}</span>
                                          </a>
                                          <div class="iq-email-date">{{$data->created_at}}</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="{{url('admin/sendemail/delete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                         <!--  <li><a href="#"><i class="ri-mail-line"></i></a></li> -->
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                         <a data-id="{{$data->id}}" data-target="#compose-email-popup" data-toggle="modal" class="individual"><i class="ri-mail-open-line"></i>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/sendemail/delete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                     <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">{{$seo->meta_title}} <a href=""></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                            <td>@foreach(json_decode($data->mail_id) as $email)
                                                               {{$email}},
                                                               @endforeach
                                                                        </td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>{{$data->created_at}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>{{$data->subject}}</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>{!!$data->message!!}</p>

                                                   </div>
                                                   <hr>

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- endforeach -->

                                 @endforeach
                              </ul>
                           </div>
                           <div class="tab-pane fade show active" id="mail-trash" role="tabpanel">
                              <ul class="iq-email-sender-list">
                                 @foreach($alldeleted as $key => $data)
                                   <li class="iq-unread">
                                    <div class="d-flex align-self-center">
                                       <div class="iq-email-sender-info">
                                          <div class="iq-checkbox-mail">
                                             <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                                <label class="custom-control-label" for="mailk{{$key}}"></label>
                                             </div>
                                          </div>
                                          <style>
                                             .star {
                                                   visibility:hidden;
                                                   font-size:30px;
                                                   cursor:pointer;
                                                   position: absolute;
                                                   margin-top: -10px;
                                               }
                                               .star:before {
                                                  content: "\2605";
                                                  position: absolute;
                                                  visibility:visible;
                                               }
                                               .star:checked:before {
                                                  content: "\2606";
                                                  position: absolute;
                                               }
                                          </style>
                                            <div class="iq-checkbox-mail">
                                             <div class=" custom-checkbox">
                                             @if($data->starred==0)
                                               <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                               @else
                                               <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                               @endif
                                             </div>
                                          </div>

                                          <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                          <a  class="iq-email-title">{{$data->name}}</a>
                                       </div>
                                       <div class="iq-email-content" data-id="{{$data->id}}">
                                          <a href="javascript: void(0);" class="iq-email-subject">
                                          <span>{{Str::limit($data->message,100)}}</span>
                                          </a>
                                          <div class="iq-email-date">{{$data->created_at}}</div>
                                       </div>
                                       <ul class="iq-social-media">
                                          <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                          <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       </ul>
                                    </div>
                                 </li>
                                 <div class="email-app-details">
                                    <div class="card">
                                       <div class="card-body p-0">
                                          <div class="">
                                             <div class="iq-email-to-list p-3">
                                                <div class="d-flex justify-content-between">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a href="javascript: void(0);">
                                                            <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                         </a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/delete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                   </ul>
                                                   <div class="iq-email-search d-flex">
                                                      <ul>
                                                         <li class="mr-3">
                                                            <a class="font-size-14" href="#">1 of 505</a>
                                                         </li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                         <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                      </ul>
                                                   </div>
                                                </div>
                                             </div>
                                             <hr class="mt-0">
                                             <div class="iq-inbox-subject p-3">
                                                <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                                <div class="iq-inbox-subject-info">
                                                   <div class="iq-subject-info">
                                                     <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                      <div class="iq-subject-status align-self-center">
                                                         <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                         <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            to Me
                                                            </a>
                                                            <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                               <table class="iq-inbox-details">
                                                                  <tbody>
                                                                     <tr>
                                                                        <td>from:</td>
                                                                        <td>{{$data->email}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>date:</td>
                                                                        <td>{{$data->created_at}}</td>
                                                                     </tr>
                                                                     <tr>
                                                                        <td>subject:</td>
                                                                        <td>{{$data->subject}}</td>
                                                                     </tr>
                                                                  </tbody>
                                                               </table>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                   </div>
                                                   <div class="iq-inbox-body mt-5">
                                                      <p>{{$data->message}}</p>

                                                   </div>
                                                   <hr>
                                             <!--       <div class="attegement">
                                                      <h6 class="mb-2">ATTACHED FILES:</h6>
                                                      <ul>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                         </li>
                                                         <li class="icon icon-attegment">
                                                            <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                         </li>
                                                      </ul>
                                                   </div> -->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- endforeach -->
                                 @endforeach
                              </ul>
                           </div>
                        </div>
                        @else
                        <div class="tab-pane fade show active" id="mail-inbox" role="tabpanel">
                           <ul class="iq-email-sender-list">
                            <!-- foreach hobe -->
                            @foreach($allmail as $key => $data)

                              <li class="iq-unread">
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                             <label class="custom-control-label" for="mailk{{$key}}"></label>
                                          </div>
                                       </div>
                                       <style>
                                          .star {
                                                visibility:hidden;
                                                font-size:30px;
                                                cursor:pointer;
                                                position: absolute;
                                                margin-top: -10px;
                                            }
                                            .star:before {
                                               content: "\2605";
                                               position: absolute;
                                               visibility:visible;
                                            }
                                            .star:checked:before {
                                               content: "\2606";
                                               position: absolute;
                                            }
                                       </style>
                                         <div class="iq-checkbox-mail">
                                          <div class=" custom-checkbox">
                                          @if($data->starred==0)
                                            <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                            @else
                                            <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                            @endif
                                          </div>
                                       </div>

                                       <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                       <a  class="iq-email-title">{{$data->name}}</a>
                                    </div>
                                    <div class="iq-email-content" data-id="{{$data->id}}">
                                       <a href="javascript: void(0);" class="iq-email-subject">
                                       <span>{{Str::limit($data->message,100)}}</span>
                                       </a>
                                       <div class="iq-email-date">{{$data->created_at}}</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                    <a data-id="{{$data->id}}" data-target="#compose-email-popup" data-toggle="modal" class="individual"><i class="ri-mail-open-line"></i>
                                                    </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                  <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>{{$data->email}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>{{$data->created_at}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>{{$data->subject}}</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>{{$data->message}}</p>

                                                </div>
                                                <hr>
                                          <!--       <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div> -->
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- endforeach -->

                              @endforeach

                           </ul>
                        </div>
                        <div class="tab-pane fade" id="mail-starred" role="tabpanel">
                           <ul class="iq-email-sender-list">
                             @foreach($allstarted as $key => $data)
                                <li class="iq-unread">
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                             <label class="custom-control-label" for="mailk{{$key}}"></label>
                                          </div>
                                       </div>
                                       <style>
                                      .star {
                                            visibility:hidden;
                                            font-size:30px;
                                            cursor:pointer;
                                            position: absolute;
                                            margin-top: -10px;
                                        }
                                        .star:before {
                                           content: "\2605";
                                           position: absolute;
                                           visibility:visible;
                                        }
                                        .star:checked:before {
                                           content: "\2606";
                                           position: absolute;
                                        }
                                       </style>
                                         <div class="iq-checkbox-mail">
                                          <div class=" custom-checkbox">
                                          @if($data->starred==0)
                                            <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                            @else
                                            <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                            @endif
                                          </div>
                                       </div>

                                       <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                       <a  class="iq-email-title">{{$data->name}}</a>
                                    </div>
                                    <div class="iq-email-content" data-id="{{$data->id}}">
                                       <a href="javascript: void(0);" class="iq-email-subject">
                                       <span>{{Str::limit($data->message,100)}}</span>
                                       </a>
                                       <div class="iq-email-date">{{$data->created_at}}</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                    <a  data-target="#compose-email-popup" data-toggle="modal">		<i class="ri-mail-open-line"></i>
                                                    </a>
                                                   </li>

                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>{{$data->email}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>{{$data->created_at}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>{{$data->subject}}</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>{{$data->message}}</p>

                                                </div>
                                                <hr>
                                          <!--       <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div> -->
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- endforeach -->
                              @endforeach
                           </ul>
                        </div>
                        <div class="tab-pane fade" id="mail-draft" role="tabpanel">
                           <ul class="iq-email-sender-list">
                              <li>
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk9">
                                             <label class="custom-control-label" for="mailk9"></label>
                                          </div>
                                       </div>
                                       <span class="ri-star-line iq-star-toggle"></span>
                                       <a href="javascript: void(0);" class="iq-email-title">Fabian Ros (Me)</a>
                                    </div>
                                    <div class="iq-email-content">
                                       <a href="javascript: void(0);" class="iq-email-subject">Eb Begg (@ebbegg) has sent
                                       you a direct message on Twitter! &nbsp;–&nbsp;
                                       <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                       </a>
                                       <div class="iq-email-date">11:49 am</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-time-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                   <img src="../assets/images/user/user-4.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>Medium Daily Digest</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>reply-to:</td>
                                                                     <td>noreply@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>to:</td>
                                                                     <td>iqonicdesigns@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>13 Dec 2019, 08:30</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>The Golden Rule</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>security:</td>
                                                                     <td>Standard encryption</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>Hi Fabian Ros,</p>
                                                   <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                   <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                   <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                </div>
                                                <hr>
                                                <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <li>
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk10">
                                             <label class="custom-control-label" for="mailk10"></label>
                                          </div>
                                       </div>
                                       <span class="ri-star-line iq-star-toggle"></span>
                                       <a href="javascript: void(0);" class="iq-email-title">Dixa Horton (Me)</a>
                                    </div>
                                    <div class="iq-email-content">
                                       <a href="javascript: void(0);" class="iq-email-subject">Mackenzie Barryo (@mackenzieBarryo) has sent
                                       you a direct message on Twitter! &nbsp;–&nbsp;
                                       <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                       </a>
                                       <div class="iq-email-date">11:49 am</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-time-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                   <img src="../assets/images/user/user-5.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>Medium Daily Digest</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>reply-to:</td>
                                                                     <td>noreply@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>to:</td>
                                                                     <td>iqonicdesigns@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>13 Dec 2019, 08:30</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>The Golden Rule</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>security:</td>
                                                                     <td>Standard encryption</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>Hi Dixa Horton,</p>
                                                   <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                   <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                   <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                </div>
                                                <hr>
                                                <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <li>
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk11">
                                             <label class="custom-control-label" for="mailk11"></label>
                                          </div>
                                       </div>
                                       <span class="ri-star-line iq-star-toggle"></span>
                                       <a href="javascript: void(0);" class="iq-email-title">Megan Allen (Me)</a>
                                    </div>
                                    <div class="iq-email-content">
                                       <a href="javascript: void(0);" class="iq-email-subject">Jecno Mac (@jecnomac) has sent
                                       you a direct message on Twitter! &nbsp;–&nbsp;
                                       <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                       </a>
                                       <div class="iq-email-date">11:49 am</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-time-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                   <img src="../assets/images/user/user-6.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>Medium Daily Digest</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>reply-to:</td>
                                                                     <td>noreply@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>to:</td>
                                                                     <td>iqonicdesigns@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>13 Dec 2019, 08:30</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>The Golden Rule</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>security:</td>
                                                                     <td>Standard encryption</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>Hi Megan Allen,</p>
                                                   <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                   <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                   <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                </div>
                                                <hr>
                                                <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <li>
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk12">
                                             <label class="custom-control-label" for="mailk12"></label>
                                          </div>
                                       </div>
                                       <span class="ri-star-line iq-star-toggle"></span>
                                       <a href="javascript: void(0);" class="iq-email-title">Jopour Xiong (Me)</a>
                                    </div>
                                    <div class="iq-email-content">
                                       <a href="javascript: void(0);" class="iq-email-subject">Mackenzie Barryo (@mackenzieBarryo) has sent
                                       you a direct message on Twitter! &nbsp;–&nbsp;
                                       <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                       </a>
                                       <div class="iq-email-date">11:49 am</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-time-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                   <img src="../assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>Medium Daily Digest</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>reply-to:</td>
                                                                     <td>noreply@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>to:</td>
                                                                     <td>iqonicdesigns@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>13 Dec 2019, 08:30</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>The Golden Rule</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>security:</td>
                                                                     <td>Standard encryption</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>Hi Jopour Xiong,</p>
                                                   <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                   <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                   <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                </div>
                                                <hr>
                                                <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <li>
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk13">
                                             <label class="custom-control-label" for="mailk13"></label>
                                          </div>
                                       </div>
                                       <span class="ri-star-line iq-star-toggle"></span>
                                       <a href="javascript: void(0);" class="iq-email-title">Deray Billings (Me)</a>
                                    </div>
                                    <div class="iq-email-content">
                                       <a href="javascript: void(0);" class="iq-email-subject">Eb Begg(@ebbegg) has sent
                                       you a direct message on Twitter! &nbsp;–&nbsp;
                                       <span>@LucasKriebel - Very cool :) Nicklas, You have a new direct message.</span>
                                       </a>
                                       <div class="iq-email-date">11:49 am</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="#"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                       <li><a href="#"><i class="ri-file-list-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-time-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Info"><a href="#"><i class="ri-information-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="#"><i class="ri-delete-bin-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Unread"><a href="#"><i class="ri-mail-unread-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Transfer"><a href="#"><i class="ri-folder-transfer-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Bookmark"><a href="#"><i class="ri-bookmark-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0">Your elite author Graphic Optimization reward is ready!</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                   <img src="../assets/images/user/user-2.jpg" class="img-fluid rounded avatar-100" alt="#">
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">Insta Dash team <a href="dummy@proX.com"><dummy@proX.com></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>Medium Daily Digest</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>reply-to:</td>
                                                                     <td>noreply@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>to:</td>
                                                                     <td>iqonicdesigns@gmail.com</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>13 Dec 2019, 08:30</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>The Golden Rule</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>security:</td>
                                                                     <td>Standard encryption</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">Jan 15, 2029, 10:20AM</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>Hi Deray Billings,</p>
                                                   <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. </p>
                                                   <p>Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                                   <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">John Deo</span></p>
                                                </div>
                                                <hr>
                                                <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </ul>
                        </div>
                        <div class="tab-pane fade" id="mail-sent" role="tabpanel">
                           <ul class="iq-email-sender-list">
                            @foreach($allsendmail as $key => $data)
                              <li class="iq-unread">
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                             <label class="custom-control-label" for="mailk{{$key}}"></label>
                                          </div>
                                       </div>
                                       <style>
                                          .star {
                                                 visibility:hidden;
                                                 font-size:30px;
                                                 cursor:pointer;
                                                 position: absolute;
                                                   margin-top: -10px;
                                             }
                                             .star:before {
                                                content: "\2605";
                                                position: absolute;
                                                visibility:visible;
                                             }
                                             .star:checked:before {
                                                content: "\2606";
                                                position: absolute;
                                             }
                                       </style>
                                         <div class="iq-checkbox-mail">
                                          <div class=" custom-checkbox">

                                            <input class="star starred" type="checkbox" name="starred" data-id="" title="bookmark page" value="" checked>

                                          </div>
                                       </div>

                                       <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                       <a  class="iq-email-title">{{$seo->meta_title}}</a>
                                    </div>
                                    <div class="iq-email-content" data-id="{{$data->id}}">
                                       <a href="javascript: void(0);" class="iq-email-subject">
                                       <span>{!! Str::limit($data->message,100) !!}</span>
                                       </a>
                                       <div class="iq-email-date">{{$data->created_at}}</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="{{url('admin/sendemail/delete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                      <!--  <li><a href="#"><i class="ri-mail-line"></i></a></li> -->
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail">
                                                      <a data-id="{{$data->id}}" data-target="#compose-email-popup" data-toggle="modal" class="individual"><i class="ri-mail-open-line"></i>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/sendemail/delete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                  <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">{{$seo->meta_title}} <a href=""></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                         <td>@foreach(json_decode($data->mail_id) as $email)
                                                            {{$email}},
                                                            @endforeach
                                                                     </td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>{{$data->created_at}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>{{$data->subject}}</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>{!!$data->message!!}</p>

                                                </div>
                                                <hr>

                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- endforeach -->

                              @endforeach
                           </ul>
                        </div>
                        <div class="tab-pane fade" id="mail-trash" role="tabpanel">
                           <ul class="iq-email-sender-list">
                              @foreach($alldeleted as $key => $data)
                                <li class="iq-unread">
                                 <div class="d-flex align-self-center">
                                    <div class="iq-email-sender-info">
                                       <div class="iq-checkbox-mail">
                                          <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="mailk{{$key}}">
                                             <label class="custom-control-label" for="mailk{{$key}}"></label>
                                          </div>
                                       </div>
                                       <style>
                                          .star {
                                                visibility:hidden;
                                                font-size:30px;
                                                cursor:pointer;
                                                position: absolute;
                                                margin-top: -10px;
                                            }
                                            .star:before {
                                               content: "\2605";
                                               position: absolute;
                                               visibility:visible;
                                            }
                                            .star:checked:before {
                                               content: "\2606";
                                               position: absolute;
                                            }
                                       </style>
                                         <div class="iq-checkbox-mail">
                                          <div class=" custom-checkbox">
                                          @if($data->starred==0)
                                            <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}" checked>
                                            @else
                                            <input class="star starred" type="checkbox" name="starred" data-id="{{$data->id}}" title="bookmark page" value="{{$data->starred}}">
                                            @endif
                                          </div>
                                       </div>

                                       <!-- <span class="ri-star-line iq-star-toggle text-warning"></span> -->
                                       <a  class="iq-email-title">{{$data->name}}</a>
                                    </div>
                                    <div class="iq-email-content" data-id="{{$data->id}}">
                                       <a href="javascript: void(0);" class="iq-email-subject">
                                       <span>{{Str::limit($data->message,100)}}</span>
                                       </a>
                                       <div class="iq-email-date">{{$data->created_at}}</div>
                                    </div>
                                    <ul class="iq-social-media">
                                       <li><a href="{{url('admin/email/softdelete/'.$data->id)}}"><i class="ri-delete-bin-2-line"></i></a></li>
                                       <li><a href="#"><i class="ri-mail-line"></i></a></li>
                                    </ul>
                                 </div>
                              </li>
                              <div class="email-app-details">
                                 <div class="card">
                                    <div class="card-body p-0">
                                       <div class="">
                                          <div class="iq-email-to-list p-3">
                                             <div class="d-flex justify-content-between">
                                                <ul>
                                                   <li class="mr-3">
                                                      <a href="javascript: void(0);">
                                                         <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                                      </a>
                                                   </li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Mail"><a href="#"><i class="ri-mail-open-line"></i></a></li>
                                                   <li data-toggle="tooltip" data-placement="top" title="Delete"><a href="{{url('admin/email/delete/'.$data->id)}}"><i class="ri-delete-bin-line"></i></a></li>
                                                </ul>
                                                <div class="iq-email-search d-flex">
                                                   <ul>
                                                      <li class="mr-3">
                                                         <a class="font-size-14" href="#">1 of 505</a>
                                                      </li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Previous"><a href="#"><i class="ri-arrow-left-s-line"></i></a></li>
                                                      <li data-toggle="tooltip" data-placement="top" title="Next"><a href="#"><i class="ri-arrow-right-s-line"></i></a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <hr class="mt-0">
                                          <div class="iq-inbox-subject p-3">
                                             <h5 class="mt-0 mb-3">{{$data->subject}}</h5>
                                             <div class="iq-inbox-subject-info">
                                                <div class="iq-subject-info">
                                                  <!--  <img src="{{asset('public/backend')}}/assets/images/user/user-1.jpg" class="img-fluid rounded avatar-100" alt="#"> -->
                                                   <div class="iq-subject-status align-self-center">
                                                      <h6 class="mb-0">{{$data->name}} <a href=""></a></h6>
                                                      <div class="dropdown">
                                                         <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         to Me
                                                         </a>
                                                         <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                                            <table class="iq-inbox-details">
                                                               <tbody>
                                                                  <tr>
                                                                     <td>from:</td>
                                                                     <td>{{$data->email}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>date:</td>
                                                                     <td>{{$data->created_at}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>subject:</td>
                                                                     <td>{{$data->subject}}</td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <span class="float-right align-self-center">{{$data->created_at}}</span>
                                                </div>
                                                <div class="iq-inbox-body mt-5">
                                                   <p>{{$data->message}}</p>

                                                </div>
                                                <hr>
                                          <!--       <div class="attegement">
                                                   <h6 class="mb-2">ATTACHED FILES:</h6>
                                                   <ul>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.doc</span>
                                                      </li>
                                                      <li class="icon icon-attegment">
                                                         <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="ml-1">mydoc.pdf</span>
                                                      </li>
                                                   </ul>
                                                </div> -->
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- endforeach -->
                              @endforeach
                           </ul>
                        </div>
                     </div>
                       @endif

                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- mail pop up -->
            <div id="compose-email-popup" class="compose-popup modal modal-sticky-bottom-right modal-sticky-lg">
               <div class="card iq-border-radius-20 mb-0">
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-md-12 mb-3">
                           <h5 class="text-primary float-left"><i class="ri-pencil-fill"></i> Compose Message</h5>
                           <button type="submit" class="float-right close-popup" data-dismiss="modal"><i class="ri-close-fill"></i></button>
                        </div>
                     </div>
                     <form class="email-form" action="{{route('admin.email.send')}}" method="post">
                     	@csrf
                        <div class="form-group row">
                           <label for="inputEmail3" class="col-sm-2 col-form-label">To:</label>
                           <div class="col-sm-10">
                           <input type="text" name="email[]" class="form-control" list="designation" id="designation" placeholder="email" data-role="tagsinput"/>
                           <datalist id="designation">
                          @foreach($subscrivemail as $smail)
                           <option value="{{$smail->email}}"></option>
                           @endforeach
                           </datalist>

                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                           <div class="col-sm-10">
                              <input type="text" name="subject" id="subject" class="form-control" placeholder="subject">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="subject" class="col-sm-2 col-form-label">Your Message:</label>
                           <div class="col-md-10">
                              <textarea name="send_message" class="textarea form-control" rows="5" placeholder="message"></textarea>
                           </div>
                        </div>
                        <div class="form-group row align-items-center compose-bottom pt-3 m-0">
                           <div class="d-flex flex-grow-1 align-items-center">
                              <div class="send-btn">
                                 <button type="submit" class="btn btn-primary">Send</button>
                              </div>
                              <div class="send-panel">
                                 <label class="ml-2 mb-0 bg-primary-light rounded" for="file"> <input type="file" name="file" id="file" style="display: none"> <a><i class="ri-attachment-line"></i> </a> </label>
                                 <label class="ml-2 mb-0 bg-primary-light rounded"> <a href="javascript:void();"> <i class="ri-map-pin-user-line text-primary"></i></a>  </label>
                           </div>
                           <div class="d-flex align-items-center">
                              <div class="send-panel float-right">
                                 <label class="ml-2 mb-0 bg-primary-light rounded"><a href="javascript:void();">  <i class="ri-delete-bin-line text-primary"></i></a>  </label>
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
<script>
      function(){
       $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
      }

</script>
 <script>
 $(document).ready(function() {
	$(".starred").click(function() {
			var val = $(this).val();
			var dataid = $(this).attr("data-id");
				if(dataid){
	             $.ajax({
	                 url: "{{  url('/get/started/change/') }}/"+dataid+'/'+val,
	                 type:"GET",
	                 dataType:"json",
	                 success:function(data) {


	                     }
	             });
	         }
	});
});
</script>


<script>
$(document).ready(function() {
	$(".iq-email-content").click(function() {

		var val = $(this).data('id');
			 //alert(val);
			//console.log(val);
				if(val){
	             $.ajax({
	                 url: "{{  url('/get/view/email/') }}/"+val,
	                 type:"GET",
	                 dataType:"json",
	                 success:function(data) {


	                     }
	             });
	         }
	});
});
</script>
<script>
$(document).ready(function() {
	$(".individual").click(function() {

		var val = $(this).data('id');

				if(val){
	             $.ajax({
	                 url: "{{  url('/get/individual/email/') }}/"+val,
	                 type:"GET",
	                 dataType:"json",
	                 success:function(data) {

                            $(".individual_email").val(data.email);

	                     }
	             });
	         }
	});
});
</script>
@endsection
