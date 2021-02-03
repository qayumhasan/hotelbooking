<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Image;

class DepartmentController extends Controller
{
    public function departmentList()
    {
        $departments = Department::where('is_deleted',0)->get();
        return view('backend.department.index',compact('departments'));
    }

    public function departmentStore(Request $request)
    {
        
        $request->validate([
            'department'=>'required',
            'department_image'=>'required',
        ]);

        $departments = new Department();
        $departments->name =$request->department;

        if ($request->hasFile('department_image')) {
            $department_img = $request->file('department_image');
            $imagename = rand(11111111,9999999999) . '.' .$department_img->getClientOriginalExtension();
            Image::make($department_img)->resize(600, 400)->save(base_path('/public/uploads/departments/' . $imagename), 100);
            $departments->image = $imagename;
        }
        
        $departments->save();

        $notification = array(
            'messege' => 'Department Insert Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
        
    }

    public function departmentStatus($id)
    {
        $departments = Department::findOrFail($id);
        if($departments->is_active == 1){
            $departments ->is_active =0;
            $departments ->save();
            $notification = array(
                'messege' => 'Department Status Change Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            $departments ->is_active =1;
            $departments ->save();
            $notification = array(
                'messege' => 'Department Status Change Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);

        }
    }

    public function departmentUpdate(Request $request)
    {
        

        $request->validate([
            'department'=>'required',
        ]);

        $departments = Department::findOrFail($request->id);
        $departments->name =$request->department;

        if ($request->hasFile('department_image')) {

            if ($departments->image) {
                $link = base_path('public/uploads/departments/') . $departments->image;
                unlink($link);
            }

            $department_img = $request->file('department_image');
            $imagename = rand(11111111,9999999999) . '.' .$department_img->getClientOriginalExtension();
            Image::make($department_img)->resize(600, 400)->save(base_path('/public/uploads/departments/' . $imagename), 100);
            $departments->image = $imagename;
        }
        
        $departments->save();

        $notification = array(
            'messege' => 'Department Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);

    }


    public function departmentDelete ($id)
    {
        $departments = Department::findOrFail($id);
        $departments->delete();
        $notification = array(
            'messege' => 'Department Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
        
    }
}
