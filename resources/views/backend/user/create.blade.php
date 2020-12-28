
@extends('layouts.admin')
@section('title', 'Add User | '.$seo->meta_title)
@section('content')
  <div class="content-page">
      <div class="container-fluid">
        <form action="{{route('admin.user.register')}}" method="post" enctype="multipart/form-data">
             @csrf
         <div class="row">
            <div class="col-xl-3 col-lg-4">

                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Add New User</h4>
                        </div>
                     </div>
                     <div class="card-body">

                           <div class="form-group text-center">
                              <div class="crm-profile-img-edit">
                                 <img class="crm-profile-pic rounded-circle avatar-100" src="{{asset('public/backend')}}/assets/images/user/11.png" alt="profile-pic">
                                 <div class="crm-p-image bg-primary" style="margin-top: 10px;">
                                    <i class="las la-pen upload-button"></i>
                                    <input name="profile_photo_path" class="file-upload" type="file" accept="image/*">
                                 </div>
                              </div>
                           <div class="img-extension mt-3">

                           </div>
                           </div>
                           <div class="form-group">
                              <label>User Role:</label>
                              <select class="form-control" id="selectuserrole" name="user_role">
                                 @foreach($allrole as $data)
                                 <option value="{{$data->id}}">{{$data->role_name}}</option>
                                 @endforeach

                              </select>
                              @error('user_role')
                              <span class="alert alert-danger">{{ $message }}</span>
                              @enderror
                           </div>
                            <div class="form-group">
                              <label>Employee Id:</label>
                               <select class="form-control" name="employee_id">
                                <option value="">--select--</option>
                                @foreach($allemployee as $employee)
                                 <option value="{{$employee->id}}">{{$employee->employee_id}}</option>
                                @endforeach
                               </select>
                            </div>
                            <div class="form-group">
                               <label>Designation:</label>
                               <input type="text" name="designation" class="form-control" list="designation" id="designation" placeholder="--select--" />
                               <datalist id="designation">
                                @foreach($designation as $dis)
                                   <option value="{{ $dis }}"></option>
                               @endforeach
                               </datalist>
                           </div>

                     </div>
                  </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">New User Information</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="new-user-info">

                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="fname">Name:<span style="color:red">*<span></label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="First Name">
                                    @error('name')
                                      <div style="color:red">{{ $message }}</div>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-12">
                                    <label for="cname">Address:</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="mobno">Mobile Number:<span style="color:red">*<span></label>
                                    <input type="text" id="mobile_number" name="phone" class="form-control" placeholder="Mobile Number">
                                    @error('phone')
                                      <div style="color:red">{{ $message }}</div>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="email">Email:<span style="color:red">*<span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    @error('email')
                                      <div style="color:red">{{ $message }}</div>
                                    @enderror
                                 </div>
                              </div>
                              <hr>
                              <h5 class="mb-3">Security</h5>
                              <div class="row">
                                 <div class="form-group col-md-12">
                                    <label for="uname">User Name:<span style="color:red">*<span></label>
                                    <input type="text" name="username" class="form-control" id="uname" placeholder="User Name">
                                     @error('username')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="pass">Password:<span style="color:red">*<span></label>
                                    <input type="password" name="password" class="form-control" id="pass" placeholder="Password">
                                     @error('password')
                                     <div style="color:red">{{ $message }}</div>
                                    @enderror
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="rpass">Repeat Password:<span style="color:red">*<span></label>
                                    <input type="password" name="password_confirmation" class="form-control" id="rpass" placeholder="Repeat Password ">
                                     @error('password_confirmation')
                                      <div style="color:red">{{ $message }}</div>
                                    @enderror
                                 </div>
                              </div>
                           <!--    <div class="checkbox">
                                 <label><input class="mr-2" type="checkbox">Enable Two-Factor-Authentication</label>
                              </div> -->
                              <button type="submit" class="btn btn-primary">Add New User</button>

                        </div>
                     </div>
                  </div>
              </div>
           </div>
          </form>
        </div>
      </div>
<script type="text/javascript">
  $(document).ready(function() {
     $('select[name="employee_id"]').on('change', function(){
         var employee_id = $(this).val();
         //alert(employee_id);

         if(employee_id) {
             $.ajax({
                 url: "{{  url('/get/useremployee/all/') }}/"+employee_id,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $("#name").val(data.employee_name);
                        $("#email").val(data.email);
                        $("#mobile_number").val(data.mobile_number);
                        $("#district").val(data.district);
                        $("#address").val(data.present_address);
                        $("#designation").val(data.present_designation);

                       //  $('#police_station').append(' <option value="">--Select--</option>');
                       //  $.each(data,function(index,districtObj){
                       //  $('#police_station').append('<option value="' + districtObj.id + '">'+districtObj.name+'</option>');
                       // });
                     }
             });
         } else {
             alert('danger');
         }

     });
 });
</script>
@endsection
