  
@extends('layouts.admin')
@section('title', 'Add User | '.$seo->meta_title)
@section('content')
@php
    $date=Carbon\Carbon::now();
     $newdate=$date->format('m/d/Y');

@endphp
<style>
  .form-control {

    border: 1px solid #443f3f;
  
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/datepicker/css/bootstrap-datepicker3.css')}}">
<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="iq-card">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">Create Employee</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.employee.index')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">All Employee</span></i>
                        </a>
                     </span>
                  </div>
                  <div class="iq-card-body">
                     <form action="{{route('admin.employee.store')}}" method="post" id="form-wizard1" class="text-center mt-4" enctype="multipart/form-data">
                      @csrf
                        <ul id="top-tab-list" class="p-0">
                          
                            @if(Session::has('success'))
                            <li id="account" class="active done">
                              <a href="javascript:void();">
                              <i class="ri-lock-unlock-line"></i><span>Account</span>
                              </a>
                           </li>
                           <li id="personal" class="active done">
                              <a href="javascript:void();">
                              <i class="ri-user-fill"></i><span>Personal</span>
                              </a>
                           </li>
                           <li id="payment" class="active done">
                              <a href="javascript:void();">
                              <i class="ri-camera-fill"></i><span>Experience & Salary Information</span>
                              </a>
                           </li>
                           <li id="confirm" class="active">
                              <a href="javascript:void();">
                              <i class="ri-check-fill"></i><span>Finish</span>
                              </a>
                           </li>
                           @else
                            <li class="active" id="account">
                              <a href="javascript:void();">
                              <i class="ri-lock-unlock-line"></i><span>Account</span>
                              </a>
                           </li>
                           <li id="personal">
                              <a href="javascript:void();">
                              <i class="ri-user-fill"></i><span>Personal</span>
                              </a>
                           </li>
                           <li id="payment">
                              <a href="javascript:void();">
                              <i class="ri-camera-fill"></i><span>Experience & Salary Information</span>
                              </a>
                           </li>
                           <li id="confirm">
                              <a href="javascript:void();">
                              <i class="ri-check-fill"></i><span>Finish</span>
                              </a>
                           </li>
                           @endif
                        </ul>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(Session::has('success'))
                        <!-- fieldsets -->
                          <fieldset class="active">
                           <div class="form-card">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4 text-left">Finish:</h3>
                                 </div>
                                 <div class="col-5">
                                    <h2 class="steps">Step 4 - 4</h2>
                                 </div>
                              </div>

                              <br><br>
                              <h2 class="text-success text-center"><strong>SUCCESS !</strong></h2>
                              <br>
                              <div class="row justify-content-center">
                                 <div class="col-3"> <img src="{{asset('public/uploads/logo/'.$logos->logo)}}" class="fit-image" alt="fit-image"> </div>
                              </div>
                              <br><br>
                              <div class="row justify-content-center">
                                 <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Employe Create</h5>
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                        @else
                        <fieldset class="active">
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Account Information:</h3>
                                 </div>
                                 <div class="col-5">
                                    <h2 class="steps">Step 1 - 4</h2>
                                 </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                                     <input type="checkbox" name="checkvalue" class="custom-control-input bg-success" id="customCheck-2" value="1">
                                     <label class="custom-control-label" for="customCheck-2">If You Have ID?</label>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                   <div class="form-group" id="hasid" style="display: none">
                                       <label>Employee Id: *</label>
                                       <input type="text" class="form-control" name="employee_id" placeholder="Employee Id" value=""/>
                                       @error('employee_id')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    <div class="form-group" id="hasnoid">
                                       <label>Employee Id: *</label>
                                       <input type="text" class="form-control" name="employee_newid"  placeholder="Employee Id" value="{{$employeeid}}" />
                                       @error('employee_neid')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Date:*</label>
                                     <input type="text" name="date" id="follow_up_update" required name="follow_date" class="datepicker form-control form-control-sm" value="{{  date('d-m-Y') }}" data-date-format="dd-mm-yyyy">
                                      @error('date')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Empoyee Name: *</label>
                                       <input type="text" class="form-control" name="employee_name" placeholder="Employee Name" value="{{old('employee_name')}}" />
                                      @error('employee_name')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Employee Type: *</label>
                                        <input type="text" name="employee_type" class="form-control" list="productName" placeholder="Employee Type" value="{{old('employee_type')}}" />
                                       <datalist id="productName">
                                           <option value="Employee">Employee</option>
                                           <option value="Staff">Staff</option>
                                           <option value="Other">Other</option>
                                       </datalist>
                                       @error('employee_type')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>District: *</label>
                                        <input type="text" name="district" class="form-control" list="district" placeholder="--select--" />
                                       <datalist id="district">
                                            @foreach($district as $dis)
                                            <option value="{{$dis->name}}"></option>
                                            @endforeach
                                       </datalist>
                                       @error('district')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Police-Station: </label>
                                       <select class="form-control" name="police_station" id="police_station">
                                         <option value="">--Select--</option>
                                       </select>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                           <button type="button" name="next" class="btn btn-primary next action-button float-right" value="Next" >Next</button>
                        </fieldset>
                       
                        <fieldset>
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Personal Information:</h3>
                                 </div>
                                 <div class="col-5">
                                    <h2 class="steps">Step 2 - 4</h2>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Father Name: </label>
                                       <input type="text" class="form-control" name="father_name" placeholder="Father Name"/>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Mother Name: </label>
                                       <input type="text" class="form-control" name="mother_name" placeholder="Mother Name" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Maritial Status: *</label>
                                       <select class="form-control" name="maritial_status">
                                         <option value="UnMarried">UnMarried</option>
                                         <option value="Married">Married</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Gender: *</label>
                                       <select class="form-control" name="gender">
                                         <option value="Male">Male</option>
                                         <option value="Female">Female</option>
                                         <option value="Others">Others</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Blood Group: </label>
                                       <select class="form-control" name="blood_group">
                                         <option value="O+">O+</option>
                                         <option value="O-">O-</option>
                                         <option value="A+">A+</option>
                                         <option value="A-">A-</option>
                                         <option value="AB+">AB+</option>
                                         <option value="B+">B+</option>
                                         <option value="B-">B-</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Religion: </label>
                                       <select class="form-control" name="religion">
                                         <option value="Islam">Islam</option>
                                         <option value="Hindu">Hindu</option>
                                         <option value="kristan">kristan</option>
                                         <option value="kristan">Buddhism</option>
                                         <option value="Others">Others</option>
                                       </select>
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Mobile Number: *</label>
                                       <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" />
                                       @error('mobile_number')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Family Contact Number: *</label>
                                       <input type="text" class="form-control" name="family_mobile_number" placeholder="Family Contact Number" />
                                      @error('family_mobile_number')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Email: *</label>
                                       <input type="text" class="form-control" name="email" placeholder="Email" />
                                       @error('email')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Date Of Birth: </label>
                                       <input type="date" class="form-control" name="date_of_birth" placeholder="Date Of Birth" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Nationality: </label>
                                       <input type="text" class="form-control" name="nationality" placeholder="Nationality" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>National Id: </label>
                                       <input type="text" class="form-control" name="national_id" placeholder="National Id" />
                                    </div>
                                 </div>
                               
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Present Address: </label>
                                      <textarea class="form-control" name="present_address" placeholder="Present Address"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Permanet Address: </label>
                                      <textarea class="form-control" name="permanent_address" placeholder="Permanet Address"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="form-group">
                                       <input type="file" class="custom-file-input" id="customFile" name="image">
                                       <label class="custom-file-label" for="customFile">Image(200px*190px)</label>
                                     </div>
                                  </div>
                                  <div class="col-md-1"></div>
                                  <div class="col-md-3">
                                     <div class="form-group">
                                       <input type="file" class="custom-file-input" id="customFile" name="cv">
                                       <label class="custom-file-label" for="customFile">CV(PDF)</label>
                                     </div>
                                  </div>
                                  <div class="col-md-1"></div>
                                  <div class="col-md-3">
                                     <div class="form-group">
                                       <input type="file" class="custom-file-input" id="customFile" name="joining_letter">
                                       <label class="custom-file-label" for="customFile">Joining Letter(PDF)</label>
                                     </div>
                                  </div>
                              
                              </div>
                           </div>
                           <button type="button" name="next" class="btn btn-primary next action-button float-right" value="Next" >Next</button>
                           <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-right mr-3" value="Previous" >Previous</button>
                        </fieldset>
                        
                        <fieldset>
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Experience & Salary Information:</h3>
                                 </div>
                                 <div class="col-5">
                                    <h2 class="steps">Step 3 - 4</h2>
                                 </div>
                              </div>
                                  <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Present Designation: *</label>
                                         <input type="text" name="present_designation" class="form-control" list="designation" placeholder="--select--" />
                                       <datalist id="designation">
                                            @foreach($designation as $desi)
                                            <option value="{{$desi}}"></option>
                                            @endforeach
                                       </datalist>
                                       @error('present_designation')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Working Hour: *</label>
                                       <input type="text" class="form-control" name="working_hour" placeholder="Working Hour" />
                                       @error('working_hour')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Present Salary: *</label>
                                       <input type="text" class="form-control" name="present_salary" placeholder="Present Salary" />
                                      @error('present_salary')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Company: </label>
                                       <input type="text" class="form-control" name="previous_company" placeholder="Previous Company"/>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Company Address: </label>
                                       <input type="text" class="form-control" name="previous_company_address" placeholder="Previous Company Address" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Designation: *</label>
                                       <input type="text" class="form-control" name="previous_designation" placeholder="Previous Designation" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Salary: </label>
                                       <input type="text" class="form-control" name="previous_salary" placeholder="Previous Salary" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Join Date: </label>
                                       <input type="date" class="form-control" name="previous_join_date" placeholder="Join Date" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>End Date: </label>
                                       <input type="date" class="form-control" name="previous_end_date" placeholder="End Date" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Opening Balance:</label>
                                       <input type="text" class="form-control" name="opening_balance" placeholder="Opening Balance" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Balance: </label>
                                       <input type="text" class="form-control" name="balance" placeholder=" Balance" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Branch Name: </label>
                                      <select class="form-control" name="brance_id">
                                        <option value="1">durbarit</option>
                                      </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary float-right" value="Submit">Submit</button>
                           <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-right mr-3" value="Previous" >Previous</button>
                        </fieldset>
                       
                        @endif

                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </div>
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/datepicker/css/bootstrap-datepicker3.css')}}">
<script src="{{asset('public/backend/assets/datepicker/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
     $('input[name="district"]').on('change', function(){
         var district = $(this).val();
         //alert(district);

         if(district) {
             $.ajax({
                 url: "{{  url('/get/policestation/all/') }}/"+district,
                 type:"GET",
                 dataType:"json",
                 success:function(data) {

                        $('#police_station').empty();
                        $('#police_station').append(' <option value="">--Select--</option>');
                        $.each(data,function(index,districtObj){
                         $('#police_station').append('<option value="' + districtObj.id + '">'+districtObj.name+'</option>');
                       });
                     }
             });
         } else {
             alert('danger');
         }

     });
 });
</script>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });
</script>


<script>
  $(document).ready(function(){
    $('#customCheck-2').change(function(){
    if(this.checked){
       $("#hasnoid").hide();
       $("#hasid").show();
    }
    else{
       $("#hasnoid").show();
       $("#hasid").hide();
    }
   

    });
});
</script>
@endsection