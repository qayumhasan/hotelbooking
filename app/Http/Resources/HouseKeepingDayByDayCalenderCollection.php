<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HouseKeepingDayByDayCalenderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $startdate = strtotime(str_replace('/', '-', $data->checkindate));

                return [
                    'title' => isset($data->room->room_no)?$data->room->room_no:'No Room',
                    'start' => date('Y-m-d', $startdate),
                    'url'=> route('admin.housekeeping.advance.booking.room',$data->id),
                ];
            })
        ];
    }
}
