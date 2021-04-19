<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    public function __construct(){
    	$this->middleware('admin');
    }

    public function index(){
        $allrole=UserRole::get();
        return view('backend.user_role.index',compact('allrole'));
    }
// update

    public function update(Request $request){
        $id=$request->id;
        $name=$request->newname;
        $status=$request->status;
      

        $data = UserRole::findorFail($id);
        if($name=='foodandbeverage'){
            $data->food_beverage=$status;
        }elseif($name=='front_office'){
            $data->front_office=$status;
        }
        elseif($name=='restuarent'){
            $data->restuarent=$status;
        }
        elseif($name=='banquet'){
            $data->banquet=$status;
        }
        elseif($name=='payroll'){
            $data->payroll=$status;
        }
        elseif($name=='accounts'){
            $data->accounts=$status;
        }
        elseif($name=='admin'){
            $data->admin=$status;
        }
        elseif($name=='stock'){
            $data->stock=$status;
        }
        elseif($name=='inventory'){
            $data->inventory=$status;
        }
        elseif($name=='housekipping'){
            $data->house_kipping=$status;
        }
        $data->save();
        return response("ok");

    }
    
}
