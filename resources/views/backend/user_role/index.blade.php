@extends('layouts.admin')
@section('title', 'All User-Role| '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">All User Role</h4>
                     </div>
                     <span class="float-right mr-2">
                     </span>
                  </div>
                  <div class="card-body">
                     <div class="">
                        <table class="table  table-bordered" >
                           <thead class="text-center">
                              <tr>
                                 <th>User Role</th>
                                 <th>Front Office</th>
                                 <th>Food and Beverage</th>
                                 <th>Restuarent</th>
                                 <th>Banquet</th>
                                 <th>Payroll</th>
                                 <th>Accounts</th>
                                 <th>Admin</th>
                                 <th>Stock</th>
                                 <th>Inventory</th>
                                 <th>House Kipping</th>
                                 
                               
                              </tr>
                           </thead>
                           <tbody class="text-center">
                              @foreach($allrole as $key => $role)
                             <tr>

                                 <td>{{$role->role_name}}</td>
                                 <td>
                                    <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                       <div class="custom-switch-inner">
                                          <input type="checkbox" class="custom-control-input" onchange="update_published(this)" name="front_office" id="front_office{{$key}}" value="{{ $role->id }}" <?php if($role->front_office == 1) echo "checked"; ?>>


                                          <label class="custom-control-label" for="front_office{{$key}}" data-on-label="On" data-off-label="Off">
                                          </label>
                                       </div>
                                    </div>
                        
                                </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="foodandbeverage" id="foodandbeverage{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->food_beverage == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="foodandbeverage{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="restuarent" id="restuarent{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->restuarent == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="restuarent{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="banquet" id="banquet{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->banquet == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="banquet{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="payroll" id="payroll{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->payroll == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="payroll{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="accounts" id="accounts{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->accounts == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="accounts{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 
                                 </td>
                                
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="admin" id="admin{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->admin == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="admin{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="stock" id="stock{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->stock == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="stock{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="inventory" id="inventory{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->inventory == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="inventory{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>
                                 <td>
                                 <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                    <div class="custom-switch-inner">
                                       <input type="checkbox" class="custom-control-input" name="housekipping" id="housekipping{{$key}}"   value="{{ $role->id }}" onchange="update_published(this)" <?php if($role->house_kipping == 1) echo "checked"; ?>>
                                       <label class="custom-control-label" for="housekipping{{$key}}" data-on-label="On" data-off-label="Off">
                                       </label>
                                    </div>
                                 </div>
                                 </td>

                             </tr>
                             @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
<script>
function update_published(el){

         var newname=el.name;
         
         
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{route('admin.userrole.permission')}}', {_token:'{{ csrf_token() }}', newname:newname,id:el.value, status:status}, function(data){
                if(data == 1){
                    //toastr.success('Published products updated successfully');
                }
                else{
                    toastr.danger('Something went wrong');
                }
            });
        }

</script>
@endsection
