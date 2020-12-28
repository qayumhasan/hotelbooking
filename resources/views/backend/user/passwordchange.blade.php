@extends('layouts.admin')
@section('title', 'General Settings | '.$seo->meta_title)
@section('content')
 <div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
                     <form class="form" action="{{route('admin.passchange.submit')}}" method="post">
                         @csrf
                        <div class="row">
                           <div class="col-lg-2"></div>
                         <div class="col-lg-8">
                              <div class="card">
                                 <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                       <h4 class="card-title">PassWord Change</h4>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <p></p>
                                   
                                       <div class="form-group">
                                          <label for="email">Old Password:</label>
                                          <input type="password" name="oldpass" class="form-control">
                                          <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                       </div>
                                       <div class="form-group">
                                          <label for="pwd">New Password:</label>
                                          <input type="password" name="password" class="form-control" id="pwd">
                                       </div>
                                        <div class="form-group">
                                          <label for="pwd">Confirm Password:</label>
                                          <input type="password" name="password_confirmation" class="form-control" id="pwd">
                                       </div>
                                    
                                       <button type="submit" class="btn btn-primary">Submit</button>
                                    
                                 </div>
                              </div>
                              </div>
                        </div>
                     </form>
                 </div>
            </div>
         </div>
      </div>
      </div>
@endsection