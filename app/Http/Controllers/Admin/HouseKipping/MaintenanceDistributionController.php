<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\ItemEntry;
use App\Models\MaintenanceDistribution;
use App\Models\Room;
use App\Models\UnitMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceDistributionController extends Controller
{
    public function issueDepartmentWiseDistribution()
    {
        $items = ItemEntry::where('is_active', 1)->where('is_deleted', 0)->get();
        

        $units = UnitMaster::where('is_active', 1)->where('is_deleted', 0)->get();

        $departments = Department::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('housekipping.maintenance.item_department_issue', compact('items','units','departments'));
    }

    public function issueDepartmentWiseDistributionStore(Request $request)
    {


        $item_count = count($request->item_name);

        for ($i = 0; $i < $item_count; $i++) {
            MaintenanceDistribution::insert([
                'order_id' => $request->order_id,
                'issue_date' => $request->issue_date,
                'department_id' => $request->department_id,
                'item_id' => $request->item_name[$i],
                'qty' => $request->item_qty[$i],
                'unit_id' => $request->item_unit[$i],
                'issued_by' => Auth::user()->id,
                'remarks' => $request->remarks,
                'issued_date' => Carbon::now(),
            ]);
        }



        $notification = array(
            'messege' => 'HouseKeeping Maintenance & Distribution Item Issued successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function issueDepartmentWiseDistributionList()
    {
        $itemIssues = MaintenanceDistribution::with('issuedby')->select(['issue_date', 'issued_by', 'remarks', 'order_id'])->orderBy('order_id', 'desc')->where('is_active', 1)->where('is_deleted', 0)->get();

        $itemIssues = $itemIssues->groupBy('order_id');

        $itemIssues = $itemIssues->all();

        return view('housekipping.maintenance.item_department_issue_list', compact('itemIssues'));
    }

    public function issueDepartmentWiseDistributionedit($id)
    {
        $itemIssues = MaintenanceDistribution::where('order_id', $id)->where('is_active', 1)->where('is_deleted', 0)->get();

        $units = UnitMaster::where('is_active', 1)->where('is_deleted', 0)->get();

        $items = ItemEntry::where('is_active', 1)->where('is_deleted', 0)->get();

        $departments = Department::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('housekipping.maintenance.item_department_issue_edit', compact('items', 'itemIssues','units','departments'));
    }

    public function departmentWiseDistributionAjaxlist(Request $request)
    {

        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $itemIssues = MaintenanceDistribution::with('issuedby')->whereBetween('issue_date', [$request->from_date, $request->to_date])->select(['issue_date', 'issued_by', 'remarks', 'order_id'])->orderBy('order_id', 'desc')->where('is_active', 1)->where('is_deleted', 0)->get();

        //    $itemIssues = $itemIssues->groupBy(['issue_date',function($item){
        //        return $item['issued_by'];
        //    }], $preserveKeys = true);

        $itemIssues = $itemIssues->groupBy('order_id');

        $itemIssues = $itemIssues->all();

        return view('housekipping.maintenance.ajax.department_issue_list', compact('itemIssues'));
        
    }

    public function issueDepartmentWiseDistributionUpdate(Request $request)
    {
        
        $itemsissue = MaintenanceDistribution::where('order_id', $request->order_id)->delete();

        $item_count = count($request->item_name);

        for ($i = 0; $i < $item_count; $i++) {
            MaintenanceDistribution::insert([
                'order_id' => $request->order_id,
                'issue_date' => $request->issue_date,
                'department_id' => $request->department_id,
                'item_id' => $request->item_name[$i],
                'qty' => $request->item_qty[$i],
                'unit_id' => $request->item_unit[$i],
                'issued_by' => Auth::user()->id,
                'remarks' => $request->remarks,
                'issued_date' => Carbon::now(),
            ]);

           
        }



        $notification = array(
            'messege' => 'HouseKeeping Maintenance & Distribution Item Updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.housekeeping.maintenance.distribution.items.issue.list')->with($notification);
    }

    public function departmentWiseDistributionlist()
    {
        $itemIssues = MaintenanceDistribution::where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy('department_id');
        $itemslists = $itemslist->all();
        $departments = Department::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('housekipping.maintenance.item_department_wise_list', compact( 'itemslists','departments'));
    }

    public function departmentwiseDistrubutionAjaxList(Request $request)
    {
        
        

        $itemIssues = MaintenanceDistribution::orwhereBetween('issue_date', [$request->from_date, $request->to_date])->where('department_id',$request->department_id)->where('is_active', 1)->where('is_deleted', 0)->get();

            $itemslist = $itemIssues->groupBy('room_id');
            $itemslists = $itemslist->all();
            return view('housekipping.maintenance.ajax.item_department_wise_ajax_list', compact( 'itemslists'));
    }

    public function dateWiseDistributionlist()
    {
        $itemIssues = MaintenanceDistribution::where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy(['issue_date',function($item){
            return $item['department_id'];
        }], $preserveKeys = true);
       $itemslists = $itemslist->all();
        return view('housekipping.maintenance.item_date_wise_list', compact( 'itemslists'));
    }

    public function issueToDateWiseAjaxList(Request $request)
    {
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        $itemIssues = MaintenanceDistribution::whereBetween('issue_date', [$request->from_date, $request->to_date])->where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy(['issue_date',function($item){
            return $item['department_id'];
        }], $preserveKeys = true);
       $itemslists = $itemslist->all();
        return view('housekipping.maintenance.ajax.issue_date_wise_ajax_list', compact( 'itemslists'));


    }
}
