<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HouseKeepingAdvanceBooking extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $startdate = strtotime(str_replace('/', '-', $data->checkindate));

                $enddate = strtotime(str_replace('/', '-', $data->checkoutdate));

                return [
                    'title' => $data->room->room_no?$data->room->room_no:'',
                    'start' => date('Y-m-d', $startdate),
                    'end' =>date('Y-m-d', $enddate),
                    'url'=> route('admin.housekeeping.advance.booking.room',$data->id),
                ];
            })
        ];
    }
}
