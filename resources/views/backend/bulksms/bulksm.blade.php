@extends('layouts.admin')
@section('title', 'Bulk Sms | '.$seo->meta_title)
@section('content')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js'></script> -->
	<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6 col-lg-6">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Bulk Sms</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <form class="form" action="{{route('admin.bulksms.send')}}" method="post">
                     	@csrf
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="col-md-12 p-0">
                                 <div class="row">
                                     <div class="col-md-12 form-group">
                                       <label for="emailid" class="control-label">Mobile Number: *</label>
																			 <input type="text" name="phone" id="email-input" class="form-control form-control-sm" value="">
		                                	<!-- <select id="multiple" name="phone[]" class="js-states form-control form-control-sm" multiple>
									                        <option value="01783038818">01783038818</option>
									                        <option value="01559505992">01559505992</option>
									                     </select> -->
                                    </div>
                                    <div class="col-md-12 form-group">
                                       <label for="pwd" class="control-label">Sms Type: *</label>
                                      	<select class="form-control form-control-sm" name="sms_type">
                                      		<option value="Masking">Masking</option>
                                      		<option value="Non-Masking">Non-Masking</option>
                                      	</select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                       <label for="cpwd" class="control-label">Message:*</label>
                                       <textarea type="text" name="message" class="form-control form-control-sm" placeholder="Your Message"></textarea>
                                    </div>
                                 </div>
                                 <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Send</button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
						<div class="col-md-5">

                    <div class="p-2">
                      <h3 class="panel-title"> <span class="menu-icon"> <i class="glyphicon glyphicon-book"></i> </span> All Mobile Numbers </h3>
                    </div>
                    <!-- vd_panel-heading -->

                    <div class="panel-body">
                      <div class="form-group pr-1 icon_parent">
                         <!-- <input type="text" class="form-control form-control-sm" id="filter-text" placeholder="Name Filter"> -->
                     </div>
                    <br/>
                    <form class="form-horizontal" role="form" action="#">

                      <a href="#" id="check-all">Check All</a> <span class="mgl-10 mgr-10">/</span> <a href="#" id="uncheck-all">Uncheck All</a>

                      <hr class=""/>
                      <div class="form-group clearfix" style="height: 250px; overflow-y:scroll;">
                        <div class="col-md-12">
                          <div class="content-list content-menu" id="email-list">
                            <div class="list-wrapper wrap-25 isotope">

                                <div class="email-item">
                                    <div class="vd_checkbox checkbox-success">
                                      <input type="checkbox" id="checkbox-1" value="01783038818">
                                      <label class="filter-name" for="checkbox-1"><em class="font-normal"></em> 01783038818</label>
                                    </div>
                                </div>
																<div class="email-item">
																		<div class="vd_checkbox checkbox-success">
																			<input type="checkbox" id="checkbox-1" value="01610279814">
																			<label class="filter-name" for="checkbox-1"><em class="font-normal"></em> 01610279814</label>
																		</div>
																</div>
                          </div>
                          <!-- list-wrapper -->
                        </div>
                        <!-- content-list -->
                      </div>
                      <!-- col-md-12 -->
                    </div>
                    <!-- form-group -->


                    <hr/>
                    <div class="form-group">
                        <button type="button" id="insert-email-btn" class="btn btn-blue"><i class="fa fa-angle-double-left append-icon"></i> INSERT</button>
                    </div>
                  </form>

              </div>
              <!-- panel -->

						</div>
         </div>
      </div>
    </div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script>
$(document).ready(function(){

$('#check-all').click(function () {
	//alert("ok");
	$('.email-item input').prop('checked', true);
});

$('#uncheck-all').click(function () {
	$('.email-item input').prop('checked', false);
});

$('#insert-email-btn').click(function (e) {
	//alert("ok")
	e.preventDefault();
	var emails = '';
	emails = $('.email-item input:checked').map(function (n) {
		return this.value;
	}).get().join(' , ');
	var comma = $('#email-input').val() ? ' , ' : '';
	if (emails) {
		$('#email-input').val($('#email-input').val() + comma + emails);
	}
});

});
</script>

@endsection
