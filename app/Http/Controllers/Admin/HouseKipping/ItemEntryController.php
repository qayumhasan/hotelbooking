<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\ItemEntry;
use App\Models\ItemIssue;
use App\Models\Room;
use App\Models\UnitMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemEntryController extends Controller
{
    public function issueToRoom()
    {
        

        $items = ItemEntry::where('is_active', 1)->where('is_deleted', 0)->get();
        $rooms = Room::where('is_active', 1)->where('is_deleted', 0)->get();
        $units = UnitMaster::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('housekipping.items.item_issue_to_room', compact('rooms', 'items','units'));
    }

    public function itemStore(Request $request)
    {
        // return $request;

        foreach ($request->room_id as $room_id) {

            $item_count = count($request->item_name);

            for ($i = 0; $i < $item_count; $i++) {
                ItemIssue::insert([
                    'order_id' => $request->order_id,
                    'issue_date' => $request->issue_date,
                    'room_id' => $room_id,
                    'item_id' => $request->item_name[$i],
                    'qty' => $request->item_qty[$i],
                    'unit_id' => $request->item_unit[$i],
                    'issued_by' => Auth::user()->id,
                    'remarks' => $request->remarks,
                    'issued_date' => Carbon::now(),
                ]);
            }
        }
        $notification = array(
            'messege' => 'HouseKeeping Item Issued successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function itemStoreList()
    {
        $itemIssues = ItemIssue::with('issuedby')->select(['issue_date', 'issued_by', 'remarks', 'order_id'])->orderBy('order_id', 'desc')->where('is_active', 1)->where('is_deleted', 0)->get();

        //    $itemIssues = $itemIssues->groupBy(['issue_date',function($item){
        //        return $item['issued_by'];
        //    }], $preserveKeys = true);

        $itemIssues = $itemIssues->groupBy('order_id');

        $itemIssues = $itemIssues->all();

        return view('housekipping.items.item_issue_list', compact('itemIssues'));
    }

    public function itemStoreListEdit($id)
    {
        $itemIssues = ItemIssue::where('order_id', $id)->where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy(['item_id', function ($item) {
            return $item['unit_id'];
        }], $preserveKeys = true);
        $itemslist = $itemslist->all();

        $items = ItemEntry::where('is_active', 1)->where('is_deleted', 0)->get();
        $units = UnitMaster::where('is_active', 1)->where('is_deleted', 0)->get();
        $rooms = Room::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('housekipping.items.item_issue_to_room_edit', compact('rooms', 'items', 'itemIssues', 'itemslist','units'));
    }

    public function itemStoreListUpdate(Request $request)
    {
        $itemsissue = ItemIssue::where('order_id', $request->order_id)->delete();


        foreach ($request->room_id as $room_id) {

            $item_count = count($request->item_name);

            for ($i = 0; $i < $item_count; $i++) {
                ItemIssue::insert([
                    'order_id' => $request->order_id,
                    'issue_date' => $request->issue_date,
                    'room_id' => $room_id,
                    'item_id' => $request->item_name[$i],
                    'qty' => $request->item_qty[$i],
                    'unit_id' => $request->item_unit[$i],
                    'issued_by' => Auth::user()->id,
                    'remarks' => $request->remarks,
                    'issued_date' => Carbon::now(),
                ]);
            }
        }
        $notification = array(
            'messege' => 'HouseKeeping Item Issue Updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.housekeeping.distribution.items.issue.list')->with($notification);
    }


    public function itemStoreAjaxList(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $itemIssues = ItemIssue::with('issuedby')->whereBetween('issue_date', [$request->from_date, $request->to_date])->select(['issue_date', 'issued_by', 'remarks', 'order_id'])->orderBy('order_id', 'desc')->where('is_active', 1)->where('is_deleted', 0)->get();

        //    $itemIssues = $itemIssues->groupBy(['issue_date',function($item){
        //        return $item['issued_by'];
        //    }], $preserveKeys = true);

        $itemIssues = $itemIssues->groupBy('order_id');

        $itemIssues = $itemIssues->all();

        return view('housekipping.items.ajax.item_issue_ajax_list', compact('itemIssues'));
    }

    public function issueToRoomWiseList()
    {
        $itemIssues = ItemIssue::where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy('room_id');
        $itemslists = $itemslist->all();


        $rooms = Room::where('is_active', 1)->where('is_deleted', 0)->get();
        return view('housekipping.items.item_room_wise_list', compact('rooms', 'itemslists'));
    }

    public function issueToRoomWiseAjaxList(Request $request)
    {
        if (!$request->room_no) {
            $request->validate([
                'from_date' => 'required',
                'to_date' => 'required',
            ]);
            $itemIssues = ItemIssue::whereBetween('issue_date', [$request->from_date, $request->to_date])->where('is_active', 1)->where('is_deleted', 0)->get();

            $itemslist = $itemIssues->groupBy('room_id');
            $itemslists = $itemslist->all();
            return view('housekipping.items.ajax.issue_room_wise_ajax_list', compact( 'itemslists'));

        }else if(isset($request->room_no)){
            $request->validate([
                'room_no' => 'required',
            ]);
            $itemIssues = ItemIssue::where('room_id',$request->room_no)->where('is_active', 1)->where('is_deleted', 0)->get();

            $itemslist = $itemIssues->groupBy('room_id');
            $itemslists = $itemslist->all();
            return view('housekipping.items.ajax.issue_room_wise_ajax_list', compact( 'itemslists'));
        }
    }

    public function issueToDateWiseList()
    {
        $itemIssues = ItemIssue::where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy(['issue_date',function($item){
            return $item['room_id'];
        }], $preserveKeys = true);
        $itemslists = $itemslist->all();
        return view('housekipping.items.item_date_wise_list', compact( 'itemslists'));
    }

    public function issueToDateWiseAjaxList(Request $request)
    {
        $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',
        ]);

        $itemIssues = ItemIssue::whereBetween('issue_date', [$request->from_date, $request->to_date])->where('is_active', 1)->where('is_deleted', 0)->get();

        $itemslist = $itemIssues->groupBy(['issue_date',function($item){
            return $item['room_id'];
        }], $preserveKeys = true);
        $itemslists = $itemslist->all();
        return view('housekipping.items.ajax.issue_date_wise_ajax_list', compact( 'itemslists'));


    }


    public function getItemSection($id)
    {
        $unit = ItemEntry::findOrFail($id)->unit_name;
        return response()->json($unit);
    }
}
