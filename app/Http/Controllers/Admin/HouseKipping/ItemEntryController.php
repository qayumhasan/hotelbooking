<?php

namespace App\Http\Controllers\Admin\HouseKipping;

use App\Http\Controllers\Controller;
use App\Models\ItemEntry;
use App\Models\Room;
use Illuminate\Http\Request;

class ItemEntryController extends Controller
{
    public function issueToRoom()
    {
        
        $items = ItemEntry::where('is_active',1)->where('is_deleted',0)->get();
        $rooms=Room::where('is_active',1)->where('is_deleted',0)->get();
        return view('housekipping.items.item_issue_to_room',compact('rooms','items'));
    }

    public function itemStore(Request $request)
    {
        // return $request;
        
        foreach ($request->room_id as $room_id) {
            
            $item_count = count($request->item_name);

            for ($i=0; $i <$item_count ; $i++) { 
                
                
            }
            
        }
    }
}
