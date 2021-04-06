@extends('layouts.admin')
@section('title', 'Edit Employee | '.$seo->meta_title)
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/datepicker/css/bootstrap-datepicker3.css')}}">
<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="iq-card">
                  <div class="iq-card-header d-flex justify-content-between">
                     <div class="iq-header-title">
                        <h4 class="card-title">Update Employee</h4>
                     </div>
                     <span class="float-right mr-2">
                        <a href="{{route('admin.employee.index')}}" class="btn btn-sm bg-primary">
                           <i class="ri-add-fill"><span class="pl-1">All Employee</span></i>
                        </a>
                     </span>
                  </div>
                  <div class="iq-card-body">
                     <form action="{{route('admin.employee.update')}}" method="post" id="form-wizard1" class="text-center mt-4" enctype="multipart/form-data">
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
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Employee Id: *</label>
                                       <input type="text" class="form-control form-control-sm" name="employee_id" id="employee_id" placeholder="Employee Id" value="{{$data->employee_id}}"/>
                                       @error('emaployee_id')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Date:*</label>
                                     <input type="text" name="date" class="datepicker form-control form-control-sm" value="{{ $current }}" >
                                      @error('date')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Empoyee Name: *</label>
                                       <input type="text" class="form-control form-control-sm" name="employee_name" placeholder="Employee Name" value="{{$data->employee_name}}" />
                                       <input type="hidden" name="id" value="{{$data->id}}">
                                      @error('employee_name')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Employee Type: *</label>
                                        <input type="text" name="employee_type" class="form-control form-control-sm" list="productName" placeholder="Employee Type" value="{{$data->employee_type}}" />
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
                                        <input type="text" name="district" class="form-control form-control-sm" list="district" placeholder="--select--" value="{{$data->district}}" />
                                       <datalist id="district">
                                       @php
                                          $alldistrict=DB::table('District_tbl')->get();
                                       @endphp
                                            @foreach($alldistrict as $dis)
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
                                       <select class="form-control form-control-sm" name="police_station" id="police_station">
                                       @php
                                          $allthana=DB::table('Thana_tbl')->get();
                                       @endphp
                                          @foreach($allthana as $thana)
                                          <option value="{{$thana->Thana}}">{{$thana->Thana}}</option>
                                          @endforeach
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
                                 <div class="col-5">
                                  
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Father Name: </label>
                                       <input type="text" class="form-control form-control-sm" name="father_name" placeholder="Father Name" value="{{$data->father_name}}" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Mother Name: </label>
                                       <input type="text" class="form-control form-control-sm" name="mother_name" placeholder="Mother Name" value="{{$data->mother_name}}" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Maritial Status: *</label>
                                       <select class="form-control form-control-sm" name="maritial_status">
                                         <option value="UnMarried" @if($data->maritial_status=='UnMarried') selected @endif>UnMarried</option>
                                         <option value="Married" @if($data->maritial_status=='Married') selected @endif>Married</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Gender: *</label>
                                       <select class="form-control form-control-sm" name="gender">
                                         <option value="Male" @if($data->gender=='Male') selected @endif>Male</option>
                                         <option value="Female" @if($data->gender=='Female') selected @endif>Female</option>
                                         <option value="Others" @if($data->gender=='Others') selected @endif>Others</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Blood Group: </label>
                                       <select class="form-control form-control-sm" name="blood_group">
                                         <option value="O+" @if($data->blood_group=='O+') selected @endif>O+</option>
                                         <option value="O-" @if($data->blood_group=='O-') selected @endif>O-</option>
                                         <option value="A+" @if($data->blood_group=='A+') selected @endif>A+</option>
                                         <option value="A-" @if($data->blood_group=='A-') selected @endif>A-</option>
                                         <option value="AB+" @if($data->blood_group=='AB+') selected @endif>AB+</option>
                                         <option value="B+" @if($data->blood_group=='B+') selected @endif>B+</option>
                                         <option value="B-" @if($data->blood_group=='B-') selected @endif>B-</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Religion: </label>
                                       <select class="form-control form-control-sm" name="religion">
                                         <option value="Islam"  @if($data->religion=='Islam') selected @endif>Islam</option>
                                         <option value="Hindu" @if($data->religion=='Hindu') selected @endif>Hindu</option>
                                         <option value="kristan" @if($data->religion=='kristan') selected @endif>kristan</option>
                                         <option value="Buddhism" @if($data->religion=='Buddhism') selected @endif>Buddhism</option>
                                         <option value="Others" @if($data->religion=='Others') selected @endif>Others</option>
                                       </select>
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Mobile Number: *</label>
                                       <input type="text" class="form-control form-control-sm" name="mobile_number" placeholder="Mobile Number" value="{{$data->mobile_number}}" />
                                       @error('mobile_number')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Family Contact Number: *</label>
                                       <input type="text" class="form-control form-control-sm" name="family_mobile_number" placeholder="Family Contact Number" value="{{$data->family_mobile_number}}" />
                                      @error('family_mobile_number')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Email: *</label>
                                       <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" value="{{$data->email}}"/>
                                       @error('email')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Date Of Birth: </label>
                                       <input type="date" class="form-control form-control-sm" name="date_of_birth" placeholder="Date Of Birth" value="{{$data->date_of_birth}}" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Nationality: </label>
                                       <input type="text" class="form-control form-control-sm" name="nationality" placeholder="Nationality" value="{{$data->nationality}}" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>National Id: </label>
                                       <input type="text" class="form-control form-control-sm" name="national_id" placeholder="National Id" value="{{$data->national_id}}" />
                                    </div>
                                 </div>
                               
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Present Address: </label>
                                      <textarea class="form-control form-control-sm" name="present_address" placeholder="Present Address">{{$data->present_address}}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label>Permanet Address: </label>
                                      <textarea class="form-control form-control-sm" name="permanent_address" placeholder="Permanet Address">{{$data->permanent_address}}</textarea>
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
                                   <div class="col-md-3">
                                     <div class="form-group">
                                       <img src="{{asset('public/uploads/employee/'.$data->image)}}" height="45px">
                                     </div>
                                  </div>
                              
                              </div>
                           </div>
                        
                           <div class="form-card text-left">
                              <div class="row">
                                 <div class="col-7">
                                    <h3 class="mb-4">Experience & Salary Information:</h3>
                                 </div>
                                 <div class="col-5">
                                  
                                 </div>
                              </div>
                                  <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group">
                                          <label>Present Designation: *</label>
                                       <input type="text" name="present_designation" class="form-control form-control-sm" list="designation" placeholder="--select--" value="{{$data->present_designation}}" />
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
                                       <input type="text" class="form-control form-control-sm" name="working_hour" placeholder="Working Hour" value="{{$data->working_hour}}" />
                                       @error('working_hour')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Present Salary: *</label>
                                       <input type="text" class="form-control form-control-sm" name="present_salary" placeholder="Present Salary" value="{{$data->present_salary}}" />
                                      @error('present_salary')
                                          <div class="alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Company: </label>
                                       <input type="text" class="form-control form-control-sm" name="previous_company" placeholder="Previous Company" value="{{$data->previous_company}}" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Company Address: </label>
                                       <input type="text" class="form-control form-control-sm" name="previous_company_address" placeholder="Previous Company Address" value="{{$data->previous_company_address}}" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Designation: *</label>
                                       <input type="text" class="form-control form-control-sm" name="previous_designation" placeholder="Previous Designation" value="{{$data->previous_designation}}"/>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Previous Salary: </label>
                                       <input type="text" class="form-control form-control-sm" name="previous_salary" placeholder="Previous Salary" value="{{$data->previous_salary}}"/>
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Join Date: </label>
                                       <input type="date" class="form-control form-control-sm" name="previous_join_date" placeholder="Join Date" value="{{$data->previous_join_date}}" />
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>End Date: </label>
                                       <input type="date" class="form-control form-control-sm" name="previous_end_date" placeholder="End Date" value="{{$data->previous_end_date}}"/>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Opening Balance:</label>
                                       <input type="text" class="form-control form-control-sm" name="opening_balance" placeholder="Opening Balance" value="{{$data->opening_balance}}" />
                                    </div>
                                 </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                       <label>Balance: </label>
                                       <input type="text" class="form-control form-control-sm" name="balance" placeholder="Balance" value="{{$data->balance}}" />
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
    })
</script>
@

@endsection