<?php

namespace App\Traits;

use App\Models\ChangeTariff;
use App\Models\Checkin;
use App\Models\Checkout;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;

class CalculatePerDayRoomTarrif
{

    public $defaultAmount = 0;
    public function getTotalTarrif($defaultAmount, $booking_no, $inday, $outday, $room_no)
    {


        $checktarrif = ChangeTariff::where('booking_no', $booking_no)->where('room_no', $room_no)->latest()->first();
        $totaltarrif = 0;

        $datewiseshow = [];
        if ($checktarrif) {

            // if change tariff exist
            $getchangetarif = ChangeTariff::where('booking_no', $booking_no)->where('room_no', $room_no)->get();


            foreach ($getchangetarif as $row) {
                $totaltarrif += $row->old_tarrif * $row->old_apply_day;

                $item['start_date'] = $row->start_date;
                $item['end_date'] = $row->end_date;
                $item['tarrif'] = $row->old_tarrif;
                $item['day'] = $row->old_apply_day;

                array_push($datewiseshow,$item);
            }

            $startdate =$checktarrif->end_date;
            $enddate =  $outday;

            $startdate = strtotime($startdate);
            $startdate = date('Y-m-d', $startdate);

            $enddate = strtotime($enddate);
            $enddate = date('Y-m-d', $enddate);


            $date = Carbon::parse($startdate);
            $now = Carbon::parse($enddate);
            $diff = $date->diffInDays($now);

            $diff = $diff == 0?1:$diff;
            
            $amount = $checktarrif->new_tarrif * $diff;


            $startday = date('Y-m-d', strtotime($startdate.' +1 day'));

            if($diff != 1){
                $item['start_date'] =$startday;
                $item['end_date'] =$enddate;
                $item['tarrif'] = $checktarrif->new_tarrif;
                $item['day'] =   $diff;
                array_push($datewiseshow,$item);
                $totaltarrif +=$checktarrif->new_tarrif * $diff;
            }

        }else{
            // if change tarrif not exits
            $startdate = strtotime($inday);
            $startdate = date('Y-m-d', $startdate);

            $enddate = strtotime($outday);
            $enddate = date('Y-m-d', $enddate);

            $date = Carbon::parse($startdate);
            $now = Carbon::parse($enddate);
            $diff = $date->diffInDays($now);
            $diff = $diff==0 ?1:$diff;

            $totaltarrif += $diff * $defaultAmount;
            $amount = $diff * $defaultAmount;
            $item['start_date'] = $inday;
            $item['end_date'] = $outday;
            $item['tarrif'] = $defaultAmount;
            $item['day'] = $diff;
            array_push($datewiseshow,$item);
        }



        $checkout = Checkout::where('booking_no', $booking_no)->first();
        if($checkout){
            $checkout->details = json_encode($datewiseshow);
            $checkout->save();
        }


        return [
            'total_tarrif'=>$totaltarrif,
            'date_show'=>$datewiseshow,
        ];

    }
}
