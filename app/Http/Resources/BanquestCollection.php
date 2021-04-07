<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BanquestCollection extends ResourceCollection
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
                $startdate = strtotime(str_replace('/', '-', $data->date_of_function_form));

                $enddate = strtotime(str_replace('/', '-', $data->date_of_function_to));

                return [
                    'title' => $data->venue->venue_name ?? '',
                    'start' => date('Y-m-d', $startdate),
                    'end' =>date('Y-m-d', $enddate),
                ];
            })
        ];
    }
}
