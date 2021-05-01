<?php

namespace App\Traits;

use App\Models\ChangeTariff;
use App\Models\Checkin;
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

        // return 'This is day'.$day.'This is Default Amount'.$defaultAmount. 'This is Booking NO'.$booking_no .'This In Day'.$inday.'This is Out Day'.$outday.'This is Room No'.$room_no;

        // if($day == 1){
        //     $inday = strtotime($inday);
        //     $inday = date('d/m/Y', $inday);


        //     $outday = strtotime($outday);
        //     $outday = date('d/m/Y', $outday);

        //    $checktarrif = ChangeTariff::where('booking_no', $booking_no)->where('apply_date',$inday)->where('room_no',$room_no)->first();

        //     if($checktarrif){
        //         return $checktarrif->tarrif;
        //     }else{
        //         return $defaultAmount;
        //     }
        // }

        // $this->defaultamount = (int)$defaultAmount;

        // $inday = strtotime($inday);
        // $inday = date('Y-m-d', $inday);


        // $outday = strtotime($outday);
        // $outday = date('Y-m-d', $outday);

        // $period = CarbonPeriod::create($inday,$outday);


        // $countTarif = [];


        // foreach ($period as $key => $date) {
        //    $date=$date->format('d/m/Y');
        //     $checktarrif = ChangeTariff::where('booking_no', $booking_no)->where('apply_date',$date)->where('room_no',$room_no)->first();

        //     if($checktarrif){
        //         $data['date']= $date;   
        //         $data['tarrif']= $checktarrif->tarrif;   
        //         array_push($countTarif,$data);
        //         $this->defaultamount =$checktarrif->tarrif;
        //     }else{
        //         $this->defaultamount =$defaultAmount;
        //         $data['date']=$date;   
        //         $data['tarrif']= $this->defaultamount;   
        //         array_push($countTarif,$data);
        //     }
        // }





        // $totalAmount = 0;

        // if(count($countTarif) == 0){
        //     $totalAmount = $totalAmount+$defaultAmount;
        // }else{
        //     foreach ($countTarif as $row) {
        //         $totalAmount = $totalAmount + $row['tarrif'];
        //     }
        // }

        // return $totalAmount;

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


        return [
            'total_tarrif'=>$totaltarrif,
            'date_show'=>$datewiseshow,
        ];

    }
}
