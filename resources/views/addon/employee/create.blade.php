  
@extends('layouts.admin')
@section('title', 'Create Employee | '.$seo->meta_title)
@section('content')
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");
@endphp
<style>
  .form-control form-control-sm {

    border: 1px solid #443f3f;
  
}
</style>
@php
date_default_timezone_set("asia/dhaka");
$current = date("m/d/Y");
@endphp
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
                     
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Account Information:</h3>
                                 </div>
                                 <div class="col-5">
                                 
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
                                       <input type="text" class="form-control form-control-sm" name="employee_id" placeholder="Employee Id" value=""/>
                                       @error('employee_id')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    <div class="form-group" id="hasnoid">
                                       <label>Employee Id: *</label>
                                       <input type="text" class="form-control form-control-sm" name="employee_newid"  placeholder="Employee Id" value="{{$employeeid}}" />
                                       @error('employee_neid')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Date:*</label>
                                     <input type="text" name="date"  class="datepicker form-control form-control-sm form-control form-control-sm-sm" value="{{ $current }}">
                                      @error('date')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Empoyee Name: *</label>
                                       <input type="text" class="form-control form-control-sm" name="employee_name" placeholder="Employee Name" value="{{old('employee_name')}}" />
                                      @error('employee_name')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Employee Type: *</label>
                                        <input type="text" name="employee_type" class="form-control form-control-sm" list="productName" placeholder="Employee Type" value="{{old('employee_type')}}" />
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
                                 <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>District: *</label>
                                        <input type="text" name="district" class="form-control form-control-sm" list="district" placeholder="--select--" />
                                       <datalist id="district">
                                            @foreach($district as $dis)
                                            <option value="{{$dis->District}}"></option>
                                            @endforeach
                                       </datalist>
                                       @error('district')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Police-Station: </label>
                                       <select class="form-control form-control-sm police_station" name="police_station" id="police_station">
                                         <option value="">--Select--</option>
                                       </select>
                                    </div>
                                 </div> -->
                                
                              </div>
                           </div>
                         
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Personal Information:</h3>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Father Name: </label>
                                       <input type="text" class="form-control form-control-sm" name="father_name" placeholder="Father Name"/>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Mother Name: </label>
                                       <input type="text" class="form-control form-control-sm" name="mother_name" placeholder="Mother Name" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Maritial Status: *</label>
                                       <select class="form-control form-control-sm" name="maritial_status">
                                         <option value="UnMarried">UnMarried</option>
                                         <option value="Married">Married</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Gender: *</label>
                                       <select class="form-control form-control-sm" name="gender">
                                         <option value="Male">Male</option>
                                         <option value="Female">Female</option>
                                         <option value="Others">Others</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Blood Group: </label>
                                       <select class="form-control form-control-sm" name="blood_group">
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
                                       <select class="form-control form-control-sm" name="religion">
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
                                       <input type="text" class="form-control form-control-sm" name="mobile_number" placeholder="Mobile Number" />
                                       @error('mobile_number')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Family Contact Number: *</label>
                                       <input type="text" class="form-control form-control-sm" name="family_mobile_number" placeholder="Family Contact Number" />
                                      @error('family_mobile_number')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Email: *</label>
                                       <input type="text" class="form-control form-control-sm" name="email" placeholder="Email" />
                                       @error('email')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Date Of Birth: </label>
                                       <input type="date" class="form-control form-control-sm" name="date_of_birth" placeholder="Date Of Birth" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Nationality: </label>
                                       <input type="text" class="form-control form-control-sm" name="nationality" placeholder="Nationality" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>National Id: </label>
                                       <input type="text" class="form-control form-control-sm" name="national_id" placeholder="National Id" />
                                    </div>
                                 </div>
                               
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Present Address: </label>
                                      <textarea class="form-control form-control-sm" name="present_address" placeholder="Present Address"></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Permanet Address: </label>
                                      <textarea class="form-control form-control-sm" name="permanent_address" placeholder="Permanet Address"></textarea>
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
                        
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Experience & Salary Information:</h3>
                                 </div>
                                
                              </div>
                                  <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Present Designation: *</label>
                                         <input type="text" name="present_designation" class="form-control form-control-sm" list="designation" placeholder="--select--" />
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
                                       <input type="text" class="form-control form-control-sm" name="working_hour" placeholder="Working Hour" />
                                       @error('working_hour')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Present Salary: *</label>
                                       <input type="text" class="form-control form-control-sm" name="present_salary" placeholder="Present Salary" />
                                      @error('present_salary')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Company: </label>
                                       <input type="text" class="form-control form-control-sm" name="previous_company" placeholder="Previous Company"/>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Company Address: </label>
                                       <input type="text" class="form-control form-control-sm" name="previous_company_address" placeholder="Previous Company Address" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Designation: *</label>
                                       <input type="text" class="form-control form-control-sm" name="previous_designation" placeholder="Previous Designation" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Salary: </label>
                                       <input type="text" class="form-control form-control-sm" name="previous_salary" placeholder="Previous Salary" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Join Date: </label>
                                       <input type="date" class="form-control form-control-sm" name="previous_join_date" placeholder="Join Date" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>End Date: </label>
                                       <input type="date" class="form-control form-control-sm" name="previous_end_date" placeholder="End Date" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Opening Balance:</label>
                                       <input type="text" class="form-control form-control-sm" name="opening_balance" placeholder="Opening Balance" />
                                       <input type="hidden" name="chart_of_account" value="ACCOUNTS PAYABLE - SALARY & ALLOWANCE"/>
                                       <input type="hidden" name="chart_of_acc_code" value="212-28-0040-0072"/>
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Balance: </label>
                                       <input type="text" class="form-control form-control-sm" name="balance" placeholder=" Balance" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Branch Name: </label>
                                      <select class="form-control form-control-sm" name="brance_id">
                                        <option value="1">durbarit</option>
                                      </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-primary float-right" value="Submit">Submit</button>

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

                       // console.log(data);
                        $('.police_station').empty();
                        $('.police_station').append(' <option value="">--Select---</option>');
                        $.each(data,function(index,districtObj){
                         $('.police_station').append('<option value="' + districtObj.Thana + '">'+districtObj.Thana+'</option>');
                       });
                     }
             });
         } else {
             //alert('danger');
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